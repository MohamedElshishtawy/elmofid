<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Degree extends Model
{
    use HasFactory;
    protected $fillable = ['students_id', 'exams_id', 'degree', 'duration'];

    public function students(){
        return $this->belongsTo(Student::class, 'students_id');
    }
    public function exams(){
        return $this->belongsTo(Exam::class, 'exams_id');
    }
}
