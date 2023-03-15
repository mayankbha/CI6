<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of Admin
 *
 * @author nitin
 */
class Users extends CI_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();

        //Only non logges in user can see this page
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            redirect(c_site_url('admin/auth'), 'refresh');
        }

        $this->load->model('user_model');
		$this->load->model('ion_auth_model');
    }

    public function index() {
		//$this->output->enable_profiler(TRUE);

        //Get all Client
        $users = $this->user_model->get_list(TRUE);
        //$content='';
        $this->load->admin_template('user-list', $this->data);
    }

    

    function get_all_users() {
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("name", "asc"));
        $filter = isset($post["filter"]) ? $post["filter"] : array("name" => "" );
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->user_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $user = $this->user_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
        $data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
        //print_r($data); die;
		echo json_encode($data);
        //$this->load->view('json_view', array('data' => $data));
    }

	//change password
    function change_password($uid=0) {
		//$this->output->enable_profiler(TRUE);

        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
		
		$this->data['uid'] = $uid;

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            //$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');

            $this->data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				'class' => 'form-control',
            	'placeholder' => 'New Password'
            );
            $this->data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				'class' => 'form-control',
            	'placeholder' => 'Confirm New Password'
            );
            $this->data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $uid,
            );

            //render
            $this->_render_page('change_password', $this->data);
        } else {
            $get_user_details = $this->user_model->get_user_details($uid);
			//print_r($get_user_details); die;

			$change = $this->ion_auth_model->reset_password($get_user_details->username, $this->input->post('new'));

			if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', array('message' => 'Password has been changed successfully', 'type' => 'success'));
				redirect('admin/users/change_password/'.$uid, 'refresh');
            } else {
                $this->session->set_flashdata('message', array('message' => 'Password could not changed.', 'type' => 'danger'));
                redirect('admin/users/change_password/'.$uid, 'refresh');
            }
        }
    }

	function user_login($id) {
		$query = $this->db->select('*')
		                  ->where('id', $id)
		                  ->limit(1)
		                  ->get('users');

		if($query->num_rows() === 1) {
			$user = $query->row();

			//print_r($user);
			$this->ion_auth_model->set_session($user);
			redirect(c_site_url('user'), 'refresh');
		}
	}

	//edit a user
    function edit_user($id) {
        $this->data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('auth', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );

            if ($this->form_validation->run() === TRUE) {
                $this->ion_auth->update($user->id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
				$this->session->set_flashdata('message', "User Saved");

                $this->data['message'] = $this->session->flashdata('message');
				$this->_render_page('user-list', $this->data);
                //redirect('admin/users', 'refresh');
            }
        }

        //display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $this->data['user'] = $user;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class' => 'form-control',
            'placeholder' => 'First Name'
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class' => 'form-control',
            'placeholder' => 'Last Name'
        );
        $this->data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'value' => $this->form_validation->set_value('company', $user->company),
			'class' => 'form-control',
            'placeholder' => 'Company'
        );
        $this->data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'value' => $this->form_validation->set_value('phone', $user->phone),
			'class' => 'form-control',
            'placeholder' => 'Phone'
        );
        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $user->email),
			'class' => 'form-control',
            'placeholder' => 'Email'
        );

        $this->_render_page('edit_user', $this->data);
    }

	function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

	function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        //$view_html = $this->load->view($view, $this->viewdata, $render);
		$view_html = $this->load->admin_template($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    public function delete($id_user = 0) {
        //Check if update need
        if ($id_user != 0) {
            $this->user_model->delete($id_user);
            $message = 'User deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(c_site_url('users/admin'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(users('users/admin'));
            die();
        }
    }

    

}
