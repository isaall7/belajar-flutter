@extends('template.admin2')
@section('content')


<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Nama Peminjam</h4>

            @if (session('success'))
                <div class="alert alert-info alert-dismissiblae fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- {{-- Filter Kategori --}} -->
            <form method="GET" action="{{ route('peminjaman.create') }}" class="mb-4">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label for="kategori" class="form-label">Filter Kategori Barang</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">-- Semua Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                    {{ ucfirst($kat) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                </div>
            </form>

            <!-- {{-- Form Peminjaman --}} -->
            <form action="{{ route('peminjaman.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <label for="">Nama Peminjam</label>
                            <input type="text" class="form-control" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required>
                            @error('nama_peminjam')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <label for="">Tanggal Meminjam</label>
                            <input type="date" class="form-control" name="tgl_meminjam" value="{{ old('tgl_meminjam') }}" required>
                            @error('tgl_meminjam')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <label for="">Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="tgl_pengembalian" value="{{ old('tgl_pengembalian') }}" required>
                            @error('tgl_pengembalian')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- {{-- Barang --}} -->
                    <div class="form-floating mb-3">
                        <div class="row">
                            @forelse($ruanganBarang as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card shadow-sm p-3">
                                        <div class="text-center mb-2">
                                            <img src="{{ asset('storage/' . $item->barang->foto) }}"
                                                class="img-fluid rounded"
                                                style="max-height: 150px; object-fit: cover;">
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label class="form-label"><strong>Nama Barang</strong></label>
                                                <input type="text" class="form-control" value="{{ $item->barang->nama_barang }}" disabled>
                                                <input type="hidden" name="nama_barang[]" value="{{ $item->barang->nama_barang }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><strong>Jumlah Stok</strong></label>
                                                <input type="number" class="form-control" value="{{ $item->stok }}" disabled>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="form-label"><strong>Minjam Berapa?</strong></label>
                                            <input type="number" name="jumlah[]" class="form-control" placeholder="Masukkan jumlah" min="0" max="{{ $item->stok }}">
                                            <input type="hidden" name="ruangan_barang_id[]" value="{{ $item->id }}">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted text-center">Tidak ada barang tersedia</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-md-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send fs-4"></i> Kirim
                            </button> | 
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
