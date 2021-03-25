<?php

class Model_Task extends Model {
	public function get_tasks($data = array()) {
		$sql = "SELECT * FROM tasks";
		$sort_data = array(
			'email',
			'user_name',
			'status'
		);		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {			
			$sql .= " ORDER BY " . $data['sort'];			
		} else {
			$sql .= " ORDER BY date_added";
		}

		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$task_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$task_data[$result['task_id']] = $result;
		}

		return $task_data;
	}
	public function get_tasks_count() {
		$sql = "SELECT COUNT(*) AS count FROM tasks";

		$query = $this->db->query($sql);

		return $query->row['count'];
	}	
	public function add_task($data) {
		$this->db->query("INSERT INTO tasks SET user_name = '" . $this->db->escape($data['user_name']) . "', email = '" . $this->db->escape($data['email']) . "', text = '" . $this->db->escape($data['text']) . "', date_added = NOW()");
		$task_id = $this->db->getLastId();

		return $task_id;
	}

	public function ch_task($data) {
		$ch_task = $this->db->query("UPDATE tasks SET status = " . $data['status'] . ", text = '" . $this->db->escape($data['text']) . "' WHERE task_id = '" . (int)$data['task_id'] . "'");
		return $ch_task;
	}
}