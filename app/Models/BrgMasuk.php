<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgMasuk extends Model
{
    use HasFactory;

    // hanya id yang tidak boleh di isi user
    protected $guarded = ['id'];

    // table yg digunakan
    protected $table = 'brg_masuk';

    // relasi mulai
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    // relasi selesai
}
