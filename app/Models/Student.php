<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'study_year', 'rating','card'];
    protected $primaryKey = 'st_id';

    public function posts(){
        return $this->hasMany(Post::class, 'st_id');
    }
    public function notifications(){
        return $this->hasMany(Notification::class, 'st_id');
    }
    public function marks(){
        return $this->hasMany(StudentMark::class, 'st_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }



}
