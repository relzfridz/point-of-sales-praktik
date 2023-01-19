<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merek;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;

class TransaksiController extends Controller
{
    
      
     
     
     
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(5);
        return view('transaksis.index',compact('transaksis'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    
     
     
     
    
    public function create()
    {
        $barang = Barang::all();
        return view('transaksis.create',  compact('barang'));
    }

    
    
     
     
     
     
    public function store(Request $request)
    {

        $find_barang = Barang::select('harga_barang')->where('nama_barang', $request->nama_barang)->first();
        $get_stok = Barang::select('stok')->where('nama_barang', $request->nama_barang)->first();
        // dd($find_barang);
        $total_harga = $request->total_barang * $find_barang;
        if ($request->total_barangs <= $get_stok) {
            if ($request->total_bayar < $total_harga) {
                return redirect()->back()->with('error', 'Uang tidak cukup!');
            }else{
                Transaksi::create([
                    'nama_barang' => $request ->nama_barang,
                    'harga_barang' => $find_barang,
                    'total_barang' => $request ->total_barang,
                    'total_harga' => $request ->total_barang  * $find_barang, 
                    'total_bayar' => $request ->total_bayar,
                    'kembalian' => $request ->total_bayar  - $request ->total_barang  * $find_barang    , 
                    'tanggal_beli' => Carbon::now(),
                    
                ]);
                FacadesDB::table('barang')->where('nama_barang', $find_barang->nama_barang)->update(['stok' => $find_barang->stok - $request->total_barang]);
            }
        }else{
            return redirect()->back()->with('error', 'stok tidak memadai!');
        }

    return redirect()->route('transaksis.index')
    
    ->with('success','Transaksi Berhasil Ditambahkan.');
}

        // $request->validate([
        //     'nama_barangs' => 'required',
        //     'harga_barangs' => 'required',
        //     'total_barangs' => 'required',
        //     'total_hargas' => 'required',
        //     'total_bayars' => 'required',
        //     'kembalians' => 'required',
        //     'tanggal_belis' => 'required'
            
        // ]);
        // $barang = Barang::find($request->id_barang);
        // if($barang->stoks < $request->total_barangs){
        //     return redirect()->back()->with('danger', 'barang tidak cukup');
        // }
// dd($request->nama_barangs);
        // Transaksi::create([
        //     'nama_barangs' => $request->nama_barangs,
        //     'harga_barangs' => $request->harga_barangs,
        //     'total_barangs' => $request->total_barangs,
        //     $total = 'total_hargas' => $request->harga_barangs * $request->total_barangs,
        //     'total_bayars' => $request->total_bayars,
        //     'kembalians' => $request->total_bayars -= $total,
        //     'tanggal_belis' => Carbon::now(),
        // ]);
        //     if ($request->total_bayars < $request->total_hargas) {
        //         return redirect()->back()->with('error', 'Uang tidak cukup!');
        //     }else {
        // $transaksi = new Transaksi;
        // $transaksi->nama_barangs = $request->nama_barangs;
        // $transaksi->harga_barangs = $request->harga_barangs;
        // $transaksi->total_barangs = $request->total_barangs;
        // $total = $transaksi->total_hargas = $request->harga_barangs * $request->total_barangs;
        // $transaksi->total_bayars = $request->total_bayars;


// $transaksi->kembalians = $request->total_bayars - $total;
        // $transaksi->tanggal_belis = Carbon::now();
        // $transaksi->save();
        //     }
        // $transaksi = new Transaksi;
        // $transaksi->nama_barangs = $request->nama_barangs;
        // $transaksi->harga_barangs = $request->harga_barangs;
        // $transaksi->total_barangs = $request->total_barangs;
        // $total = $transaksi->total_hargas = $request->harga_barangs * $request->total_barangs;
        // $transaksi->total_bayars = $request->total_bayars;
        // $transaksi->kembalians = $request->total_bayars - $total;
        // $transaksi->tanggal_belis = Carbon::now();
        // $transaksi->save();

        // $barang->stoks -= $request->total_barangs;
        // $barang->save();

        // return redirect()->route('transaksis.index')
        // ->with('success', 'transaksis created successfully');
    

    
     
     
     
     
     
    public function show(Transaksi $transaksi)
    {
        return view('transaksis.show', compact('transaksi'));

    }

    

     
     
    
     
    public function edit(Transaksi $transaksi)
    {
        $barangs = Barang::all();
        $mereks = Merek::all();
        return view('transaksis.edit', compact('transaksi', 'barang', 'merek'));

    }

   
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'total_barang' => 'required',
            'total_harga' => 'required',
            'total_bayar' => 'required',
            'kembalian' => 'required',
            'tanggal_beli' => 'required'       
         ]);
        $transaksi->update($request->all());
        return redirect()->route('transaksis.index')
        ->with('success', 'transaksi created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksis.index')
        ->with('success','transaksi deleted successfully');
    }
}