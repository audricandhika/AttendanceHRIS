<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    public function run(): void
    {
        $holidays = [
            // Januari
            ['date' => '2025-01-01', 'name' => 'Tahun Baru Masehi 2025 (Libur Nasional)'],
            ['date' => '2025-01-27', 'name' => 'Isra Mi\'raj Nabi Muhammad SAW (Libur Nasional)'],
            ['date' => '2025-01-28', 'name' => 'Tahun Baru Imlek 2576 Kongzili (Libur Nasional)'],
            ['date' => '2025-01-29', 'name' => 'Cuti Bersama Tahun Baru Imlek 2576 Kongzili'],
            // Maret
            ['date' => '2025-03-28', 'name' => 'Cuti Bersama Hari Suci Nyepi Tahun Baru Saka 1947'],
            ['date' => '2025-03-29', 'name' => 'Hari Suci Nyepi Tahun Baru Saka 1947 (Libur Nasional)'],
            // April (Idul Fitri 1446 H)
            ['date' => '2025-03-31', 'name' => 'Hari Raya Idul Fitri 1446 H (1 Syawal) (Libur Nasional)'],
            ['date' => '2025-04-01', 'name' => 'Hari Raya Idul Fitri 1446 H (2 Syawal) (Libur Nasional)'],
            ['date' => '2025-04-02', 'name' => 'Cuti Bersama Idul Fitri 1446 H'],
            ['date' => '2025-04-03', 'name' => 'Cuti Bersama Idul Fitri 1446 H'],
            ['date' => '2025-04-04', 'name' => 'Cuti Bersama Idul Fitri 1446 H'],
            ['date' => '2025-04-07', 'name' => 'Cuti Bersama Idul Fitri 1446 H'],
            ['date' => '2025-04-18', 'name' => 'Wafat Yesus Kristus / Good Friday (Libur Nasional)'],
            // Mei
            ['date' => '2025-05-01', 'name' => 'Hari Buruh Internasional (Libur Nasional)'],
            ['date' => '2025-05-12', 'name' => 'Hari Raya Waisak 2569 (Libur Nasional)'],
            ['date' => '2025-05-13', 'name' => 'Cuti Bersama Hari Raya Waisak 2569'],
            ['date' => '2025-05-29', 'name' => 'Kenaikan Yesus Kristus (Libur Nasional)'],
            ['date' => '2025-05-30', 'name' => 'Cuti Bersama Kenaikan Yesus Kristus'],
            // Juni
            ['date' => '2025-06-01', 'name' => 'Hari Lahir Pancasila (Libur Nasional)'],
            ['date' => '2025-06-06', 'name' => 'Hari Raya Idul Adha 1446 H (Libur Nasional)'],
            ['date' => '2025-06-09', 'name' => 'Cuti Bersama Hari Raya Idul Adha 1446 H'],
            // Agustus
            ['date' => '2025-08-17', 'name' => 'Hari Kemerdekaan Republik Indonesia ke-80 (Libur Nasional)'],
            ['date' => '2025-08-18', 'name' => 'Cuti Bersama Hari Kemerdekaan RI ke-80'],  // Tambahan update Agustus 2025
            // September
            ['date' => '2025-09-05', 'name' => 'Maulid Nabi Muhammad SAW (Libur Nasional)'],
            // Desember
            ['date' => '2025-12-25', 'name' => 'Hari Raya Natal (Libur Nasional)'],
            ['date' => '2025-12-26', 'name' => 'Cuti Bersama Hari Raya Natal'],
        ];

        // Clear & insert untuk akurasi
        DB::table('holidays')->truncate();
        DB::table('holidays')->insert($holidays);
    }
}
