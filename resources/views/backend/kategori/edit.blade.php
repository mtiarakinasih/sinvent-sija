
@extends ('backend.layouts.adm_template')
@section ('content')

<div class="row">
    <div class="col text-center">
        <h3>Edit Kategori</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('kategori.update', $rsKategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Deskripsi field -->
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" value="{{ old('deskripsi', $rsKategori->deskripsi) }}">
                        @error('deskripsi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Kategori dropdown -->
                    <div class="form-group mb-3">
                        <label for="kategori">Pilih Kategori</label>
                        <select name="kategori" class="form-select">
                            @foreach($listKategori as $key => $val)
                                <option value="{{ $key }}" {{ $rsKategori->kategori == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit buttons -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">PERBARUI</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">BATAL</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
