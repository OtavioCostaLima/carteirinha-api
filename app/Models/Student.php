<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classs;
use App\Models\Ponto;
use App\Models\MParent;

class Student extends Model
{

   protected $connection = 'tenant';
  protected $fillable = ['nome', 'telefone','email','parent_id','id'];

	public $rules = [
  	'nome' => 'required'
	];

  public function classes(){
     return $this->belongsToMany(Classs::class,"student_class");
  }

  public function points(){
    return $this->hasMany(Ponto::class,'student_id');
  }

    public function parent(){
    return $this->belongsTo(MParent::class);
  }

}
