<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BrgKeluar;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BrgKeluarController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.brg_keluar.index', [
            'title'   => 'Barang Keluar',
            'dataBarang' => Barang::with(['kategori', 'stok'])->get(),
            'dataBrgKeluar' => BrgKeluar::with(['barang'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $dataBarang = Barang::where('id', $request->barang_id)->first();
        $dataStok = Stok::where('barang_id', $request->barang_id)->first();

        // Simpan data baru ke dalam database
        try {
            BrgKeluar::create([
                "barang_id" => $request->barang_id,
                "tanggal" => $request->tanggal,
                "jumlah" => $request->jumlah,
                "ket" => $request->ket,
                "penerima" => $request->penerima,
                "total_harga" => $dataBarang->harga_satuan * ((int) $request->jumlah),
            ]);

            $dataStok->update([
                "stok" => $dataStok->stok - (int)$request->jumlah,
                "total_harga" => $dataBarang->harga_satuan * ($dataStok->stok - (int)$request->jumlah),
            ]);
            
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Masuk Gagal Ditambahkan!');
            // return redirect()->back()->with('failed', '<strong>Data Gudang Gagal Disimpan</strong> : ' . $th->getMessage());
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Masuk Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            // menghapus sebuah data pada database
            $dataBrgKeluar = BrgKeluar::with(['barang'])->where('id', $id)->first();
            $dataStok = Stok::where('barang_id', $dataBrgKeluar->barang_id)->first();

            // kurangi stok
            $stok = $dataStok->stok + $dataBrgKeluar->jumlah;

            $dataStok->update([
                "stok" => $stok,
                "total_harga" => $dataBrgKeluar->barang->harga_satuan * ($stok),
            ]);

            $dataBrgKeluar->delete();

        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Keluar Gagal Dihapus!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Keluar Berhasil Dihapus!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // ambil data berdasarkan id
        $dataBrgKeluar = BrgKeluar::where('id', $id)->first();
        $dataBarang = Barang::where('id', $request->barang_id)->first();
        $dataStok = Stok::where('barang_id', $request->barang_id)->first();

        // menyimpan perubahan data ke dalam database
        try {
            // hitung stok
            $stok = $dataStok->stok + $dataBrgKeluar->jumlah;
            $stok = $stok - (int) $request->jumlah;
            // dd($stok);

            $dataBrgKeluar->update([
                "barang_id" => $request->barang_id,
                "tanggal" => $request->tanggal,
                "jumlah" => $request->jumlah,
                "ket" => $request->ket,
                "total_harga" => $dataBarang->harga_satuan * ((int) $request->jumlah),
            ]);

            $dataStok->update([
                "stok" => $stok,
                "total_harga" => $dataBarang->harga_satuan * $stok,
            ]);
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data Barang Keluar Gagal Diubah!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data Barang Keluar Berhasil Diubah!');
        return redirect()->back();
    }
}
