@extends('backend.layouts.adm_template')

@section('content')
<div class="row">
    <div class="card border-0 shadow-sm rounded w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h4>Detail Barang Keluar</h4>
                </div>
            </div>

            <div class="row">
                @if($rsetBarangKeluar)
                <div class="col-12">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $rsetBarangKeluar->id }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Keluar</th>
                                <td>{{ $rsetBarangKeluar->tgl_keluar }}</td>
                            </tr>
                            <tr>
                                <th>Quantity Masuk</th>
                                <td>{{ $rsetBarangKeluar->qty_keluar }}</td>
                            </tr>
                            <tr>
                                <th>Barang</th>
                                <td>{{ $rsetBarangKeluar->barang->merk ?? 'Tidak ada barang' }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $rsetBarangKeluar->barang->kategori->kategori ?? 'Tidak ada kategori' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <p>Data Barang Keluar tidak ditemukan.</p>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-dark mb-3 mx-auto">KEMBALI</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
