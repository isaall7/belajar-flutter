<?php

namespace App\Http\Controllers;


use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Detailpinjaman;
use App\Models\Ruangan_barang;
use App\Models\DetailPengembalian;
use Illuminate\Http\Request;
use DB;
class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalian = Pengembalian::with('detail_pengembalian.ruangan_barang.barang')->orderBy('id','desc')->get();
        return view('pengembalian.index', compact('pengembalian'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengembalian = [
            'detail_peminjaman' => DetailPinjaman::with('peminjaman', 'ruangan_barang.barang')->get(),
            'peminjaman' => Peminjaman::all(),
            'ruangan_barang' => Ruangan_barang::all(),
            'detail_pengembalian' => DetailPengembalian::all(),
        ];
        return view('pengembalian.return', compact('pengembalian'));
    }

    /**
     * Store a newly created resource in storage.
     */
   
     public function store(Request $request)
     {
         try {
             $request->validate([
                 'peminjaman_id' => 'required|exists:peminjamen,id',
                 'tgl_pengembalian' => 'required|date',
                 'detail_pinjaman_id' => 'required|array',
                 'detail_pinjaman_id.*' => 'exists:detail_peminjamen,id',
                 'jumlah_dikembalikan' => 'required|array',
                 'jumlah_dikembalikan.*' => 'required|numeric|min:0',
                 'keterangan' => 'required|array',
                 'keterangan.*' => 'required|string',
                 'catatan' => 'nullable|string',
             ]);
     
             DB::beginTransaction();
             
             $pengembalian = new Pengembalian;
             $pengembalian->peminjaman_id = $request->peminjaman_id;
             $pengembalian->tgl_pengembalian = $request->tgl_pengembalian;
             $pengembalian->catatan = $request->catatan;
             $pengembalian->status = 'sudah dikembalikan';
             $pengembalian->save();
     
             foreach ($request->detail_pinjaman_id as $i => $detailId) {
                 $jumlah = $request->jumlah_dikembalikan[$i];
                 $keterangan = $request->keterangan[$i];
     
                 $detail = DetailPinjaman::findOrFail($detailId);
                 $ruanganBarang = Ruangan_barang::findOrFail($detail->ruangan_barang_id);
     
                 // Tambahkan stok
                 $ruanganBarang->stok += $jumlah;
                 $ruanganBarang->save();
     
                 // Simpan ke detail_pengembalians
                 DetailPengembalian::create([
                     'pengembalian_id' => $pengembalian->id,
                     'detail_peminjaman_id' => $detailId,
                     'jumlah_dikembalikan' => $jumlah,
                     'keterangan' => $keterangan,
                 ]);
             }
                // Update status peminjaman menjadi 'dikembalikan'
            $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
            $peminjaman->status = 'dikembalikan';
            $peminjaman->save();

             DB::commit();
     
             return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil disimpan');
         } catch (\Exception $e) {
             DB::rollBack();
             return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
         }
     }
     

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        DB::beginTransaction();

        try {
            foreach ($pengembalian->detail_pengembalian as $detail) {
                $ruanganBarang = Ruangan_barang::find($detail->detail_peminjaman->ruangan_barang_id);
                
                if ($ruanganBarang) {
                    $ruanganBarang->stok -= $detail->jumlah_dikembalikan;
                    $ruanganBarang->save();
                }
            }

            // Hapus pengembalian terlebih dahulu
            $pengembalian->delete();

            // Lalu hapus data peminjaman yang terkait
            if ($pengembalian->peminjaman) {
                $pengembalian->peminjaman->delete();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data pengembalian dan peminjaman berhasil dihapus, stok dikembalikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


}
