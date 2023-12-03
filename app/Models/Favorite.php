<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'karya_id'];
}