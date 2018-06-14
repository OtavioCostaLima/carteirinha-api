<?php 

namespace App\Repositories;

use App\Models\Institution;

class InstitutionRepository {
	private $institution;

	public function __construct(Institution $institution) {
		$this->institution = $institution;
	}

	public function create($data) {
		return $this->institution->create($data);
	}
}