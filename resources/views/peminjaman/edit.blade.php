@extends('template.admin2')

@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
        <h4 class="card-title mb-4">Edit Peminjaman</h4>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" value="{{ old('nama_peminjam', $peminjaman->nama_peminjam) }}" required>
            </div>

            <div class="mb-3">
                <label for="tgl_meminjam" class="form-label">Tanggal Meminjam</label>
                <input type="date" name="tgl_meminjam" class="form-control" value="{{ old('tgl_meminjam', $peminjaman->tgl_meminjam) }}" required>
            </div>

            <div class="mb-3">
                <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" name="tgl_pengembalian" class="form-control" value="{{ old('tgl_pengembalian', $peminjaman->tgl_pengembalian) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Barang yang Dipinjam</label>
                <div id="barang-container">
                    @foreach ($peminjaman->detail_peminjaman as $index => $detail)
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <select name="ruangan_barang_id[]" class="form-control" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach ($ruanganBarang as $rb)
                                        <option value="{{ $rb->id }}"
                                            {{ $detail->ruangan_barang_id == $rb->id ? 'selected' : '' }}>
                                            {{ $rb->barang->nama_barang ?? '-' }} | {{ $rb->ruangan->nama_ruangan ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="jumlah[]" class="form-control" min="1" value="{{ $detail->jumlah }}" required>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
