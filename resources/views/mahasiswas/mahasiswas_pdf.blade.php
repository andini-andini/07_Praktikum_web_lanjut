@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h4><strong>KARTU HASIL STUDI (KHS)</strong></h4>
        </div>
        <div class="col-12 my-4">
            <br><br>
            <p class="m-0"><strong>Nama:</strong> {{ $mahasiswas->Nama }}</p>
            <p class="m-0"><strong>NIM:</strong> {{ $mahasiswas->Nim }}</p>
            <p class="m-0"><strong>Kelas:</strong> {{ $mahasiswas->Kelas->nama_kelas }}</p>
        </div>
        <div class="col-12">

        <br><br><br><br>
        <br><br>
            <table class="table table-bordered">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                </tr>
                @foreach ($mahasiswas->matakuliah as $mk)
                    <tr>
                        <td>{{ $mk->nama_matkul }}</td>
                        <td>{{ $mk->sks }}</td>
                        <td>{{ $mk->semester }}</td>
                        <td>{{ $mk->pivot->nilai }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
