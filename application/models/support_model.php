<?php
	class Support_model extends CI_Model {

		private $table = 'support';

		public function __construct() {
			parent::__construct();
		}

		/*
		 * Save contact record
		*/
		public function saveData($support_data) {
			$this->db->insert($this->table, $support_data);
			return $this->db->insert_id();
		}

		public function saveRequestData($data) {
			$this->db->insert('request_feature', $data);
			return $this->db->insert_id();
		}

		public function saveProblemData($data) {
			$this->db->insert('report_problem', $data);
			return $this->db->insert_id();
		}
	}
?>