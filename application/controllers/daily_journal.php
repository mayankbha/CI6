<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Daily_Journal extends CI_Controller
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

        $this->load->model('daily_journal_model');
    }
    
    /**
     * Show fitness page for logged in user 
     */
    public function index($id=0)
    {
		$uid = $this->ion_auth->get_user_id();

        if($id) $data['form'] = $this->daily_journal_model->get_event($id);
		
        $data['id'] = $id;
		
        if($this->input->post('submit')){
			$d['uid'] = $this->ion_auth->get_user_id();
            $d['dtime'] = $this->input->post('dtime');
            $d['dtime'] = date('Y-m-d h:i:s',strtotime($d['dtime']));
            $d['title'] = $this->input->post('title');
            $d['details'] = $this->input->post('details');
			$d['create_date'] = date('Y-m-d h:i:s');

            if($id){
                 $this->daily_journal_model->update_record($d,$id);
                 $data['form'] = $this->daily_journal_model->get_event($id);
				 
				 $this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));

				redirect(c_site_url('daily_journal'));
            } else {
                 $this->daily_journal_model->add_record($d);
                 $this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));

				redirect(c_site_url('daily_journal'));
            }
           
        }

		$data['id'] = $id;
        $data['events'] = $this->daily_journal_model->get_records($uid);
        $this->load->user_template('daily-journal-form',$data);
    }

    public function ajax(){
        $changed = $this->input->post('changed');
        $eventId = $this->input->post('eventId');
        $this->daily_journal_model->update_event_date($eventId,$changed);
    }

	public function delete_record() {
		$id = $this->input->post('id');
        $this->daily_journal_model->delete_record($id);
		$this->session->set_flashdata('message', array(
			'message' => 'Record removed sucessfully.',
			'type' => 'success'
		));
    }

	public function print_record($id) {
		$print_record_details = $this->daily_journal_model->get_event($id);

		$new_arr['Date/Time'] = $print_record_details->dtime;
		$new_arr['Title'] = $print_record_details->title;
		$new_arr['Detail'] = $print_record_details->details;

		$this->data['heading'] = $this->session->userdata('identity'). ' DAILY JOURNAL FOR HEALTHY LIFESTYLE';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}

?>