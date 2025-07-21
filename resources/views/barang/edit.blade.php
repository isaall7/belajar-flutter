@extends('template.admin2')
@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Ruangan</h4>
            <div class="card">
    <div class="card-body">
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

        <form action="{{route('barang.update', $barang->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="" value="{{ $barang->nama_barang }}" required>
                        @error('nama_barang') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Tgl Masuk</label>
                        <input type="date" class="form-control" name="tgl_masuk" id="" value="{{ $barang->tgl_masuk }}" required>
                        @error('tgl_masuk') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Merek</label>
                        <input type="text" class="form-control" name="merek" id="" value="{{ $barang->merek }}" required>
                        @error('merek') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Harga</label>
                        <input type="number" class="form-control" name="harga" id="" value="{{ $barang->harga }}" required>
                        @error('harga') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Stok</label>
                        <input type="number" class="form-control" name="stok" id="" value="{{ $barang->stok }}" required>
                        @error('stok') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="Nama Product">foto Barang</label>
                        <input type="file" class="form-control" name="foto" id="" value="{{ $barang->foto }}" accept="image/*" required>
                        <small>foto</small>
                        @if($barang->foto)
                        <div class="mt-2">
                            <img src="{{asset('storage/' . $barang->foto)}}" style="border-radius: 8px;" width="90" height="90">
                        </div>
                        @endif
                        @error('Foto') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-md-flex align-items-center" style="float: right">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send fs-4"></i>
                                Kirim
                            </button> | 
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
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