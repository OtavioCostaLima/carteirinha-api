<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MParent extends Model
{
	   protected $connection = 'tenant';
	protected $table = "parents";
    protected $fillable = ['nome', 'telefone','email','cpf'];

    public function students(){
    	return $this->hasMany(\App\Models\Student::class,"parent_id","id");
    }
}
