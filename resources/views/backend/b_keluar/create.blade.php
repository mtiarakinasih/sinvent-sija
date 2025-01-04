@extends('backend.layouts.adm_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Barang Keluar</h4>
                </div>
                <div class="card-body">
                    <!-- Menampilkan pesan sukses atau error -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('barangkeluar.store') }}" method="POST">
                        @csrf

                        <!-- Tanggal Keluar -->
                        <div class="form-group">
                            <label for="tgl_keluar">Tanggal Keluar</label>
                            <input type="date"
                                   id="tgl_keluar"
                                   name="tgl_keluar"
                                   class="form-control @error('tgl_keluar') is-invalid @enderror"
                                   value="{{ old('tgl_keluar') }}"
                                   placeholder="Masukkan Data Tanggal Keluar">
                            @error('tgl_keluar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Jumlah Keluar -->
                        <div class="form-group">
                            <label for="qty_keluar">Jumlah Keluar</label>
                            <input type="number"
                                   id="qty_keluar"
                                   name="qty_keluar"
                                   class="form-control @error('qty_keluar') is-invalid @enderror"
                                   value="{{ old('qty_keluar') }}"
                                   placeholder="Masukkan Jumlah Keluar">
                            @error('qty_keluar')
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
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
