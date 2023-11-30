<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.kategori.index', [
            'title'   => 'Kategori',
            'dataKategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        // membuat validasi data yang di input user
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required|unique:kategori',
        ], [
            'nama.unique' => 'Nama telah dipakai',
        ]);

        // jika tidak lolos validasi
        if($validatedData->fails()) {
            Alert::error('Gagal', 'Data Kategori Gagal Ditambahkan!');
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // Simpan data baru ke dalam database
        try {
            Kategori::create([
                "nama" => $request->nama,
            ]);
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Kategori Gagal Ditambahkan!');
            // return redirect()->back()->with('failed', '<strong>Data Gudang Gagal Disimpan</strong> : ' . $th->getMessage());
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Kategori Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // ambil data kategori berdasarkan id
        $dataKategori = Kategori::where('id', $id)->first();

        // membuat validasi data yang di input user
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
        ]);

        // jika nama diubah
        if($request->nama != $dataKategori->nama) {
            $validatedData = Validator::make($request->all(), [
                'nama' => 'unique:kategori',
            ], [
                'nama.unique' => 'Nama telah dipakai',
            ]);
        }

        // jika tidak lolos validasi
        if($validatedData->fails()) {
            Alert::error('Gagal', 'Data Kategori Gagal Diubah!');
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // menyimpan perubahan data ke dalam database
        $dataKategori->update([
            "nama" => $request->nama,
        ]);

        // redirect
        Alert::success('Berhasil', 'Data Kategori Berhasil Diubah!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            // menghapus sebuah data pada database
            $dataKategori = Kategori::where('id', $id)->first();
            $dataKategori->delete();

        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Kategori Gagal Dihapus!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Kategori Berhasil Dihapus!');
        return redirect()->back();
    }

    
}
