<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class t_return_stock_out_controller extends CI_Controller {
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
			$this->db->from('m_shop');
			$this->db->where('m_shop_status', 'Active');
			$this->db->select('m_shop_id, m_shop_name');
			$this->db->order_by('m_shop_name');
			$get1= $this->db->get();
			$data['data']['list_m_shop']= $get1->result();
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
		$date = $this->input->post('date');


		$this->db->from('t_return_stock_in a');
		$this->db->join('m_shop b','a.m_shop_id=b.m_shop_id');
		$this->db->join('t_imei c','a.t_imei_id_return=c.t_imei_id');
		$this->db->join('t_imei d','a.t_imei_id_replacement=d.t_imei_id');
		$this->db->join('m_employee e','a.create_by=e.m_employee_id');
		$this->db->where("DATE_FORMAT(a.create_at, '%M %Y')=DATE_FORMAT('".$date."', '%M %Y' )" );
		$this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		$this->db->select(
				'a.t_return_stock_in_id,
				b.m_shop_name,
				DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				c.t_imei_number as t_imei_number_return,
				d.t_imei_number as t_imei_number_replacement,
				e.m_employee_full_name,
				a.t_return_stock_in_note');

		$result['row_total']	= count($this->db->get()->result());
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('t_return_stock_in a');
		$this->db->join('m_shop b','a.m_shop_id=b.m_shop_id');
		$this->db->join('t_imei c','a.t_imei_id_return=c.t_imei_id');
		$this->db->join('t_imei d','a.t_imei_id_replacement=d.t_imei_id');
		$this->db->join('m_employee e','a.create_by=e.m_employee_id');
		$this->db->where("DATE_FORMAT(a.create_at, '%M %Y')=DATE_FORMAT('".$date."', '%M %Y' )" );
		$this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		$this->db->select(
				'a.t_return_stock_in_id,
				b.m_shop_name,
				DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				c.t_imei_number as t_imei_number_return,
				d.t_imei_number as t_imei_number_replacement,
				e.m_employee_full_name,
				a.t_return_stock_in_note');
		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			if($value[0]=="t_imei_number_return"){
				$this->db->order_by("c.t_imei_number");
			}
			else if($value[0]=="t_imei_number_replacement"){
				$this->db->order_by("d.t_imei_number");
			}
			else{
				$this->db->order_by($value[0]);
			}
		}

		if($search!=null || $search!=""){
			$this->db->where("(m_shop_name LIKE '%".$search."%' ESCAPE '!' 
							or 
							c.t_imei_number LIKE '%".$search."%' ESCAPE '!' 
							or 
							d.t_imei_number LIKE '%".$search."%' ESCAPE '!' 
							or 
							t_return_stock_in_note LIKE '%".$search."%' ESCAPE '!' 
							or 
							m_employee_full_name LIKE '%".$search."%' ESCAPE '!' 
							or 
							DATE_FORMAT(a.create_at, '%M %Y %h:%i %p') LIKE '%".$search."%' ESCAPE '!')
							");
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
		$imei_return	= $this->input->post('imei_return');
		$imei_replacement	= $this->input->post('imei_replacement');
		$t_return_stock_in_note	= $this->input->post('t_return_stock_in_note');
		$m_shop_id	= $this->input->post('m_shop_id');

		$this->db->trans_start(); // Query will be rolled back
		$this->db->trans_begin();
		
		$this->db->from('t_imei');
		$this->db->where('t_imei_number',$imei_return);
		$get_imei_return= $this->db->get()->row();

		$this->db->from('t_imei');
		$this->db->where('t_imei_number',$imei_replacement);
		$get_imei_replacment= $this->db->get()->row();

		$this->db->from('m_warehouse');
		$this->db->where('m_warehouse_id',$get_imei_replacment->m_warehouse_id);
		$get_warehouse= $this->db->get()->row();

		$this->db->from('m_warehouse');
		$this->db->where('m_warehouse_id',$get_imei_return->m_warehouse_id);
		$get_warehouse_old= $this->db->get()->row();

		//create entry
		$data_entry = array(
			"t_imei_id_return"=>$get_imei_return->t_imei_id,
			"t_imei_id_replacement"=>$get_imei_replacment->t_imei_id,
			"t_return_stock_in_note"=>$t_return_stock_in_note,
			"m_shop_id"=>$m_shop_id,
			"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
		);

		$data_entry['create_by'] = $_SESSION['employee_code'];
		$data_entry['create_at'] = date("Y-m-d H:i:s");

		$status = "succsess";
		$this->db->insert('t_return_stock_in', $data_entry);
		$msg = "Save success";
		$code = $this->db->insert_id();

		//update imei return
		$data_imei_return = array(
			"t_imei_status"=>"Ready",
			"update_at"=>date("Y-m-d H:i:s"),
			"update_by"=>$_SESSION['employee_code'],
			"m_warehouse_id"=>$get_warehouse->m_warehouse_id,
		);

		$this->db->set($data_imei_return);
		$this->db->where("t_imei_number",$imei_return);
		$this->db->update('t_imei');

		//update History retrurn
		$this->db->from('t_imei a');
		$this->db->join('m_warehouse b','a.m_warehouse_id=b.m_warehouse_id');
		$this->db->where('t_imei_number',$imei_return);
		$data_imei_by_number_return= $this->db->get()->row();

		$data_history_return_1 = array(
			"t_imei_id"=>$data_imei_by_number_return->t_imei_id,
			"create_at"=>date("Y-m-d H:i:s"),
			"create_by"=>$_SESSION['employee_code'],
			"hs_imei_status"=>"Return goods to  warehouse ". $get_warehouse->m_warehouse_name,
		);
		$this->db->insert('hs_imei', $data_history_return_1);

		//update stock retrurn
		$this->db->from('t_stock a');
		$this->db->join('t_imei b','a.m_product_id=b.m_product_id');
		$this->db->where('t_imei_number',$imei_return);
		$this->db->where('a.m_warehouse_id',$_SESSION['m_warehouse_id']);
		$get_Stock_return= $this->db->get()->row();

		if($get_Stock_return==null){
			$data_stock_return = array(
				"t_stock_total"=>1,
				"m_product_id"=>$get_Stock_return->m_product_id,
				"create_at"=>date("Y-m-d H:i:s"),
				"create_by"=>$_SESSION['employee_code'],
				"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
			);
			$this->db->insert('t_stock', $data_stock_return);
		}
		else{
			$data_stock_return = array(
				"t_stock_total"=>$get_Stock_return->t_stock_total+1,
				"update_at"=>date("Y-m-d H:i:s"),
				"update_by"=>$_SESSION['employee_code'],
			);


			$this->db->set($data_stock_return);
			$this->db->where("t_stock_id",$get_Stock_return->t_stock_id);
			$this->db->update('t_stock');
		}

		//========================
		//update imei replacement
		$data_imei_replacement = array(
			"t_imei_status"=>"Sold",
			"update_at"=>date("Y-m-d H:i:s"),
			"update_by"=>$_SESSION['employee_code'],
			"m_warehouse_id"=>$_SESSION['m_warehouse_id'],
		);

		$this->db->set($data_imei_replacement);
		$this->db->where("t_imei_number",$imei_replacement);
		$this->db->update('t_imei');

		//update History replacement
		$this->db->from('t_imei a');
		$this->db->join('m_warehouse b','a.m_warehouse_id=b.m_warehouse_id');
		$this->db->where('t_imei_number',$imei_replacement);
		$data_imei_by_number_replacement= $this->db->get()->row();

		$data_history_replacement = array(
			"t_imei_id"=>$data_imei_by_number_replacement->t_imei_id,
			"create_at"=>date("Y-m-d H:i:s"),
			"create_by"=>$_SESSION['employee_code'],
			"hs_imei_status"=>"Replacement Imei ".$imei_return." from  warehouse ". $get_warehouse->m_warehouse_name." to warehouse ".$get_warehouse_old->m_warehouse_name,
		);
		$this->db->insert('hs_imei', $data_history_replacement);

		//update stock replacement
		$this->db->from('t_stock a');
		$this->db->join('t_imei b','a.m_product_id=b.m_product_id');
		$this->db->where('t_imei_number',$imei_replacement);
		$this->db->where('a.m_warehouse_id',$_SESSION['m_warehouse_id']);
		$get_Stock_replacement= $this->db->get()->row();
		
		$data_stoct_replacement = array(
			"t_stock_total"=>$get_Stock_replacement->t_stock_total-1,
			"update_at"=>date("Y-m-d H:i:s"),
			"update_by"=>$_SESSION['employee_code'],
		);

		$this->db->set($data_stoct_replacement);
		$this->db->where("t_stock_id",$get_Stock_replacement->t_stock_id);
		$this->db->update('t_stock');

		// update transaction
		$this->db->from('t_outcome_goods_entry a');
		$this->db->where('t_imei_id',$get_Stock_return->t_imei_id);
		$update_t_outcome= $this->db->get()->row();

		$data_outcome = array(
			"t_imei_id"=>$get_Stock_replacement->t_imei_id,
			"update_at"=>date("Y-m-d H:i:s"),
			"update_by"=>$_SESSION['employee_code'],
		);

		$this->db->set($data_outcome);
		$this->db->where("t_imei_id",$get_Stock_return->t_imei_id);
		$this->db->update('t_outcome_goods_entry');

		$data_imei_replacement = array(
			"t_imei_status"=>"Ready",
			"update_at"=>date("Y-m-d H:i:s"),
			"update_by"=>$_SESSION['employee_code'],
			"t_imei_status"=>"Sold",
			"m_warehouse_id"=>$get_warehouse_old->m_warehouse_id,
		);

		$this->db->set($data_imei_replacement);
		$this->db->where("t_imei_number",$imei_replacement);
		$this->db->update('t_imei');

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

	public function check_exsis_imei_return(){
		$imei 		= $this->input->post('imei_return');
		$m_shop_id 		= $this->input->post('m_shop_id');

		$this->db->where("a.t_imei_number",$imei);
		$this->db->where("a.t_imei_status","Sold");
		$this->db->where("b.m_shop_id",$m_shop_id);
		$this->db->from('t_imei a');
		$this->db->join('t_outcome_goods_entry b','a.t_imei_id=b.t_imei_id');
		//$this->db->join('m_warehouse c','b.m_warehouse_id=c.m_warehouse_id');
		$this->db->join('m_product d','a.m_product_id=d.m_product_id');
		$result['data'] = $this->db->get()->row();

		echo json_encode($result);
	}

	public function check_exsis_imei_replacement(){
		$imei 		= $this->input->post('imei_replacement');

		$this->db->where("a.t_imei_number",$imei);
		$this->db->where("a.t_imei_status","Ready");
		$this->db->where('b.m_warehouse_id',$_SESSION['m_warehouse_id']);
		$this->db->from('t_imei a');
		$this->db->join('t_income_goods_entry b','a.t_imei_id=b.t_imei_id');
		$this->db->join('m_warehouse c','b.m_warehouse_id=c.m_warehouse_id');
		$this->db->join('m_product d','a.m_product_id=d.m_product_id');
		$result['data'] = $this->db->get()->row();

		echo json_encode($result);
	}




}
