<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'class', 'link', 'availability'];

    public static function where(string $string, $pdf_id)
    {
    }

   /* public function students()
    {
        return $this->belongsToMany(Student::class, 'pdf_student', 'students_id', 'e_books_id');
    }*/
}
