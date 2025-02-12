<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengguna extends Model
{
    use HasFactory;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $fillable = ["id_user","nama","password","email","level"];
    protected $keyType = 'string';
    public $timestamps = false;
}
