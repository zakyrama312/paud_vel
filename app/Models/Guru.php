<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

    public function penggajian()
    {
        return $this->hasMany(Penggajian::class,'guru_id');
    }
}
