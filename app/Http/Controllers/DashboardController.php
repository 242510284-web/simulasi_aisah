<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Inject service melalui Constructor Property Promotion
     */
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {}

    /**
     * Menampilkan halaman dashboard utama
     */
    public function index()
    {
        // Mengambil data ringkasan penjualan hari ini
        $ringkasan = $this->laporanService->ringkasanHariIni();

        return view('dashboard', [
            'tanggalHariIni'         => Carbon::now(),
            
            // Mapping variabel agar sesuai dengan variabel di view dashboard.blade.php
            'totalPenjualanHariIni'  => $ringkasan['total_penjualan'] ?? 0,
            'jumlahTransaksiHariIni' => $ringkasan['total_transaksi'] ?? 0,
            'totalTunai'             => $ringkasan['total_cash'] ?? 0,
            'totalNonTunai'          => $ringkasan['total_non_tunai'] ?? 0,
            
            // Variabel stok disesuaikan dengan nama di Blade ($stokRendah & $produkHabis)
            'stokRendah'             => $this->stokService->produkStokRendah(),
            'produkHabis'            => $this->stokService->produkStokHabis(),
            
            'produkTerlaris'        => $this->laporanService->produkTerlarisHariIni(),
        ]);
    }
}