<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Storage;


class Student extends Model implements Authenticatable

{
    use HasFactory;
    use AuthenticatableTrait;
    protected $fillable = [ 'code',
                            'name',
                            'phone',
                            'parent_phone',
                            'email',
                            'password',
                            'money',
                            'class',
                            'group'
    ];


    public static function student_image($id)
    {
        // Get all files in the 'public' disk directory
        $files = Storage::disk('public')->files('students');

        // Loop through each file
        foreach ($files as $file) {

            // Extract the file name without extension
            $fileWithoutExtension = pathinfo($file, PATHINFO_FILENAME);

            // Check if the current file matches the provided name
            if ((int)$fileWithoutExtension == $id) {
                // Return the full file name with extension
                return $file;
            }
        }
        return null;
    }


    public function groups()
    {
        return $this->belongsTo(Group::class, 'groups_id');
    }
    public function degrees(){
        return $this->hasMany(Degree::class,'degrees_id');
    }

    public function times(){
        return $this->hasMany(Time::class,'times_id');
    }

    public function ebooks()
    {
        return $this->belongsToMany(EBook::class, 'pdf_student', 'e_books_id', 'students_id');
    }

}
