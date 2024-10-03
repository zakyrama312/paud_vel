<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
     use HasFactory;
    protected $table = 'pembayarans';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

}
