<?php
	class Daily_Journal_Model extends CI_Model{

		var $table = 'daily_journal';

		public function __construct(){
			parent::__construct();
		}

		public function add_record($data){
			$this->db->insert($this->table,$data);
		}

		public function update_record($data,$id){
			$this->db->where('id',$id);
			$this->db->update($this->table,$data);
		}

		public function get_records($uid){
			$this->db->where('uid', $uid);
			$result = $this->db->get($this->table);
			if($result->num_rows()){
				return $result->result();
			} else {
				return false;
			}
		}

		public function get_event($id){
			$this->db->where('id',$id);
			$r = $this->db->get($this->table);
			if($r->num_rows()){
				return $r->row();
			} else {
				return false;
			}
		}

		public function update_event_date($id,$date){
			$this->db->where('id',$id);
			$event = $this->db->get($this->table);
			if($event->num_rows()) {

				$e = $event->row();

				if($date>0) {
					$date = '+'.$date.' day';
				} else {
					$date = '-'.($date*-1).' day';
				}

				$new_date = date('Y-m-d H:i:s', strtotime($e->dtime.$date));
				$this->db->where('id',$id);
				$this->db->update($this->table, array('update_date' => $new_date));
				echo date('Y/m/d H:i', strtotime($new_date));
			}
		}

		public function delete_record($id) {
			$this->db->where('id', $id);
			$this->db->delete($this->table);
		}

	}

?>