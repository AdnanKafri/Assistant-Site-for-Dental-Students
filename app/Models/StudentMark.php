<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMark extends Model
{

    use SoftDeletes;

    use HasFactory;
    protected $primaryKey = 'm_id';  // تأكد من أن المفتاح الأساسي هو m_id
    protected $fillable = ['st_id', 'su_id', 'mark'];


    public function student()
    {
        return $this->belongsTo(Student::class, 'st_id', 'st_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'su_id', 'su_id');
    }
}
