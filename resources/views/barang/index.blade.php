@extends('template.admin2')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Barang</h4>
                <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Tambah barang
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Foto Barang</th>
                            <th>Kategori Barang</th>
                            <th>Merek</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" width="90" height="90">
                                </td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->merek }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-success btn-sm mb-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('barang.destroy', $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data barang</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
