<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan_barang;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Peminjaman;


class DashboardController extends Controller
{
    public function index()
    {
        return view('template.backend');
    }

    public function indexxx()
    {
        return view('template.admin2');
    }

    public function welcome(Request $request)
    {
        $ruanganBarang = Ruangan_barang::all();
        $ruangan = Ruangan::with('ruangan_barang')->orderBy('id','desc')->get();


        // Ambil semua kategori unik dari barang
        $kategoriFilter = Barang::select('kategori')->distinct()->get();

        // Jika ada filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $barang = Barang::where('kategori', $request->kategori)->get();
        } else {
            $barang = Barang::all();
        }

        return view('welcome', compact('ruanganBarang', 'barang','ruangan','kategoriFilter'));
    }

    public function show($id)
    {
        $ruangan = Ruangan::with('ruangan_barang.barang')->findOrFail($id);
        return view('ruangan', compact('ruangan'));
    }


}
