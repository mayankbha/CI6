<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Meal extends CI_Controller 
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
    }

    /**
     * Retrn Ajax data
     */
    public function get_my_meals()
    {
        $response = $this->load->user_template('meal-ajax', $this->data, TRUE, TRUE);
        
        /* //If need to send json use this
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('foo' => 'bar')));
        */
        $this->output->set_output($response);
    }
}
