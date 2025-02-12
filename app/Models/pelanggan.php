<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;
    protected $table = 'tb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ["id_pelanggan","nama_pelanggan","NoHo_pelanggan","alamat"];
    protected $keyType = 'string';
    public $timestamps = false;
}
