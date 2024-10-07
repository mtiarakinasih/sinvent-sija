@extends('backend.layouts.adm_template')

@section('content')
<div class="container-fluid">
    <h1>Tambah Barang Keluar</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
        <div class="form-group">
            <label for="tgl_keluar">Tanggal Keluar</label>
            <input type="date" name="tgl_keluar" class="form-control" required value="{{ old('tgl_keluar') }}">
            @if ($errors->has('tgl_keluar'))
                <span class="text-danger">{{ $errors->first('tgl_keluar') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="qty_keluar">Jumlah Keluar</label>
            <input type="number" name="qty_keluar" class="form-control" required value="{{ old('qty_keluar') }}">
            @if ($errors->has('qty_keluar'))
                <span class="text-danger">{{ $errors->first('qty_keluar') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="barang_id">Barang</label>
            <select name="barang_id" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach ($rsetBarang as $barang)
                    <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>{{ $barang->merk }}</option>
                @endforeach
            </select>
            @if ($errors->has('barang_id'))
                <span class="text-danger">{{ $errors->first('barang_id') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
