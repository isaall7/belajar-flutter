@extends('template.admin2')
@section('content')

<div class="container-fluid py-6">
    <div class="card shadow-sm rounded-4 w-100">
        <div class="card-body">
            <h4 class="card-title mb-3">Tambah Ruangan</h4>
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
        <form action="{{route('ruangan.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <label for="">Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan" id="" value="{{ old('nama_ruangan')}}" required>
                        @error('nama_ruangan') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="">Foto Ruangan</label>
                        <input type="file" class="form-control" name="foto" id="" value="{{ old('foto')}}" accept="image/*" required>
                        @error('foto') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control" value="{{ old('deskripsi') }}"></textarea>
                        @error('deskripsi') 
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
                            <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Kembali</a>

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