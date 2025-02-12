<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;
        protected $table = 'tb_penjualan';
        protected $primaryKey = 'id_penjualan';
        protected $fillable = ["id_penjualan","id_sales","id_produk","id_pelanggan","tanggal_penjualan","jumlah_penjualan","total_harga","bukti_penjualan"];
        protected $keyType = 'string';
        public $timestamps = false;
        public function produk()
        {
            return $this->belongsTo('App\Models\produk', 'id_produk', 'id_produk');
        }

        public function pelanggan()
        {
            return $this->belongsTo('App\Models\pelanggan', 'id_pelanggan', 'id_pelanggan');
        }

        public function user()
        {
            return $this->belongsTo('App\Models\User', 'id_sales', 'id');
        }
}
