@extends('mahasiswas.layout')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('mahasiswas.update', $Mahasiswa->Nim) }}" id="myForm"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                    <label for="Nim">Nim</label><br>
                    <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $Mahasiswa->Nim }}" aria-describedby="Nim" >
                </div>
                <div class="form-group">
                    <label for="Nama">Nama</label><br>
                    <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $Mahasiswa->Nama }}" aria-describedby="Nama" >
                </div>
                @php
                    $pathImage = '';
                    $Mahasiswa->feature_image ? ($pathImage = 'storage/' . $Mahasiswa->feature_image) : ($pathImage = 'img/empty.jpg');
                @endphp
                <div class="d-flex align-items-start mb-3">
                    <img src="{{ asset('' . $pathImage . '') }}" alt="" width="100" class="img-responsive">
                    <div class="form-group" >
                        <label for="image">Profil</label><br>
                        <input type="file" class="form-control" required="required" name="image"><br>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Kelas">Kelas</label><br>
                    <select type="Kelas" name="Kelas" class="form-control" id="Kelas">
                        <option selected disabled>--- Pilih Kelas ---</option>
                        @foreach ($Kelas as $kls)
                            <option value="{{ $kls->id }}"
                                {{ $Mahasiswa->Kelas->id === $kls->id ? 'selected' : '' }}>
                                {{ $kls->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Jurusan">Jurusan</label><br>
                    <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $Mahasiswa->Jurusan }}" aria-describedby="Jurusan" >
                </div>
                <div class="form-group">
                    <label for="Tgl_Lahir">Tgl_Lahir</label><br>
                    <input type="Tgl_Lahir" name="Tgl_Lahir" class="form-control" id="Tgl_Lahir"  value="{{ $Mahasiswa->Tgl_Lahir }}" aria-describedby="Tgl_Lahir" >
                </div>
                <div class="form-group">
                    <label for="No_Handphone">No_Handphone</label><br>
                    <input type="No_Handphone" name="No_Handphone" class="form-control" id="No_Handphone" value="{{ $Mahasiswa->No_Handphone }}" aria-describedby="No_Handphone" >
                </div>
                <div class="form-group">
                    <label for="Email">Email</label><br>
                    <input type="Email" name="Email" class="form-control" id="Email"  value="{{ $Mahasiswa->Email }}" aria-describedby="Email" >
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
