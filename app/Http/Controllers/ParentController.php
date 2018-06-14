<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParentController extends Controller
{

	private $parent;

	public function __construct (\App\Models\MParent $parent) {
		$this->parent = $parent;
	}

    public function show ($id) {
    	
    	$parent = $this->parent->where('cpf','=',$id)->first();
    
    	if($parent) {
    		return response()->json($parent,200); 
    	} else {
    		return response()->json(['errors' => 'Pai ou responsável não encontrado.'],404); 
    	}
    }
}
