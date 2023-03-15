<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Description of selfphoto_model
 *
 * @author SITS
 */
class Selfphoto_model extends CI_Model {

    private $table = 'self_photo';

    /**
     * save or Update a USER into database
     * @param type $data
     * @return boolean
     */
    function save($data = array()) {
        if (empty($data)) {
            return FALSE;
        }
        if (isset($data['id']) && $data['id'] !== 0) {
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $data['create_date'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }

    /**
     * Get List of all photo
     * @param type $searchs
     * @param type $sort
     * @param type $from
     * @param type $num_result
     * @param type $is_array
     * @return type
     */
    public function get_list($searchs = array(), $sort = array(), $is_array = false) {
        
        $this->db->select($this->table . '.*');

        //Sort 
        if (!empty($sort)) {
            foreach ($sort as $field => $sort_order) {
                $this->db->order_by($field, $sort_order);
            }
        }

        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (empty($val)) {
                    continue;
                }
                if($field=='static')  
                    $this->db->where($val, NULL, FALSE);    
                else
                    $this->db->where($field, $val);
            }
        }
        
        $query = $this->db->get($this->table);

        //echo $this->db->last_query(); 
        if ($is_array == true) {
            return $query->result_array();
        }
        return  $query->result();
    }

    /**
     * Return Single photo
     * @param type $searchs
     * @param type $sort
     * @param type $from
     * @param type $num_result
     * @param type $is_array
     * @return type
     */
    public function get_photo_by_id($id, $is_array=false) {
        
        $this->db->select($this->table . '.*'); 
        $this->db->where('id', $id); 

        $query = $this->db->get($this->table);

        //echo $this->db->last_query(); 
        if ($is_array == true) {
            return $query->row_array();
        }
        return  $query->row();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return TRUE;
    }

	/*
	 * Get count of total user's meal photos
	*/
	public function getUserSelfPhotosCount($uid, $privacy_status=1) {
		if($privacy_status == 1) {
				$this->db->where('uid', $uid);
				$result = $this->db->get($this->table);
			} else {
				$this->db->where('uid', $uid);
				$this->db->where('privacy_status', $privacy_status);
				$result = $this->db->get($this->table);
			}

		if($result->num_rows() > 0) {
			return $result->num_rows();
		}
	}

	public function getUserSelfPhotos($uid, $limit, $start, $privacy_status=1, $sort_order='asc') {
		if($privacy_status == 1) {
			$this->db->limit($limit, $start);
			$this->db->where('uid', $uid);
			$this->db->order_by('id', $sort_order);
			$result = $this->db->get($this->table);
		} else {
			$this->db->limit($limit, $start);
			$this->db->where('uid', $uid);
			$this->db->where('privacy_status', $privacy_status);
			$this->db->order_by('id', $sort_order);
			$result = $this->db->get($this->table);
		}

		if($result->num_rows()>0){
			return $result->result();
		} else {
			return false;
		}
	}

}
