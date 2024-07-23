<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $fillable = ['id','fullname', 'email', 'password', 'photo','phone', 'check_state'];


    public function posts(){
        return $this->hasMany(Post::class, 's_id');
    }
    public function notifications(){
        return $this->hasMany(Notification::class, 's_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

}
