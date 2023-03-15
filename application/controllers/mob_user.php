<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mob_user extends CI_Controller {

public function __construct() {
    
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('ion_auth_model');
        $this->load->model('selfphoto_model');
        $this->load->library('ckeditor');
        $this->load->model('fitness_model');
        $this->load->model('tips_model');
        $this->load->model('meal_planner_model');
	$this->load->model('mealphoto_model');
	$this->load->model('daily_journal_model');
	$this->load->library('email');
		$this->load->model('support_model');
		$this->load->model('meal_planner_model');
		$this->load->model('mealphoto_model');
		$this->load->library('pagination');
		$this->load->model('video_model');
	
}




public function register(){
 
           $userData = array('name' => $this->input->post('name'));
           $out=$this->ion_auth->register(
           $this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $userData, array('2'));
       if($out!=FALSE){ echo "Registeration Successfull ! <br /> Check Your Mail For Activation";}else{echo "Username Already Exists";}
       
        } 
        
public function login() {

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'))) {
            
    
        echo $this->ion_auth->get_user_id();

            } else {
          
    
        echo $this->ion_auth->errors();
            }
        
    }
    
public function getselfielist(){
$search = array();
$id=$_REQUEST['user_id'];
 $search['uid'] = $id;
 $this->data['photo_list'] = $this->selfphoto_model->get_list($search);
$s=json_encode(array_values($this->data['photo_list']));
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}    

public function deleteselfie(){

$id=$_REQUEST['photo_id'];
$photo = $this->selfphoto_model->get_photo_by_id($id, TRUE);
        if ( empty($photo) ) {
            echo 'Record not found. Please try again later.';
        }
        else{
        $upload_dir = BASEPATH . '../uploads/' . $user_id . '/self/';
        $file = $upload_dir . $photo['photo_img'];

        $this->selfphoto_model->remove($photo['id']);
        unset($file);

       echo 'Photo removed successfully';
       }
}


public function selfie(){

 $user_id = $_POST['id'];
 $id=(int)$_POST['photo_id'];     
 
 $photoo=$_FILES;
 $privacy_status = $_POST['privacy_status'];
 $photo_title = $_POST['photo_title'];
 $date_time = $_POST['date_time'];
 $photo_description = $_POST['photo_description'];
 $photo_weight = $_POST['photo_weight'];
 $photo_bmi = $_POST['photo_bmi'];
      
            $upload_dir = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            
            if (!is_dir($upload_dir)) {
                $u_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id)) ? mkdir(BASEPATH . '../uploads/' . $user_id, 0777) : '';
                $s_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id.'/self')) ? mkdir(BASEPATH . '../uploads/' . $user_id.'/self', 0777) : '';
                mkdir($upload_dir, 0777);
            }

            $config['upload_path'] = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
           
            if (!$this->upload->do_upload('userfile', FALSE) && $id==0) {
                echo "upload error";
            } 
            else {
           $photo_file = $this->upload->data();
                $photo = array(
                    'id' => $id,
		    'privacy_status' => $privacy_status,
                    'photo_title' => $photo_title,
                    'date_time' => $date_time,
                    'photo_description' => $photo_description,
                    'photo_weight' => $photo_weight,
                    'photo_bmi' => $photo_bmi,
                    'uid' =>  $user_id,
                );
                
                if(isset($photo_file['file_name']) && $photo_file['file_name'] !== "") {
                    $photo['photo_img'] = $photo_file['file_name'];
                    
                    $crop_data = $photoo; 
	                $r_config['image_library'] = 'gd2';
					$r_config['source_image'] = $photo_file['full_path'];
					$r_config['new_image'] = $photo_file['file_path'].'../'.$photo_file['file_name'];
					$r_config['maintain_ratio'] = FALSE;
					$this->load->library('image_lib', $r_config);
					$this->image_lib->crop();
                    }
                $photo_id = $this->selfphoto_model->save($photo);
                if ($photo_id)
                {
                	echo "success";   
                }else{
                	echo "database error";
                }
            }
}

    public function forget_password(){
      $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');

        if ($this->form_validation->run() == false) {
          
    
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = 'Email Used To Register';
            } else {
                $this->data['identity_label'] = 'Email Used To Register';
            }

          
    
            echo "Server Not Email Found";
            
        } 
        else {
          
         
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            
         
      
            
            if (empty($identity)) {
     
                $this->ion_auth->set_message('Email not found');
       
                echo $this->ion_auth->messages();
   
                
            }else{

           
      
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

            if ($forgotten) {
              
               echo $this->ion_auth->messages();
    
       
            } else {
               echo $this->ion_auth->errors();
                
            }
            }
        }
    }
    
 public function fitness(){
 $d['dtime'] = $this->input->post('dtime');
			$d['privacy_status'] = $this->input->post('privacy_status');
            $d['dtime'] = date('Y-m-d h:i:s',strtotime($d['dtime']));
            $d['title'] = $this->input->post('title');
            $d['description'] = $this->input->post('description');
            $d['calories'] = $this->input->post('calories');
            $d['cardio'] = $this->input->post('cardio');
            $d['supplements'] = $this->input->post('supplements');
            $d['notes'] = $this->input->post('notes');
	$d['uid'] = $this->input->post('user_id');
	$id=$this->input->post('fit_id');		
	if($id){
		$data['form'] = $this->fitness_model->get_event($id);
                 $this->fitness_model->update_record($d,$id);
               echo 'Record added successfully';
            } else {
                 $this->fitness_model->add_record($d);
               echo 'Record added successfully';		
            }		
 
 }
 public function deletefitness(){
 
 $id = $_REQUEST['fit_id'];
        $this->fitness_model->delete_record($id);
		echo 'Record removed successfully';
 
 }
 
public function getfitnessall(){
$data=array();
$id=$_REQUEST['user_id'];
$data = $this->fitness_model->get_records($id);
//echo 'DATA>>'.$id;
$s=json_encode(array_values($data));
//echo $data;
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}

public function tipsadd(){

$id=$this->input->post('tip_id');
$tip_type = implode(',', $this->input->post('tip_type'));
$d['uid'] = $this->input->post('user_id');
            $d['tip_type'] = $tip_type;
			$d['privacy_status'] = $this->input->post('privacy_status');
            $d['title'] = $this->input->post('title');
            $d['description'] = $this->input->post('description');
            $d['create_date'] = date('Y-m-d h:i:s');
			$d['update_date'] = date('Y-m-d h:i:s');

            if($id){
                 $this->tips_model->update_record($d, $id);
                 echo 'Record added successfully';

            } else {
                 $this->tips_model->add_record($d);
                 echo 'Record added successfully';

				
            }

}
     
public function getalltips(){

$id=$_REQUEST['user_id'];
$data = $this->tips_model->get_records($id);
$s=json_encode(array_values($data));
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}

public function deletetip(){

$id=$_REQUEST['tip_id'];
$this->tips_model->delete_record($id);
		echo 'Record removed successfully';
} 

public function dailyj(){
$id=$this->input->post('daily_id');
$d['uid'] = $this->input->post('user_id');
            $d['dtime'] = $this->input->post('dtime');
            $d['dtime'] = date('Y-m-d h:i:s',strtotime($d['dtime']));
            $d['title'] = $this->input->post('title');
            $d['details'] = $this->input->post('details');
			$d['create_date'] = date('Y-m-d h:i:s');

            if($id){
                 $this->daily_journal_model->update_record($d,$id);
                 $data['form'] = $this->daily_journal_model->get_event($id);
				 
				echo 'Record added successfully';

				
            } else {
                 $this->daily_journal_model->add_record($d);
               echo 'Record added successfully';
}       

}
public function getalldaily(){

$id=$_REQUEST['user_id'];
$data = $this->daily_journal_model->get_records($id);
$s=json_encode(array_values($data));
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}

public function deletedaily(){

$id=$_REQUEST['daily_id'];
$this->daily_journal_model->delete_record($id);
echo 'Record removed successfully';
} 
	
public function request_features() {
	

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
	
					echo 'Your feature request has been sent successfully. We will respond to you shortly';
		
    }
    
public function report_problems() {

		
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
	
					echo 'Your problem has been sent successfully. We will respond to you shortly';
	
					
			
    }    
    
public function user_support(){

$uid=$this->input->post('user_id');

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
	
					echo 'Your support request has been sent successfully. We will respond to you shortly';
		
}    


public function pass() {
		$id=$this->input->post('user_id');

	$identity=$this->ion_auth_model->getusername($id);
		if($identity!=""){
			
			$change = $this->ion_auth_model->change_password($identity, $this->input->post('old'), $this->input->post('new'));
			if($change) {
				echo $id;

			} else {
				echo 'Invalid old password';
		
            }
        }
        else{
        
        echo 'Invalid UserID';
        }
	}
	
public function getmyuname(){
$id=$_REQUEST['user_id'];
$identity=$this->ion_auth_model->getusername($id);
echo $identity;
}	
    
public function getuserdata() {
	$uid=$_REQUEST['user_id'];
	$data=array();
	$data['userdetails'] = $this->user_model->get_user_details($uid);
	echo json_encode(($data));
	}
	
public function updateuser(){

$uid = $_POST['uid'];
$photoo=$_FILES;
$data = array(
		'first_name' => $_POST['fname'],
		'last_name' => $_POST['lname'],
		'email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'address' => $_POST['address'],
		'city' => $_POST['city'],
		'state' => $_POST['state'],
		'zip' => $_POST['zip'],
		'diet' => $_POST['diet'],
		'nickname' => $_POST['nickname'],
		'goals' => $_POST['goals']
		);


			if($_FILES['userfile']['name'] != '') {
				$upload_dir = BASEPATH . '../uploads/' . $uid . '/profile/';
		
				if(!is_dir($upload_dir)) {
					$u_dir = (!is_dir(BASEPATH . '../uploads/' . $uid)) ? mkdir(BASEPATH . '../uploads/' . $uid, 0777) : '';
					mkdir($upload_dir, 0777);
				}
		
				$config['upload_path'] = BASEPATH . '../uploads/' . $uid . '/profile';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = TRUE;
		
				$this->load->library('upload', $config);
		
				if(!$this->upload->do_upload('userfile', FALSE)) {
					echo $this->upload->display_errors();
				
				} else {
					$photo_file = $this->upload->data();

					$data['profile_pic'] = $photo_file['file_name'];
		
					
				
					unset($file);
				}
			}

			//print_r($meal_data); die;
			$this->user_model->updateUserProfile($data, $uid);
	
			echo 'Record updated successfully';
		}

public function mealplanner(){

	$uid = $_POST['uid'];
	$id=$_POST['meal_id'];
	if($_FILES['userfile']['name'] != ''){
	$meal_kind = $_POST['meal_kind'];
	}else{
     	$meal_kind = implode(',', $_POST['meal_kind']);
     	}
     	
     	
	$d['uid'] = $uid;
           
	if($_POST['dtime'] != '') 
	{$d['dtime'] = $_POST['dtime'];} 
	else {$d['dtime'] = '';	}

           $d['title'] = addslashes($_POST['title']);
	   $d['privacy_status'] = $_POST['privacy_status'];
	   $d['meal_kind'] = $meal_kind;
           $d['details'] = $_POST['details'];
           $d['extra'] = $_POST['extra'];
           $d['notes'] = $_POST['notes'];
           $d['create_date'] = date('Y-m-d h:i:s');

			if($_FILES['userfile']['name'] != '') {
			
				$upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/original/';

				if (!is_dir($upload_dir)) {
					$u_dir = (!is_dir(BASEPATH . '../uploads/' . $uid)) ? mkdir(BASEPATH . '../uploads/' . $uid, 0777) : '';
					$s_dir = (!is_dir(BASEPATH . '../uploads/' . $uid.'/meal')) ? mkdir(BASEPATH . '../uploads/' . $uid.'/meal', 0777) : '';
					mkdir($upload_dir, 0777);
				}
	
	
			
				$config['upload_path'] = BASEPATH . '../uploads/' . $uid . '/meal/original/';
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size'] = '1000';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				$config['encrypt_name'] = TRUE;
	
				$this->load->library('upload', $config);
	
				if(!$this->upload->do_upload('userfile', FALSE)) {
					
					echo 'S1'.$this->upload->display_errors();
				
				} else {
					$photo_file = $this->upload->data();
	
					$d['meal_photo'] = $photo_file['file_name'];
	
				
					$crop_data = $_FILES;
						
					//Set resize config
					$r_config['image_library'] = 'gd2';
					$r_config['source_image'] = $photo_file['full_path'];
					$r_config['new_image'] = $photo_file['file_path'].'../'.$photo_file['file_name'];
					$r_config['maintain_ratio'] = FALSE;
	
						
					$this->load->library('image_lib', $r_config);
					$this->image_lib->crop();
				}
			}

            if($id != 0) {
				

				$this->meal_planner_model->update_record($d, $id);

				echo 'Record added successfully';
            } 
            else {
                 $this->meal_planner_model->add_record($d);
                echo 'Record added successfully';
            }
 
}

public function getallmeals(){

$id=$_REQUEST['user_id'];
 $data = $this->meal_planner_model->get_records($id);
$s=json_encode(($data));
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}

public function deletemeal(){
$uid = $_REQUEST['user_id'];
		$id = $_REQUEST['meal_id'];

		$detail = $this->meal_planner_model->get_event($id);
		$upload_dir = BASEPATH . '../uploads/' . $uid . '/meal/';
        $file = $upload_dir . $detail->meal_photo;
		unset($file);

        $this->meal_planner_model->delete_record($id);

		echo 'Record removed successfully';
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

public function addvideo(){
$uid = $this->input->post('user_id');
$id=$this->input->post('video_id');
$video_id = $this->youtube_id_from_url($this->input->post('video_link'));
if($video_id){
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
			
			$this->video_model->saveVideo($video_data, $id);

			if($id != 0) {
				echo 'Record updated successfully';
			} else {
				echo 'Record added successfully';
			}

}
else{

echo 'Invalid You Tube URL Please Enter the Correct One';
}

}

public function getallvideo(){

$id=$_REQUEST['user_id'];
$data = $this->video_model->getUserVideos($id, 20, 0, 1);;
$s=json_encode(($data));
$s1=json_decode($s);
if(empty($s1)){
echo 'null';
}
else{
echo $s;
}
}

}
