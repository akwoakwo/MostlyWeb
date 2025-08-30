<?php

namespace App\Models;

use App\Models\Logo;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logoproduk extends Model
{
    use HasFactory;
    protected $table = 'logo_produks';
    protected $guards = [];
    protected $fillable=['id','produk_id','logo_id'];

    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function logos()
    {
        return $this->belongsTo(Logo::class, 'logo_id');
    }
}
