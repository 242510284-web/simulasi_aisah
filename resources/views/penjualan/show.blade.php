@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

{{-- Style CSS Khusus Cetak Struk Thermal 80mm --}}
<style>
    @media print {
        /* Sembunyikan elemen navigasi dan tombol saat dicetak */
        nav, .navbar, .btn, .no-print, header, footer {
            display: none !important;
        }

        /* Set ukuran kertas ke struk thermal 80mm */
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            background: #fff !important;
            font-family: 'Courier New', Courier, monospace !important;
            font-size: 10pt;
            color: #000 !important;
            padding: 4mm;
            margin: 0;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Header Struk Kasir */
        .struk-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .struk-header h4 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
        }

        /* Tabel Struk Kasir */
        .table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-bottom: 8px !important;
        }

        .table th, .table td {
            font-size: 9pt !important;
            padding: 2px 0 !important;
            border: none !important;
            background: transparent !important;
            color: #000 !important;
        }

        .border-dashed {
            border-bottom: 1px dashed #000 !important;
        }

        .border-double {
            border-top: 1px dashed #000 !important;
            border-bottom: 3px double #000 !important;
        }
    }
</style>

{{-- Navbar Hanya Muncul di Layar Monitor --}}
<div class="no-print">
    @include('layouts.navbar')
</div>

<div class="container my-4">

    {{-- Header Struk Kasir (Hanya Muncul Saat Dicetak) --}}
    <div class="d-none d-print-block struk-header">
        <h4>POS CAFCA</h4>
        <p class="mb-0" style="font-size: 8pt;">Toko Perlengkapan Olahraga</p>
        <p class="mb-0" style="font-size: 8pt;">Jl. SMKN 4 Tasikmalaya</p>
    </div>

    {{-- Judul Halaman dan Tombol Aksi --}}
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h3 class="fw-bold text-primary m-0">Detail Transaksi #{{ $penjualan->id }}</h3>
        <div class="d-flex gap-2">
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm rounded-3">
                ← Kembali
            </a>
            {{-- Tombol Cetak Struk --}}
            <button onclick="window.print()" class="btn btn-success btn-sm rounded-3 fw-bold">
                🖨️ Cetak Struk
            </button>
        </div>
    </div>

    {{-- Kartu Info Transaksi --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row gy-3">
                <div class="col-md-3">
                    <small class="text-muted d-block">Tanggal Transaksi</small>
                    <strong class="fs-6">{{ $penjualan->created_at->format('d-m-Y H:i:s') }}</strong>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Kasir</small>
                    <strong class="fs-6">{{ $penjualan->user->name ?? '-' }}</strong>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Metode Pembayaran</small>
                    <span class="badge bg-info text-dark px-3 py-1 fw-bold">
                        {{ $penjualan->metode_pembayaran ?? '-' }}
                    </span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Status</small>
                    <span class="badge {{ $penjualan->status == 'COMPLETED' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-1">
                        {{ $penjualan->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Produk yang Dibeli --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 no-print">Daftar Produk</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light border-dashed">
                        <tr>
                            <th class="no-print" style="width: 40px;">#</th>
                            <th>Nama Produk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan->itemPenjualan as $index => $item)
                        <tr>
                            <td class="no-print">{{ $index + 1 }}</td>
                            <td>{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->kuantitas }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Tidak ada item produk pada transaksi ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="border-double">
                        <tr class="table-primary fw-bold fs-5">
                            <td colspan="3" class="text-end py-2">Total Pembayaran:</td>
                            <td colspan="2" class="text-end py-2">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Pesan Footer Struk Kasir (Hanya Muncul Saat Dicetak) --}}
            <div class="d-none d-print-block text-center mt-3 pt-2 border-dashed">
                <p class="mb-1" style="font-size: 8pt;">*** Terima Kasih ***</p>
                <p class="mb-0" style="font-size: 7pt;">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
            </div>
        </div>
    </div>
</div>

@endsection