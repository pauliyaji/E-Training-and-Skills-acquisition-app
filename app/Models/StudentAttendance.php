<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [

        'course_id',
        'batch_id',
        'student_id',
        'expected_attendance',
        'student_total_attendance',
        'minimum_attendance',
        'status',

    ];

    public function batches(){
        return $this->belongsTo(Batch::class, 'batch_id');
    }
    public function courses(){
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
