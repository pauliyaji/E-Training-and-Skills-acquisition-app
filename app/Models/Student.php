<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'student_no',
        'user_id',
        'center_location',
        'institution',
        'lga_depts',
        'course_id',
        'category_id'
    ];

    public function lgas(){
        return $this->belongsTo(Lga::class, 'lga_depts');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function courses(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
