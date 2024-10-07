@extends('backend.layouts.adm_template')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Kolom kosong untuk menggeser form ke kanan -->
            <div class="col-md-8"></div>

            <!-- Kolom form berada di bagian kanan -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Edit Barang') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('barang.update', $rsetBarang->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="merk">{{ __('Merk') }}</label>
                                <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" value="{{ old('merk', $rsetBarang->merk) }}" required>
                                @error('merk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="seri">{{ __('Seri') }}</label>
                                <input type="text" name="seri" class="form-control @error('seri') is-invalid @enderror" value="{{ old('seri', $rsetBarang->seri) }}">
                                @error('seri')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="spesifikasi">{{ __('Spesifikasi') }}</label>
                                <textarea name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror">{{ old('spesifikasi', $rsetBarang->spesifikasi) }}</textarea>
                                @error('spesifikasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok">{{ __('Stok') }}</label>
                                <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $rsetBarang->stok) }}">
                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kategori_id">{{ __('Kategori') }}</label>
                                <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($rsKategori as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $rsetBarang->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->deskripsi }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan Perubahan') }}
                                </button>
                                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                                    {{ __('Kembali') }}
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection