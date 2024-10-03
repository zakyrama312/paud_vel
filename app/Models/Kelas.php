<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

     public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
