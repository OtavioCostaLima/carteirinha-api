<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\DataBaseInstitution;

class Institution extends Model
{
	  protected $connection = 'pgsql';

	  protected $fillable = ['name'];

	  public function database () {
	  	    return $this->hasOne(DataBaseInstitution::class,'institution_id');
	  }
}
