<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\barangmasuk;

class barangdiproses extends Model
{
    use HasFactory;
    protected $table = 'tb_barang_diproses';
    protected $primaryKey = 'id_barang_diproses';
    protected $fillable = ["id_barang_diproses","id_barang_masuk","tanggal_proses","jumlah_diproses","status"];
    protected $keyType = 'string';
    public $timestamps = false;

    public function barangMasuk()
    {
        return $this->belongsTo(barangmasuk::class, 'id_barang_masuk');
    }
}
