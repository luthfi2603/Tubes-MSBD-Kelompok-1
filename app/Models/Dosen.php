<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model {
    use HasFactory;
    protected $primaryKey = 'nidn';
    protected $keyType = 'string';
    public $timestamps = false;
}