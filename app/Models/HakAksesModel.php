<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAksesModel extends Model
{
    use HasFactory;
    protected $table = "hak_akses";
    protected $fillable = ["nama_hak_akses"];
}
