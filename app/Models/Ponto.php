<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Ponto extends Model
{
	 protected $connection = 'tenant';
    protected $fillable = ['tipo','student_id'];

    public function student(){
      return $this->belongsTo(Student::class);
    }

}
