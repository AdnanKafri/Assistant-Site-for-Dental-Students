<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'images'];

    protected $primaryKey = 't_id';

    protected $casts = [
        'images' => 'array',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 't_id');
    }
}
