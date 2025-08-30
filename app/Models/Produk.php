<?php

namespace App\Models;

use App\Models\Logo;
use App\Models\Preview;
use App\Models\Kategori;
use App\Models\Pemesanan;
use App\Models\Logoproduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $guarded = [];
    protected $fillable=['id','kategori_id','nama_produk', 'gambar_produk', 'fitur'];
    protected $casts = [
        'fitur' => 'array',
    ];

    public function kategori_produk()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function previews()
    {
        return $this->hasMany(Preview::class, 'produk_id');
    }

    public function logos()
    {
        return $this->belongsToMany(Logo::class, 'logo_produks', 'produk_id', 'logo_id');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'produk_id');
    }
}
