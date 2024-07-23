<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'n_id'; // Assuming 'n_id' is the primary key

    protected $fillable = [
        'p_id', 's_id', 'st_id', 'po_id', 'Description', 'type'
    ];


    public function student(){
        return $this->belongsTo(Student::class, 'st_id');
    }
    public function patient(){
        return $this->belongsTo(Patient::class, 'p_id');
    }
    public function supervisor(){
        return $this->belongsTo(Supervisor::class, 's_id');
    }
    public function post(){
        return $this->belongsTo(Post::class, 'po_id');
    }


}
