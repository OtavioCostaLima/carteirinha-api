<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBaseInstitution extends Model
{
	  public $table = "database_institution";
	  protected $connection = 'pgsql';
	  
	  protected $fillable = ['institution_id','driver','host','database','username','password','charset','collation', 'prefix'];
}
