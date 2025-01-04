@extends('backend.layouts.adm_template')

@section('content')

<!-- Header Section -->
<div class="row">
    <div class="col-12 text-center">
        <h3>Laravel CRUD | Barang Masuk</h3>
    </div>
</div>

<!-- Content Section -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">

                <!-- Top Actions -->
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="col">
                        <form action="{{ route('barangmasuk.index') }}" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari barang masuk" aria-label="Search" aria-describedby="button-addon2" value="{{ request()->search }}">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Notifications -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Table Section -->
                <div class="table-responsive">
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
                            @forelse ($rsetBarangMasuk as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tgl_masuk }}</td>
                                    <td>{{ $item->qty_masuk }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('barangmasuk.show', $item->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <form action="{{ route('barangmasuk.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin untuk menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Barang Masuk belum tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                {{ $rsetBarangMasuk->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
