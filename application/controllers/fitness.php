<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Fitness extends CI_Controller
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

		//Initialize ckeditor library
		$this->load->library('ckeditor');

        $this->load->model('fitness_model');
    }
    
    /**
     * Show fitness page for logged in user 
     */
    public function index($id=0)
    {
		$this->ckeditor->basePath = c_site_url('assets/ckeditor/');
		$this->ckeditor->config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['width'] = '200px';
		$this->ckeditor->config['height'] = '200px';

		$uid = $this->ion_auth->get_user_id();

        if($id) $data['form'] = $this->fitness_model->get_event($id);
		
        $data['id'] = $id;
		$data['uid'] = $this->ion_auth->get_user_id();
		$data['events'] = $this->fitness_model->get_records($uid);

        if($this->input->post('submit')){
            $d['dtime'] = $this->input->post('dtime');
			$d['privacy_status'] = $this->input->post('privacy_status');
            $d['dtime'] = date('Y-m-d h:i:s',strtotime($d['dtime']));
            $d['title'] = $this->input->post('title');
            $d['description'] = $this->input->post('description');
            $d['calories'] = $this->input->post('calories');
            $d['cardio'] = $this->input->post('cardio');
            $d['supplements'] = $this->input->post('supplements');
            $d['notes'] = $this->input->post('notes');
			$d['uid'] = $uid;

            if($id){
				$data['form'] = $this->fitness_model->get_event($id);
                 $this->fitness_model->update_record($d,$id);
                 $this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));
				redirect(c_site_url('fitness'));
            } else {
                 $this->fitness_model->add_record($d);
                 $this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));
				redirect(c_site_url('fitness'));
            }
           
        }
        $this->load->user_template('fitness-form', $data);
    }

    public function ajax(){
        $changed = $this->input->post('changed');
        $eventId = $this->input->post('eventId');
        $this->fitness_model->update_event_date($eventId,$changed);
    }

	/**
     * Retrn user fitness schedule ajax data
     */
    public function get_user_fitness_schedule()
    {
		$uid = $this->ion_auth->get_user_id();

		$this->data['user_fitness_schedules'] = $this->fitness_model->getUserFitnessSchedule($uid, 1);
        $response = $this->load->user_template('user-fitness-schedule-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function delete_record() {
		$id = $this->input->post('id');
        $this->fitness_model->delete_record($id);
		$this->session->set_flashdata('message', array(
			'message' => 'Record removed sucessfully.',
			'type' => 'success'
		));
    }

	public function print_record($id) {
		$print_record_details = $this->fitness_model->get_event($id);

		$new_arr['Date/Time'] = $print_record_details->dtime;
		$new_arr['Title'] = $print_record_details->title;
		$new_arr['Description'] = $print_record_details->description;
		$new_arr['Calories'] = $print_record_details->calories;
		$new_arr['Cardio'] = $print_record_details->cardio;
		$new_arr['Supplements'] = $print_record_details->supplements;
		$new_arr['Notes'] = $print_record_details->notes;

		$this->data['heading'] = $this->session->userdata('identity'). ' FITNESS SCHEDULE DETAILS';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}
