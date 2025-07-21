@extends('template.admin2')

@section('content')
<br><br><br>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Detail Peminjaman dari <b><i>{{$peminjaman->nama_peminjam}}</i></b></h4>
        @if (session('success'))
            <div class="alert alert-info alert-dismissiblae fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{route('detail.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <h4>Barang</h4>
                    </div>
                    <div class="form-floating mb-3">
                        <div class="row">
                        @foreach($ruanganbarang as $item)
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
                                            <input type="number" name="stok" class="form-control" value="{{ $item->barang->stok }}" disabled>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label"><strong>Minjam Berapa?</strong></label>
                                        <input type="number" name="jumlah[]" class="form-control">
                                        <input type="hidden" name="ruangan_barang_id[]" value="{{ $item->id }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
        <div class="col-12">
            <div class="d-md-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-send fs-4"></i> Submit
                </button>
            </div>
        </div>
    </div>
</form>

    </div>
</div>
        </div>
    </div>
</div>

@endsection