@extends('backend.layouts.adm_template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Kategori</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" 
                                   name="deskripsi" 
                                   id="deskripsi" 
                                   class="form-control @error('deskripsi') is-invalid @enderror" 
                                   value="{{ old('deskripsi') }}" 
                                   placeholder="Masukkan deskripsi kategori" 
                                   required>
                            @error('deskripsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="kategori">Pilih Kategori</label>
                            <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($listKategori as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
