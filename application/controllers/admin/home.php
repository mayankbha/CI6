<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
        parent::__construct();

        //Only non logges in user can see this page
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin()) {
            redirect(c_site_url('admin/auth'), 'refresh');
        }
    }

	public function index()
	{
		$this->load->admin_template();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */