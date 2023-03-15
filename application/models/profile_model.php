<?php
	class Video_model extends CI_Model {

		private $table = 'video';

		public function __construct(){
			parent::__construct();
		}

		/*
		 * Upload Meal Photo
		*/
		public function saveVideo($video_data, $id) {
			if($id != 0) {
				$this->db->where('id', $id);
				$this->db->update($this->table, $video_data);
			} else {
				$this->db->insert($this->table, $video_data);
				return $this->db->insert_id();
			}
		}

		public function getUserVideos($uid) {
			$this->db->where('uid', $uid);
			$result = $this->db->get($this->table);

			if($result->num_rows()>0){
				return $result->result();
			} else {
				return false;
			}
		}

		public function getUserVideoDetails($id) {
			$this->db->where('id', $id);
			$result = $this->db->get($this->table);

			if($result->num_rows()>0){
				return $result->row();
			} else {
				return false;
			}
		}

	}
?>