@extends('backend.layouts.adm_template')

@section('content')
<div class="row">
    <div class="card border-0 shadow-sm rounded w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h4>Detail Kategori</h4>
                </div>
            </div>

            <div class="row">
                @if($rsKategori->isNotEmpty())
                <div class="col-12">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $rsKategori[0]->id }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $rsKategori[0]->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $rsKategori[0]->kategori }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $rsKategori[0]->ket }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <p>Data Kategori tidak ditemukan.</p>
                @endif
            </div>

            <!-- Tombol Kembali -->
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3 mx-auto">KEMBALI</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
