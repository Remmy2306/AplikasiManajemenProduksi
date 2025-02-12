<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\barangdiproses;

class barangkeluar extends Model
{
    use HasFactory;
    protected $table = 'tb_barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $fillable = ["id_barang_keluar","id_proses","tanggal_keluar","jumlah_keluar","tujuan"];
    protected $keyType = 'string';
    public $timestamps = false;

    public function proses()
    {
        return $this->belongsTo(barangdiproses::class, 'id_proses');
    }
}
