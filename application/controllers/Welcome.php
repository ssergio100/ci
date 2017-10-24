<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        $data = [];
        //load the view and saved it into $html variable
        $data['data'] = 'Sergio';
        $html = $this->load->view('welcome_message', $data, true);

        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";

        $this->m_pdf->pdf->AddPage('L');
       //generate the PDF from the given html
   

        $this->m_pdf->pdf->WriteHTML($html);


        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
