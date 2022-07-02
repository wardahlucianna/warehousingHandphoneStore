<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_feature_controller extends CI_Controller {
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
			$this->db->from('m_feature');
			$this->db->where('m_feature_id',$id);
			$get= $this->db->get();
			$count= $get->num_rows();
			$data['data']['data']= $get->result();
			$m_feature_group_id = count($data['data']['data'])==0?"":$data['data']['data'][0]->m_feature_id;

			$this->db->from('m_feature_group');
			$this->db->where('m_feature_group_id', $m_feature_group_id);
			$this->db->or_where('m_feature_group_status', 'Active');
			$this->db->select('m_feature_group_id, m_feature_group_name, m_feature_group_url, m_feature_group_icon');
			$this->db->order_by('m_feature_group_name');
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

		$result['row_total']	= $this->db->count_all_results('m_feature');
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('m_feature a');
		$this->db->join('m_feature_group b','a.m_feature_group_id=b.m_feature_group_id');
		$this->db->select(
				'a.m_feature_id,
				a.m_feature_name,
				a.m_feature_url,
				a.m_feature_icon,
				a.m_feature_visible,
				a.m_feature_squance,
				a.m_feature_menu_type,
				a.m_feature_status,
				b.m_feature_group_name');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			$this->db->like('m_feature_name', $search);
			$this->db->or_like('m_feature_url', $search);
			$this->db->or_like('m_feature_icon', $search);
			$this->db->or_like('m_feature_visible', $search);
			$this->db->or_like('m_feature_squance', $search);
			$this->db->or_like('m_feature_menu_type', $search);
			$this->db->or_like('m_feature_status', $search);
			$this->db->or_like('m_feature_group_name', $search);
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
		$code	= $this->input->post('m_feature_id');
		$m_feature_group_id	= $this->input->post('m_feature_group_id_area');
		$m_feature_name	= $this->input->post('m_feature_name');
		$m_feature_url	= $this->input->post('m_feature_url');
		$m_feature_icon	= $this->input->post('m_feature_icon');
		$m_feature_visible	= $this->input->post('m_feature_visible_area');
		$m_feature_squance	= $this->input->post('m_feature_squance');
		$m_feature_menu_type = $this->input->post('m_feature_menu_type_area');
		$m_feature_status	= $this->input->post('m_feature_status');

		$m_feature_visible	= $m_feature_visible==true?true:false;
		$m_feature_status	= $m_feature_status==true?"Active":"Not Active";

		

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();
		
		$data = array(
			"m_feature_id"=>$code,
			"m_feature_group_id"=>$m_feature_group_id,
			"m_feature_name"=>$m_feature_name,
			"m_feature_url"=>$m_feature_url,
			"m_feature_icon"=>$m_feature_icon,
			"m_feature_status"=>$m_feature_status,
			"m_feature_visible"=>$m_feature_visible,
			"m_feature_squance"=>$m_feature_squance,
			"m_feature_status"=>$m_feature_status,
			"m_feature_menu_type"=>$m_feature_menu_type,
		);

		//kode
		$count_name = 0;
		$count_url = 0;
		$count_icon = 0;
		if($code==""){
			$this->db->where("m_feature_name",$m_feature_name);
			$this->db->from('m_feature');
			$count_name += $this->db->get()->num_rows();

			$this->db->where("m_feature_url",$m_feature_url);
			$this->db->where("m_feature_url!=","");
			$this->db->from('m_feature');
			$count_url += $this->db->get()->num_rows();

			$this->db->where("m_feature_icon",$m_feature_icon);
			$this->db->where("m_feature_icon!=","");
			$this->db->from('m_feature');
			$count_icon += $this->db->get()->num_rows();

			$data['create_by'] = $_SESSION['employee_code'];
			$data['create_at'] = date("Y-m-d H:i:s");
		}
		else{
			$this->db->where("m_feature_name",$m_feature_name);
			$this->db->where("m_feature_id!=",$code);
			$this->db->from('m_feature');
			$count_name += $this->db->get()->num_rows();

			$this->db->where("m_feature_url",$m_feature_url);
			$this->db->where("m_feature_url!=","");
			$this->db->where("m_feature_id!=",$code);
			$this->db->from('m_feature');
			$count_url += $this->db->get()->num_rows();

			$this->db->where("m_feature_icon",$m_feature_icon);
			$this->db->where("m_feature_icon!=","");
			$this->db->where("m_feature_id!=",$code);
			$this->db->from('m_feature');
			$count_icon += $this->db->get()->num_rows();

			$data['update_by'] = $_SESSION['employee_code'];
			$data['update_at'] = date("Y-m-d H:i:s");
		}

		$status = "same";
		if($count_name>0 && $count_url>0 && $count_icon>0 ){
			$msg = "Data already";
		}
		else if($count_name>0){
			$msg = "Data <b>Name</b> already";
		}
		else if($count_url>0){
			$msg = "Data <b>URL</b> already";
		}
		else if($count_icon>0){
			$msg = "Data <b>Icon</b> already";
		}
		else{
			$status = "succsess";
			if($code==""){
				$this->db->insert('m_feature', $data);
				$msg = "Save success";
			}
			else{
				$this->db->set($data);
				$this->db->where("m_feature_id",$code);
				$this->db->update('m_feature');
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

		$this->db->where("m_feature_id",$id);
		$this->db->from('map_feature');
		$count 	+= $this->db->count_all_results();
		
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
