<?php

class Controller_Task extends Controller
{
	function __construct()
	{
		session_start();
		$this->user = isset($_SESSION['user']) ? $_SESSION['user'] : 0;
		$this->data = array('user'=>$this->user);	
		$this->model = new Model_Task();
		$this->view = new View();
	}
	
	function action_index()	{
		$is_admin = false;
		if ($this->user === 1) {
			$is_admin = true;
		}

		$post = array(
			'text' => strip_tags($_POST['text']),
			'status' => (isset($_POST['status']) ? 1 : 0),	
			'task_id' => (int)$_POST['task_id'],						
		);
		if (isset($_POST['ch_task'])) {
			if ($is_admin) {
				$ch_task = $this->model->ch_task($post);
				if ($ch_task) {
					$this->data['success'] = 'Изменения сохранены!';
				} else {
					$this->data['error'] = 'Ошибка!';
				}				
			} else {
				header('Location: /user/login',true, 301);
				return;
			}	
		}	

		$this->data['is_admin'] = $is_admin;

		$items_on_page = ITEMS_ON_PAGE;
		$items_count = $this->model->get_tasks_count();
		$pages = ceil($items_count/$items_on_page);
		$page = (isset($_GET['page']) and $_GET['page'] > 1 and $_GET['page'] <= $pages) ? ($_GET['page']-1) : 0;

		$this->data['pages'] = array();
		if ($pages > 1) {
			for ($i=1; $i <= $pages; $i++) { 
				$_GET['page'] = $i;
				$this->data['pages'][] = array('url' => http_build_query($_GET), 'page' => $i);
			}
		}
		$this->data['page'] = $page + 1;

		$filter['start'] = $page*$items_on_page;
		$filter['limit'] = $items_on_page;	

		$filter['sort'] = isset($_GET['sort']) ? $_GET['sort']: '';
		$filter['order'] = isset($_GET['order']) ? $_GET['order']: '';		

		$this->data['task'] = $this->model->get_tasks($filter);	
		$this->data['title'] = 'Задачи';
		$this->data['sort'] = array('email'=>'email', 'user_name'=>'Имя пользователя', 'status'=>'Статус');	
		$this->data['order'] = array('ASC'=>'По возрастанию', 'DESC'=>'По убыванию');	
		$this->view->generate('task_view.php', 'template_view.php', $this->data);
	}

	function action_add() {
		$this->data['title'] = 'Добавить задачу';
		if (isset($_POST['add_task'])) {
				
			$errors = array();
			if (empty($_POST['user_name'])) {
				$errors[] = 'Введите имя пользователя!';
			}
			$pattern = '/^([a-z][a-z\d\.\-_]{0,28}[a-z\d]|[a-z])@[\w_\-\d\.]*\.[\w]{2,5}$/iu';
			if (empty($_POST['email'])) {
				$errors[] = 'Введите email!';
			} elseif ((!preg_match($pattern, trim($_POST['email'])))) {
				$errors[] = 'Проверьте email!';
			}
			if (empty($_POST['text'])) {
				$errors[] = 'Введите текст!';
			}

			if (empty($errors)) {
				$post = array(
					'text' => strip_tags($_POST['text']),
					'user_name' => strip_tags($_POST['user_name']),	
					'email' => strip_tags($_POST['email']),					 	
				);	
				$task_id = $this->model->add_task($post);	
				if ($task_id) {
					$this->data['success'] = 'Запись добавлена';
				}	
			} else {
				$this->data['errors'] = $errors;
			}		
		}

		$this->view->generate('addtask_view.php', 'template_view.php', $this->data);	

	}	

}