<?php

namespace App\Repositories;

use App\Models\DataBaseInstitution;

class DataBaseInstitutionRepository {
    
	private $dataBaseInstitution;

    public function __construct(DataBaseInstitution $dataBaseInstitution) {
        $this->dataBaseInstitution = $dataBaseInstitution;
    }

	public function create ($data, $institution) {
  
        $dataCreate = array(
          "institution_id" =>  $institution->id,
          "driver" => "pgsql",
          "host" => $data["host"],
          "database" => $data["database"],
          "username" => $data["username"],
          "password" => $data["password"],
          "charset" => $data["charset"],
          "collation" => $data["collation"],
          "prefix" => $data["prefix"]
        );

        return $this->dataBaseInstitution->create($dataCreate);
		}

}