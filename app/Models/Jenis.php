<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

    public function infaq()
    {
        return $this->hasMany(Infaq::class);
    }
}
