<?php

namespace App\Repositories;
use App\Models\Mparent;

class ParentRepository {

	private $parent;

	public function __construct(Mparent $parent) {
		$this->parent = $parent; 
	}

	public function create($data) {
		$this->parent->create($data);
	} 
}