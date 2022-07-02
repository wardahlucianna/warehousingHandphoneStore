<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class map_feature_controller extends CI_Controller {
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
			$this->db->from('map_feature');
			$this->db->where('m_user_group_id',$id);
			$this->db->select('m_feature_id');
			$get= $this->db->get();
			$count= $get->num_rows();
			$data['data']['data']= $get->result();
			$data['data']['id']= $id;

			$this->db->from('m_feature');
			$this->db->where('m_feature_status', 'Active');
			$this->db->order_by('m_feature_name asc');
			$this->db->select('m_feature_id, m_feature_name,m_feature_group_id');
			$get1= $this->db->get();
			$data['data']['list_m_feature']= $get1->result();

			$this->db->from('m_feature a');
			$this->db->join('m_feature_group b','b.m_feature_group_id = a.m_feature_group_id');
			$this->db->where('a.m_feature_status', 'Active');
			$this->db->where('b.m_feature_group_status', 'Active');
			$this->db->order_by('m_feature_group_name asc');
			$this->db->select('a.m_feature_group_id, m_feature_group_name');
			$this->db->distinct();
			$get1= $this->db->get();
			$data['data']['list_m_feature_group']= $get1->result();
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

		$this->db->from('m_user_group');
		$this->db->where('m_user_group_status',"Active");
		$result['row_total']	= $this->db->get()->num_rows();
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('m_user_group');
		$this->db->where('m_user_group_status',"Active");
		$this->db->select('(select count(*) from map_feature where m_user_group_id=m_user_group.m_user_group_id) as aksi,m_user_group_id,m_user_group_name,m_user_group_status');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			$this->db->like('m_user_group_name', $search);
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
		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();

		$count_feature	= $this->input->post('count_feature');
		$m_user_group_id = $this->input->post('m_user_group_id');

		$this->db->from('m_feature');
		$this->db->where('m_feature_status', 'Active');
		$this->db->order_by('m_feature_name asc');
		$this->db->select('m_feature_id, m_feature_name,m_feature_group_id');
		$data= $this->db->get()->result();

		foreach ($data as $key => $item) {
			$m_feature_id = $item->m_feature_id;
			$post = $this->input->post($m_feature_id);

			$data = array(
				"m_user_group_id"=>$m_user_group_id,
				"m_feature_id"=>$m_feature_id,
			);

			if($post!=""){
				$this->db->from('map_feature');
				$this->db->where('m_feature_id', $m_feature_id);
				$this->db->where('m_user_group_id', $m_user_group_id);
				$data_map_feature= $this->db->get()->result();
				$count_map_feature= count($data_map_feature);

				if($count_map_feature==0){
					$data['create_by'] = $_SESSION['employee_code'];
					$data['create_at'] = date("Y-m-d H:i:s");
					$this->db->insert('map_feature', $data);
				}
				else{
					$data['map_feature_id'] = $data_map_feature[0]->map_feature_id;
					$data['update_by'] = $_SESSION['employee_code'];
					$data['update_at'] = date("Y-m-d H:i:s");

					$this->db->set($data);
					$this->db->where('m_feature_id', $m_feature_id);
					$this->db->where('m_user_group_id', $m_user_group_id);
					$this->db->update('map_feature');
				}
			}
			else{
				$this->db->where('m_feature_id', $m_feature_id);
				$this->db->where('m_user_group_id', $m_user_group_id);
				$data = $this->db->delete('map_feature');
			}

		}

		$msg = "Update success";
		$status = "succsess";

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
			$this->db->where('m_feature_id', $id);
			$data = $this->db->delete('m_feature');
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
