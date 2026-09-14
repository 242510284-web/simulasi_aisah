<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanService
{
    public function ringkasanHariIni(): array
    {
        $data = DB::table('penjualan')
            ->whereDate('created_at', Carbon::today())
            ->selectRaw("
                COUNT(*) as total_transaksi,
                COALESCE(SUM(total_pembayaran), 0) as total_penjualan,
                COALESCE(SUM(CASE WHEN UPPER(metode_pembayaran) IN ('CASH', 'TUNAI') THEN total_pembayaran ELSE 0 END), 0) as total_cash,
                COALESCE(SUM(CASE WHEN UPPER(metode_pembayaran) NOT IN ('CASH', 'TUNAI') THEN total_pembayaran ELSE 0 END), 0) as total_non_tunai
            ")
            ->first();

        return [
            'total_transaksi' => $data->total_transaksi ?? 0,
            'total_penjualan' => $data->total_penjualan ?? 0,
            'total_cash'      => $data->total_cash ?? 0,
            'total_non_tunai'  => $data->total_non_tunai ?? 0,
        ];
    }

    public function produkTerlarisHariIni(int $limit = 5)
    {
        return DB::table('item_penjualan')
            ->join('penjualan', 'penjualan.id', '=', 'item_penjualan.penjualan_id')
            ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
            ->whereDate('penjualan.created_at', Carbon::today())
            ->groupBy('produk.id', 'produk.nama', 'produk.stok')
            ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(item_penjualan.kuantitas) as total_terjual')
            )
            ->orderByDesc('total_terjual')
            ->limit($limit)
            ->get();
    }
}