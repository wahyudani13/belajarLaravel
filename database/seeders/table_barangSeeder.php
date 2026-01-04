<?php

namespace Database\Seeders;

// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class table_barangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('table_barang')->insert([
            'nama' => 'Barang ke - ' . rand(1, 100),
            'quantity' => rand(1, 100),
            'keterangan' => 'ini keterangan ke - ' . rand(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // DB::table('table_barang')->insert([]);
    }
}
