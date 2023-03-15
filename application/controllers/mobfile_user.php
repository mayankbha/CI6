<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobfile_user extends CI_Controller {

public function __construct() {
	
        parent::__construct();

		$this->load->model('user_model');
		$this->load->model('ion_auth_model');
		$this->load->library('pagination');
        $this->load->model('selfphoto_model');
}




public function register(){
 
           $userData = array('name' => $this->input->post('name'));
           $out=$this->ion_auth->register(
                  $this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $userData, array('2')
           );
			//$this->session->set_flashdata('message', 'Thank you for registration, activation link is sent to your email id. Please check your email and activate your account.');
			if($out!=FALSE){ echo "Registered Successfully";}else{echo "Registration Unsuccessful";}
        
        //echo "added";
        } 

public function login() {

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'))) {
                //if the login is successful
                //redirect them back to the home pagedan
echo $this->ion_auth->get_user_id();

            } else {
                //if the login was un-successful
                //redirect them back to the login page
            //echo $this->session->set_flashdata('message', $this->ion_auth->messages());
		echo $this->ion_auth->errors();
            }
        
    }


public function upload(){

 $user_id = "61";
         $id=0;     
$photoo=$_FILES;
echo array_values($photoo);
            //Check and create directory if not exist
      
            $upload_dir = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            
            if (!is_dir($upload_dir)) {
                $u_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id)) ? mkdir(BASEPATH . '../uploads/' . $user_id, 0777) : '';
                $s_dir = (!is_dir(BASEPATH . '../uploads/' . $user_id.'/self')) ? mkdir(BASEPATH . '../uploads/' . $user_id.'/self', 0777) : '';
                mkdir($upload_dir, 0777);
            }

            $config['upload_path'] = BASEPATH . '../uploads/' . $user_id . '/self/original/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1000';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            //echo '<pre>'; print_r($config['upload_path']); die;
            if (!$this->upload->do_upload('userfile', FALSE) && $id==0) {
                echo "upload error".$this->upload->display_errors().$id;
 //  $stf=$_FILES;
 //  print_r(array_values($stf);
      //   print_r($_FILES["file"]["name"]);
         //  $upload = diverse_array($_FILES[0]);
         // echo array_values($stf);
 //echo print_r($first_names);    
         
 // print_r($last_names);
            } 
            else {
            echo "success Uploaded";
            }
}

public function fitness(){
	$id=0;
	$uid=$this->input->post('id');
          
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
                echo'Record updated successfully';
	
	    } else {
                
                 $this->fitness_model->add_record($d);
                echo 'Record added successfully';
					
            }
           
        }



}





