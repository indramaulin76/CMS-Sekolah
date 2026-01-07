<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $staffs = [
            [
                'name' => 'Didi Permana, S.H.I',
                'position' => 'Kepala Sekolah',
                'type' => 'teacher', // Headmaster is technically a teacher assigned as head
                'order' => 1,
            ],
            [
                'name' => 'Salim, S.Pd.I',
                'position' => 'Waka Kurikulum & Guru PAI',
                'type' => 'waka',
                'order' => 2,
            ],
            [
                'name' => 'Julianto, S.Pd',
                'position' => 'Pembina OSIS & Guru B. Inggris',
                'type' => 'teacher',
                'order' => 3,
            ],
            [
                'name' => 'Sri Mulyati, S.Pd',
                'position' => 'Guru B. Indonesia',
                'type' => 'teacher',
                'order' => 4,
            ],
            [
                'name' => 'Lutfi Agung Pambudi, M. Pd',
                'position' => 'Guru Matematika Wajib',
                'type' => 'teacher',
                'order' => 5,
            ],
            [
                'name' => 'Vidia Laela, S.BIO',
                'position' => 'Guru Biologi & BK',
                'type' => 'teacher',
                'order' => 6,
            ],
            [
                'name' => 'Dwiana Agustin Hadiningrum, S.Pd',
                'position' => 'Guru B. Inggris',
                'type' => 'teacher',
                'order' => 7,
            ],
            [
                'name' => 'Rudini Irawan, S.Pd',
                'position' => 'Guru Sosiologi & BK',
                'type' => 'teacher',
                'order' => 8,
            ],
            [
                'name' => 'Muhamad Kurniansyah, S.Pd',
                'position' => 'Guru Sejarah Indonesia',
                'type' => 'teacher',
                'order' => 9,
            ],
            [
                'name' => 'Ahmad Ridwan Komarudin, Amd, Kom',
                'position' => 'Guru PJOK',
                'type' => 'teacher',
                'order' => 10,
            ],
            [
                'name' => 'Vina Alda Fauzia, S.A.P',
                'position' => 'Guru SBK',
                'type' => 'teacher',
                'order' => 11,
            ],
            [
                'name' => 'Umi Hani, S.Pd',
                'position' => 'Guru Geografi',
                'type' => 'teacher',
                'order' => 12,
            ],
            [
                'name' => 'Ruslan Abdul Gani Umar, S.Pd',
                'position' => 'Guru Matematika Peminatan',
                'type' => 'teacher',
                'order' => 13,
            ],
            [
                'name' => 'Dianto Saputra, S.H',
                'position' => 'Guru PPKN',
                'type' => 'teacher',
                'order' => 14,
            ],
            [
                'name' => 'Michael Saputra',
                'position' => 'Guru Ekonomi',
                'type' => 'teacher',
                'order' => 15,
            ],
            [
                'name' => 'Damartyas Hidayati, S.Si',
                'position' => 'Guru Kimia',
                'type' => 'teacher',
                'order' => 16,
            ],
            [
                'name' => 'Fikri Zain, S.Pd',
                'position' => 'Guru Fisika',
                'type' => 'teacher',
                'order' => 17,
            ],
            [
                'name' => 'Septiana, S.Pd',
                'position' => 'Kepala TU',
                'type' => 'staff',
                'order' => 18,
            ],
            [
                'name' => 'Nailatus Shoffy',
                'position' => 'Staf TU',
                'type' => 'staff',
                'order' => 19,
            ],
            [
                'name' => 'Basuki',
                'position' => 'Sarpras/K3',
                'type' => 'staff',
                'order' => 20,
            ],
        ];

        foreach ($staffs as $staff) {
            Staff::create(array_merge($staff, [
                'is_active' => true,
                'nip' => null, // Default null as requested data didn't have NIP
                'photo' => null,
            ]));
        }
    }
}
