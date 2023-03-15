<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author SITS
 */

class User_Public_Profile extends CI_Controller
{
    public function __construct() {
        parent::__construct();

		$this->load->model('user_public_model');
		$this->load->model('fitness_model');
		$this->load->model('meal_planner_model');
		$this->load->model('mealphoto_model');
		$this->load->model('selfphoto_model');
		$this->load->model('tips_model');
		$this->load->model('video_model');
    }
    
    /**
     * Show profile page for logged in user
     */
    public function index($username='')
    {
		$user_detail = $this->user_public_model->get_user($username);
		$data['uid'] = $user_detail->id;
		$data['username'] = $user_detail->username;
		$data['user_details'] = $user_detail;
		//$this->session->set_userdata('event_heading', 'Healthy Fitness Schedule');
        $this->load->user_template('user_public_profile', $data);
    }

	/**
     * Return user fitness schedule ajax data
     */
    public function get_user_fitness_schedule($uid=0)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
		$this->data['user_fitness_schedules'] = $this->fitness_model->getUserFitnessSchedule($uid, 0);
        $response = $this->load->user_template('user-public-fitness-schedule-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function show_fitness_record_detail($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$fitness_record_details = $this->fitness_model->get_event($id);

		$new_arr['Date/Time'] = $fitness_record_details->dtime;
		$new_arr['Title'] = $fitness_record_details->title;
		$new_arr['Description'] = $fitness_record_details->description;
		$new_arr['Calories'] = $fitness_record_details->calories;
		$new_arr['Cardio'] = $fitness_record_details->cardio;
		$new_arr['Supplements'] = $fitness_record_details->supplements;
		$new_arr['Notes'] = $fitness_record_details->notes;

		$this->data['heading'] = $user_name->first_name. ' FITNESS SCHEDULE DETAILS';
		$this->data['show_record_details'] = $new_arr;
		$this->load->user_template('show-record', $this->data);
    }

	/**
     * Return user meal schedule ajax data
     */
    public function get_user_meal_schedule($uid=0)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
		$this->data['user_meal_schedules'] = $this->meal_planner_model->getUserMealSchedule($uid, 0);
        $response = $this->load->user_template('meal-public-schedule-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function show_meal_planner_record($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$meal_planner_record_details = $this->meal_planner_model->get_event($id);

		$uid = $this->ion_auth->get_user_id();
		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/meal/'.$meal_planner_record_details->meal_photo.'"></div>';
		$new_arr['Date/Time'] = $meal_planner_record_details->dtime;
		$new_arr['Title'] = $meal_planner_record_details->title;
		$new_arr['Meal Kind'] = $meal_planner_record_details->meal_kind;
		$new_arr['Recipe'] = $meal_planner_record_details->details;
		$new_arr['Car, Carbs, Fat, Etc.'] = $meal_planner_record_details->extra;
		$new_arr['Notes'] = $meal_planner_record_details->notes;

		$this->data['heading'] = $user_name->first_name. ' MEAL SCHEDULE';
		$this->data['show_record_details'] = $new_arr;
		$this->load->user_template('show-record', $this->data);
    }

	/**
     * Return user meal photos ajax data
     */
    public function get_user_meal_photos($uid=0)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
        $response = $this->load->user_template('user-public-meal-photos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	/*
	 * User meal photos via ajax
	*/
	public function ajax_function($uid=0)
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

		$uid = $uid;
		$data['uid'] = $uid;
		$data['query'] = $this->mealphoto_model->getUserMealPhotos($uid, $data['per_page'], $data['start'], 0, 'asc');
		$data['total'] = $this->mealphoto_model->getUserMealPhotosCount($uid, 0);

		$this->load->print_template('user-public-meal-photos-ajax-load', $data);
	}

	public function show_meal_photo_record($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$show_meal_photo_details = $this->mealphoto_model->getUserMealDetails($id);

		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/meal/'.$show_meal_photo_details->meal_photo.'"></div>';
		$new_arr['Date/Time'] = $show_meal_photo_details->dtime;
		$new_arr['Title'] = $show_meal_photo_details->title;
		$new_arr['Meal Kind'] = $show_meal_photo_details->meal_kind;
		$new_arr['Recipe'] = $show_meal_photo_details->details;
		$new_arr['Car, Carbs, Fat, Etc.'] = $show_meal_photo_details->extra;
		$new_arr['Notes'] = $show_meal_photo_details->notes;

		$this->data['heading'] = $user_name->first_name. ' MEAL SCHEDULE';
		$this->data['show_record_details'] = $new_arr;
		$this->load->user_template('show-record', $this->data);
    }

	public function get_user_self_photos($uid=0)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
        $response = $this->load->user_template('user-public-self-photos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	/*
	 * User self photos via ajax
	*/
	public function selfphoto_ajax_function($uid=0)
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

		$uid = $uid;
		$data['uid'] = $uid;
		$data['query'] = $this->selfphoto_model->getUserSelfPhotos($uid, $data['per_page'], $data['start'], 0, 'asc');
		$data['total'] = $this->selfphoto_model->getUserSelfPhotosCount($uid, 0);

		$this->load->print_template('user-public-self-photos-ajax-load', $data);
	}

	public function show_selfphoto_record($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$show_selfphoto_record_details = $this->selfphoto_model->get_photo_by_id($id);

		$uid = $uid;
		$new_arr['Image'] = '<div class="thumbnail"><img src="'.c_site_url().'/uploads/'.$uid.'/self/'.$show_selfphoto_record_details->photo_img.'"></div>';
		$new_arr['Date/Time'] = $show_selfphoto_record_details->date_time;
		$new_arr['Title'] = $show_selfphoto_record_details->photo_title;
		$new_arr['Photo Weight'] = $show_selfphoto_record_details->photo_weight;
		$new_arr['Photo BMI'] = $show_selfphoto_record_details->photo_bmi;
		$new_arr['Description'] = $show_selfphoto_record_details->photo_description;

		$this->data['heading'] = $user_name->first_name. ' SELF PHOTOS DETAILS';
		$this->data['show_record_details'] = $new_arr;
		$this->load->user_template('show-record', $this->data);
    }

	/**
     * Return user tips schedule ajax data
     */
    public function get_user_tips($uid=0)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
		$this->data['user_tips'] = $this->tips_model->getUserTips($uid, 0);
        $response = $this->load->user_template('tip-public-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	public function show_tip_record($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$show_record_details = $this->tips_model->get_event($id);

		$new_arr['Date/Time'] = $show_record_details->create_date;
		$new_arr['Title'] = $show_record_details->title;
		$new_arr['Description'] = $show_record_details->description;

		$this->data['heading'] = $user_name->first_name. ' TIPS, SUGGESTIONS AND MOTIVATIONAL / INSPIRATIONAL COMMENTS';
		$this->data['show_record_details'] = $new_arr;
		$this->load->user_template('show-record', $this->data);
    }

	/**
     * Return user videos ajax data
     */
    public function get_user_videos($uid)
    {
		$uid = $uid;
		$this->data['uid'] = $uid;
        $response = $this->load->user_template('user-public-videos-ajax', $this->data, TRUE, TRUE);
        $this->output->set_output($response);
    }

	/*
	 * User videos photos via ajax
	*/
	public function video_ajax_function($uid=0)
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

		$uid = $uid;
		$data['uid'] = $uid;
		$data['query'] =  $this->video_model->getUserVideos($uid, $data['per_page'], $data['start'], 0);
		$data['total'] = $this->video_model->getUserVideosCount($uid, 0);

		$this->load->print_template('user-public-videos-photos-ajax-load', $data);
	}

	public function show_video_record($uid, $id) {
		$user_name = $this->user_public_model->get_user_name($uid);

		$video_record_details = $this->video_model->getUserVideoDetails($id);

		$new_arr['Video'] = '<div class="col-xs-12 col-sm-4 col-lg-4"><iframe src="'.$video_record_details->video_embed_link.'" width="240"></iframe></div>';
		$new_arr['Date/Time'] = $video_record_details->create_date;
		$new_arr['Title'] = $video_record_details->title;
		$new_arr['Video Link'] = $video_record_details->video_link;
		$new_arr['Description'] = $video_record_details->description;

		$this->data['heading'] = $user_name->first_name. ' VIDEO DETAIL';
		$this->data['print_record_details'] = $new_arr;
		$this->load->print_template('print-record', $this->data);
    }

}

?>