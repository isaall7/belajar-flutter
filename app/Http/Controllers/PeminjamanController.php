<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan_barang;
use App\Models\DetailPinjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('detail_peminjaman.ruangan_barang.barang')->orderBy('id','desc')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ambil semua kategori unik dari tabel barang
        $kategori = Barang::select('kategori')->distinct()->pluck('kategori');
    
        // Ambil data ruangan_barang + relasi barang & ruangan
        $query = Ruangan_barang::with(['barang', 'ruangan']);
    
        // Jika ada filter kategori
        if ($request->filled('kategori')) {
            $query->whereHas('barang', function ($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }
    
        $ruanganBarang = $query->get();
    
        return view('peminjaman.create', [
            'kategori' => $kategori,
            'ruanganBarang' => $ruanganBarang,
            'kategoriDipilih' => $request->kategori // Supaya opsi tetap terpilih
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(Request $request)
     {
         DB::beginTransaction();
     
         try {
             // Validasi
             $request->validate([
                 'nama_peminjam' => 'required|string|max:255',
                 'tgl_meminjam' => 'required|date',
                 'tgl_pengembalian' => 'required|date|after_or_equal:tgl_meminjam',
                 'ruangan_barang_id.*' => 'required|exists:ruangan_barangs,id',
                 'jumlah.*' => 'nullable|integer|min:0',
             ]);

             // Simpan ke tabel utama
             $peminjaman = Peminjaman::create([
                 'nama_peminjam' => $request->nama_peminjam,
                 'tgl_meminjam' => $request->tgl_meminjam,
                 'tgl_pengembalian' => $request->tgl_pengembalian,
                 'status' => 'dipinjam',
             ]);
     
             // Proses barang
             foreach ($request->jumlah as $index => $jumlah) {
                 if ($jumlah > 0) {
                     $ruanganBarangId = $request->ruangan_barang_id[$index];
     
                     $ruanganBarang = Ruangan_barang::find($ruanganBarangId);
     
                     if ($ruanganBarang && $ruanganBarang->stok >= $jumlah) {
                         // Kurangi stok
                         $ruanganBarang->stok -= $jumlah;
                         $ruanganBarang->save();
     
                         // Simpan ke detail_peminjaman
                         DetailPinjaman::create([
                             'peminjaman_id' => $peminjaman->id,
                             'ruangan_barang_id' => $ruanganBarangId,
                             'jumlah' => $jumlah,
                         ]);
                     } else {
                         DB::rollBack();
                         return redirect()->back()->with('error', 'Stok tidak cukup untuk: ' . $ruanganBarang->barang->nama_barang)->withInput();
                     }
                 }
             }

             DB::commit();
             return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil.');
     
         } catch (\Exception $e) {
             DB::rollBack();
             return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage())->withInput();
         }
     }

     public function edit(Peminjaman $peminjaman)
    {
        $ruanganBarang = Ruangan_barang::with('barang', 'ruangan')->get();
        $peminjaman->load('detail_peminjaman.ruangan_barang.barang', 'detail_peminjaman.ruangan_barang.ruangan');

        return view('peminjaman.edit', compact('peminjaman', 'ruanganBarang'));
    }


     public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Validasi input
            $request->validate([
                'nama_peminjam' => 'required|string|max:255',
                'tgl_meminjam' => 'required|date',
                'tgl_pengembalian' => 'required|date|after_or_equal:tgl_meminjam',
                'ruangan_barang_id.*' => 'required|exists:ruangan_barangs,id',
                'jumlah.*' => 'nullable|integer|min:0',
            ]);

            $peminjaman = Peminjaman::with('detail_peminjaman.ruangan_barang')->findOrFail($id);

            // Kembalikan stok dari data lama
            foreach ($peminjaman->detail_peminjaman as $detail) {
                if ($detail->ruangan_barang) {
                    $detail->ruangan_barang->stok += $detail->jumlah;
                    $detail->ruangan_barang->save();
                }
                $detail->delete(); // hapus detail lama
            }

            // Update data peminjaman
            $peminjaman->update([
                'nama_peminjam' => $request->nama_peminjam,
                'tgl_meminjam' => $request->tgl_meminjam,
                'tgl_pengembalian' => $request->tgl_pengembalian,
            ]);

            // Simpan data baru ke detail
            foreach ($request->jumlah as $index => $jumlah) {
                if ($jumlah > 0) {
                    $ruanganBarangId = $request->ruangan_barang_id[$index];
                    $ruanganBarang = \App\Models\Ruangan_barang::find($ruanganBarangId);

                    if ($ruanganBarang && $ruanganBarang->stok >= $jumlah) {
                        $ruanganBarang->stok -= $jumlah;
                        $ruanganBarang->save();

                        \App\Models\DetailPinjaman::create([
                            'peminjaman_id' => $peminjaman->id,
                            'ruangan_barang_id' => $ruanganBarangId,
                            'jumlah' => $jumlah,
                        ]);
                    } else {
                        DB::rollBack();
                        return back()->with('error', 'Stok tidak cukup untuk: ' . $ruanganBarang->barang->nama_barang)->withInput();
                    }
                }
            }

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage())->withInput();
        }
    }


     public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $peminjaman = Peminjaman::with('detail_peminjaman.ruangan_barang')->findOrFail($id);

            // Kembalikan stok
            foreach ($peminjaman->detail_peminjaman as $detail) {
                $ruanganBarang = $detail->ruangan_barang;

                if ($ruanganBarang) {
                    $ruanganBarang->stok += $detail->jumlah;
                    $ruanganBarang->save();
                }

                // Hapus detail peminjaman
                $detail->delete();
            }

            // Hapus peminjaman
            $peminjaman->delete();

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Data berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('peminjaman.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */

}
