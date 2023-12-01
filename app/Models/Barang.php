<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // hanya id yang tidak boleh di isi user
    protected $guarded = ['id'];

    // table yg digunakan
    protected $table = 'barang';

    // relasi mulai
    public function brg_masuk()
    {
        return $this->hasMany(BrgMasuk::class);
    }

    public function brg_keluar()
    {
        return $this->hasMany(BrgKeluar::class);
    }

    public function stok()
    {
        return $this->hasMany(Stok::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    // relasi selesai
}
