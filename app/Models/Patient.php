<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'Address', 'age', 'post_timer'];

    protected $primaryKey = 'p_id';


    public function posts(){
        return $this->hasMany(Post::class, 'p_id');
    }
    public function notifications(){
        return $this->hasMany(Notification::class, 'p_id');
    }

    // التأكد من أن العلاقة مع المستخدم تُعرّف بشكل صحيح
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
