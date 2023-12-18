<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteEbook extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'ebook_id'];
}
