<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class t_income_goods_entry_controller extends CI_Controller {
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
		
		if($aksi == 'insert_handler'){
			$id = $this->input->get('id');
			$this->db->from('m_warehouse');
			$this->db->where('m_warehouse_id',$id);
			$get= $this->db->get();
			$count= $get->num_rows();
			$data['data']['data']= $get->result();

			$this->db->from('m_product');
			$this->db->where('m_product_status', 'Active');
			$this->db->select('m_product_id, m_product_name');
			$this->db->order_by('m_product_name');
			$get1= $this->db->get();
			$data['data']['list_m_product']= $get1->result();
		}
		else if($aksi == 'detail_handler'){
			$id = $this->input->get('id');
			$data['data']['id']= $id;

			$this->db->from('t_income_goods_entry');
			$this->db->where('t_income_goods_entry_code',$id);
			$this->db->select('DATE_FORMAT(create_at, "%d %M %Y %h:%i %p") as create_at');
			$get= $this->db->get()->row();
			$data['data']['create_at']= $get->create_at;
		}
		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
		
	}

	public function data_table()
	{
		$start = $this->input->post('start');
		$length	= $this->input->post('length');
		$search	= $this->input->post('search');
		$sort = $this->input->post('sort');

		$result['row_total']	= $this->db->count_all_results('m_warehouse');
		$result['row_filter'] 	= $result['row_total'];

		$this->db->distinct();
		$this->db->from('t_income_goods_entry a');
		$this->db->join('m_employee b','a.create_by=b.m_employee_id');
		$this->db->select(
				'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				a.t_income_goods_entry_code,
				b.m_employee_full_name');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			$this->db->like('m_employee_full_name', $search);
			$this->db->or_like('a.create_at', $search);
			$result['data'] = $this->db->get()->result();
			$result['row_filter'] = count($result['data']);
		}
		else{
			$result['data'] = $this->db->get()->result();
		}

		$result['status'] = "";
		echo json_encode($result);
	}

	public function data_table_detail()
	{
		$start = $this->input->post('start');
		$length	= $this->input->post('length');
		$search	= $this->input->post('search');
		$sort = $this->input->post('sort');
		$id = $this->input->post('id');

		$result['row_total']	= $this->db->count_all_results('m_warehouse');
		$result['row_filter'] 	= $result['row_total'];

		$this->db->distinct();
		$this->db->from('t_income_goods_entry a');
		$this->db->join('t_imei b','a.t_imei_id=b.t_imei_id');
		$this->db->join('m_product c','b.m_product_id=c.m_product_id');
		$this->db->where('t_income_goods_entry_code',$id);
		$this->db->select(
				'a.t_income_goods_entry_id,
				c.m_product_name,
				b.t_imei_number,
				b.note');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			// $this->db->like('m_employee_full_name', $search);
			// $this->db->or_like('a.create_at', $search);
			// $result['data'] = $this->db->get()->result();
			// $result['row_filter'] = count($result['data']);
		}
		else{
			$result['data'] = $this->db->get()->result();
		}

		$result['status'] = "";
		echo json_encode($result);
	}

	public function save()
	{
		$data_imei_string	 = $this->input->post('data_imei');
		$data_imei = json_decode($data_imei_string);

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();

		$uniqid = uniqid();
		foreach($data_imei as $x => $val) {
			$imei = $val->imei;
			$m_product_id = $val->m_product_id;
			$note = $val->note;

			$data_imei = array(
				"t_imei_number"=>$imei,
				"t_imei_status"=>"Ready",
				"m_product_id"=>$m_product_id,
				"note"=>$note,
				"create_at"=>date("Y-m-d H:i:s"),
				"create_by"=>$_SESSION['employee_code'],
			);
			$this->db->insert('t_imei', $data_imei);
			$last_id_imei = $this->db->insert_id();

			$data_entry = array(
				"t_income_goods_entry_code"=>$uniqid,
				"t_imei_id"=>$last_id_imei,
				"create_at"=>date("Y-m-d H:i:s"),
				"create_by"=>$_SESSION['employee_code'],
				"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
			);
			$this->db->insert('t_income_goods_entry', $data_entry);

			$this->db->from('m_warehouse');
			$this->db->where('m_warehouse_id',$_SESSION['m_warehouse_id']);
			$get_warehouse= $this->db->get()->row();

			$data_history = array(
				"t_imei_id"=>$last_id_imei,
				"create_at"=>date("Y-m-d H:i:s"),
				"create_by"=>$_SESSION['employee_code'],
				"t_imei_id_status"=>"Income warehose ". $get_warehouse->m_warehouse_name,
			);
			$this->db->insert('hs_imei1', $data_history);


			$this->db->from('t_stock');
			$this->db->where('m_product_id',$m_product_id);
			$this->db->where('m_warehouse_id',$_SESSION['m_warehouse_id']);
			$get= $this->db->get()->row();

			if($get==null){
				$data_entry = array(
					"t_stock_total"=>1,
					"m_product_id"=>$m_product_id,
					"create_at"=>date("Y-m-d H:i:s"),
					"create_by"=>$_SESSION['employee_code'],
					"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
				);
				$this->db->insert('t_stock', $data_entry);
			}
			else{
				$data_entry = array(
					"t_stock_total"=>$get->t_stock_total+1,
					"m_product_id"=>$m_product_id,
					"create_at"=>date("Y-m-d H:i:s"),
					"create_by"=>$_SESSION['employee_code'],
					"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
				);

				$this->db->set($data_entry);
				$this->db->where("t_stock_id",$get->t_stock_id);
				$this->db->update('t_stock');
			}
		}
		$msg = "Save success";
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

	public function check_exsis_imei(){
		$imei 		= $this->input->post('imei');

		$this->db->where("t_imei_number",$imei);
		$this->db->from('t_imei');
		$result['data'] = $this->db->get()->row();

		echo json_encode($result);
	}
}
