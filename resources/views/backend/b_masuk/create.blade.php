@extends('backend.layouts.adm_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Barang Masuk</h4>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan sukses atau error -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('barangmasuk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Tanggal Masuk -->
                        <div class="form-group">
                            <label for="tgl_masuk">Tanggal Masuk</label>
                            <input type="date"
                                   id="tgl_masuk"
                                   name="tgl_masuk"
                                   class="form-control @error('tgl_masuk') is-invalid @enderror"
                                   value="{{ old('tgl_masuk') }}"
                                   placeholder="Masukkan Data Tanggal Masuk">
                            @error('tgl_masuk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Quantity Masuk -->
                        <div class="form-group">
                            <label for="qty_masuk">Quantity Masuk</label>
                            <input type="text"
                                   id="qty_masuk"
                                   name="qty_masuk"
                                   class="form-control @error('qty_masuk') is-invalid @enderror"
                                   value="{{ old('qty_masuk') }}"
                                   placeholder="Masukkan Quantity Masuk">
                            @error('qty_masuk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Barang ID -->
                        <div class="form-group">
                            <label for="barang_id">Barang</label>
                            <select id="barang_id"
                                    name="barang_id"
                                    class="form-control @error('barang_id') is-invalid @enderror">
                                <option value="">Pilih Barang</option>
                                @foreach($rsetBarang as $barang)
                                    <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                        {{ $barang->id }} - {{ $barang->merk }} - Stok: {{ $barang->stok }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tombol Simpan dan Kembali -->
                        <div class="form-group mt-4 d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary me-2">SIMPAN</button>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
