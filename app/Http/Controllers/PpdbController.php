<?php

namespace App\Http\Controllers;

use App\Models\PpdbPeriod;
use App\Models\PpdbRegistration;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PpdbController extends Controller
{
    public function index(): View
    {
        $activePeriod = PpdbPeriod::active()->open()->first();
        // Settings are now globally available via View Composer in AppServiceProvider
        return view('ppdb.index', compact('activePeriod'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // reCAPTCHA validation
            'g-recaptcha-response' => ['nullable', new ReCaptcha],
            
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birth_place' => 'required|string|max:100',
            'birth_date' => 'required|date',
            'religion' => 'required|string',
            'nisn' => 'required|string|digits:10|unique:ppdb_registrations,nisn',
            'previous_school' => 'required|string|max:255',
            'nik' => 'required|string|digits:16|unique:ppdb_registrations,nik',
            'kk_number' => 'required|string|digits:16',
            'parent_name' => 'required|string|max:255',
            'parent_address' => 'required|string',
            'parent_occupation' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'parent_phone' => 'required|string|max:20',
            
            // Optional/Hidden fields handled in controller or nullable
            'nickname' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',
            'nisn.unique' => 'NISN ini sudah terdaftar.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'kk_number.digits' => 'Nomor KK harus terdiri dari 16 digit angka.',
        ]);

        // Sanitize text inputs to prevent XSS
        $validated['full_name'] = strip_tags($validated['full_name']);
        $validated['parent_name'] = strip_tags($validated['parent_name']);
        $validated['parent_address'] = strip_tags($validated['parent_address']);
        $validated['previous_school'] = strip_tags($validated['previous_school']);
        $validated['parent_occupation'] = strip_tags($validated['parent_occupation']);
        if (!empty($validated['nickname'])) {
            $validated['nickname'] = strip_tags($validated['nickname']);
        }
        if (!empty($validated['address'])) {
            $validated['address'] = strip_tags($validated['address']);
        }

        $period = PpdbPeriod::active()->open()->firstOrFail();
        $validated['ppdb_period_id'] = $period->id;
        $validated['status'] = 'pending';
        
        // Handle optional fields that are required by DB
        // Set email to null instead of fake placeholder
        $validated['email'] = $validated['email'] ?? null;
        
        if (empty($validated['address'])) {
            $validated['address'] = $validated['parent_address']; // Use parent address as student address
        }

        try {
            $registration = PpdbRegistration::create($validated);
            
            // Store registration code in session for access control
            session(['ppdb_registration_code' => $registration->registration_code]);
            
            return redirect()->route('ppdb.success', $registration->registration_code);
        } catch (\Exception $e) {
            \Log::error('PPDB Registration Error: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'])
                ->withInput();
        }
    }

    public function success(string $code): View
    {
        // Verify session access to prevent enumeration attacks
        $sessionCode = session('ppdb_registration_code');
        if ($sessionCode !== $code) {
            abort(403, 'Akses tidak diizinkan. Silakan daftar terlebih dahulu.');
        }
        
        $registration = PpdbRegistration::where('registration_code', $code)->firstOrFail();
        return view('ppdb.success', compact('registration'));
    }

    public function printCard(string $code): View
    {
        // Allow access if user is authenticated admin OR has valid session code
        $sessionCode = session('ppdb_registration_code');
        $isAdmin = auth()->check();
        
        if (!$isAdmin && $sessionCode !== $code) {
            abort(403, 'Akses tidak diizinkan. Silakan daftar terlebih dahulu.');
        }
        
        $registration = PpdbRegistration::where('registration_code', $code)
            ->with('period')
            ->firstOrFail();
        return view('ppdb.kartu-pendaftaran', compact('registration'));
    }

    public function announcement(): View
    {
        $activePeriod = PpdbPeriod::active()->first();
        $announcements = [];
        // Settings are now globally available via View Composer in AppServiceProvider
        
        if ($activePeriod && $activePeriod->announcement_date <= now()) {
            $announcements = PpdbRegistration::where('ppdb_period_id', $activePeriod->id)
                ->whereIn('status', ['accepted', 'rejected'])
                ->get();
        }

        return view('ppdb.announcement', compact('activePeriod', 'announcements'));
    }

    public function exportPdf(string $code)
    {
        // Allow access if user is authenticated admin OR has valid session code
        $sessionCode = session('ppdb_registration_code');
        $isAdmin = auth()->check();
        
        if (!$isAdmin && $sessionCode !== $code) {
            abort(403, 'Akses tidak diizinkan. Silakan daftar terlebih dahulu.');
        }
        
        $registration = PpdbRegistration::where('registration_code', $code)
            ->with('period')
            ->firstOrFail();
        
        $settings = \App\Models\GeneralSetting::first();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('ppdb.export-pdf', [
            'registration' => $registration,
            'settings' => $settings,
        ]);
        
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Kartu-Pendaftaran-' . $code . '.pdf');
    }
}
