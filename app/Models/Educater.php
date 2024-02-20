<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educater extends Model
{
    use HasFactory;


    public static function class_human_read(int $class){
        switch ($class) {
            case 1: return "الصف الأول الثانوى";
            case 2: return "الصف الثانى الثانوى";
            case 3: return "الصف الثالث الثانوى";
        }
    }

}
