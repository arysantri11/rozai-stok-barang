<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.barang.index', [
            'title'   => 'Barang',
            'dataBarang' => Barang::all(),
            'dataKategori' => Kategori::with(['barang'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        // membuat validasi data yang di input user
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga_satuan' => 'required',
            'satuan' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'kategori.required' => 'Pilih Kategori',
            'harga.required' => 'Harga tidak boleh kosong',
            'satuan.required' => 'Pilih Satuan',
        ]);

        // jika tidak lolos validasi
        if($validatedData->fails()) {
            Alert::error('Gagal', 'Data Barang Gagal Ditambahkan!');
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // Simpan data baru ke dalam database
        try {
            Barang::create([
                "nama" => $request->nama,
                "kategori_id" => $request->kategori_id,
                "merk" => $request->merk,
                "ukuran" => $request->ukuran,
                "harga_satuan" => (int) $request->harga_satuan,
                "satuan" => $request->satuan,
                "lokasi" => $request->lokasi,
            ]);
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Gagal Ditambahkan!');
            // return redirect()->back()->with('failed', '<strong>Data Gudang Gagal Disimpan</strong> : ' . $th->getMessage());
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // ambil data barang berdasarkan id
        $dataBarang = Barang::where('id', $id)->first();

        // membuat validasi data yang di input user
        $validatedData = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori_id' => 'required',
            'harga_satuan' => 'required',
            'satuan' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'kategori.required' => 'Pilih Kategori',
            'harga.required' => 'Harga tidak boleh kosong',
            'satuan.required' => 'Pilih Satuan',
        ]);

        // jika tidak lolos validasi
        if($validatedData->fails()) {
            Alert::error('Gagal', 'Data Barang Gagal Diubah!');
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // menyimpan perubahan data ke dalam database
        $dataBarang->update([
            "nama" => $request->nama,
            "kategori_id" => $request->kategori_id,
            "merk" => $request->merk,
            "ukuran" => $request->ukuran,
            "harga_satuan" => (int) $request->harga_satuan,
            "satuan" => $request->satuan,
            "lokasi" => $request->lokasi,
        ]);

        // redirect
        Alert::success('Berhasil', 'Data Barang Berhasil Diubah!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            // menghapus sebuah data pada database
            $dataBarang = Barang::where('id', $id)->first();
            $dataBarang->delete();

        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Gagal Dihapus!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Berhasil Dihapus!');
        return redirect()->back();
    }
}
