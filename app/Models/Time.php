<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $fillable = ['students_id', 'exams_id'];

    public function students(){
        return $this->belongsTo(Student::class, 'students_id');
    }
    public function exams(){
        return $this->belongsTo(Exam::class, 'exams_id');
    }
}
