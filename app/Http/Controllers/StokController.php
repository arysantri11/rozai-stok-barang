<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.stok.index', [
            'title'   => 'Stok',
            'dataStok' => Stok::with(['barang'])->get(),
        ]);
    }
}
