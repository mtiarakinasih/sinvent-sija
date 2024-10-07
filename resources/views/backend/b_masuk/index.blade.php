@extends('backend.layouts.adm_template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h1>Data Barang Masuk</h1>
        </div>
        <div class="col-md-6 text-right">
            <form action="{{ route('barangmasuk.index') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Cari..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request()->search }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary">Tambah Barang Masuk</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Masuk</th>
                <th>Qty Masuk</th>
                <th>Merk Barang</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rsetBarangMasuk as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->tgl_masuk }}</td>
                    <td>{{ $item->qty_masuk }}</td>
                    <td>{{ $item->merk }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>
                        <a href="{{ route('barangmasuk.show', $item->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                        <a href="{{ route('barangmasuk.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                        <form action="{{ route('barangmasuk.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $rsetBarangMasuk->links() }} <!-- Pagination links -->
</div>
@endsection
