<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
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
        $barang = Barang::latest()->get();
        return view('barang.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try { $request->validate([
            'nama_barang' => 'required|string|max:225',
            'merek' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric|max:100',
            'kategori' => 'required|string|max:225',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('barang', 'public');
        }

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merek = $request->merek;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->kategori = $request->kategori;
        $barang->foto = $fotoPath;
        $barang->save();

        session()->flash('success', 'Barang telah Ditambahkan');
        return redirect()->route('barang.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        try { $request->validate([
            'nama_barang' => 'required|string|max:225',
            'merek' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('barang', 'public');
        }

        $barang->nama_barang = $request->nama_barang;
        $barang->merek = $request->merek;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->foto = $fotoPath;
        $barang->save();

        session()->flash('success', 'Data Barang Telah dirubah');
        return redirect()->route('barang.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        session()->flash('fail', 'Barang telah dihapus');
        return redirect()->route('barang.index');
    }
}
