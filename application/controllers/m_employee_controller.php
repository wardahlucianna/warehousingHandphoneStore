<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_employee_controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array("html","form","url","text"));
		$this->db = $this->load->database('database',true);
		$this->load->model('m_menu');
		$this->load->model('m_email');
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
		$this->db->where('a.m_feature_url',$m_feature_url);
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
		
		if($aksi == 'insert_handler' || $aksi == 'edit_handler'){
			$id = $this->input->get('id');
			$this->db->from('m_employee');
			$this->db->where('m_employee_id',$id);
			$get= $this->db->get();
			$count= $get->num_rows();
			$data['data']['data']= $get->result();
			$m_position_id = count($data['data']['data'])==0?"":$data['data']['data'][0]->m_position_id;
			$m_user_group_id = count($data['data']['data'])==0?"":$data['data']['data'][0]->m_user_group_id;

			$this->db->from('m_position');
			$this->db->where('m_position_status', 'Active');
			$this->db->where('m_position_name!=', "Root");
			$this->db->select('m_position_id, m_position_name');
			$this->db->order_by('m_position_name');
			$get= $this->db->get();
			$data['data']['list_m_position']= $get->result();

			$this->db->from('m_warehouse');
			$this->db->where('m_warehouse_status', 'Active');
			$this->db->select('m_warehouse_id, m_warehouse_name');
			$this->db->order_by('m_warehouse_name');
			$get= $this->db->get();
			$data['data']['list_m_warehouse']= $get->result();

			$this->db->from('m_user_group');
			$this->db->where('m_user_group_status', 'Active');
			$this->db->or_where('m_user_group_id', $m_user_group_id);
			$this->db->select('m_user_group_id, m_user_group_name');
			$this->db->order_by('m_user_group_name');
			$get= $this->db->get();
			$data['data']['list_m_user_group']= $get->result();
		}
		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
	}

	public function data_table()
	{
		$start 			= $this->input->post('start');
		$length 		= $this->input->post('length');
		$search 		= $this->input->post('search');
		$sort 		= $this->input->post('sort');

		$result['row_total']	= $this->db->count_all_results('m_employee');
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('m_employee a');
		$this->db->join('m_position b','a.m_position_id=b.m_position_id');
		$this->db->join('m_user_group c','a.m_user_group_id=c.m_user_group_id');
		$this->db->join('m_warehouse d','a.m_warehouse_id=d.m_warehouse_id');
		$this->db->select(
				'a.m_employee_id,
				a.m_employee_full_name,
				a.m_employee_sort_name,
				b.m_position_name,
				c.m_user_group_name,
				a.m_employee_username,
				d.m_warehouse_name,
				a.m_employee_status');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			$this->db->like('m_employee_full_name', $search);
			$this->db->or_like('m_employee_sort_name', $search);
			$this->db->or_like('m_position_name', $search);
			$this->db->or_like('m_user_group_name', $search);
			$this->db->or_like('m_employee_username', $search);
			$this->db->or_like('m_employee_email', $search);
			$this->db->or_like('m_employee_email_verification', $search);
			$this->db->or_like('m_employee_status', $search);
			$result['data'] = $this->db->get()->result();
			$result['row_filter'] = count($result['data']);
		}
		else{
			$result['data'] = $this->db->get()->result();
		}

		$result['status'] = "";
		echo json_encode($result);
	}

	public function save()
	{
		$code	= $this->input->post('m_employee_id');
		$m_employee_full_name	= $this->input->post('m_employee_full_name');
		$m_employee_sort_name	= $this->input->post('m_employee_sort_name');
		$m_position_id	= $this->input->post('m_position_id_area');
		$m_user_group_id = $this->input->post('m_user_group_id_area');
		$m_employee_email	= $this->input->post('m_employee_email');
		$m_employee_username = $this->input->post('m_employee_username');
		$m_warehouse_id = $this->input->post('m_warehouse_id');
		$m_employee_status	= $this->input->post('m_employee_status');
		$m_employee_status	= $m_employee_status==true?"Active":"Not Active";

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();
		
		$data = array(
			"m_employee_id"=>$code,
			"m_employee_full_name"=>$m_employee_full_name,
			"m_employee_sort_name"=>$m_employee_sort_name,
			"m_position_id"=>$m_position_id,
			"m_user_group_id"=>$m_user_group_id,
			"m_employee_email"=>$m_employee_email,
			"m_employee_username"=>$m_employee_username,
			"m_employee_status"=>$m_employee_status,
			"m_warehouse_id"=>$m_warehouse_id,
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
		if($count_username>0){
			$msg = "Data already";
		}
		else if($count_username>0){
			$msg = "Data <b>User</b> already";
		}
		else{
			$status = "succsess";

			if($code==""){
				$this->db->insert('m_employee', $data);
				$msg = "Save success";
				$code = $this->db->insert_id();
			}
			else{
				$this->db->set($data);
				$this->db->where("m_employee_id",$code);
				$this->db->update('m_employee');
				$msg = "Update success";	
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

	public function delete(){
		$id 		= $this->input->get('id');
		$count 		= 0;
		
		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();

		if($count>0){
			$status 	= "failed";
			$msg 	= "Delete failed";
		}
		else{
			$status 	= "delete";
			$msg 	= "Delete success";
			$this->db->where('m_employee_id', $id);
			$data = $this->db->delete('m_employee');
		}

		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    $status = "failed";
		    $msg = "Process failed";
		}
		else{
		    $this->db->trans_commit();
		}

		$result['msg']=$msg;
		$result['status']=$status;

		$this->db->trans_complete();
		echo json_encode($result);
	}

	public function resert_password(){
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		$password = base64_encode($password);
		
		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();

		$this->db->from('m_employee');
		$this->db->where("m_employee_id",$_SESSION['employee_code']);
		$this->db->where("m_employee_password",$password);
		$count = $this->db->get()->num_rows();

		if($count>0){
			$this->db->set("m_employee_password",base64_encode('000000'));
			$this->db->where("m_employee_id",$id);
			$this->db->update('m_employee');
			$status = "succsess";
			$msg = "Reset password succsess";
		}
		else{
			$status = "failed";
			$msg = "Reset password failed";
		}

		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    $status = "failed";
		    $msg = "Process failed";
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
