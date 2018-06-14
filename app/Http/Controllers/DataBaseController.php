<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\DataBaseService;

class dataBaseController extends Controller
{

	private $dataBaseService;

	public function __construct(DataBaseService $dataBaseService) {
		$this->dataBaseService = $dataBaseService;
	}  

	public function create(Request $request) {
		$data = $request->all();
		$data = $this->dataBaseService->create($data);
		return response($data); 
	}

}
