@extends ('backend.layouts.adm_template')
@section ('content')
<!-- awal header  -->
<div class="row">
    <!-- Column lebar 12 col, text rata tengah  -->
    <div class="col text-center">
        <h3>Laravel CRUD | Kategori</h3>
    </div>
</div>    
<!-- akhir header  -->
<div class="row">
    <div class="card border-0 shadow-sm rounded w-100"> <!-- Make card full width -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4>Show Kategori</h4>
                </div>
            </div>
            <div class="row">
                @if($rsKategori->isNotEmpty())
                <div class="col-12">
                    <table class="table table-striped table-hover">
                        <tr>
                            <td>ID</td>
                            <td>&nbsp;</td>
                            <td>{{ $rsKategori[0]->id }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>&nbsp;</td>
                            <td>{{ $rsKategori[0]->deskripsi }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>&nbsp;</td>
                            <td>{{ $rsKategori[0]->kategori }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>&nbsp;</td>
                            <td>{{ $rsKategori[0]->ket }}</td>
                        </tr>
                    </table>
                </div>
                @else
                <p>Data tidak ditemukan.</p>
                @endif
            </div>
            <div class="row">
                <div class="col text-center">
                    <a href="{{ route('kategori.index') }}" class="btn btn-md btn-dark mb-3 mx-auto">BACK</a> <!-- Center the button but keep it smaller -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
