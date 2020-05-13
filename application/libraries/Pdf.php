
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 *  ======================================= 
 *  Author     : Jaeeme Khan 
 *  License    : Protected 
 *  Email      : jaeemekhan@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */
require_once APPPATH . "/third_party/tcpdf/tcpdf.php";
class Pdf extends tcpdf {
    public function __construct() {
        parent::__construct();
    }
	
	
	//Page header
	 
	
	/* public function Footer() {
		// Position at 15 mm from bottom
		$footertext = "hello";
		$this->writeHTMLCell(0, 0, '', '', $footertext, 0, 0, false,true, "L", true);
		$this->SetY(-8);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 5, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	} */
}