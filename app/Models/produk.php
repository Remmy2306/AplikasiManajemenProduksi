<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'tb_produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = ["id_produk","nama_produk","harga","foto_barang"];
    protected $keyType = 'string';
    public $timestamps = false;
}
