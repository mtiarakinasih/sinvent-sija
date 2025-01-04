@extends('backend.layouts.adm_template')

@section('content')

<div class="row">
    <div class="col text-center">
        <h3>Edit Data Barang Keluar</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('barangkeluar.update', $rsetBarangKeluar->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal Keluar -->
                    <div class="form-group mb-3">
                        <label for="tgl_keluar">Tanggal Keluar</label>
                        <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" 
                               name="tgl_keluar" 
                               value="{{ old('tgl_keluar', $rsetBarangKeluar->tgl_keluar) }}" 
                               placeholder="Masukkan Data Tanggal Keluar">
                        @error('tgl_keluar')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Quantity Keluar -->
                    <div class="form-group mb-3">
                        <label for="qty_keluar">Quantity Keluar</label>
                        <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" 
                               name="qty_keluar" 
                               value="{{ old('qty_keluar', $rsetBarangKeluar->qty_keluar) }}" 
                               placeholder="Masukkan Quantity Keluar">
                        @error('qty_keluar')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Pilihan Barang -->
                    <div class="form-group mb-3">
                        <label for="barang_id">Barang</label>
                        <select class="form-select @error('barang_id') is-invalid @enderror" name="barang_id">
                            <option value="">Pilih Barang</option>
                            @foreach($rsetBarang as $barang)
                            <option value="{{ $barang->id }}" {{ $rsetBarangKeluar->barang_id == $barang->id ? 'selected' : '' }}>
                                {{ $barang->merk }} - {{ $barang->seri }} (Kategori: {{ $barang->kategori->deskripsi }})
                            </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Tombol Update dan Kembali -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">PERBARUI</button>
                        <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
