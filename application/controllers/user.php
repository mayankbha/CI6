<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class User extends CI_Controller {
    private $data = array();

    public function __construct() {
        parent::__construct();

		$this->load->model('user_model');
		$this->load->model('ion_auth_model');

        //Only logges in user can see this page
        if($this->ion_auth->logged_in()) {
			if($this->ion_auth->is_admin()) {
				redirect(c_site_url('home/login'), 'refresh');
			}
        }
    }
    
    /**
     * Show home page for logged in user
     */
    public function index()
    {
        $this->load->user_template('home');
    }
    
    /**
     * Logout an logged in user
     */
    public function logout()
    {
        $this->ion_auth->logout();
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        
        redirect(c_site_url('home/login'), 'refresh');
    }

	public function my_account($up='') {
		$uid = $this->ion_auth->get_user_id();

		if($up != '') {
			if($up == 'ecp') {
				$this->data['change_password_error_message'] = $this->session->flashdata('change_password_error_message');
			}

			if($up == 'scp') {
				$this->data['change_password_success_message'] = $this->session->flashdata('change_password_success_message');
			}
		}

		if($up != '') {
			if($up == 'eup') {
				$this->data['update_error_profile_message'] = $this->session->flashdata('update_error_profile_message');
			}

			if($up == 'sup') {
				$this->data['update_success_profile_message'] = $this->session->flashdata('update_success_profile_message');
			}
		}
		
		$this->data['user_details'] = $this->user_model->get_user_details($uid);
		$this->load->user_template('user-account-detail', $this->data);
	}

	//change password
	public function change_password() {
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if($this->form_validation->run() == false) {
			$this->data['change_password_validation_error_message'] = validation_errors();
			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

			$this->load->user_template('user-account-detail', $this->data);
		} else {
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
			$change = $this->ion_auth_model->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if($change) {
				$this->session->set_flashdata('change_password_success_message', array(
						'change_password_success_message' => 'Password changed successfully',
						'type' => 'success',
				));
				redirect('user/my_account/scp', 'refresh');

				//$this->session->set_flashdata('change_password_success_message', $this->ion_auth->messages());
				//$this->logout();
			} else {
				$this->session->set_flashdata('change_password_error_message', array(
						'change_password_error_message' => 'Invalid old password.',
						'type' => 'danger',
				));

				redirect('user/my_account/ecp', 'refresh');

				//$this->session->set_flashdata('change_password_error_message', $this->ion_auth->errors());
            }
        }
	}

	public function edit_profile() {
		$uid = $this->ion_auth->get_user_id();

		if(isset($_POST) && !empty($_POST)) {
			$data = array(
				'first_name' => $this->input->post('fname'),
				'last_name' => $this->input->post('lname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'diet' => $this->input->post('diet'),
				'nickname' => $this->input->post('nickname'),
				'goals' => $this->input->post('goals')
			);

			if($_FILES['photo']['name'] != '') {
				$upload_dir = BASEPATH . '../uploads/' . $uid . '/profile/';
		
				if(!is_dir($upload_dir)) {
					$u_dir = (!is_dir(BASEPATH . '../uploads/' . $uid)) ? mkdir(BASEPATH . '../uploads/' . $uid, 0777) : '';
					mkdir($upload_dir, 0777);
				}
		
				$config['upload_path'] = BASEPATH . '../uploads/' . $uid . '/profile';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
		
				$this->load->library('upload', $config);
		
				if(!$this->upload->do_upload('photo', FALSE)) {
					$this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
					//$this->data['file_error'] = $this->upload->display_errors();
					$this->session->set_flashdata('update_error_profile_message', array(
							'update_error_profile_message' => $this->upload->display_errors(),
							'type' => 'danger',
					));
		
					redirect(c_site_url('user/my_account/eup'));
				} else {
					$photo_file = $this->upload->data();

					//print_r($photo_file) . "<br>";

					$data['profile_pic'] = $photo_file['file_name'];
		
					//Manipulate image
					$crop_data = $this->input->post('crooperdata');
					$crop_data = ($crop_data =="") ? '' : json_decode($crop_data);
		
					//Set resize config
					$r_config['image_library'] = 'gd2';
					$r_config['source_image'] = $photo_file['full_path'];
					$r_config['new_image'] = $photo_file['file_path'].$photo_file['file_name'];
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
		
					$this->data['user_photo'] = $this->user_model->get_user_details($id);
					$file = $upload_dir . $this->data['user_photo']->profile_pic;
					unset($file);
				}
			}

			//print_r($meal_data); die;
			$this->user_model->updateUserProfile($data, $uid);
	
			$this->session->set_flashdata('update_success_profile_message', array(
					'update_success_profile_message' => 'Record updated successfully',
					'type' => 'success',
			));

			redirect(c_site_url('user/my_account/sup'));
		}
	}

	public function TermsOfService() {
		$this->load->template('termsOfService', $this->data, false, 'user');
	}

}