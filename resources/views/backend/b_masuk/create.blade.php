@extends('backend.layouts.adm_template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-left">
            <h1>Tambah Barang Masuk</h1>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('barangmasuk.store') }}" method="POST" enctype="multipart/form-data">                    
                @csrf

                <div class="form-group">
                    <label class="font-weight-bold">TANGGAL MASUK</label>
                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk') }}" placeholder="Masukkan Data Tanggal Masuk">
                
                    @error('tgl_masuk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">QUANTITY MASUK</label>
                    <input type="text" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk') }}" placeholder="Masukkan Quantity Masuk">
                
                    @error('qty_masuk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">BARANG ID</label>
                    <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id">
                        <option value="">Pilih Barang</option>
                        @foreach($rsetBarang as $barang)
                            <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                {{ $barang->id }} - {{ $barang->merk }} - Stok: {{ $barang->stok }}
                            </option>
                        @endforeach
                    </select>

                    @error('barang_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                <button type="reset" class="btn btn-md btn-warning">RESET</button>
            </form> 
        </div>
    </div>
</div>
@endsection
