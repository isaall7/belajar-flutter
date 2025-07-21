@extends('template.admin2')
@section('content')

<br><br><br>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Ganti Ruangan</h4>
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
        <form action="{{route('ruangan.update', $ruangan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
            <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="Nama Product">Nama Ruangan</label>
                        <input type="text" class="form-control" name="nama_ruangan" id="" value="{{ $ruangan->nama_ruangan }}" required>
                        @error('nama_ruangan') 
                        {{ $message }}
                        @enderror
                    </div>
            </div>
            <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="Nama Product">Foto Ruangan</label>
                        <input type="file" class="form-control" name="foto" id="" value="{{ $ruangan->foto }}" accept="image/*" required>
                        <small>foto</small>
                        @if($ruangan->foto)
                        <div class="mt-2">
                            <img src="{{asset('storage/' . $ruangan->foto)}}" style="border-radius: 8px;" width="90" height="90">
                        </div>
                        @endif
                        @error('Foto') 
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                    <label for="Nama Product">Deskripsi</label> 
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $ruangan->deskripsi }}</textarea>
                        @error('deskripsi') 
                        {{ $message }}
                        @enderror
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