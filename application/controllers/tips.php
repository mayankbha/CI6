<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */

class Tips extends CI_Controller
{
    private $data = array();

    public function __construct() {
        parent::__construct();
        
        //Only logges in user can see this page
        if (!$this->ion_auth->logged_in())
        {
            redirect(c_site_url('home/login'), 'refresh');
        }

		$this->load->model('tips_model');
    }
    
    /**
     * Show tips page for logged in user
     */
    public function index($id=0) {
		$uid = $this->ion_auth->get_user_id();
		
		if($id) $data['form'] = $this->tips_model->get_event($id);

        $data['id'] = $id;

        if($this->input->post('submit')) {
			$tip_type = implode(',', $this->input->post('tip_type'));

			$d['uid'] = $this->ion_auth->get_user_id();
            $d['tip_type'] = $tip_type;
			$d['privacy_status'] = $this->input->post('privacy_status');
            $d['title'] = $this->input->post('title');
            $d['description'] = $this->input->post('description');
            $d['create_date'] = date('Y-m-d h:i:s');
			$d['update_date'] = date('Y-m-d h:i:s');

            if($id){
                 $this->tips_model->update_record($d, $id);
                 $data['form'] = $this->tips_model->get_event($id);
				 $this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));

				redirect(c_site_url('tips'));
            } else {
                 $this->tips_model->add_record($d);
                 $this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));

				redirect(c_site_url('tips'));
            }
        }

		$data['id'] = $id;
        $data['events'] = $this->tips_model->get_records($uid);
        $this->load->user_template('tip-form', $data);
    }

	public function ajax() {
        $changed = $this->input->post('changed');
        $eventId = $this->input->post('eventId');
        $this->tips_model->update_event_date($eventId,$changed);
    }

    /**
     * Return user tips schedule ajax data
     */
    public function get_user_tips()
    {
		$uid = $this->ion_auth->get_user_id();
		$this->data['user_tips'] = $this->tips_model->getUserTips($uid, 1);
        $response = $this->load->user_template('tip-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function delete_record() {
		$id = $this->input->post('id');
        $this->tips_model->delete_record($id);
		$this->session->set_flashdata('message', array(
			'message' => 'Record removed sucessfully.',
			'type' => 'success'
		));
    }

	public function print_record($id) {
		$print_record_details = $this->tips_model->get_event($id);

		$new_arr['Date/Time'] = $print_record_details->create_date;
		$new_arr['Title'] = $print_record_details->title;
		$new_arr['Description'] = $print_record_details->description;

		$this->data['heading'] = $this->session->userdata('identity'). ' TIPS, SUGGESTIONS AND MOTIVATIONAL / INSPIRATIONAL COMMENTS';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }
}

