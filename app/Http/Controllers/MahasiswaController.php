<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        $mahasiswas = Mahasiswa::with('kelas')->orderBy('Nim', 'desc')->paginate(3);
        return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Tgl_Lahir' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);

        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        //fungsi eloquent untuk mengambil data kelas dari relation
        $kelas = Kelas::find($request->get('Kelas'));

        //fungsi eloquent untuk menyimpan data mahasiswa
        $Mahasiswa = new Mahasiswa();
        $Mahasiswa->Nim = $request->get('Nim');
        $Mahasiswa->Nama = $request->get('Nama');
        $Mahasiswa->feature_image = $image_name;
        $Mahasiswa->Jurusan = $request->get('Jurusan');
        $Mahasiswa->Tgl_Lahir = $request->get('Tgl_Lahir');
        $Mahasiswa->No_Handphone = $request->get('No_Handphone');
        $Mahasiswa->Email = $request->get('Email');

        $Kelas = new Kelas;
        $Kelas->id = $request->get('Kelas');

        $Mahasiswa->Kelas()->associate($Kelas); // FUngsi eloquent untuk menyimpan belongTo
        $Mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();

        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::with('Kelas')->where('Nim', $Nim)->first();
        $Kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa', 'Kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Tgl_Lahir' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);


        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        //fungsi eloquent untuk menyimpan data mahasiswa
        $Mahasiswa = Mahasiswa::with('Kelas')->where('Nim', $Nim)->first();
        $Mahasiswa->Nim = $request->get('Nim');
        $Mahasiswa->Nama = $request->get('Nama');
        $Mahasiswa->feature_image = $image_name;
        $Mahasiswa->Jurusan = $request->get('Jurusan');
        $Mahasiswa->Tgl_Lahir = $request->get('Tgl_Lahir');
        $Mahasiswa->No_Handphone = $request->get('No_Handphone');
        $Mahasiswa->Email = $request->get('Email');
        $Mahasiswa->save();

        if ($Mahasiswa->feature_image && file_exists(storage_path('app/public/' . $Mahasiswa->feature_image))) {
            Storage::delete('public/' . $Mahasiswa->feature_image);
        }

        $Kelas = new Kelas;
        $Kelas->id = $request->get('Kelas');

        $Mahasiswa->Kelas()->associate($Kelas); // FUngsi eloquent untuk menyimpan belongTo
        $Mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);

        //fungsi eloquent untuk menghapus data pada relasi mahasiswa_matakuliah
        $Mahasiswa->matakuliah()->detach();

        //fungsi eloquent untuk menghapus data
        $Mahasiswa->delete();;
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%" . $request->keywords . "%")->paginate(5);
        return view('mahasiswas.search', compact('mahasiswas'));
    }
    public function nilai($Nim)
    {
        //menampilkan detail data nilai mahasiswa dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswas = Mahasiswa::with('Kelas', 'matakuliah')->find($Nim);
        return view('mahasiswas.nilai', compact('mahasiswas'));
    }
};
