<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentfeedback extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'student_no',
      'st_feedback',
      'st_feedbackdate',
      'ment_feedback',
        'ment_date',
    ];
}
