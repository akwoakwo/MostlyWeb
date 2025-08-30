<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori_produks';
    protected $guards = [];
    protected $fillable=['id','nama_kategori'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
