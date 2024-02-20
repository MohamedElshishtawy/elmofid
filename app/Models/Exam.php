<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    use HasFactory;
    protected $fillable = ['name', 'class', 'duration', 'start_date', 'end_date', 'availability','random_order', 'show_deg'];

    public function degrees(){
        return $this->hasMany(Degree::class,'degrees_id');
    }

    public function times(){
        return $this->hasMany(Time::class,'times_id');
    }
}


