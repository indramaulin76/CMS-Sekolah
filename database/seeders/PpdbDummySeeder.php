<?php

namespace Database\Seeders;

use App\Models\PpdbPeriod;
use App\Models\PpdbRegistration;
use Illuminate\Database\Seeder;

class PpdbDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create PPDB Period - Gelombang 1 2026
        $period = PpdbPeriod::updateOrCreate(
            ['academic_year' => '2026/2027', 'name' => 'Gelombang 1'],
            [
                'registration_start' => '2026-01-06 00:00:00',
                'registration_end' => '2026-01-07 23:59:59',
                'announcement_date' => '2026-01-07 12:00:00',
                'quota' => 120,
                'status' => 'active',
                'description' => '<p><strong>Selamat datang di PPDB SMA Tunas Harapan Tahun Ajaran 2026/2027!</strong></p>
<p>Pendaftaran Gelombang 1 dibuka secara online. Silakan lengkapi formulir dengan data yang benar dan valid.</p>
<p><em>Kuota penerimaan terbatas 120 siswa.</em></p>',
                'requirements' => '<ul>
<li>Fotokopi Kartu Keluarga (KK) - 2 lembar</li>
<li>Fotokopi Akta Kelahiran - 2 lembar</li>
<li>Fotokopi Ijazah SMP/MTs atau Surat Keterangan Lulus (SKL) - 2 lembar</li>
<li>Fotokopi SKHUN atau Rapor semester 1-5 - 2 lembar</li>
<li>Pas Foto 3x4 latar merah - 4 lembar</li>
<li>Fotokopi KTP Orang Tua - 2 lembar</li>
</ul>
<p><strong>Catatan:</strong> Semua berkas di atas wajib dibawa saat verifikasi ke sekolah.</p>',
            ]
        );

        // Create 5 dummy students
        $students = [
            [
                'full_name' => 'Ahmad Rizky Pratama',
                'nickname' => 'Rizky',
                'gender' => 'male',
                'birth_place' => 'Jakarta',
                'birth_date' => '2010-03-15',
                'religion' => 'Islam',
                'nisn' => '0012345678',
                'previous_school' => 'SMP Negeri 1 Jakarta',
                'nik' => '1234567890123456',
                'kk_number' => '1234567890123457',
                'parent_name' => 'Budi Pratama',
                'parent_address' => 'Jl. Merdeka No. 10, Jakarta Selatan',
                'parent_occupation' => 'Pegawai Swasta',
                'phone' => '081234567890',
                'parent_phone' => '081234567891',
                'status' => 'pending',
            ],
            [
                'full_name' => 'Siti Nurhaliza Putri',
                'nickname' => 'Siti',
                'gender' => 'female',
                'birth_place' => 'Bandung',
                'birth_date' => '2010-07-22',
                'religion' => 'Islam',
                'nisn' => '0012345679',
                'previous_school' => 'SMP Negeri 2 Bandung',
                'nik' => '2234567890123456',
                'kk_number' => '2234567890123457',
                'parent_name' => 'Agus Hidayat',
                'parent_address' => 'Jl. Asia Afrika No. 25, Bandung',
                'parent_occupation' => 'Wiraswasta',
                'phone' => '082234567890',
                'parent_phone' => '082234567891',
                'status' => 'pending',
            ],
            [
                'full_name' => 'Muhammad Farhan Alfarizi',
                'nickname' => 'Farhan',
                'gender' => 'male',
                'birth_place' => 'Surabaya',
                'birth_date' => '2010-11-08',
                'religion' => 'Islam',
                'nisn' => '0012345680',
                'previous_school' => 'MTs Negeri 1 Surabaya',
                'nik' => '3234567890123456',
                'kk_number' => '3234567890123457',
                'parent_name' => 'Hendra Wijaya',
                'parent_address' => 'Jl. Pemuda No. 55, Surabaya',
                'parent_occupation' => 'Guru',
                'phone' => '083234567890',
                'parent_phone' => '083234567891',
                'status' => 'verified',
            ],
            [
                'full_name' => 'Dewi Anggraini Kusuma',
                'nickname' => 'Dewi',
                'gender' => 'female',
                'birth_place' => 'Yogyakarta',
                'birth_date' => '2010-05-30',
                'religion' => 'Kristen',
                'nisn' => '0012345681',
                'previous_school' => 'SMP Kristen 1 Yogyakarta',
                'nik' => '4234567890123456',
                'kk_number' => '4234567890123457',
                'parent_name' => 'Stefanus Kusuma',
                'parent_address' => 'Jl. Malioboro No. 88, Yogyakarta',
                'parent_occupation' => 'Dokter',
                'phone' => '084234567890',
                'parent_phone' => '084234567891',
                'status' => 'accepted',
            ],
            [
                'full_name' => 'Reza Mahendra Putra',
                'nickname' => 'Reza',
                'gender' => 'male',
                'birth_place' => 'Semarang',
                'birth_date' => '2010-09-12',
                'religion' => 'Islam',
                'nisn' => '0012345682',
                'previous_school' => 'SMP Negeri 3 Semarang',
                'nik' => '5234567890123456',
                'kk_number' => '5234567890123457',
                'parent_name' => 'Andi Mahendra',
                'parent_address' => 'Jl. Pandanaran No. 100, Semarang',
                'parent_occupation' => 'Pengusaha',
                'phone' => '085234567890',
                'parent_phone' => '085234567891',
                'status' => 'rejected',
                'notes' => '[REJECTED] Dokumen tidak lengkap - KK belum dilegalisir',
            ],
        ];

        foreach ($students as $student) {
            PpdbRegistration::updateOrCreate(
                ['nisn' => $student['nisn']],
                array_merge($student, [
                    'ppdb_period_id' => $period->id,
                    'address' => $student['parent_address'],
                ])
            );
        }

        $this->command->info('PPDB dummy data created successfully!');
        $this->command->info('- Period: Gelombang 1 2026/2027');
        $this->command->info('- Students: 5 registrations');
    }
}
