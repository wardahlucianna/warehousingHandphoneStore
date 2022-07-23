<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class r_stock_out_controller extends CI_Controller {
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
		if($aksi == "filter_report"){
			$this->db->from('m_warehouse');
			$this->db->where('m_warehouse_status', 'Active');
			$this->db->select('m_warehouse_id, m_warehouse_name');
			$this->db->order_by('m_warehouse_name');
			$get= $this->db->get();
			$data['data']['list_m_warehouse']= $get->result();

			$this->db->from('m_shop');
			$this->db->where('m_shop_status', 'Active');
			$this->db->select('m_shop_id, m_shop_name');
			$this->db->order_by('m_shop_name');
			$get= $this->db->get();
			$data['data']['list_m_shop']= $get->result();
		}
		else if($aksi=='report'){

		 	$data['data']["m_warehouse_id"] = $this->input->get('m_warehouse_id_area');
		 	$data['data']["start_date"] = $this->input->get('start_date_format');
		 	$data['data']["end_date"] = $this->input->get('end_date_format');
		 	$data['data']["date_range"] = $this->input->get('date_range');
		 	$data['data']["m_shop_id"] = $this->input->get('m_shop_id');
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
		$date = $this->input->post('date');
		$m_warehouse_id = $this->input->post('m_warehouse_id');
		$m_shope_id = $this->input->post('m_shope_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$this->db->from('t_outcome_goods_entry a');
		$this->db->join('m_employee b','a.create_by=b.m_employee_id');
		$this->db->join('t_imei c','a.t_imei_id=c.t_imei_id');
		$this->db->join('m_product d','c.m_product_id=d.m_product_id');
		$this->db->join('m_warehouse e','a.m_warehouse_id=e.m_warehouse_id');
		$this->db->join('m_shop i','a.m_shop_id=i.m_shop_id');
		$this->db->join('m_color f','d.m_color_id=f.m_color_id');
		$this->db->join('m_size g','d.m_size_id=g.m_size_id');
		$this->db->join('m_product_type h','d.m_product_type_id=h.m_product_type_id');
		$this->db->select(
				'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				b.m_employee_full_name,
				c.t_imei_number,
				c.t_imei_status,
				e.m_warehouse_name,
				i.m_shop_name,
				h.m_product_type_name,
				f.m_color_name,
				g.m_size_name,
				a.t_outcome_goods_entry_id');
		$this->db->where(" a.create_at BETWEEN '".$start_date."' AND '".$end_date."'");

		if($m_warehouse_id!=null || $m_warehouse_id!=""){
			 $this->db->where('a.m_warehouse_id=',$m_warehouse_id);
		}

		if($m_warehouse_id!=null || $m_warehouse_id!=""){
			$this->db->where('a.m_warehouse_id=',$m_warehouse_id);
		}

		$result['row_total']	= count($this->db->get()->result());
		$result['row_filter'] 	= $result['row_total'];

		$this->db->from('t_outcome_goods_entry a');
		$this->db->join('m_employee b','a.create_by=b.m_employee_id');
		$this->db->join('t_imei c','a.t_imei_id=c.t_imei_id');
		$this->db->join('m_product d','c.m_product_id=d.m_product_id');
		$this->db->join('m_warehouse e','a.m_warehouse_id=e.m_warehouse_id');
		$this->db->join('m_shop i','a.m_shop_id=i.m_shop_id');
		$this->db->join('m_color f','d.m_color_id=f.m_color_id');
		$this->db->join('m_size g','d.m_size_id=g.m_size_id');
		$this->db->join('m_product_type h','d.m_product_type_id=h.m_product_type_id');
		$this->db->select(
				'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				b.m_employee_full_name,
				c.t_imei_number,
				c.t_imei_status,
				e.m_warehouse_name,
				i.m_shop_name,
				h.m_product_type_name,
				f.m_color_name,
				g.m_size_name,
				a.t_outcome_goods_entry_id');

		$this->db->where(" a.create_at BETWEEN '".$start_date."' AND '".$end_date."'");

		if($m_warehouse_id!=null || $m_warehouse_id!=""){
			$this->db->where('a.m_warehouse_id=',$m_warehouse_id);
		}

		if($m_shope_id!=null || $m_shope_id!=""){
			$this->db->where('a.m_shope_id=',$m_shope_id);
		}

		$this->db->limit($length,$start);
		
		foreach ($sort as $key => $value) {
			$this->db->order_by($value[0]);
		}

		if($search!=null || $search!=""){
			$this->db->where("(m_employee_full_name LIKE '%".$search."%' ESCAPE '!' 
							or t_imei_number LIKE '%".$search."%' ESCAPE '!' 
							or t_imei_status LIKE '%".$search."%' ESCAPE '!' 
							or m_warehouse_name LIKE '%".$search."%' ESCAPE '!' 
							or m_product_type_name LIKE '%".$search."%' ESCAPE '!' 
							or m_color_name LIKE '%".$search."%' ESCAPE '!' 
							or m_size_name LIKE '%".$search."%' ESCAPE '!' 
							or m_shop_name LIKE '%".$search."%' ESCAPE '!' 
							or DATE_FORMAT(a.create_at, '%M %Y %h:%i %p') LIKE '%".$search."%' ESCAPE '!')");
			$result['data'] = $this->db->get()->result();
			$result['row_filter'] = count($result['data']);
		}
		else{
			$result['data'] = $this->db->get()->result();
		}


		$result['status'] = "";
		echo json_encode($result);
	}

	function report_pdf(){
		$start_date = $this->input->post('start_date');
		$m_warehouse_id = $this->input->post('m_warehouse_id');
		$end_date = $this->input->post('end_date');
		$m_shope_id = $this->input->post('m_shope_id');

		$this->db->from('t_outcome_goods_entry a');
		$this->db->join('m_employee b','a.create_by=b.m_employee_id');
		$this->db->join('t_imei c','a.t_imei_id=c.t_imei_id');
		$this->db->join('m_product d','c.m_product_id=d.m_product_id');
		$this->db->join('m_warehouse e','a.m_warehouse_id=e.m_warehouse_id');
		$this->db->join('m_shop i','a.m_shop_id=i.m_shop_id');
		$this->db->join('m_color f','d.m_color_id=f.m_color_id');
		$this->db->join('m_size g','d.m_size_id=g.m_size_id');
		$this->db->join('m_product_type h','d.m_product_type_id=h.m_product_type_id');
		$this->db->select(
				'DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at,
				b.m_employee_full_name,
				c.t_imei_number,
				c.t_imei_status,
				e.m_warehouse_name,
				i.m_shop_name,
				h.m_product_type_name,
				f.m_color_name,
				g.m_size_name,
				a.t_outcome_goods_entry_id');
		$this->db->where(" a.create_at BETWEEN '".$start_date."' AND '".$end_date."'");

		if($m_warehouse_id!=null || $m_warehouse_id!=""){
			 $this->db->where('a.m_warehouse_id=',$m_warehouse_id);
		}

		if($m_warehouse_id!=null || $m_warehouse_id!=""){
			$this->db->where('a.m_warehouse_id=',$m_warehouse_id);
		}

		$this->db->order_by('m_shop_name asc,m_product_type_name asc,m_size_name asc,m_color_name asc');
		$data["data"] = $this->db->get()->result();
		$html=$this->load->view('Report/report_stock_out', $data, true); 
		
		if(isset($_POST["btn_print"])){
			$this->load->library('m_pdf');
			$pdf = $this->m_pdf->page_portrait();
	       	$pdf->WriteHTML($html);
			$pdf->Output();
		}
	}
}
