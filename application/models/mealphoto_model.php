<?php
	class Mealphoto_model extends CI_Model {

		//private $table_mealphoto = 'meal_photo';
		private $table_mealphoto = 'meal_planner';

		public function __construct(){
			parent::__construct();
		}

		public function get_list($uid, $sort = array(), $is_array = false) {
        
			$this->db->select($this->table_mealphoto . '.*');
	
			//Sort 
			if (!empty($sort)) {
				foreach ($sort as $field => $sort_order) {
					$this->db->order_by($field, $sort_order);
				}
			}

			$this->db->where('meal_photo !=', '');
			$this->db->where('uid', $uid);

			$query = $this->db->get($this->table_mealphoto);
	
			//echo $this->db->last_query(); 
			if ($is_array == true) {
				return $query->result_array();
			}
			return  $query->result();
		}

		/*
		 * Get count of total user's meal photos
		*/
		public function getUserMealPhotosCount($uid, $privacy_status=1) {
			if($privacy_status == 1) {
				$this->db->where('meal_photo !=', '');
				$this->db->where('uid', $uid);
				$result = $this->db->get($this->table_mealphoto);
			} else {
				$this->db->where('meal_photo !=', '');
				$this->db->where('uid', $uid);
				$this->db->where('privacy_status', $privacy_status);
				$result = $this->db->get($this->table_mealphoto);
			}

			if($result->num_rows() > 0) {
				return $result->num_rows();
			}
		}

		/*
		 * Upload Meal Photo
		*/
		public function uploadMealData($meal_data, $id) {
			if($id != 0) {
				$this->db->where('id', $id);
				$this->db->update($this->table_mealphoto, $meal_data);
			} else {
				$this->db->insert($this->table_mealphoto, $meal_data);
				return $this->db->insert_id();
			}
		}

		public function getUserMealPhotos($uid, $limit, $start, $privacy_status=1, $sort_order='asc') {
			if($privacy_status == 1) {
				$this->db->limit($limit, $start);
				$this->db->where('meal_photo !=', '');
				$this->db->where('uid', $uid);
				$this->db->order_by('id', $sort_order);
				$result = $this->db->get($this->table_mealphoto);
			} else {
				$this->db->limit($limit, $start);
				$this->db->where('meal_photo !=', '');
				$this->db->where('uid', $uid);
				$this->db->where('privacy_status', $privacy_status);
				$this->db->order_by('id', $sort_order);
				//$this->db->where(array('uid' => $uid, 'privacy_status' => $privacy_status));
				$result = $this->db->get($this->table_mealphoto);
			}

			if($result->num_rows()>0){
				return $result->result();
			} else {
				return false;
			}
		}

		public function getUserMealDetails($id) {
			$this->db->where('id', $id);
			$result = $this->db->get($this->table_mealphoto);

			if($result->num_rows()>0) {
				return $result->row();
			} else {
				return false;
			}
		}

		public function remove($id) {
        	$this->db->where('id', $id);
        	$this->db->update($this->table_mealphoto, array('meal_photo' => ''));
        	return TRUE;
 		}

	}
?>