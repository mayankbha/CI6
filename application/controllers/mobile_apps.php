<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_Apps extends CI_Controller {
	public function index() {
		$this->load->template('mobile_apps', '', false, 'site-new');
	}
}