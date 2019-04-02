<?php namespace Victorem\Libraries\Fpdf;

class PDF_MC_Table extends Report {

	private $widths = [];
	private $aligns = [];

	private $numberCells;
	public static $sizeNumeration = 8;

	private function getWidthTable()
	{
		return $this->getWidth() - self::$sizeNumeration;
	}

	public function getSizeCell($percentage = null)
	{
		if($percentage)
		{
			return $this->getWidthTable() * $percentage / 100;
		}

		return $this->getWidthTable() / $this->numberCells;
	}

	public function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	public function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	public function setWidthsWithPercentages($percentages)
	{
		$this->widths = [];
		array_push($this->widths, self::$sizeNumeration);
		
		foreach ($percentages as $p) {
	    	array_push($this->widths, $this->getSizeCell($p));
	    }
	}

	function Row($data)
	{		
		//Calculate the height of the row
		$nb=0;
		foreach ($data as $key => $text) 
		{
			$nb=max($nb,$this->NbLines($this->widths[$key],$text));
		}

		$h=5*$nb;

		//Issue a page break first if needed
		//$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,utf8_decode(' ' . $data[$i]),0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	/*function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}*/

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}
