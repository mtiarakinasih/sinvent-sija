@extends('backend.layouts.adm_template')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="{{ route('barang.create') }}" class="btn btn-md btn-success btn-sm pull-right">TAMBAH BARANG</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="/barang" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        @if(session('Gagal'))
            <div class="alert alert-danger mt-2">
                {{ session('Gagal') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MERK</th>
                    <th>SERI</th>
                    <th>SPESIFIKASI</th>
                    <th>STOK</th>
                    <th>KATEGORI</th>
                    <th style="width: 15%">AKSI</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($rsetBarang as $index => $rowbarang)
                    <tr>
                        <td>{{ $loop->iteration + ($rsetBarang->currentPage() - 1) * $rsetBarang->perPage() }}</td>
                        <td>{{ $rowbarang->merk }}</td>
                        <td>{{ $rowbarang->seri }}</td>
                        <td>{{ $rowbarang->spesifikasi }}</td>
                        <td>{{ $rowbarang->stok }}</td>
                        <td>{{ $rowbarang->kategori_id }} - {{ $rowbarang->deskripsi }}</td>
                        <td class="text-center"> 
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST">
                                <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Barang belum tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $rsetBarang->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection
