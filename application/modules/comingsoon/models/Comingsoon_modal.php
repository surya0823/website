<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comingsoon_modal extends CI_Model{

    /* User Login */
	public function userLogin($email,$password) {
        $this->db->where("email", $email);
		$this->db->where("password",md5($password));
		$this->db->where("status", 1);
		$query=$this->db->get(TBL_USERS);
		if($query->num_rows()>0){
			$row=$query->row();
			// Session For Admin Login 
			$this->db->where('user_id',$row->user_id);
			$data = array(
				'user_id' 			=> $row->user_id,
				'user_type' 		=> $row->user_type,
				'name' 				=> $row->name,
				'email'  			=> $row->email,
				'logged_in' 		=> TRUE,
				'is_user_in'		=> TRUE
			);
			$this->session->set_userdata($data);
			return true;
		} else {
			return false;
		}
    }

	
}