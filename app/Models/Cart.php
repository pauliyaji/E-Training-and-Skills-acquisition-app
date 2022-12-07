<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'course_id',
        'subject_id',
        'student_id',
        'present',
        'absent',
        'period_id',
        'date',
        'user_id',
        'student_no',
        'auth_id',

    ];

    public function classes(){
        return $this->belongsTo(Set::class, 'class_id');
    }
    public function course_id(){
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function subjects(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function students(){
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function periods(){
        return $this->belongsTo(Period::class, 'period_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
