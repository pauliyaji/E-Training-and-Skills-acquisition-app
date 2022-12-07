<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'no_of_subjects',
      'duration',
      'minimum_attendance',
      'category_id',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }


}
