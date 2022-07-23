<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class m_pdf {
    public function __construct(){
		date_default_timezone_set('Asia/Jakarta');
		//$this =   &get_instance();
	}	

    public function page_landscape(){
 		$mpdf = new \Mpdf\Mpdf();
 		$data = $this->header_footer();
		$mpdf->SetHTMLHeader($data['html_header']);
		$mpdf->SetFooter($data['html_footer']);
		$mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            10, // margin_left
            10, // margin right
            20, // margin top
            15, // margin bottom
            3, // margin header
            3); // margin footer
		return $mpdf;  
    }

    public function page_portrait(){
 		$mpdf = new \Mpdf\Mpdf();
 		$data = $this->header_footer();
		$mpdf->SetHTMLHeader($data['html_header']);
		$mpdf->SetFooter($data['html_footer']);
		$mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            10, // margin_left
            10, // margin right
            20, // margin top
            15, // margin bottom
            3, // margin header
            3); // margin footer
		return $mpdf;    
    }

    public function header_footer(){
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
				</tr>
			</table>";

		return $data;   
    }
}
