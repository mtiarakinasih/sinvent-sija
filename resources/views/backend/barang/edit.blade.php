@extends('backend.layouts.adm_template')

@section('content')

<div class="row">
    <div class="col text-center">
        <h3>Edit Barang</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form method="POST" action="{{ route('barang.update', $rsetBarang->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Merk Input -->
                    <div class="form-group mb-3">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" id="merk" 
                               class="form-control @error('merk') is-invalid @enderror" 
                               placeholder="Merk" value="{{ old('merk', $rsetBarang->merk) }}" required>
                        @error('merk')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Seri Input -->
                    <div class="form-group mb-3">
                        <label for="seri">Seri</label>
                        <input type="text" name="seri" id="seri" 
                               class="form-control @error('seri') is-invalid @enderror" 
                               placeholder="Seri" value="{{ old('seri', $rsetBarang->seri) }}">
                        @error('seri')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Spesifikasi Input -->
                    <div class="form-group mb-3">
                        <label for="spesifikasi">Spesifikasi</label>
                        <textarea name="spesifikasi" id="spesifikasi" 
                                  class="form-control @error('spesifikasi') is-invalid @enderror"
                                  placeholder="Spesifikasi">{{ old('spesifikasi', $rsetBarang->spesifikasi) }}</textarea>
                        @error('spesifikasi')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Stok Input -->
                    <div class="form-group mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" id="stok" 
                               class="form-control @error('stok') is-invalid @enderror" 
                               placeholder="Stok" value="{{ old('stok', $rsetBarang->stok) }}">
                        @error('stok')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori Dropdown -->
                    <div class="form-group mb-3">
                        <label for="kategori_id">Kategori</label>
                        <select name="kategori_id" id="kategori_id" 
                                class="form-select @error('kategori_id') is-invalid @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($rsKategori as $kategori)
                                <option value="{{ $kategori->id }}" 
                                        {{ $rsetBarang->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->deskripsi }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit and Back Buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">PERBARUI</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
