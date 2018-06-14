<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
	protected $connection = 'tenant';
  protected $fillable = ['description','type'];

public $rules = [
'description' => 'required',
'type'  => 'required'
];

public $timetamps = false;
}
