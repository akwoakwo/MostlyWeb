<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'pemesanan_id',
        'transaction_id_midtrans',
        'order_id_midtrans',
        'total_amount',
        'payment_method',
        'issuer',
        'acquirer',
        'reference_number',
        'status',
        'transaction_time',
    ];

    /**
     * Relasi dengan model Pemesanan.
     */
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }
}