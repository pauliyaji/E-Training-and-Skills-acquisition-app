<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_no',
        'user_id',
        'position',
        'area',
        'company',
        'address',
        'lga_depts',
        'category_id'
    ];

    public function lgas(){
        return $this->belongsTo(Lga::class, 'lga_depts');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
