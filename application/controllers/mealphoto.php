<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Mealphoto extends CI_Controller 
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

		$this->load->library('pagination');
		$this->load->model('mealphoto_model');
	}

	/**
	*Show photo upload page for logged in user
	*/

	public function index($id=0) 
    {
		$uid = $this->ion_auth->get_user_id();

		if($_FILES['photo']['name'] != '') {
			$upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/original/';

			$config['upload_path'] = BASEPATH . '../uploads/' . $uid . '/meal/original/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('photo', FALSE)) {
				$this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
				//$this->data['file_error'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', array(
						'message' => $this->upload->display_errors(),
						'type' => 'danger',
				));

				redirect(c_site_url('mealphoto'));
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

				//echo "<pre>"; print_r($r_config); die();

				$this->load->library('image_lib', $r_config);
				$this->image_lib->crop();

				$this->data['meal_photo'] = $this->mealphoto_model->getUserMealDetails($id);
				$file = $upload_dir . $this->data['meal_photo']->meal_photo;
				unset($file);

				//print_r($meal_data); die;
				$this->mealphoto_model->uploadMealData($d, $id);

				$this->session->set_flashdata('message', array(
						'message' => 'Record updated successfully',
						'type' => 'success',
				));

				redirect(c_site_url('mealphoto'));
			}
        }

		if($id != 0) {
			$this->data['meal_photo'] = $this->mealphoto_model->getUserMealDetails($id);
		}

		$this->data['id'] = $id;
		$this->data['uid'] = $uid;
		$this->data['meal_photos'] = $this->mealphoto_model->get_list($uid, array('id' => 'asc'));
		//$this->data['meal_photos'] = $this->mealphoto_model->get_list($uid, 200, 0, 1, 'asc');
		$this->load->user_template('meal-photo-upload', $this->data);
	}

    /*public function index($id=0) 
    {
		 $uid = $this->ion_auth->get_user_id();

        //Set Validation Rules
        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('meal_kind', 'Meal Kind', 'required|xss_clean');

		//Check Validations
        if($this->form_validation->run() == TRUE) {

			$meal_kind = implode(',', $this->input->post('meal_kind'));

			//Array to save data
			$meal_data = array(
				'uid' => $uid,
				'privacy_status' => $this->input->post('privacy_status'),
				'title' => $this->input->post('title'),
				/*'date_time' => $this->input->post('date_time'),
				'meal_kind' => $meal_kind,
				'description' => $this->input->post('description'),
				'recipe' => $this->input->post('recipe'),
				'nutritional_facts' => $this->input->post('nutritional_facts'),
				'create_date' => strtotime(date('Y-m-d h:i:s'))
			);

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

			if($_FILES['photo'] != '') {
				if(!$this->upload->do_upload('photo', FALSE)) {
					$this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
					//$this->data['file_error'] = $this->upload->display_errors();
					$this->session->set_flashdata('message', array(
						'message' => $this->upload->display_errors(),
						'type' => 'danger',
					));

					redirect(c_site_url('mealphoto'));
				} else {
					$photo_file = $this->upload->data();

					$meal_data['meal_photo'] = $photo_file['file_name'];

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

                    if($id != 0) {
						$this->data['user_meal_details'] = $this->mealphoto_model->getUserMealDetails($id);
						//print_r($this->data['user_meal_details']);
                        $file = $upload_dir . $this->data['user_meal_details']->meal_photo;
                        unset($file);
                    }
				}
			}

			//print_r($meal_data); die;
			$this->mealphoto_model->uploadMealData($meal_data, $id);

			if($id != 0) {
				$this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));

				redirect(c_site_url('mealphoto'));
			} else {
				$this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));

				redirect(c_site_url('mealphoto'));
			}
        }

		if($id != 0) {
			$this->data['user_meal_details'] = $this->mealphoto_model->getUserMealDetails($id);
		}

		$this->data['id'] = $id;
		$this->data['uid'] = $uid;
		$this->data['meal_photos'] = $this->mealphoto_model->getUserMealPhotos($uid, 20, 0, 1);
		$this->load->user_template('meal-photo-upload', $this->data);
	}*/

	public function remove($id=0)
    {
        $uid = $this->ion_auth->get_user_id();
        $photo = $this->mealphoto_model->getUserMealDetails($id, TRUE);
        if ( empty($photo) ) {
            $this->session->set_flashdata('message', array(
                        'message' => 'Record not found. Please try again later.',
                        'type' => 'danger',
                ));
            redirect(c_site_url('mealphoto'));
        }
        $upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/';
        $file = $upload_dir . $photo->meal_photo;

        $this->mealphoto_model->remove($photo->id);
        unset($file);

        $this->session->set_flashdata('message', array(
                'message' => 'Photo removed sucessfully.',
                'type' => 'success',
            ));
        redirect(c_site_url('mealphoto'));
    }

	/**
     * Return user meal photos ajax data
     */
    public function get_user_meal_photos()
    {
        $response = $this->load->user_template('user-meal-photos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function mealphoto_ajax_cp() {
		$uid = $this->ion_auth->get_user_id();
		$this->data['photo_list'] = $this->mealphoto_model->get_list($uid, array('id' => $this->input->post('order')));
		$response = $this->load->user_template('user-meal-photos-ajax-cp', $this->data, TRUE, TRUE);
		echo $response;
		//$this->output->set_output($response);
    }

	/*
	 * User meal photos via ajax
	*/
	public function ajax_function()
	{
		$data['page'] = $_POST['page'];
		$data['cur_page'] = $data['page'];
		$data['page'] -= 1;
		$data['per_page'] = $_POST['per_page'];
		$data['previous_btn'] = true;
		$data['next_btn'] = true;
		$data['first_btn'] = true;
		$data['last_btn'] = true;
		$data['start'] = $data['page'] * $data['per_page'];

		$data['sort_order'] = $_POST['sort_order'];

		//$this->output->enable_profiler(TRUE);

		$uid = $this->ion_auth->get_user_id();
		$data['uid'] = $uid;
		$data['query'] = $this->mealphoto_model->getUserMealPhotos($uid, $data['per_page'], $data['start'], 1, $data['sort_order']);
		$data['total'] = $this->mealphoto_model->getUserMealPhotosCount($uid, 1);

		$this->load->print_template('user-meal-photos-ajax-load', $data);
	}

	public function print_record($id) {
		$print_record_details = $this->mealphoto_model->getUserMealDetails($id);

		$uid = $this->ion_auth->get_user_id();
		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/meal/'.$print_record_details->meal_photo.'"></div>';
		$new_arr['Date/Time'] = $print_record_details->date_time;
		$new_arr['Title'] = $print_record_details->title;
		$new_arr['Meal Kind'] = $print_record_details->meal_kind;
		$new_arr['Description'] = $print_record_details->description;
		$new_arr['Recipe'] = $print_record_details->recipe;
		$new_arr['Nutritional Facts'] = $print_record_details->nutritional_facts;

		$this->data['heading'] = $this->session->userdata('identity'). ' MEAL SCHEDULE';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}
