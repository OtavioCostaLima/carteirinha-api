<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TeacherService;
class TeacherController extends Controller
{
    private $teacherService;

    public function __construct(TeacherService $teacherService) {
    	 private $this->teacherService = $teacherService;
    }
    
}
