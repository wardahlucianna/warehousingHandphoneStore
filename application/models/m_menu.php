<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class m_menu extends CI_Model{
 
	public function __construct()	{
		parent::__construct();
		$this->db = $this->load->database('database',true);
	}
	
	public function hak_akses() {
		$this->db->from('map_feature a');
		$this->db->join('m_feature b','a.m_feature_id = b.m_feature_id');
		$this->db->join('m_feature_group c','c.m_feature_group_id = b.m_feature_group_id');
		$this->db->where('c.m_feature_group_status','Active');
		$this->db->where('b.m_feature_status','Active');
		$this->db->where('b.m_feature_visible',1);
		$this->db->where('m_user_group_id',$_SESSION['employee_user_group_id']);
		$this->db->where('m_feature_menu_type','Left menu');
		$this->db->order_by('c.m_feature_group_name','asc');
		$this->db->order_by('b.m_feature_squance','asc');
		$this->db->select('c.m_feature_group_id,c.m_feature_group_icon,c.m_feature_group_name');
		$this->db->distinct();
		$result['m_feature_group'] = $this->db->get()->result();

		$this->db->from('map_feature a');
		$this->db->join('m_feature b','a.m_feature_id = b.m_feature_id');
		$this->db->join('m_feature_group c','c.m_feature_group_id = b.m_feature_group_id');
		$this->db->where('m_feature_status','Active');
		$this->db->where('m_feature_menu_type','Left menu');
		$this->db->where('m_feature_visible',1);
		$this->db->where('m_user_group_id',$_SESSION['employee_user_group_id']);
		$this->db->order_by('c.m_feature_group_name','asc');
		$this->db->order_by('b.m_feature_squance','asc');
		$this->db->select('b.m_feature_url,b.m_feature_name, b.m_feature_group_id,b.m_feature_icon');
		$this->db->distinct();
		$result['m_feature_left'] = $this->db->get()->result();

		$this->db->from('map_feature a');
		$this->db->join('m_feature b','a.m_feature_id = b.m_feature_id');
		$this->db->join('m_feature_group c','c.m_feature_group_id = b.m_feature_group_id');
		$this->db->where('m_feature_status','Active');
		$this->db->where('m_feature_menu_type','Top menu');
		$this->db->where('m_feature_visible',1);
		$this->db->where('m_user_group_id',$_SESSION['employee_user_group_id']);
		$this->db->order_by('c.m_feature_group_name','asc');
		$this->db->order_by('b.m_feature_squance','asc');
		$this->db->select('b.m_feature_url,b.m_feature_name, b.m_feature_group_id,b.m_feature_icon');
		$this->db->distinct();
		$result['m_feature_top'] = $this->db->get()->result();
        return $result;
    }
}