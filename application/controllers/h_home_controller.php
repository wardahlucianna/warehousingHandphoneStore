<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class h_home_controller extends CI_Controller {
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

		$this->load->view("form_full_dashboard",$data);
	}

	public function template()
	{
		$aksi = $this->input->get('aksi');
		$group_title = $this->input->get('group_title');
		$file_title = $this->input->get('file_title');
		$data['aksi'] = $aksi;
		$data['data'] = array();
		$data['path'] = str_replace("/template","",current_url());
		$date = date("Y-m-d H:i:s");
		$yesterday = date("Y-m-d H:i:s",strtotime("-1 days"));
		
		if($aksi == 'total_all_product'){
			//total all product
			$this->db->from('t_imei');
			$this->db->where('t_imei_status','Ready');
			$get= $this->db->get();
			$count= $get->num_rows();
			$data['data']['total_all_product']= $count;

			//total stoct in today
			$this->db->distinct();
			$this->db->from('t_outcome_goods_entry a');
			$this->db->join('m_employee b','a.create_by=b.m_employee_id');
			$this->db->select(
					'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
					b.m_employee_full_name');
			$this->db->where("DATE_FORMAT(a.create_at, '%d %M %Y')=DATE_FORMAT('".$date."', '%d %M %Y' )" );

			if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
				 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
			}

			$data['data']['total_stoct_in']	= count($this->db->get()->result());

			//total stoct in yesterday
			$this->db->distinct();
			$this->db->from('t_outcome_goods_entry a');
			$this->db->join('m_employee b','a.create_by=b.m_employee_id');
			$this->db->select(
					'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
					b.m_employee_full_name');
			$this->db->where("DATE_FORMAT(a.create_at, '%d %M %Y')=DATE_FORMAT('".$yesterday."', '%d %M %Y' )" );
			
			if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
				 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
			}
			$total_stoct_in_yesterday	= count($this->db->get()->result());

			//caculate persen
			$data['data']['persen_stoct_in'] = 0;
			$data['data']['status_stoct_in'] = "fa fa-exchange";
			$data['data']['colur_stoct_in'] = "bg-warning";
			$data['data']['colur_text_stoct_in'] = "text-warning";

			// $data['data']['total_stoct_in'] = 1;
			// $total_stoct_in_yesterday = 15;

			if($data['data']['total_stoct_in']==0 && $total_stoct_in_yesterday==0){
				$data['data']['persen_stoct_in'] = 0;
				$data['data']['status_stoct_in'] = "fa fa-exchange";
				$data['data']['colur_stoct_in'] = "bg-warning";
				$data['data']['colur_text_stoct_in'] = "text-warning";
			}
			else if($data['data']['total_stoct_in'] == $total_stoct_in_yesterday){
				$data['data']['persen_stoct_in'] = 100;	
				$data['data']['status_stoct_in'] = "fa fa-exchange";
				$data['data']['colur_stoct_in'] = "bg-warning";
				$data['data']['colur_text_stoct_in'] = "text-warning";
			}
			else if($data['data']['total_stoct_in'] > $total_stoct_in_yesterday){
				$data['data']['persen_stoct_in'] = ceil(($data['data']['total_stoct_in']-$total_stoct_in_yesterday)/$data['data']['total_stoct_in']*100);	
				$data['data']['status_stoct_in'] = "fa fa-arrow-up";
				$data['data']['colur_stoct_in'] = "bg-info";
				$data['data']['colur_text_stoct_in'] = "text-info";
			}
			else if($data['data']['total_stoct_in'] < $total_stoct_in_yesterday){
				$data['data']['persen_stoct_in'] = ceil(($total_stoct_in_yesterday-$data['data']['total_stoct_in'])/$total_stoct_in_yesterday*100);	
				$data['data']['status_stoct_in'] = "fa fa-arrow-down";
				$data['data']['colur_stoct_in'] = "bg-danger";
				$data['data']['colur_text_stoct_in'] = "text-danger";
			}
		}
		else if($aksi == 'summary_product'){

		}

		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
		
	}

	public function data_table()
	{
		$start 			= $this->input->post('start');
		$length 		= $this->input->post('length');
		$search 		= $this->input->post('search');
		$sort 			= $this->input->post('sort');

		
		$this->db->from('t_stock a');
		$this->db->join('m_product b', 'a.m_product_id=b.m_product_id');
		$this->db->where('b.m_product_status=','Active');

		if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
			 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		}
		$result['row_total']	= count($this->db->get()->result());
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('t_stock a');
		$this->db->join('m_product b', 'a.m_product_id=b.m_product_id');
		$this->db->where('b.m_product_status=','Active');
		$this->db->where('a.t_stock_total<=b.m_product_limit');
		if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
			 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		}

		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		$result['data'] = $this->db->get()->result();


		$result['status'] = "";
		echo json_encode($result);
	}

	public function data_summery_table()
	{
		$start 			= $this->input->post('start');
		$length 		= $this->input->post('length');
		$search 		= $this->input->post('search');
		$sort 			= $this->input->post('sort');

		
		$this->db->from('t_stock a');
		$this->db->join('m_product b', 'a.m_product_id=b.m_product_id');
		$this->db->join('m_product_type c', 'b.m_product_type_id=c.m_product_type_id');
		$this->db->where('b.m_product_status=','Active');

		if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
			 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		}
		$result['row_total']	= count($this->db->get()->result());
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('t_stock a');
		$this->db->join('m_product b', 'a.m_product_id=b.m_product_id');
		$this->db->join('m_product_type c', 'b.m_product_type_id=c.m_product_type_id');
		$this->db->where('b.m_product_status=','Active');
		$this->db->where('a.t_stock_total<=b.m_product_limit');
		if($_SESSION['m_warehouse_id']!=null || $_SESSION['m_warehouse_id']!=""){
			 $this->db->where('a.m_warehouse_id=',$_SESSION['m_warehouse_id']);
		}

		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		$result['data'] = $this->db->get()->result();


		$result['status'] = "";
		echo json_encode($result);
	}
}
