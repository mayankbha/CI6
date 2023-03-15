<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */

class Profile extends CI_Controller
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        
        //Only logges in user can see this page
        if (!$this->ion_auth->logged_in())
        {
            redirect(c_site_url('home/login'), 'refresh');
        }

		$this->load->model('user_public_model');
    }
    
    /**
     * Show profile page for logged in user
     */
    public function index()
    {
		$user_detail = $this->user_public_model->get_user($this->session->userdata('identity'));
		$data['user_details'] = $user_detail;
        $this->load->user_template('profile', $data);
    }
}
