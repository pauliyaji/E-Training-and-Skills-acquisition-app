<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentorshipstatus extends Model
{
    use HasFactory;

    protected $table = 'mentorshipstatuses';

    protected $fillable = [
      'status',
    ];
}
