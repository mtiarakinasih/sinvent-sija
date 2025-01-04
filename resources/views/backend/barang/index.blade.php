@extends('backend.layouts.adm_template')
@section('content')

<!-- Awal header -->
<div class="row">
    <div class="col-12 text-center">
        <h3>Laravel CRUD | Barang</h3>
    </div>
</div>
<!-- Akhir header -->

<!-- Awal content -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('barang.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
                    </div>
                    <div class="col">
                        <form action="/barang" method="GET">
                            @csrf
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Cari barang"
                                       aria-label="Search for items"
                                       aria-describedby="button-addon2"
                                       value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary"
                                        type="submit"
                                        id="button-addon2">
                                    Search
                                </button>
                            </div>
                        </form>
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

                <div class="table-responsive"> <!-- Membuat tabel lebih fleksibel -->
                    <table class="table table-bordered"> <!-- Menambahkan border antar data -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>MERK</th>
                                <th>SERI</th>
                                <th>SPESIFIKASI</th>
                                <th>STOK</th>
                                <th>KATEGORI</th>
                                <th>AKSI</th>
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
                </div>

                <!-- Pagination -->
                {{ $rsetBarang->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Akhir content -->

@endsection
