<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */
class Video extends CI_Controller 
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

		$this->load->library('pagination');
		$this->load->model('video_model');
	}

	public function youtube_id_from_url($url) {
		$pattern =
			'%^ # Match any youtube URL
			(?:https?://)?  # Optional scheme. Either http or https
			(?:www\.)?      # Optional www subdomain
			(?:             # Group host alternatives
			youtu\.be/    # Either youtu.be,
			| youtube\.com  # or youtube.com
			(?:           # Group path alternatives
			/embed/     # Either /embed/
			| /v/         # or /v/
			| /watch\?v=  # or /watch\?v=
			)             # End path alternatives.
			)               # End host alternatives.
			([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
			$%x';

		$result = preg_match($pattern, $url, $matches);

		if(false !== (bool)$result) {
			return $matches[1];
		}

		return false;
	}

	/**
	*Show photo upload page for logged in user
	*/
    public function index($id=0) 
    {
		 $uid = $this->ion_auth->get_user_id();

        //Set Validation Rules
        $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
        $this->form_validation->set_rules('video_link', 'Video Link', 'required|xss_clean');

		//Check Validations
        if ($this->form_validation->run() == TRUE) {

			$video_id = $this->youtube_id_from_url($this->input->post('video_link'));

			//Array to save data
			$video_data = array(
				'uid' => $uid,
				'title' => $this->input->post('title'),
				'privacy_status' => $this->input->post('privacy_status'),
				'video_link' => $this->input->post('video_link'),
				'video_image_link' => 'http://img.youtube.com/vi/'.$video_id.'/0.jpg',
				'video_embed_link' => '//www.youtube.com/embed/'.$video_id,
				'description' => $this->input->post('description'),
				'create_date' => date('Y-m-d h:i:s')
			);

			//print_r($video_data); die;

			$this->video_model->saveVideo($video_data, $id);

			if($id != 0) {
				$this->session->set_flashdata('message', array(
					'message' => 'Record updated successfully',
					'type' => 'success',
				));

				redirect(c_site_url('video'));
			} else {
				$this->session->set_flashdata('message', array(
					'message' => 'Record added successfully',
					'type' => 'success',
				));

				redirect(c_site_url('video'));
			}
        }

		if($id != 0) {
			$this->data['user_video_details'] = $this->video_model->getUserVideoDetails($id);
		}

		$this->data['id'] = $id;
		$this->data['uid'] = $uid;
		//$this->data['meal_photos'] = $this->video_model->get_list($uid, array('id' => 'asc'));
		$this->data['user_videos'] = $this->video_model->getUserVideos($uid, 20, 0, 1);
		$this->load->user_template('video-upload.php', $this->data);
	}

	/**
     * Return user videos ajax data
     */
    public function get_user_videos()
    {
        $response = $this->load->user_template('user-videos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	/*
	 * User vodeos photos via ajax
	*/
	public function ajax_function()
	{
		$data['page'] = $_POST['page'];
		$data['cur_page'] = $data['page'];
		$data['page'] -= 1;
		$data['per_page'] = $_POST['per_page'];
		$data['previous_btn'] = true;
		$data['next_btn'] = true;
		$data['first_btn'] = true;
		$data['last_btn'] = true;
		$data['start'] = $data['page'] * $data['per_page'];

		//$this->output->enable_profiler(TRUE);

		$uid = $this->ion_auth->get_user_id();
		$data['uid'] = $uid;
		$data['query'] =  $this->video_model->getUserVideos($uid, $data['per_page'], $data['start'], 1);
		$data['total'] = $this->video_model->getUserVideosCount($uid, 1);

		$this->load->print_template('user-videos-photos-ajax-load', $data);
	}

	public function delete_record($id) {
        $this->video_model->delete_record($id);
        $this->session->set_flashdata('message', array(
                'message' => 'Record removed sucessfully.',
                'type' => 'success',
            ));
        redirect(c_site_url('video'));
    }

	public function print_record($id) {
		$print_record_details = $this->video_model->getUserVideoDetails($id);

		$new_arr['Date/Time'] = $print_record_details->create_date;
		$new_arr['Title'] = $print_record_details->title;
		$new_arr['Video Link'] = $print_record_details->video_link;
		$new_arr['Description'] = $print_record_details->description;

		$this->data['heading'] = $this->session->userdata('identity'). ' VIDEO DETAIL';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}
