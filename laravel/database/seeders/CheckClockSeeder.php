<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\CheckClock;
use Carbon\Carbon;

class CheckClockSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 1 karyawan aktif (pastikan ada employee di DB dulu!)
        $employee = Employee::first(); // atau ->where('employment_status', 'aktif')->first();
        if (!$employee) {
            $this->command->info('Belum ada employee! Jalankan UserSeeder atau EmployeeSeeder dulu.');
            return;
        }

        $today = Carbon::today(); // 2025-11-22 (sesuai tanggal sekarang)

        // === DATA UNTUK TESTING BERBAGAI KONDISI ===

        // 1. Hari ini (22 Nov 2025) → sudah Clock In, belum Clock Out
        CheckClock::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'check_clock_type' => 0,
                'date' => $today,
            ],
            [
                'clock_in' => '08:15:00',
                'clock_out' => '16:15:00',
                'latitude' => $employee->department->latitude,
                'longitude' => $employee->department->longitude,
                'accuracy_meters' => 15,
            ]
        );

        // 2. Kemarin (21 Nov) → sudah Clock In & Out (normal 8 jam)
        CheckClock::updateOrCreate(
            [
                'employee_id' => $employee->id,
                'check_clock_type' => 0,
                'date' => $today->clone()->subDay(),
            ],
            [
                'clock_in' => '07:55:00',
                'clock_out' => '17:10:00', // 9 jam 15 menit → lembur 1 jam 15 menit
                'latitude' => $employee->department->latitude + 0.0001,
                'longitude' => $employee->department->longitude + 0.0001,
                'accuracy_meters' => 20,
            ]
        );
    }
}
