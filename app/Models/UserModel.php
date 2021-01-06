<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = "user";
    protected $fillable = ["username","password","id_hak_akses","active"];
    protected $primaryKey = "id_user";
}
