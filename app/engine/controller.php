<?php

class Controller {
	
	public $model;
	public $view;
	protected $user;	
	protected $data;
	
	public function __construct() {
		$this->view = new View();	
	}
	
	public function action_index()	{
	}
}