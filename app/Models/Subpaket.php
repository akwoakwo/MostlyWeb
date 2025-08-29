<?php

namespace App\Models;

use App\Models\Paket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subpaket extends Model
{
    use HasFactory;
    protected $table = 'detail_pakets';
    protected $guards = [];
    protected $fillable=['id','paket_id','nama_subpaket','harga','benefit'];
    protected $casts = [
        'benefit' => 'array',
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
