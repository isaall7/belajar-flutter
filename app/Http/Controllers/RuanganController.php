<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
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
        $ruangan = Ruangan::latest()->get();
        return view('ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {  $request->validate([
            'nama_ruangan' => 'required|string|max:225',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('ruangan', 'public');
        }

        $ruangan = new Ruangan;
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->deskripsi = $request->deskripsi;
        $ruangan->foto = $fotoPath;
        $ruangan->save();

        session()->flash('success', 'Ruangan Telah Ditambah');
        
        return redirect()->route('ruangan.index');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        try {  $request->validate([
            'nama_ruangan' => 'required|string|max:225',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('ruangan', 'public');
        }

        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->deskripsi = $request->deskripsi;
        $ruangan->foto = $fotoPath;
        $ruangan->save();

        session()->flash('success', 'Ruangan Telah Ditambah');
        
        return redirect()->route('ruangan.index');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        session()->flash('fail', 'Ruangan Telah Dihapus');
        return redirect()->route('ruangan.index');
    }
}
