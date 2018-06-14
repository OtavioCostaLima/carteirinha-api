<?php 

namespace App\Services;
use App\Repositories\TeacherRepository;


class TeacherService {
	private $teacherRepository;

	 public function __construct(TeacherRepository $teacherRepository) {
    	 private $this->teacherRepository = $teacherRepository;
    }


}