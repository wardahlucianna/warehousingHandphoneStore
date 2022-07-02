<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class m_pdf {
    public function __construct(){
		date_default_timezone_set('Asia/Jakarta');
		//$this =   &get_instance();
	}	

    public function page_landscape(){
 		include_once APPPATH.'/third_party/mpdf/mpdf.php';

 		$data = $this->header_footer();
		$mpdf = new mPDF('utf-8', 'A4-L', '', '', 10,10,25,15,3,3);
		$mpdf->SetHTMLHeader($data['html_header']);
		$mpdf->SetFooter($data['html_footer']);
		return $mpdf;   
    }

    public function page_portrait(){
 		include_once APPPATH.'/third_party/mpdf/mpdf.php';
		$data = $this->header_footer();
		$mpdf = new mPDF('utf-8', 'A4-P', '', '', 10,10,20,15,3,3);
		$mpdf->SetHTMLHeader($data['html_header']);
		$mpdf->SetFooter($data['html_footer']);
		return $mpdf;   
    }

    public function header_footer(){
    	$CI =   &get_instance();
		$CI->db->from('m_company');
		$CI->db->where('m_company_status','Active');
		$data = $CI->db->get()->result();

		foreach ($data as $row){
			$m_company_id 		= $row->m_company_id;
			$name 		= $row->m_company_name;
			$address 	= $row->m_company_address;
			$phone1 	= $row->m_company_phone1;
			$phone2 	= $row->m_company_phone2;
			$phone 		= "";
			$fax 		= "";

			$CI->db->from('map_contact a');
			$CI->db->join('m_contact_type b', 'a.m_contact_type_id=b.m_contact_type_id');
			$CI->db->join('m_contact c', 'c.m_contact_id=a.m_contact_id');
			$CI->db->where('c.m_contact_type_ref','Company');
			$CI->db->where('c.m_contact_ref',$m_company_id);
			$data_contact = $CI->db->get()->result();
			
			foreach ($data_contact as $row1){
				if($row1->m_contact_type_name=="Fax"){
					if($phone!=""){
						$fax .= ", ";
					}
					else{
						$fax .= "Fax. ";	
					}

					$fax .= $row1->map_contact_note;
				}
				else if($row1->m_contact_type_name=="Telepon" || $row1->m_contact_type_name=="Handphone"){
					if($phone!=""){
						$phone .= ", ";
					}
					else{
						$phone .= "Phone ";	
					}
					$phone .= $row1->map_contact_note;
				}
			}
		}

		$data['html_footer']="
			<table width='100%' style='font-size:12px'>
				<tr>
					<td width='30%' style='border-color:white'>".date('d M Y')."</td>
					<td width='40%' align='center' style='border-color:white'></td>
					<td width='30%' style='text-align: right;border-color:white'>Page {PAGENO}</td>
				</tr>
			</table>";

		$data['html_header']="
			<table width='100%' style='font-size:12px'>
				<tr>
					<td width='40%' style='border-color:white'><img src='". base_url().'assets/images/logo_dark.png'."' style='height:50px'> </td>
					<td width='25%' align='center' style='border-color:white'></td>
					<td width='35%' style='border-color:white;padding-left:100px'>
						<p style='text-align:left'><b>".$name."</b><br>
						".nl2br($address)." <br>
						".$phone." <br>
						".$fax." <br>
						</p>
					</td>
				</tr>
			</table>";

		return $data;   
    }
}
