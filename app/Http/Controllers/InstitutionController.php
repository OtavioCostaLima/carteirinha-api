<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;

class InstitutionController extends Controller
{
   private $institution;

    public function __construct (Institution $institution) {
    	$this->institution = $institution;
    }

    public function index () { 
        return $this->institution->all();
    }

	public function show($id) {
		   	$institution = $this->institution->find($id);
		   	$data = array($institution->database);
           return $data;
	}

    
}
