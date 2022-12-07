<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
      'batch_id',
      'course_id',
      'subject_id',
      'student_id',
      'present',
        'absent',
        'period_id',
      'date',

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
