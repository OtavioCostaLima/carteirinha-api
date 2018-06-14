<?php

namespace App\Services;

use App\Repositories\DataBaseRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\DataBaseInstitutionRepository;
use App\Repositories\UserRepository;


class DataBaseService {

	private $dataBaseRepository;
	private $institutionRepository;
	private $dataBaseInstitutionRepository;
	private $userRepository;

	public function __construct(
		DataBaseRepository $dataBaseRepository, 
		InstitutionRepository $institutionRepository,
	    DataBaseInstitutionRepository $dataBaseInstitutionRepository,
	    UserRepository $userRepository
		) {
		$this->dataBaseRepository = $dataBaseRepository;
		$this->institutionRepository = $institutionRepository;
		$this->dataBaseInstitutionRepository = $dataBaseInstitutionRepository;
		$this->userRepository = $userRepository;
	}  

	public function create($data) {
		
		$values = $this->dataBaseRepository->create($data);
		if (!is_null($values) && $values != 500) {
			$institution = $this->institutionRepository->create($data);
			if(!is_null($institution)) {
 			$dataBaseinstitution = $this->dataBaseInstitutionRepository->create($values, $institution);
 			if(!is_null($dataBaseinstitution)) {
 				$user = $this->userRepository->create($data);
 				return $user;
 			}
			}
		}
		return 500; 
	}
}