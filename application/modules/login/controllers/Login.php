<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('login_model');
        $this->load->helper(array('form', 'url', 'cookie','common_helper'));
        $this->load->library(array('form_validation', 'user_agent', 'email', 'session','upload'));
    }


/*signup first function*/ 
    public function index(){
        $data['site_title'] = "";
        $this->load->view('signup');
    }

/*404 page not found*/
    public function notFound(){
        $data['site_title'] = "";
        $this->load->view('notFound');
    }


}