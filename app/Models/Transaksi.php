<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['anggota_id', 'jenis', 'jumlah', 'tanggal', 'keterangan'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}