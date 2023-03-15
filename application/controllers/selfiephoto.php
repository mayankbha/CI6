<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Selfiephoto extends CI_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();

        //Only logges in user can see this page
        if (!$this->ion_auth->logged_in()) {
            redirect(c_site_url('home/login'), 'refresh');
        }

		$this->load->library('pagination');

        //load Model
        $this->load->model('selfphoto_model');
    }

    /**
     * Show photo upload page for logged in user
     */
    public function index($id = 0) {
        //Set required data
		//print_r($this->input->post()); die;
        
		$this->data['id'] = $id;
		
        $edit_photo = $this->selfphoto_model->get_photo_by_id($id, TRUE);
        $this->data['photo'] = $edit_photo;

        //Exclude pic in case of edit
        $search = array();
		
        if(!empty($edit_photo)) {
            //$search['static'] = "id!='".$edit_photo['id']."'";
        }

        //Get list of all photo
        $search['uid'] = $this->ion_auth->get_user_id();
        $this->data['photo_list'] = $this->selfphoto_model->get_list($search);

        //Set Validation Rules
        $this->form_validation->set_rules('photo_title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('photo_weight', 'Weight', 'required|xss_clean');
        $this->form_validation->set_rules('photo_bmi', 'BMI', 'required|xss_clean');
        $this->form_validation->set_rules('photo', 'Photo', 'trim|xss_clean|checkdoc');

        //Check Validations
        if ($this->form_validation->run() == TRUE) {
            $user_id = $this->ion_auth->get_user_id();
            
            //Check and create directory if not exist
            
            $upload_dir = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            
            if (!is_dir($upload_dir)) {
                $u_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id)) ? mkdir(BASEPATH . '../uploads/' . $user_id, 0777) : '';
                $s_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id.'/self')) ? mkdir(BASEPATH . '../uploads/' . $user_id.'/self', 0777) : '';
                mkdir($upload_dir, 0777);
            }

            $config['upload_path'] = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1000';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            //echo '<pre>'; print_r($config['upload_path']); die;
            if (!$this->upload->do_upload('photo', FALSE) && $id==0) {
                $this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
                $this->data['file_error'] = $this->upload->display_errors();
                
            } else {
                $photo_file = $this->upload->data();

                //Array to save data
                $photo = array(
                    'id' => $id,
		    'privacy_status' => $this->input->post('privacy_status'),
                    'photo_title' => $this->input->post('photo_title'),
                    'date_time' => ($this->input->post('date_time')) ? date('Y-m-d H:i:s', strtotime($this->input->post('date_time'))) : NULL ,
                    'photo_description' => $this->input->post('photo_description'),
                    'photo_weight' => $this->input->post('photo_weight'),
                    'photo_bmi' => $this->input->post('photo_bmi'),
                    'uid' => $this->ion_auth->get_user_id(),
                );

                if(isset($photo_file['file_name']) && $photo_file['file_name'] !== "") {
                    $photo['photo_img'] = $photo_file['file_name'];

                    //Manipulate image
	                $crop_data = $this->input->post('crooperdata');
	                $crop_data = ($crop_data == "") ? '' : json_decode($crop_data);

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
	        	
                    if( $id!=0 ) {
                        $file = $upload_dir . $this->data['photo']['photo_img'];
                        unset($file);
                    }
                }
                
                //Save Data
                $photo_id = $this->selfphoto_model->save($photo);
                if ($photo_id)
                {
                    $this->session->set_flashdata('message', array(
                        'message' => 'Photo uploaded successfully',
                        'type' => 'success',
                    ));
                    redirect(c_site_url('selfiephoto'));
                }
            }
        }

        $this->load->user_template('photo-upload', $this->data);
    }

	public function selfie_ajax_cp() {
		$search['uid'] = $this->ion_auth->get_user_id();
		$this->data['photo_list'] = $this->selfphoto_model->get_list($search, array('id' => $this->input->post('order')));
		$response = $this->load->user_template('user-selfie-photos-ajax-cp', $this->data, TRUE, TRUE);
		echo $response;
		//$this->output->set_output($response);
    }

    public function remove($id=0)
    {
        $user_id = $this->ion_auth->get_user_id();
        $photo = $this->selfphoto_model->get_photo_by_id($id, TRUE);
        if ( empty($photo) ) {
            $this->session->set_flashdata('message', array(
                        'message' => 'Record not found. Please try again later.',
                        'type' => 'danger',
                ));
            redirect(c_site_url('selfiephoto'));
        }
        $upload_dir = BASEPATH . '../uploads/' . $user_id . '/self/';
        $file = $upload_dir . $photo['photo_img'];

        $this->selfphoto_model->remove($photo['id']);
        unset($file);

        $this->session->set_flashdata('message', array(
                'message' => 'Photo removed sucessfully.',
                'type' => 'success',
            ));
        redirect(c_site_url('selfiephoto'));
    }

    public function get_user_self_photos()
    {
        $response = $this->load->user_template('user-self-photos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	/*
	 * User self photos via ajax
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
		$data['query'] = $this->selfphoto_model->getUserSelfPhotos($uid, $data['per_page'], $data['start'], 1, $data['sort_order']);
		$data['total'] = $this->selfphoto_model->getUserSelfPhotosCount($uid, 1);

		$this->load->print_template('user-self-photos-ajax-load', $data);
	}

	public function print_record($id) {
		$print_record_details = $this->selfphoto_model->get_photo_by_id($id);

		$uid = $this->ion_auth->get_user_id();
		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/self/'.$print_record_details->photo_img.'"></div>';
		$new_arr['Date/Time'] = $print_record_details->date_time;
		$new_arr['Title'] = $print_record_details->photo_title;
		$new_arr['Photo Weight'] = $print_record_details->photo_weight;
		$new_arr['Photo BMI'] = $print_record_details->photo_bmi;
		$new_arr['Description'] = $print_record_details->photo_description;

		$this->data['heading'] = $this->session->userdata('identity'). ' SELF PHOTOS DETAILS';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }
}
