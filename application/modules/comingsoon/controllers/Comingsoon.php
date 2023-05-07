<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comingsoon extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('comingsoon_modal');
        $this->load->helper(array('form', 'url', 'cookie','common_helper'));
        $this->load->library(array('form_validation', 'user_agent', 'email', 'session','upload'));
    }


/* first function*/ 
    public function index(){
        if(isset($_POST) && !empty($_POST)){
            extract($_POST);
            $this->db->insert('notify', array_filter($_POST));
            /*email notification*/
            $emailData = array(
                    'email'=>$email
                ); 
            email_send('Notify me when Techrefic is live', $email, $emailData, 'email-template/notify_email');
            /*email notification end*/
            echo json_encode(array('status'=>true, 'message'=>'Send Successfully.'));die;
        }
        $data['site_title'] = "Coming Soon | Techrefic";
        $this->load->view('index', $data);
    }

}