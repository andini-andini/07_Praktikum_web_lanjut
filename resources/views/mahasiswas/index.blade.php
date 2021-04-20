@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-10">
                    <form action="{{ route('mahasiswas.search') }}" method="GET">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" name="keywords" class="form-control" id="keywords" aria-describedby="keywords" placeholder="Masukkan nama mahasiswa">
                                <span class="input-group-btn ml-3">
                                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 ml-auto">
                    <a class="btn btn-success" href="{{ route('mahasiswas.create') }}">Input Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Profil</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            {{-- <th>Tgl_Lahir</th>
            <th>No_Handphone</th>
            <th>Email</th> --}}
            <th width="280px">Action</th>
        </tr>
        @foreach ($mahasiswas as $Mahasiswa)
        <tr>

            <td>{{ $Mahasiswa->Nim }}</td>
            <td>{{ $Mahasiswa->Nama }}</td>
            <td>
                @php
                    $pathImage = '';
                    $Mahasiswa->feature_image ? ($pathImage = 'storage/' . $Mahasiswa->feature_image) : ($pathImage = 'img/empty.jpg');
                @endphp
                <img src="{{ asset('' . $pathImage . '') }}" width="100" alt="">
            </td>
            <td>{{ $Mahasiswa->Kelas->nama_kelas }}</td>
            <td>{{ $Mahasiswa->Jurusan }}</td>
            {{-- <td>{{ $Mahasiswa->Tgl_Lahir }}</td>
            <td>{{ $Mahasiswa->No_Handphone }}</td>
            <td>{{ $Mahasiswa->Email }}</td> --}}
            <td>
            <form action="{{ route('mahasiswas.destroy',$Mahasiswa->Nim) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->Nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->Nim) }}">Edit</a>
                <a class="btn btn-warning" href="{{ route('mahasiswas.nilai', $Mahasiswa->Nim) }}">Nilai</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-12 text-center">
            {{ $mahasiswas->links() }}
        </div>
    </div>
@endsection
