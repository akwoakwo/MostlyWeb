<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use App\Models\Review;
use App\Models\Subpaket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanans';
    protected $guarded = [];
    protected $fillable=['id', 'user_id', 'subpaket_id', 'produk_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subpaket()
    {
        return $this->belongsTo(Subpaket::class, 'subpaket_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

        public function ulasan()
    {
        return $this->hasOne(Review::class, 'pemesanan_id', 'id');
    }
}
