<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class t_tracking_controller extends CI_Controller {
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
		
		$result['data'] = json_encode($data);
		$this->load->view($group_title.'/'.$file_title,$result);
	}

	public function data_table()
	{
		$start 			= $this->input->post('start');
		$length 		= $this->input->post('length');
		$search 		= $this->input->post('search');
		$sort 		= $this->input->post('sort');
		$imei 		= $this->input->post('imei');

		$this->db->from('hs_imei a');
		$this->db->join('t_imei b', 'a.t_imei_id=b.t_imei_id');
		$this->db->where('t_imei_number', $imei);

		$result['row_total'] = count($this->db->get()->result());
		$result['row_filter'] = $result['row_total'];

		$this->db->from('hs_imei a');
		$this->db->join('t_imei b', 'a.t_imei_id=b.t_imei_id');
		$this->db->where('t_imei_number', $imei);
		$this->db->select('DATE_FORMAT(a.create_at, "%d %M %Y %h:%i %p") as create_at, a.hs_imei_status');
		$this->db->order_by('a.create_at desc');

		$result['data'] = $this->db->get()->result();

		$result['status'] = "";
		echo json_encode($result);
	}

	

}
