<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class s_change_logo_controller extends CI_Controller {
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
		$upload_logo_dark = $_FILES['upload_logo_dark']["name"];
		$tmp_file_upload_logo_dark = $_FILES['upload_logo_dark']["tmp_name"];
		$location_upload_logo_dark = './assets/images/logo_dark.png';

		$upload_logo = $_FILES['upload_logo']["name"];
		$tmp_file_upload_logo = $_FILES['upload_logo']["tmp_name"];
		$location_upload_logo = './assets/images/logo.png';

		$upload_logo_sm = $_FILES['upload_logo_sm']["name"];
		$tmp_file_upload_logo_sm = $_FILES['upload_logo_sm']["tmp_name"];
		$location_upload_logo_sm = './assets/images/logo_sm.png';

		$upload_logo_icon = $_FILES['upload_favicon']["name"];
		$tmp_file_upload_logo_icon = $_FILES['upload_favicon']["tmp_name"];
		$location_upload_logo_icon = './assets/images/favicon.ico';
		
		//delete-insert logo_dark;
		if($upload_logo_dark!=""){
			if (file_exists($location_upload_logo_dark)) {
				unlink($location_upload_logo_dark);
			}
			move_uploaded_file($tmp_file_upload_logo_dark, $location_upload_logo_dark);		
		}
		
		//delete-insert logo;
		if($upload_logo!=""){
			if (file_exists($location_upload_logo)) {
				unlink($location_upload_logo);
			}
			move_uploaded_file($tmp_file_upload_logo, $location_upload_logo);
		}

		//delete-insert logo_icon;
		if($upload_logo_sm!=""){
			if (file_exists($location_upload_logo_sm)) {
				unlink($location_upload_logo_sm);
			}
			move_uploaded_file($tmp_file_upload_logo_sm, $location_upload_logo_sm);
		}

		if($upload_logo_icon!=""){
			if (file_exists($location_upload_logo_icon)) {
				unlink($location_upload_logo_icon);
			}
			move_uploaded_file($tmp_file_upload_logo_icon, $location_upload_logo_icon);
		}
		

		

		

		$msg = "Update success";	
		$status = "succsess";

		$result['msg']=$msg;
		$result['status']=$status;
		
		$this->db->trans_complete();
		echo json_encode($result);
	}
}
