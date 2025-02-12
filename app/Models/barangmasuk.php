<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangmasuk extends Model
{
    use HasFactory;
    protected $table = 'tb_barang_masuk';
    protected $primaryKey = 'id_barang_masuk';
    protected $fillable = ["id_barang_masuk","tanggal_masuk","nama_barang","jumlah","supplier"];
    protected $keyType = 'string';
    public $timestamps = false;
}
