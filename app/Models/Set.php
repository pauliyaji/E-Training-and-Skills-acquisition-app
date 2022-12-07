<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'course_id',
        'student_id',
        'period_id',
    ];
    public function student()
    {
        return $this->belongsToMany(Student::class, 'set_student');
    }

    public function students(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function batches(){
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function courses(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function periods(){
        return $this->belongsTo(Period::class, 'period_id');
    }
}
