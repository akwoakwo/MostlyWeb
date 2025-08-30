<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preview extends Model
{
    use HasFactory;
    protected $table = 'preview_produks';
    protected $guarded = [];
    protected $fillable=['id','produk_id','gambar'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
