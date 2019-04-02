<?php namespace Victorem\Libraries\Fpdf;

use Fpdf;
use Victorem\Libraries\Campaing;

class Report extends Fpdf
{
	public $candidate;
	public $title;
	public $withFooter;

	function init($candidate, $title, $withFooter = true) 
	{
       	$this->candidate = $candidate;
       	$this->title = $title;
       	$this->withFooter = $withFooter;

		$this->AliasNbPages();
		$this->addPage();
	}

	public function getWidth()
	{
		return $this->w - $this->lMargin - $this->rMargin;
	}

	function Header()
	{
	    $this->Image(url('images/reportes.jpg'), 10, 5, 20);
	    $this->SetFont('Arial', 'B', 19);
	    $this->setY(13);
	    $this->Cell(0, 0, utf8_decode($this->candidate), 0, 0, 'C');

	    $this->setY(23);
	    $this->SetFont('Arial', 'B', 17);
	    $this->SetTextColor(21, 75, 179);
	    $this->Cell(0, 0, utf8_decode($this->title), 0, 0, 'C');

	    $this->Image(Campaing::getPoliticalLogo(), $this->getWidth() - 10, 6, 20);
        $this->Line(10, 30, $this->w - $this->lMargin, 30);	

        $this->setY(37);
	}


	function Footer()
	{
		if($this->withFooter)
		{
	    	$this->SetY(-15);
	        $this->SetFont('Arial', 'B', 10);
	        $this->Cell(0, 10, utf8_decode('Fecha de consulta '.date("d-m-Y", time())), 0, 0, 'L');
	    	$this->Cell(0, 10, utf8_decode($this->PageNo().' de {nb}'), 0, 0, 'R');
	    }
	}
}

?>