<?php

namespace App\Models;

use App\Models\Subpaket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $guards = [];
    protected $fillable=['id','nama_paket'];

    public function detail_paket()
    {
        return $this->hasMany(Subpaket::class, 'paket_id');
    }
}
