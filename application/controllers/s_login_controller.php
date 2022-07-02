<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class s_login_controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->db = $this->load->database('database',true);
		session_start();
		date_default_timezone_set("Asia/Jakarta");
	}	

	public function index()
	{
		$data["alert"] = '';
		$data['path'] = str_replace("/index","",current_url());
		$this->load->view("form_login",$data);
	}

	function verifikasi(){
		$username = $_POST['username'];
		$password = base64_encode($_POST['password']);
		$password_def = base64_encode('000000');
		
		$this->db->from('m_employee a');
		$this->db->from('m_position b', 'a.m_employee_id=b.m_employee_id');
		$this->db->where("m_employee_status","Active");
		$this->db->where("m_employee_username",$username);
		$this->db->where("m_employee_password",$password);
		$data = $this->db->get()->result();

		$jumdata 	= count($data);

		$jumlah_user = 0;
		if($jumdata>0){
			foreach ($data as $row){
				$_SESSION['employee_code'] = $row->m_employee_id;
				$_SESSION['employee_full_name'] = $row->m_employee_full_name;
				$_SESSION['employee_sort_name'] = $row->m_employee_sort_name;
				$_SESSION['employee_position_code'] = $row->m_position_id;
				$_SESSION['employee_position_name'] = $row->m_position_name;
				$_SESSION['employee_user_group_id'] = $row->m_user_group_id;
				$_SESSION['m_warehouse_id'] = $row->m_warehouse_id;
			}

			if($password_def==$password){
				redirect("s_change_password_controller/index");
			}
			else{
				redirect("h_home_controller/index");
			}
		}
		else{
			$data["alert"] = 'Maaf, pengguna dan kata sandi salah';
			$data['path'] = str_replace("/index","",current_url());
			$this->load->view("form_login",$data);
		}
	}
}
