<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class CategoryController extends Controller
{
	public function index(Request $request)
{
    // return view('backend.layouts.adm_template');
    if ($request->search) {
        $rsKategori = DB::table('kategori')
                        ->select('id',
                                 'deskripsi',
                                 'kategori',
                                 DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', 'like', $request->search)
                        ->orWhere('deskripsi', 'like', '%'.$request->search.'%')
                        ->paginate(5);
    } else {
        $rsKategori = DB::table('kategori')
                        ->select('id', 
                                 'deskripsi', 
                                 'kategori', 
                                 DB::raw('ketKategori(kategori) as ket'))
                        ->paginate(5);
    }
    return view('backend.kategori.index', compact('rsKategori'));
}

    public function create()
    {
        $listKategori=array(''=>'Pilih Kategori',
                            'M'=>'Modal',
                            'A'=>'Alat',
                            'BHP'=>'Bahan Habis Pakai',
                            'BTHP'=>'Bahan Tidak Habis Pakai');
        return view('backend.kategori.create',compact('listKategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi'=>'required',
            'kategori'=>'required'
        ]);
        
        Kategori::create([
            'deskripsi'=>$request->deskripsi,
            'kategori'=>$request->kategori
        ]);
        return redirect()->route('kategori.index')->with(['success'=>'Data Berhasil Disimpan!']);
    }
    
    public function show(string $id)
    {
        $rsKategori = DB::table('kategori')
                        ->select('id', 
                                 'deskripsi', 
                                 'kategori', 
                                 DB::raw('ketKategori(kategori) as ket'))
                        ->where('id', $id)
                        ->get();
        return view('backend.kategori.show',compact('rsKategori'));
    }

    public function edit($id)
{
    $rsKategori = DB::table('kategori')
                    ->select('id', 'deskripsi', 'kategori')
                    ->where('id', $id)
                    ->first(); // Mengambil satu hasil untuk edit
    
    if (!$rsKategori) {
        return redirect()->route('kategori.index')->with('error', 'Data tidak ditemukan.');
    }

    $listKategori = [
        '' => 'Pilih Kategori',
        'M' => 'Modal',
        'A' => 'Alat',
        'BHP' => 'Bahan Habis Pakai',
        'BTHP' => 'Bahan Tidak Habis Pakai'
    ];

    return view('backend.kategori.edit', compact('rsKategori', 'listKategori'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi'=>'required',
            'kategori'=>'required'
        ]);
        
        $rsKategori=Kategori::find($id);
        $rsKategori->update($request->all());
        
        return redirect()->route('kategori.index')->with(['success'=>'Data Berhasil Diubah!']);
    }

      public function destroy(string $id)
    {
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Gagal dihapus']);
        } else {
            $rseKategori = Kategori::find($id);
            $rseKategori->delete();
            return redirect()->route('kategori.index')->with(['Success' => 'Berhasil dihapus']);
        }
    }


}
