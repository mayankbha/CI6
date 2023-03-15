<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Meal_Planner extends CI_Controller
{
    private $data = array();

    public function __construct() 
    {
        parent::__construct();
        
        //Only logges in user can see this page
        if (!$this->ion_auth->logged_in())
        {
            redirect(c_site_url('home/login'), 'refresh');
        }
        $this->load->model('meal_planner_model');
		$this->load->model('mealphoto_model');
    }
    
    /**
     * Show fitness page for logged in user 
     */
    public function index($id=0)
    {
		$uid = $this->ion_auth->get_user_id();
		
        if($id) $data['form'] = $this->meal_planner_model->get_event($id);

        $data['id'] = $id;

        if($this->input->post('submit')) {
			$meal_kind = implode(',', $this->input->post('meal_kind'));

			$d['uid'] = $this->ion_auth->get_user_id();
            
			if($this->input->post('dtime') != '') {
				$d['dtime'] = $this->input->post('dtime');
			} else {
				$d['dtime'] = '';
			}

            $d['title'] = addslashes($this->input->post('title'));
			$d['privacy_status'] = $this->input->post('privacy_status');
			$d['meal_kind'] = $meal_kind;
            $d['details'] = $this->input->post('details');
            $d['extra'] = $this->input->post('extra');
            $d['notes'] = $this->input->post('notes');
            $d['create_date'] = date('Y-m-d h:i:s');

			//print_r($d);
			//print_r($_FILES['photo']);

			if($_FILES['photo']['name'] != '') {
				$upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/original/';

				if (!is_dir($upload_dir)) {
					$u_dir = (!is_dir(BASEPATH . '../uploads/' . $uid)) ? mkdir(BASEPATH . '../uploads/' . $uid, 0777) : '';
					$s_dir = (!is_dir(BASEPATH . '../uploads/' . $uid.'/meal')) ? mkdir(BASEPATH . '../uploads/' . $uid.'/meal', 0777) : '';
					mkdir($upload_dir, 0777);
				}
	
				$config['upload_path'] = BASEPATH . '../uploads/' . $uid . '/meal/original/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size'] = '1000';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				$config['encrypt_name'] = TRUE;
	
				$this->load->library('upload', $config);
	
				if(!$this->upload->do_upload('photo', FALSE)) {
					$this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
					//$this->data['file_error'] = $this->upload->display_errors();
					$this->session->set_flashdata('message', array(
						'message' => $this->upload->display_errors(),
						'type' => 'danger',
					));
	
					redirect(c_site_url('meal_planner/index/'.$id));
				} else {
					$photo_file = $this->upload->data();
	
					$d['meal_photo'] = $photo_file['file_name'];
	
					//Manipulate image
					$crop_data = $this->input->post('crooperdata');
					$crop_data = ($crop_data =="") ? '' : json_decode($crop_data);
	
					//Set resize config
					$r_config['image_library'] = 'gd2';
					$r_config['source_image'] = $photo_file['full_path'];
					$r_config['new_image'] = $photo_file['file_path'].'../'.$photo_file['file_name'];
					$r_config['maintain_ratio'] = FALSE;
	
					if($crop_data != '') {
						$r_config['width'] = $crop_data->width;
						$r_config['height'] = $crop_data->height;
						$r_config['x_axis'] = $crop_data->x1;
						$r_config['y_axis'] = $crop_data->y1;
					}
	
					//echo "<pre>"; print_r($r_config) ;die();
	
					$this->load->library('image_lib', $r_config);
					$this->image_lib->crop();
				}
			}

            if($id != 0) {
				if($_FILES['photo']['name'] != '') {
					$data['form'] = $this->meal_planner_model->get_event($id);
					$file = $upload_dir . $this->data['form']->meal_photo;
					unset($file);
				}

				$this->meal_planner_model->update_record($d, $id);

				$this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));

				redirect(c_site_url('meal_planner'));
            } else {
                 $this->meal_planner_model->add_record($d);
                 $this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));

				redirect(c_site_url('meal_planner'));
            }
           
        }

		$data['id'] = $id;
        $data['events'] = $this->meal_planner_model->get_records($uid);
        $this->load->user_template('meal-planner-form',$data);
    }

    public function ajax(){
        $changed = $this->input->post('changed');
        $eventId = $this->input->post('eventId');
        $this->meal_planner_model->update_event_date($eventId,$changed);
    }

	/**
     * Return user meal schedule ajax data
     */
    public function get_user_meal_schedule()
    {
		//$this->output->enable_profiler(TRUE);
		$uid = $this->ion_auth->get_user_id();
		$this->data['user_meal_schedules'] = $this->meal_planner_model->getUserMealSchedule($uid, 1);
        $response = $this->load->user_template('meal-schedule-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function delete_record() {
		$uid = $this->ion_auth->get_user_id();

		$id = $this->input->post('id');

		$detail = $this->meal_planner_model->get_event($id);
		$upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/';
        $file = $upload_dir . $detail->meal_photo;
		unset($file);

        $this->meal_planner_model->delete_record($id);

		$this->session->set_flashdata('message', array(
			'message' => 'Record removed sucessfully.',
			'type' => 'success'
		));
    }

	public function print_record($id) {
		$print_record_details = $this->meal_planner_model->get_event($id);

		$uid = $this->ion_auth->get_user_id();
		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/meal/'.$print_record_details->meal_photo.'"></div>';
		$new_arr['Date/Time'] = $print_record_details->dtime;
		$new_arr['Title'] = stripslashes($print_record_details->title);
		$new_arr['Meal Kind'] = $print_record_details->meal_kind;
		$new_arr['Recipe'] = $print_record_details->details;
		$new_arr['Car, Carbs, Fat, Etc.'] = $print_record_details->extra;
		$new_arr['Notes'] = $print_record_details->notes;

		$this->data['heading'] = $this->session->userdata('identity'). ' MEAL SCHEDULE';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}
