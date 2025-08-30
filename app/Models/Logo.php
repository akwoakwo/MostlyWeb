<?php

namespace App\Models;

use App\Models\Logoproduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logo extends Model
{
    use HasFactory;
    protected $table = 'logos';
    protected $guards = [];
    protected $fillable=['id','nama_logo','gambar_logo'];

    public function logos()
    {
        return $this->hasMany(Logoproduk::class, 'logo_id');
    }
}
