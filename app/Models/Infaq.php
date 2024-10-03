<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infaq extends Model
{
    use HasFactory;
    protected $table = 'infaqs';
    protected $primarykey = 'id';
    protected $guarded = [];

    // public $incrementing = false;
    public $timestamps = true;

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }
}
