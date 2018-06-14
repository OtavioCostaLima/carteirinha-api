<?php 

namespace App\Repositories;
use App\User;

class UserRepository {
 	
 	private $user;

 	public function __construct(User $user) {
 		$this->user = $user;
 	}

 	public function create($data) {
 		  return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);	
 	}
}