@extends('template.admin2')
@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Ruangan</h4>
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

        <form action="{{route('barang.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="" value="{{ old('nama_barang')}}" required>
                        @error('nama_barang') 
                        {{ $massage }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Merek</label>
                        <input type="text" class="form-control" name="merek" id="" value="{{ old('merek')}}" required>
                        @error('merek') 
                        {{ $massage }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Harga</label>
                        <input type="number" class="form-control" name="harga" id="" value="{{ old('harga')}}" required>
                        @error('harga') 
                        {{ $massage }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Stok</label>
                        <input type="number" class="form-control" name="stok" id="" value="{{ old('stok')}}" required>
                        @error('stok') 
                        {{ $massage }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Foto Barang</label>
                        <input type="file" class="form-control" name="foto" id="" value="{{ old('foto')}}" accept="image/*" required>
                        @error('foto') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <label for="">Kategori</label>
                        <select name="kategori" id="" class="form-control">
                            <option value="" disable>--Pilih Kategori--</option>
                            <option value="Alat Tulis">Alat Tulis</option>
                            <option value="Buku">Buku</option>
                            <option value="Elekronik">Elekronik</option>
                            <option value="Furnitur">Furnitur</option>
                            <option value="Band">Band</option>
                        @error('kategori') 
                        {{ $message }}
                        @enderror
                        </select>
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