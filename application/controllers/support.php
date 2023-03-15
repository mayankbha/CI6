<?php 
/**
 * Description of Support
 *
 * @author SITS
 */
class Support extends CI_Controller{
    
    private $data = array(); 
    
    public function __construct() {
        parent::__construct();

		$this->load->library('email');
		$this->load->model('support_model');
    }
    
    public function index()
    {
		$uid = $this->ion_auth->get_user_id();

		//Set Validation Rules
        $this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'required');

		if($this->input->post()) {

			if ($this->form_validation->run() === TRUE) {
				if($this->session->userdata('captcha') == $this->input->post('captcha')) {
					//Array to save data
					$support_data = array(
						'firstname' => $this->input->post('fname'),
						'lastname' => $this->input->post('lname'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'message' => $this->input->post('message')
					);
	
					$this->support_model->saveData($support_data);
	
					$config['mailtype'] = 'html';
					$config['charset'] = 'iso-8859-1';
	
					$this->email->initialize($config);
	
					$this->email->from('admin@healthfreakslive.com', 'Health Freaks');
					$this->email->to($this->input->post('email'));
	
					$body = '<p>Hello Admin,</p><p>'.$this->input->post('name').' sent a support request.</p><p>The details are following:</p><p>Email: '.$this->input->post('email').'</p><p>Phone: '.$this->input->post('phone').'</p><p>Username: '.$this->input->post('username').'</p><p>Message: '.$this->input->post('message').'</p>';
	
					$this->email->subject('new support request');
					$this->email->message($body);
	
					$this->email->send();
	
					$this->session->set_flashdata('message', array(
						'message' => 'Your support request has been sent successfully. We will respond to you shortly',
						'type' => 'success',
					));
	
					redirect(c_site_url('support'));
				} else {
					$this->session->set_flashdata('message', array(
						'message' => 'Capcha is invalid',
						'type' => 'danger',
					));
	
					redirect(c_site_url('support'));
				}
			}
		}

		$this->load->template('support', $this->data, false, 'site-new');
    }

	public function set_captcha_session() {
		$code = $this->input->post('code');
		$this->session->set_userdata('captcha', $code);
		//echo $this->session->userdata('captcha');

		/*if($this->session->userdata('captcha')) {
			$this->session->set_userdata('captcha', $code);
		} else {
			$this->session->set_userdata('captcha', $code);
		}*/
	}

	public function create_captcha() {
		//for degit captcha
		//$code = rand(1000, 9999);

		//for alphabates captcha
		$words  = "abcdefghijlmnopqrstvwyz";
		$vocals = "aeiou";
		$code  = "";
		$vocal = rand(0, 1);

		//captcha length for alphabates 
		$length = rand('6', '8');

		for($i=0; $i<$length; $i++) {
			if($vocal) {
				$code .= substr($vocals, mt_rand(0, 4), 1);
			} else {
				$code .= substr($words, mt_rand(0, 22), 1);
			}
			$vocal = !$vocal;
		}

		//echo $code;
		$this->session->set_userdata('captcha', $code);

		$im = imagecreatetruecolor(100, 30);
		$bg = imagecolorallocate($im, 22, 86, 165);
		$fg = imagecolorallocate($im, 255, 255, 255);
		imagefill($im, 0, 0, $bg);
		imagestring($im, 5, 5, 5,  $code, $fg);
		header("Cache-Control: no-cache, must-revalidate");
		header('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
	}

	public function request_feature() {
		//Only logges in user can see this page
        if($this->ion_auth->logged_in()) {
			if($this->ion_auth->is_admin()) {
				redirect(c_site_url('home/login'), 'refresh');
			}
        }

		$uid = $this->ion_auth->get_user_id();

		//Set Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		//$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('username', 'Username', 'required');
		//$this->form_validation->set_rules('message', 'Message', 'required');
        //$this->form_validation->set_rules('captcha', 'Captcha', 'required');

		if($this->input->post()) {

			if ($this->form_validation->run() === TRUE) {
				//if($this->session->userdata('captcha') == $this->input->post('captcha')) {
					//Array to save data
					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'username' => $this->input->post('username'),
						'request' => $this->input->post('request')
					);
	
					$this->support_model->saveRequestData($data);
	
					$config['mailtype'] = 'html';
					$config['charset'] = 'iso-8859-1';
	
					$this->email->initialize($config);
	
					$this->email->from('admin@healthfreakslive.com', 'Health Freaks');
					$this->email->to($this->input->post('email'));
	
					$body = '<p>Hello Admin,</p><p>'.$this->input->post('name').' sent a feature request.</p><p>The details are following:</p><p>Email: '.$this->input->post('email').'</p><p>Phone: '.$this->input->post('phone').'</p><p>Username: '.$this->input->post('username').'</p><p>Request: '.$this->input->post('request').'</p>';
	
					$this->email->subject('new feature request');
					$this->email->message($body);
	
					$this->email->send();
	
					$this->session->set_flashdata('message', array(
						'message' => 'Your feature request has been sent successfully. We will respond to you shortly',
						'type' => 'success',
					));
	
					redirect(c_site_url('support/request_feature'));
				/*} else {
					$this->session->set_flashdata('message', array(
						'message' => 'Capcha is invalid',
						'type' => 'danger',
					));
	
					redirect(c_site_url('support/request_feature'));
				}*/
			}
		}

		$this->load->user_template('request-feature', $this->data);
    }

	public function report_problem() {
		//Only logges in user can see this page
        if($this->ion_auth->logged_in()) {
			if($this->ion_auth->is_admin()) {
				redirect(c_site_url('home/login'), 'refresh');
			}
        }

		$uid = $this->ion_auth->get_user_id();

		//Set Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
		//$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('username', 'Username', 'required');
		//$this->form_validation->set_rules('message', 'Message', 'required');
        //$this->form_validation->set_rules('captcha', 'Captcha', 'required');

		if($this->input->post()) {

			if ($this->form_validation->run() === TRUE) {
				//if($this->session->userdata('captcha') == $this->input->post('captcha')) {
					//Array to save data
					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'username' => $this->input->post('username'),
						'computer_type' => $this->input->post('computer_type'),
						'device_type' => $this->input->post('device_type'),
						'os' => $this->input->post('os'),
						'browser' => $this->input->post('browser'),
						'details' => $this->input->post('details')
					);
	
					$this->support_model->saveProblemData($data);
	
					$config['mailtype'] = 'html';
					$config['charset'] = 'iso-8859-1';
	
					$this->email->initialize($config);
	
					$this->email->from('admin@healthfreakslive.com', 'Health Freaks');
					$this->email->to($this->input->post('email'));
	
					$body = '<p>Hello Admin,</p><p>'.$this->input->post('name').' report a problem.</p><p>The details are following:</p><p>Email: '.$this->input->post('email').'</p><p>Phone: '.$this->input->post('phone').'</p><p>Username: '.$this->input->post('username').'</p><p>Computer Used: '.$this->input->post('computer_type').'</p><p>Device Used: '.$this->input->post('device_type').'</p><p>Operating System: '.$this->input->post('os').'</p><p>Browser: '.$this->input->post('browser').'</p><p>Details: '.$this->input->post('details').'</p>';
	
					$this->email->subject('User report a problem');
					$this->email->message($body);
	
					$this->email->send();
	
					$this->session->set_flashdata('message', array(
						'message' => 'Your problem has been sent successfully. We will respond to you shortly',
						'type' => 'success',
					));
	
					redirect(c_site_url('support/report_problem'));
				/*} else {
					$this->session->set_flashdata('message', array(
						'message' => 'Capcha is invalid',
						'type' => 'danger',
					));
	
					redirect(c_site_url('support/report_problem'));
				}*/
			}
		}

		$this->load->user_template('report-problem', $this->data);
    }

	public function TermsOfService() {
		$this->load->template('termsOfService', $this->data, false, 'site-new');
	}

}

?>