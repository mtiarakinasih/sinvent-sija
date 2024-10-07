@extends ('backend.layouts.adm_template')
@section ('content')
<!-- membuat row header  -->
<div class="row">
    <div class="col text-center">
        <h3>Laravel CRUD | Kategori</h3>
    </div>
</div>
<!-- akhir row  header -->

<!-- membuat row content  -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-floating mb-4">
                            <label for="floatingPassword">Deskripsi</label>
                                <input type="text"
                                       name="deskripsi"
                                       class="form-control @error('deskripsi') is-invalid @enderror w-100"
                                       placeholder="Deskripsi"
                                       value="{{ old('deskripsi') }}">

                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <select name="kategori" class="form-select border-primary" aria-label="Default select example">
                                    @foreach($listKategori as $key=>$val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Move submit and reset buttons inside the form -->
                            <div class="row mt-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </div>
                                <div class="col text-end">
                                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3">BACK</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- akhir card -->
@endsection
