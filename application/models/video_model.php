<?php
	class Video_model extends CI_Model {

		private $table = 'video';

		public function __construct(){
			parent::__construct();
		}

		public function get_list($uid, $sort = array(), $is_array = false) {
        
			$this->db->select($this->table . '.*');
	
			//Sort 
			if (!empty($sort)) {
				foreach ($sort as $field => $sort_order) {
					$this->db->order_by($field, $sort_order);
				}
			}

			$this->db->where('uid', $uid);

			$query = $this->db->get($this->table);
	
			//echo $this->db->last_query(); 
			if ($is_array == true) {
				return $query->result_array();
			}
			return  $query->result();
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

		/*
		 * Get count of total user videos
		*/
		public function getUserVideosCount($uid, $privacy_status=1) {$this->db->limit($limit, $start);
			if($privacy_status == 1) {
				$result = $this->db->where('uid', $uid)->get($this->table);
			} else {
				$result = $this->db->where(array('uid' => $uid, 'privacy_status' => $privacy_status))->get($this->table);
			}

			if($result->num_rows() > 0) {
				return $result->num_rows();
			}
		}

		public function getUserVideos($uid, $limit, $start, $privacy_status=1) {
			if($privacy_status == 1) {
				$this->db->limit($limit, $start);
				$this->db->where('uid', $uid);
				$result = $this->db->get($this->table);
			} else {
				$this->db->limit($limit, $start);
				$this->db->where(array('uid' => $uid, 'privacy_status' => $privacy_status));
				$result = $this->db->get($this->table);
			}

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

		public function delete_record($id) {
			$this->db->where('id', $id);
			$this->db->delete($this->table);
		}

	}
?>