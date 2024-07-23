<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    public $timestamps = true; // Assuming you are using timestamps
    protected $primaryKey = 'su_id';
    protected $fillable = ['name', 'subject_year'];



//    public function studentsMarks()
//    {
//        return $this->hasMany(StudentsMark::class, 'su_id');
//    }
    public function studentsMarks(){
        return $this->hasMany(StudentMark::class, 'su_id');
    }

}
