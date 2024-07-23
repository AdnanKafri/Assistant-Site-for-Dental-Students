<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    protected $primaryKey = 'po_id';

    protected $fillable = [
        'id', 't_id', 'Description', 'images', 'state', 'patient_rate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function notifications(){
        return $this->hasMany(Notification::class, 'po_id');
    }
    public function statusType(){
        return $this->belongsTo(StatusType::class, 't_id');
    }
    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }

    // تخزين الصور كمصفوفة JSON
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

}
