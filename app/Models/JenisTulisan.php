<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTulisan extends Model {
    use HasFactory;
    protected $primaryKey = 'jenis_tulisan';
    protected $keyType = 'string';
}