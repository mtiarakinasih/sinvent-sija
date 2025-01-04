@extends('backend.layouts.adm_template')
@section('content')
<div class="row">
    <div class="card border-0 shadow-sm rounded w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h4>Detail Barang</h4>
                </div>
            </div>

            <div class="row">
                @if($rsetBarang)
                <div class="col-12">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $rsetBarang->id }}</td>
                            </tr>
                            <tr>
                                <th>Merk</th>
                                <td>{{ $rsetBarang->merk }}</td>
                            </tr>
                            <tr>
                                <th>Seri</th>
                                <td>{{ $rsetBarang->seri }}</td>
                            </tr>
                            <tr>
                                <th>Spesifikasi</th>
                                <td>{{ $rsetBarang->spesifikasi }}</td>
                            </tr>
                            <tr>
                                <th>Stok</th>
                                <td>{{ $rsetBarang->stok }}</td>
                            </tr>
                            <tr>
                            <th>Kategori</th>
                                <td>{{ $rsetBarang->deskripsi ?? 'Tidak ada kategori' }}</td>
                            </tr>
                            <tr>
                            <th>Keterangan</th>
                                <td>{{ $rsetBarang->ket ?? 'Tidak ada keterangan' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <p>Data Barang tidak ditemukan.</p>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('barang.index') }}" class="btn btn-md btn-dark mb-3 mx-auto">KEMBALI</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
