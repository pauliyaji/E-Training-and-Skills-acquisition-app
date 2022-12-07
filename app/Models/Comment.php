<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =[
        'ass_id',
        'comments',
        'user_id'
    ];

    public function assignments(){
        return $this->belongsTo(Assignment::class, 'ass_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
