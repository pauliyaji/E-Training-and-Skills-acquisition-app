<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Starterpack extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'device',
      'serial_no',
      'date_of_issuance',
        'usertype_id',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function usertypes(){
        return $this->belongsTo(Usertype::class, 'usertype_id');
    }
}
