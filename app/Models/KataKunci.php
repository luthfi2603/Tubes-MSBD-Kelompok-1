<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KataKunci extends Model {
    use HasFactory;

    protected $primaryKey = 'kata_kunci';
    protected $keyType = 'string';
}