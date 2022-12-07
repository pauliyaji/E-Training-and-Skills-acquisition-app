<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ass_no',
        'description',
        'student_no',
        'mentor_id',
        'status',
    ];

    // note that the mentor_id is same as the mentor user id
    public function mentors(){
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function statuses(){
        return $this->belongsTo(Assstatus::class, 'status');
    }

    public function students(){
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function assignments(){
        return $this->belongsTo(Assignment::class, 'ass_no');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
