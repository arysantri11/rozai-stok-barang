<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.user.index', [
            'title'   => 'User',
            'dataUser' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        // membuat validasi data yang di input user
        $validatedData = Validator::make($request->all(), [
            'username' => 'required|unique:users',
        ], [
            'username.unique' => 'Username telah dipakai',
        ]);

        // jika tidak lolos validasi
        if($validatedData->fails()) {
            Alert::error('Gagal', 'Data User Gagal Ditambahkan!');
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }

        // Simpan data baru ke dalam database
        try {
            User::create([
                "username" => $request->username,
                "name" => $request->name,
                "password" => bcrypt($request->password),
            ]);
        } catch (\Throwable $th) {
            // redirect
            Alert::error('Gagal', 'Data User Gagal Ditambahkan!');
            // return redirect()->back()->with('failed', '<strong>Data Gudang Gagal Disimpan</strong> : ' . $th->getMessage());
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data User Berhasil Ditambahkan!');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // ambil data user berdasarkan id
        $dataUser = User::where('id', $id)->first();
        $password = $dataUser->password;

        // jika password diubah
        if($request->password !== '') {
            $password = bcrypt($request->password);
        }

        try {
            // menyimpan perubahan data ke dalam database
            $dataUser->update([
                "username" => $request->username,
                "name" => $request->name,
                "password" => $password,
                "role" => $request->role,
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            // redirect
            Alert::error('Gagal', 'Data User Gagal Diubah!');
            return redirect()->back();
        }

        // redirect
        Alert::success('Berhasil', 'Data User Berhasil Diubah!');
        return redirect()->back();
    }
}
