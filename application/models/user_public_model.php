<?php
	class User_Public_Model extends CI_Model{

		var $table = 'users';

		public function __construct(){
			parent::__construct();
		}

		public function get_user($username) {
			$this->db->where('username', $username);
			$result = $this->db->get($this->table);

			if($result->num_rows()) {
				return $result->row();
			} else {
				return false;
			}
		}

		public function get_user_name($id) {
			$this->db->where('id', $id);
			$result = $this->db->get($this->table);

			if($result->num_rows()) {
				return $result->row();
			} else {
				return false;
			}
		}

	}

?>