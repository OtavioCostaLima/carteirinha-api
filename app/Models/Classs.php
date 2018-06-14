<?php

namespace App\Models;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classs extends Model

{
  protected $connection = 'tenant';
  protected $table = 'classes';
  protected $fillable = ['descricao','sigla','turno','ano'];
  public $timestamps = false;


  public function students(){
       return $this->belongsToMany(Student::class,'student_class');
  }

  public function timetables(): HasMany {
       return $this->hasMany(TimeTable::class);
   }
}
