@extends('template.user')

@section('content')
<div class="container my-5">

    <div class="row mb-5">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="Foto Ruangan" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <h3 class="text-uppercase">{{ $ruangan->nama_ruangan }}</h3>
            <p style="text-align: justify;">{{ $ruangan->deskripsi }}</p>
        </div>
    </div>
<br>
    <div class="mb-3 mt-5">
        <h5 class="text-uppercase fw-bold">Barang-barang di ruangan ini:
        <a href="{{route('welcome')}}" class="btn btn-sm btn-primary" style="float: right;"> Kembali</a>
        </h5>
    </div>

    <div class="row">
        @forelse($ruangan->ruangan_barang as $item)
            <div class="col-md-4 mb-4">
                <article class="post-item border rounded p-2 h-100 shadow-sm">
                    <div class="post-image mb-2 text-center">
                        <a href="#">
                            <img src="{{ asset('storage/' . $item->barang->foto) }}" alt="{{ $item->barang->nama_barang }}" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                        </a>
                    </div>
                    <div class="post-content d-flex flex-column gap-1 text-center">
                        <div class="post-meta text-uppercase text-secondary small">
                            <span class="post-category">{{ $item->barang->kategori }} /</span>
                            <span class="meta-day">{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d M Y') }}</span>
                        </div>
                        <h6 class="post-title text-uppercase mb-1">
                            {{ $item->barang->nama_barang }}
                        </h6>
                        <p class="mb-0">Stok: {{ $item->stok }}</p>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Tidak ada barang di ruangan ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
