<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $table = 'penggajians';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
