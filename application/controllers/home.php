<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of home
 *
 * @author SITS
 */
class Home extends CI_Controller {

    private $data = array();

    public function __construct() {
        parent::__construct();

        //Only non logges in user can see this page
        if($this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
			redirect(c_site_url('user'), 'refresh');
        }
    }

    /*
     * Show Home page and registration form
     */

    public function index() {
        //Set Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		//$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_message('is_unique', '%s is already exists.');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');

        if ($this->form_validation->run() == TRUE) {
            $userData = array('name' => $this->input->post('name'));
            $this->ion_auth->register(
                    $this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $userData, array('2')
            );
			$this->session->set_flashdata('message', 'Thank you for registration, activation link is sent to your email id. Please check your email and activate your account.');
			redirect(c_site_url("home/login"));
            die();
        } else {
            //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $this->data['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'class' => 'cus-input-front validate[required]',
                'placeholder' => 'Name',
                'value' => $this->form_validation->set_value('name'),
            );

            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'cus-input-front validate[required,email]',
                'placeholder' => 'Email',
                'value' => $this->form_validation->set_value('email'),
            );

            $this->data['username'] = array(
                'name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'class' => 'cus-input-front validate[required]',
                'placeholder' => 'Username',
                'value' => $this->form_validation->set_value('username'),
            );

            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'cus-input-front validate[required]',
                'placeholder' => 'Password',
                'value' => $this->form_validation->set_value('password'),
            );

            $this->data['agree'] = array(
                'name' => 'agree',
                'id' => 'agree',
                'type' => 'checkbox',
				'class' => 'validate[required]',
                'value' => '1'
            );
        }
        $this->load->template('home', $this->data, false, 'site-new');
    }

    /*
     * Login User
     */
    public function login() {
        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            //check to see if the user is logging in
            //check for "remember me"
            //$remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'))) {
                //if the login is successful
                //redirect them back to the home pagedan
				$this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(c_site_url('user'), 'refresh');
            } else {
                //if the login was un-successful
                //redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(c_site_url('home/login'), 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'validate[required]'
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'validate[required]'
            );

            $this->load->template('login', $this->data, false, 'site-new');
        }
    }

    /**
     * Forgot password
     */
    function forgot_password() {
		//$this->output->enable_profiler(TRUE);

        $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');

        if ($this->form_validation->run() == false) {
            //setup the input
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = 'Email Used To Register';
            } else {
                $this->data['identity_label'] = 'Email Used To Register';
            }

            //set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->load->template('forgot_password', $this->data);
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
			
			//print_r($identity);
			
            if (empty($identity)) {
                $this->ion_auth->set_message('Email not found');
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(c_site_url("home/forgot_password"), 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(c_site_url("home/forgot_password"), 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(c_site_url("home/forgot_password"), 'refresh');
            }
        }
    }

    //reset password - retrive step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                $this->load->template('reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('home/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("home/forgot_password", 'refresh');
        }
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
}
