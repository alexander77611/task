<?php

class Model_User extends Model {
	private $users;
	public function __construct() {
		$this->users = array(
			'admin' => array(
				'id' => 1,
				'pass' => md5('123'),
			)
		);

	}
	public function get_user($username) {
		$user = array();
		if (isset($this->users['admin'])) {
			$user = $this->users['admin'];
		}
		return $user;

	}
}