<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'institution',
        'lga_depts',
        'image',
        'center',
        'email',
        'phone',
        'address',
        'description',
        'user_id',
    ];


}
