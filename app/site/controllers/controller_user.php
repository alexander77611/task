<?php

class Controller_User extends Controller
{

	function __construct() {		
		session_start();
		$this->user = isset($_SESSION['user']) ? $_SESSION['user'] : 0;
		$this->data = array('user'=>$this->user);	
		$this->model = new Model_User();
		$this->view = new View();
	}
	function action_index()	{	
		header('Location: /',true, 301);
	}
	function action_login()	{
		if ($this->user) {
			header('Location: /',true, 301);
		}
		$post = $_POST;	
		$errors = array();
		if (isset($post['login'])) {
			if (empty($post['user_name'])) {
				$errors[] = 'Введите имя пользователя!';
			}
			if (empty($post['pass'])) {
				$errors[] = 'Введите пароль!';
			}
			if (empty($errors)) {

				$user = $this->model->get_user($post['user_name']);
				if (isset($user['id']) and $user['pass'] === md5($post['pass'])) {					
					$_SESSION['user'] = $user['id'];
					header('Location: /',true, 301);
				} else {
					$errors[] = 'Проверьте имя пользователя и пароль!';
					$this->data['errors'] = $errors;
				}
			} else {
				$this->data['errors'] = $errors;
			}			
		}


		$this->data['title'] = 'Авторизация';
		$this->view->generate('user_view.php', 'template_view.php', $this->data);

	}
	function action_logout() {
		session_destroy();	
		header('Location: /',true, 301);
	}

}