<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class s_profile_controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->db = $this->load->database('database',true);
		$this->load->model('m_menu');
		$this->load->model('m_email');
		date_default_timezone_set("Asia/Jakarta");
		session_start();
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

		$id = $this->input->get('id');
		$this->db->from('m_employee');
		$this->db->where('m_employee_id',$_SESSION['employee_code']);
		$get= $this->db->get();
		$count= $get->num_rows();
		$data['data']['data']= $get->result();
		$m_position_id = count($data['data']['data'])==0?"":$data['data']['data'][0]->m_position_id;
		$m_user_group_id = count($data['data']['data'])==0?"":$data['data']['data'][0]->m_user_group_id;

		$this->db->from('m_position');
		$this->db->where('m_position_status', 'Active');
		$this->db->where('m_position_name!=', "Root");
		$this->db->or_where('m_position_id', $m_position_id);
		$this->db->select('m_position_id, m_position_name');
		$get= $this->db->get();
		$data['data']['list_m_position']= $get->result();

		$this->db->from('m_user_group');
		$this->db->where('m_user_group_status', 'Active');
		$this->db->or_where('m_user_group_id', $m_user_group_id);
		$this->db->select('m_user_group_id, m_user_group_name');
		$get= $this->db->get();
		$data['data']['list_m_user_group']= $get->result();

		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
	}

	public function save()
	{
		$code	= $this->input->post('m_employee_id');
		$m_employee_full_name	= $this->input->post('m_employee_full_name');
		$m_employee_sort_name	= $this->input->post('m_employee_sort_name');
		$m_employee_email	= $this->input->post('m_employee_email');
		$m_employee_username = $this->input->post('m_employee_username');
		$m_employee_status	= $this->input->post('m_employee_status');

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();
		
		$data = array(
			"m_employee_id"=>$code,
			"m_employee_full_name"=>$m_employee_full_name,
			"m_employee_sort_name"=>$m_employee_sort_name,
			"m_employee_email"=>$m_employee_email,
			"m_employee_username"=>$m_employee_username,
			"m_employee_status"=>"Active",
		);

		//kode
		$count_email = 0;
		$count_username = 0;
		if($code==""){
			$this->db->from('m_employee');
			$this->db->where("m_employee_email",$m_employee_email);
			$count_email += $this->db->get()->num_rows();

			$this->db->from('m_employee');
			$this->db->where("m_employee_username",$m_employee_username);
			$count_username += $this->db->get()->num_rows();

			$data['m_employee_password'] = base64_encode('000000');
			$data['create_by'] = $_SESSION['employee_code'];
			$data['create_at'] = date("Y-m-d H:i:s");
		}
		else{
			$this->db->from('m_employee');
			$this->db->where("m_employee_email",$m_employee_email);
			$this->db->where("m_employee_id!=",$code);
			$count_email += $this->db->get()->num_rows();

			$this->db->from('m_employee');
			$this->db->where("m_employee_username",$m_employee_username);
			$this->db->where("m_employee_id!=",$code);
			$count_username += $this->db->get()->num_rows();

			$data['update_by'] = $_SESSION['employee_code'];
			$data['update_at'] = date("Y-m-d H:i:s");
		}

		$status = "same";
		if($count_email>0 && $count_username>0){
			$msg = "Data already";
		}
		else if($count_email>0){
			$msg = "Data <b>Email</b> already";
		}
		else if($count_username>0){
			$msg = "Data <b>User</b> already";
		}
		else{
			if($code==""){
				$data['m_employee_email_verification'] = false;
				$this->db->insert('m_employee', $data);
				$msg = "Save success";
				$code = $this->db->insert_id();
			}
			else{
				$this->db->from('m_employee');
				$this->db->where("m_employee_id",$code);
				$this->db->where("m_employee_email",$m_employee_email);
				$count = $this->db->get()->num_rows();

				$this->db->set($data);
				$this->db->where("m_employee_id",$code);
				$this->db->update('m_employee');
				$msg = "Update success";	
				$status = "succsess";
			}
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
