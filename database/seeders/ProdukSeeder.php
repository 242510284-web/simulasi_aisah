<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data produk satu per satu di dalam array ini
        $produkList = [
            [
                'user_id'    => 1, // Sesuaikan dengan ID user/admin kamu
                'nama'       => 'Kopi Susu Gula Aren',
                'harga_beli' => 10000,
                'harga_jual' => 18000,
                'stok'       => 50,
            ],
            [
                'user_id'    => 1,
                'nama'       => 'Teh Tarik',
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'stok'       => 100,
            ],
            // Tambahkan data produk lainnya di sini...
        ];

        foreach ($produkList as $data) {
            Produk::create($data);
        }
    }
}