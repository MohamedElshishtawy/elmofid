<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = [
        'class',
        'name',
        'description',
        'link',
        'availability',
    ];

    protected  $table = '_homework';
}
