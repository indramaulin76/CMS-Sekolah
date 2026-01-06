<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Headmaster;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure Headmaster exists
        if (Headmaster::count() === 0) {
            Headmaster::create([
                'name' => 'Drs. H. Ahmad Dahlan, M.Pd.',
                'greeting' => 'Selamat datang di SMA Tunas Harapan. Kami berkomitmen memberikan pendidikan terbaik.',
                'photo' => null,
                'is_active' => true,
            ]);
        }

        // Create Waka
        $wakas = [
            ['name' => 'Budi Santoso, S.Pd.', 'position' => 'Waka Kurikulum', 'type' => 'waka', 'order' => 1],
            ['name' => 'Siti Aminah, M.Pd.', 'position' => 'Waka Kesiswaan', 'type' => 'waka', 'order' => 2],
            ['name' => 'Rudi Hartono, S.T.', 'position' => 'Waka Sarpras', 'type' => 'waka', 'order' => 3],
            ['name' => 'Dewi Sartika, S.Pd.', 'position' => 'Waka Humas', 'type' => 'waka', 'order' => 4],
        ];

        foreach ($wakas as $waka) {
            Staff::create($waka);
        }

        // Create Teachers
        $teachers = [
            ['name' => 'Joko Widodo, S.Pd.', 'position' => 'Guru Matematika', 'type' => 'teacher'],
            ['name' => 'Megawati, S.Pd.', 'position' => 'Guru Bahasa Indonesia', 'type' => 'teacher'],
            ['name' => 'Susilo Bambang, M.Sc.', 'position' => 'Guru Fisika', 'type' => 'teacher'],
            ['name' => 'Abdurrahman, S.Ag.', 'position' => 'Guru PAI', 'type' => 'teacher'],
            ['name' => 'Bacharuddin Jusuf, M.T.', 'position' => 'Guru TIK', 'type' => 'teacher'],
        ];

        foreach ($teachers as $teacher) {
            Staff::create($teacher);
        }
    }
}
