<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $exists = NewsletterSubscriber::where('email', $validated['email'])->exists();

        if ($exists) {
            return back()->with('info', 'Email sudah terdaftar.');
        }

        NewsletterSubscriber::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'subscribed_at' => now(),
        ]);

        Mail::to($validated['email'])->send(
            new WelcomeMail($validated['email'], $validated['name'] ?? null)
        );

        return back()->with('success', 'Terima kasih! Email selamat datang sudah dikirim ke ' . $validated['email']);
    }
}
