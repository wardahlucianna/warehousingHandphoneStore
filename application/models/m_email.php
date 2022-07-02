<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class m_email extends CI_Model{
	public function __construct()	{
		parent::__construct();
		$this->load->library('email');
		$this->db = $this->load->database('database',true);
	}
 
	function config() {
		$this->db->from('m_email_setting');
		$this->db->where('m_email_setting_status','Active');
		$data = $this->db->get()->result();

		// $config['protocol'] = "smtp";
  //       $config['smtp_crypto'] = 'ssl';
  //       $config['smtp_host'] = 'smtp.gmail.com';
  //       $config['smtp_port'] = 465;
  //       $config['smtp_user'] = 'wardah.rose123@gmail.com';
  //       $config['smtp_pass'] = '42876888';
  //       $config['charset'] = "utf-8";
  //       $config['mailtype'] = "html";
  //       $config['newline'] = "\r\n";

		  $config['protocol'] = "smtp";
      $config['smtp_crypto'] = $data[0]->m_email_setting_crypto;
      $config['smtp_host'] = $data[0]->m_email_setting_host;
      $config['smtp_port'] = $data[0]->m_email_setting_port;
      $config['smtp_user'] = $data[0]->m_email_setting_user;
      $config['smtp_pass'] = base64_decode($data[0]->m_email_setting_password);
      $config['charset'] = "utf-8";
      $config['mailtype'] = "html";
      $config['newline'] = "\r\n";
    
    return $config;
	}


	
}