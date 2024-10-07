@extends('backend.layouts.adm_template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>Edit Data Barang Masuk</h1>
                
                <form action="{{ route('barangmasuk.update', $barangMasuk->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal Masuk -->
                    <div class="form-group">
                        <label class="font-weight-bold">TANGGAL MASUK</label>
                        <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk', $barangMasuk->tgl_masuk) }}" placeholder="Masukkan Data Tanggal Masuk">
                        @error('tgl_masuk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Quantity Masuk -->
                    <div class="form-group">
                        <label class="font-weight-bold">QUANTITY MASUK</label>
                        <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk', $barangMasuk->qty_masuk) }}" placeholder="Masukkan Quantity Masuk">
                        @error('qty_masuk')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Pilihan Barang -->
                    <div class="form-group">
                        <label class="font-weight-bold">BARANG</label>
                        <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id">
                            <option value="">Pilih Barang</option>
                            @foreach($rsetBarang as $barang)
                                <option value="{{ $barang->id }}" {{ $barangMasuk->barang_id == $barang->id ? 'selected' : '' }}>
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
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
