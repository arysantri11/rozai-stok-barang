<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class ExportDataController extends Controller
{
    public function stok()
    {
        // cek role user login
        // if(Auth::user()->role != '1') {
        //     return redirect('dashboard');
        // }

        return view('dashboard.export.stok', [
            'title'   => 'Export Stok',
            'dataStok' => Stok::with(['barang'])->get(),
        ]);
    }
}
