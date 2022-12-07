<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentmentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_no',
        'mentor_id',
        'mentor_user_id',
        'duration',
        'start_date',
        'end_date',
        'total_assignment_expected',
        'mentorship_status_id',
        'date_assigned',
        'auth_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentorusers(){
        return $this->belongsTo(User::class, 'mentor_user_id');
    }

    public function mentors(){
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    public function status(){
        return $this->belongsTo(Mentorshipstatus::class, 'mentorship_status_id');
    }

}
