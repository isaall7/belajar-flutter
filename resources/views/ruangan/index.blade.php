@extends('template.admin2')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Ruangan</h4>
                <a href="{{ route('ruangan.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus"></i> Tambah Ruangan
                </a>
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-bordered bg-white align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Foto Ruangan</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ruangan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_ruangan }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded" width="90" height="90">
                            </td>
                            <td>{{Str::limit($item->deskripsi, 40)}}</td>
                            <td>
                                <a href="{{ route('ruangan.edit', $item->id) }}" class="btn btn-success btn-sm mb-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('ruangan.destroy', $item->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda Yakin?')">
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
                            <td colspan="5" class="text-center">Tidak ada data Ruangan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
