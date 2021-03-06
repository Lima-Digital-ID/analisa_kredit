<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    protected $table = 'cabang';


    public function cabang()
    {
        return $this->hasMany('\App\Models\Cabang', 'id');
    }

}
