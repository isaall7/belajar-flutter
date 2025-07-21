<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Ruangan_barang;
use App\Models\Detail_peminjaman;
use Illuminate\Http\Request;

class RuanganBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $ruangan_barang = Ruangan_barang::with('barang','ruangan')->orderBy('id', 'desc')->get();
        return view('ruanganbarang.index', compact('ruangan_barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('ruanganbarang.create', compact('barang','ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try { $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'stok' => 'required|numeric',
            'tgl_masuk' => 'required|date',
        ]);

        $ruangan_barang = new Ruangan_barang;
        $ruangan_barang->barang_id = $request->barang_id;
        $ruangan_barang->ruangan_id = $request->ruangan_id;
        $ruangan_barang->stok = $request->stok;
        $ruangan_barang->tgl_masuk = $request->tgl_masuk;
        $ruangan_barang->save();

        session()->flash('success', 'Data barang telah masuk');
        return redirect()->route('ruanganbarang.index', compact('ruangan_barang'));

        }   catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan_barang $ruangan_barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan_barang $ruangan_barang)
    {
        $barang = Barang::all();
        $ruangan = Ruangan::all();
        return view('ruanganbarang.edit', compact('barang','ruangan','ruangan_barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan_barang $ruangan_barang)
    {
        try {
            $request->validate([
                'barang_id' => 'required|exists:barangs,id',
                'ruangan_id' => 'required|exists:ruangans,id',
                'tgl_masuk' => 'required|date',
            ]);
        
            $ruangan_barang->barang_id = $request->barang_id;
            $ruangan_barang->ruangan_id = $request->ruangan_id;
            $ruangan_barang->tgl_masuk = $request->tgl_masuk;
            $ruangan_barang->save();
        
            session()->flash('success', 'Data barang telah diperbarui');
            return redirect()->route('ruanganbarang.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Cari data relasi berdasarkan ID
    $ruangan_barang = Ruangan_barang::find($id);

    // Jika tidak ditemukan, kembalikan error
    if (!$ruangan_barang) {
        return redirect()->back()->with('error', 'Data ruangan barang tidak ditemukan');
    }

    // Hapus data
    $ruangan_barang->delete();

    // Beri notifikasi berhasil
    session()->flash('success', 'Data ruangan barang berhasil dihapus');
    return redirect()->route('ruanganbarang.index');
}

}
