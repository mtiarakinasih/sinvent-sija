{{$rsKategori}}

//<?php $row1 = $rsKategori[0];
//$row2 = $rsKategori[1];
//$row3 = $rsKategori[2];
//echo $rsKategori[1]->deskripsi;
//?>

@forelse ($rsKategori as $row)
    {{ $row->id }}
    {{ $row->kategori }}
    <br/>
@empty
@endforelse
