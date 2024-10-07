@extends('backend.layouts.adm_template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" name="merk" id="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk') }}" required>
                            @error('merk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="seri">Seri</label>
                            <input type="text" name="seri" id="seri" class="form-control @error('seri') is-invalid @enderror" value="{{ old('seri') }}">
                            @error('seri')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="spesifikasi">Spesifikasi</label>
                            <textarea name="spesifikasi" id="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror">{{ old('spesifikasi') }}</textarea>
                            @error('spesifikasi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}">
                            @error('stok')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($rsetKategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Barang</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
