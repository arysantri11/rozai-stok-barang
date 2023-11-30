<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BrgMasukController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.brg_masuk.index', [
            'title'   => 'Barang Masuk',
            'dataBarang' => Barang::with(['kategori'])->get(),
            'dataBrgMasuk' => BrgMasuk::with(['barang'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $dataBarang = Barang::where('id', $request->barang_id)->first();

        // Simpan data baru ke dalam database
        try {
            BrgMasuk::create([
                "barang_id" => $request->barang_id,
                "tanggal" => $request->tanggal,
                "jumlah" => $request->jumlah,
                "ket" => $request->ket,
                "total_harga" => $dataBarang->harga_satuan * ((int) $request->jumlah),
            ]);
        } catch (\Throwable $th) {
            // dd($th);
            // redirect
            Alert::error('Gagal', 'Data Barang Masuk Gagal Ditambahkan!');
            // return redirect()->back()->with('failed', '<strong>Data Gudang Gagal Disimpan</strong> : ' . $th->getMessage());
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Masuk Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // ambil data berdasarkan id
        $dataBrgMasuk = BrgMasuk::where('id', $id)->first();
        $dataBarang = Barang::where('id', $request->barang_id)->first();

        // menyimpan perubahan data ke dalam database
        try {
            $dataBrgMasuk->update([
                "barang_id" => $request->barang_id,
                "tanggal" => $request->tanggal,
                "jumlah" => $request->jumlah,
                "ket" => $request->ket,
                "total_harga" => $dataBarang->harga_satuan * ((int) $request->jumlah),
            ]);
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Masuk Gagal Diubah!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Masuk Berhasil Diubah!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            // menghapus sebuah data pada database
            $dataBrgMasuk = BrgMasuk::where('id', $id)->first();
            $dataBrgMasuk->delete();

        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Masuk Gagal Dihapus!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Masuk Berhasil Dihapus!');
        return redirect()->back();
    }
}
