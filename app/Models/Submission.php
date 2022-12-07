<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'mentor_id',
        'ass_id',
        'description',
        'file',
        'status',
        'remarks'
    ];

    public function mentors(){
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function statuses(){
        return $this->belongsTo(Assstatus::class, 'status');
    }

    public function students(){
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function assignments(){
        return $this->belongsTo(Assignment::class, 'ass_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
