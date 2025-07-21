@extends('template.admin2')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Data Pengembalian</h4>
                <a href="{{ route('pengembalian.create') }}" class="btn btn-sm btn-danger">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pengembalian
                </a>
            </div>

            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center small">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Barang Dikembalikan</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($pengembalian as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->peminjaman->nama_peminjam }}</td>
                            <td>
                                <ul class="list-group list-group-flush small">
                                    @forelse($item->detail_pengembalian as $detail)
                                        <li class="list-group-item">
                                            <div><strong>{{ $detail->detail_peminjaman?->ruangan_barang?->barang?->nama_barang ?? 'Barang tidak ditemukan' }}</strong></div>
                                            <div class="text-muted">
                                                Jumlah: {{ $detail->jumlah_dikembalikan }} | 
                                                Keterangan: {{ ucfirst($detail->keterangan) }}
                                            </div>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted">Tidak ada detail</li>
                                    @endforelse
                                </ul>
                            </td>
                            <td class="text-center">{{ $item->peminjaman->tgl_meminjam }}</td>
                            <td class="text-center">{{ $item->tgl_pengembalian }}</td>
                            <td class="text-center">
                                <span class="badge bg-success badge-status">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td>{{ $item->catatan ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('pengembalian.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data pengembalian.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<style>
    .table td, .table th {
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .list-group-item {
        background-color: transparent;
        padding: 0.3rem 0.5rem;
        font-size: 0.8rem;
    }
    .badge-status {
        font-size: 0.75rem;
        padding: 0.3em 0.6em;
    }
</style>
@endsection
