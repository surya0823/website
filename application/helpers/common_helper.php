<?php
ob_start();
// Function For User 
if(!function_exists('is_user_in')) {
	function is_user_in() {
		$CI =& get_instance();
		$is_logged_in = $CI->session->userdata('is_user_in');
		if(!isset($is_logged_in) || $is_logged_in != true) {
		    redirect(LOGOUT);
		}
	}
}
// data get by id.
if(!function_exists('get_data_by_id')) {
	function get_data_by_id($table="", $row_name="", $row_id="") {
		$CI =& get_instance();
		$CI->db->where($row_name, $row_id);	
		$query=$CI->db->get($table);
		// echo $CI->db->last_query();
		if($query->num_rows()>0) {
			return $query->row();
		} else {
			return array();
		}
	}
}
// Function For Update All Data 
if(!function_exists('update_data')) {
	function update_data($table, $where=array(), $data=array()) {
		$CI =& get_instance();
		$CI->db->where($where);
		$CI->db->update($table,$data);
		// echo $CI->db->last_query();
		if($CI->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}
}
// Function For Delete Data 
if(!function_exists('delete_data')) {
	function delete_data($table, $row_name, $row_id) {
		$CI =& get_instance();
		$CI->db->where($row_name, $row_id);
		$CI->db->delete($table);
		if($CI->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}
}
// Function For date Data 
if(!function_exists('only_date_formate')) {
	function only_date_formate($date) {
		if(!empty($date)) {
			$date_new=date_create($date);
			return date_format($date_new, "d M Y");
		} else {
			return false;
		}
	}
}
// Function For date time Data 
if(!function_exists('time_date_formate')) {
	function time_date_formate($date) {
		if(!empty($date)) {
			$date_new=date_create($date);
			return date_format($date_new,"d M Y h:i A");
		} else {
			return false;
		}
	}
}
// Function For Get All Data 
if(!function_exists('get_all_data')) {
	function get_all_data($table, $id, $data, $orderBy="", $order="",$limit="",$group_by="",$select="", $where_in="") {
		$CI =& get_instance();
		if(!empty($select)){
			$CI->db->select($select);
		}
		$CI->db->where($id, $data);

		if (!empty($where_in)) {
			// $CI->db->where_in($where_in);
			$CI->db->where_in($where_in[0], $where_in[1]);
		}

		$CI->db->order_by($orderBy, $order);
		if(!empty($limit)){
			$CI->db->limit($limit);
		}
		if(!empty($group_by)){
			$CI->db->group_by($group_by);
		}
		$data = $CI->db->get($table);
		// echo $CI->db->last_query();
		if($data->num_rows()>0) {
			return $data->result();
		} else {
			return array();
		}
	}
}
if(!function_exists('get_all_data_like')) {
	function get_all_data_like($table, $id, $data, $orderBy="", $order="",$limit="",$group_by="",$select="") {
		$CI =& get_instance();
		if(!empty($select)){
			$CI->db->select($select);
		}
		$CI->db->like($id, $data);
		$CI->db->order_by($orderBy, $order);
		if(!empty($limit)){
			$CI->db->limit($limit);
		}
		if(!empty($group_by)){
			$CI->db->group_by($group_by);
		}
		$data = $CI->db->get($table);
		if($data->num_rows()>0) {
			return $data->result();
		} else {
			return array();
		}
	}
}
// Function For Get All Data 
if(!function_exists('get_all_data_count')) {
	function get_all_data_count($table, $id, $data, $where_in1='', $where_in2='', $or_where='') {
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->where($id, $data);
		if (!empty($where_in1)) {
			$CI->db->where_in($where_in1[0], $where_in1[1]);
		}if (!empty($where_in2)) {
			$CI->db->where_in($where_in2[0], $where_in2[1]);
		}if (!empty($or_where)) {
			$CI->db->or_where($or_where);
		}
		$data = $CI->db->count_all_results($table);		
		// echo $CI->db->last_query();
		if($data) {
			return $data;
		} else {
			return 0;
		}
	}
}
if(!function_exists('encrypt')) {
	function encrypt($string, $key=5) {
		$result = '';
		for($i=0, $k= strlen($string); $i<$k; $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result .= $char;
		}
		return base64_encode($result);
	}
}
if(!function_exists('decrypt')) {
	function decrypt($string, $key=5) {
		$result = '';
		$string = base64_decode($string);
		for($i=0,$k=strlen($string); $i< $k ; $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
}
if(!function_exists('email_is_unique')) {
	function email_is_unique($email) {
		$CI =& get_instance();
		$CI->db->select('*');
		$CI->db->where('emailaddress', $email);
		$CI->db->where('delete_data', 0);
		$CI->db->where('admin_id', $CI->session->userdata('admin_id'));
		$data = $CI->db->count_all_results('fn_users');		
		if($data) {
			return $data;
		} else {
			return 0;
		}
	}
}
function upload_image($path, $image_name, $input_name){
    // define parameters
    $CI =& get_instance();
    $config['upload_path'] = $path;
    $config['allowed_types'] = '*';
    $config['file_name'] = $image_name;
    $config['max_size']      = '0';
    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);
    // upload the image
    if ($CI->upload->do_upload($input_name)) {
        // success
        // $errors[] = $CI->upload->display_errors();
    } else {
        // failed
        // $errors[] = $CI->upload->display_errors();
    }
}
function create_unique_slug($string,$table,$field='work_space',$key=NULL,$value=NULL){
    $t =& get_instance();
    $slug = url_title($string);
    $slug = strtolower($slug);
    $i = 0;
    $params = array ();
    $params[$field] = $slug;
 
    if($key)$params["$key !="] = $value; 
 
    while ($t->db->where($params)->get($table)->num_rows())
    {   
        if (!preg_match ('/-{1}[0-9]+$/', $slug ))
            $slug .= '-' . ++$i;
        else
            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
         
        $params [$field] = $slug;
    }   
    return $slug;   
}
if(!function_exists('check_is_empty')) {
	function check_is_empty($value) {
		if(!empty($value)) {
			return $value;
		} else {
			return 'N/A';

		}
	}
}
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(!function_exists('email_send')) {
	function email_send($subject,$emails,$arrayData='', $template='') {
		$CI =& get_instance();
		/* send email */
        $CI->load->library('email');
        $CI->email->from('rohan.gour@techrefic.com', 'Techrefic');
        $CI->email->to($emails);
        $CI->email->subject($subject);
        $CI->email->message($CI->load->view($template, $arrayData, true));
        $sent = $CI->email->send();
		if($sent) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>