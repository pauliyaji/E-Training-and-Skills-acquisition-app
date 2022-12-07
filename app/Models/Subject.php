<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'duration',
      'file',
      'course_id',
      'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
