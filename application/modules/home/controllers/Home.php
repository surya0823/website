<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('home_modal');
        $this->load->helper(array('form', 'url', 'cookie','common_helper'));
        $this->load->library(array('form_validation', 'user_agent', 'email', 'session','upload'));
    }


/*signup first function*/ 
    public function index(){
        $data['site_title'] = "";
        $this->load->view('includes/header');
        $this->load->view('index');
        $this->load->view('includes/footer');
    }

    public function services(){
        $data['site_title'] = "";
        $this->load->view('includes/header');
        $this->load->view('services');
        $this->load->view('includes/footer');
    }

}