<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class s_change_password_controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->db = $this->load->database('database',true);
		$this->load->model('m_menu');
		session_start();
		date_default_timezone_set("Asia/Jakarta");
	}	

	public function index()
	{
		$data['hak_akses'] 	= $this->m_menu->hak_akses();

		$base_url = base_url();
		$current_url = current_url();
		$m_feature_url = str_replace($base_url,"",$current_url);

		$this->db->from('m_feature a');
		$this->db->join('m_feature_group b','a.m_feature_group_id=b.m_feature_group_id');
		$this->db->where('m_feature_url',$m_feature_url);
		$result= $this->db->get()->result();
		$data['form_title'] = $result[0]->m_feature_name;
		$data['group_title'] = $result[0]->m_feature_group_name;
		$data['file_title'] = str_replace('_controller/index',"",$m_feature_url);
		$data['path'] = str_replace("/index","",current_url());
		$data['data'] = "";
		$this->load->view("form_full",$data);
	}

	public function template()
	{
		$aksi = $this->input->get('aksi');
		$group_title = $this->input->get('group_title');
		$file_title = $this->input->get('file_title');
		$data['aksi'] = $aksi;
		$data['data'] = array();
		$data['path'] = str_replace("/template","",current_url());

		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
	}

	public function save()
	{
		$code	= $this->input->post('m_employee_id');
		$m_employee_password_lama = $this->input->post('m_employee_password_lama');
		$m_employee_password_new = $this->input->post('m_employee_password_new');
		$m_employee_password_new = base64_encode($m_employee_password_new);
		$m_employee_password_lama = base64_encode($m_employee_password_lama);

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();

		$this->db->where("m_employee_id",$code);
		$this->db->from('m_employee');
		$data = $this->db->get()->result();
		$m_employee_password = count($data)==0?"":$data[0]->m_employee_password;
		
		if($m_employee_password==$m_employee_password_lama){
			$this->db->set("m_employee_password",$m_employee_password_new);
			$this->db->where("m_employee_id",$code);
			$this->db->update('m_employee');
			$msg = "Change password success. Application logout and login with new password";
			$status = "succsess";

		}
		else{
			$msg = "Wrong <b>old Password</b> ";
			$status = "failed";
		}
		
		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    $msg = "Process failed";
			$status = "failed";
		}
		else{
		    $this->db->trans_commit();
		}

		$result['msg']=$msg;
		$result['status']=$status;

		$this->db->trans_complete();
		echo json_encode($result);
	}
}
