<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Ruangan;
use App\Models\Ruangan_barang;
use App\Models\DetailPinjaman;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $barang = Barang::all();
        $totalBarang = $barang->count();

        $peminjaman = Peminjaman::all();
        $totalPeminjaman = $peminjaman->count();

        $pengembalian = Pengembalian::all();
        $totalPengembalian = $pengembalian->count();

        $ruangan = Ruangan::all();
        $totalRuangan = $ruangan->count();

        // ambil data peminjaman
        $peminjamann = Peminjaman::with('detail_peminjaman.ruangan_barang.barang')->orderBy('id','desc')->get();
        $peminjamanBaru = $peminjamann->take(4);

        $pengembalianBaru = Pengembalian::with([
            'detail_pengembalian.detail_peminjaman.peminjaman',
            'detail_pengembalian.detail_peminjaman.ruangan_barang.barang'
        ])->latest()->take(5)->get();
            
        $tanggalSeminggu = collect(Carbon::now()->subDays(6)->daysUntil(Carbon::now()))
        ->map(function ($date) {
            $tgl = $date->toDateString();

            $totalPeminjaman = DB::table('peminjamen')
                ->join('detail_peminjamen', 'peminjamen.id', '=', 'detail_peminjamen.peminjaman_id')
                ->whereDate('peminjamen.tgl_meminjam', $tgl)
                ->sum('jumlah');

            $totalPengembalian = DB::table('pengembalians')
                ->join('detail_pengembalians', 'pengembalians.id', '=', 'detail_pengembalians.pengembalian_id')
                ->whereDate('pengembalians.tgl_pengembalian', $tgl)
                ->sum('jumlah_dikembalikan');

            return [
                'tanggal' => $date->locale('id')->translatedFormat('l'),
                'peminjaman' => $totalPeminjaman,
                'pengembalian' => $totalPengembalian,
            ];
        });


        return view('home', compact(
            'totalBarang',
            'totalPeminjaman',
            'totalPengembalian',
            'totalRuangan',
            'peminjamanBaru',
            'pengembalianBaru',
            'tanggalSeminggu'
        
        ));
    }

}   
