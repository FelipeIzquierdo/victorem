<?php namespace Victorem\Libraries\Fpdf;

use Victorem\Entities\User;

class ReportTable extends PDF_MC_Table
{
	public static $plans = array(10, 20, 30, 50, 70, 100, 120, 150, 170, 200, 300, 400, 500, 600);
	private $fontCells;
	private $fontTitles;
	private $heightCells;

	public function init($candidate, $title, $fontCells = 8, $withFooter = true, $heightCells = 8, $fontTitles = 11) 
	{
       	$this->candidate 	= $candidate;
       	$this->title 		= $title;

       	$this->withFooter	= $withFooter;
       	$this->heightCells 	= $heightCells;
       	$this->fontTitles 	= $fontTitles;
       	$this->fontCells 	= $fontCells;

		$this->AliasNbPages();
		$this->addPage();
	}

	public static function findPlan($number)
	{
		foreach (self::$plans as $key => $plan) 
		{
			if($number < $plan)
			{
				return $plan;
			}
		}
	}


	private function resetFontCells()
	{
		$this->SetLineWidth(.3);
	    $this->SetFont('Arial', '', $this->fontCells);
	    $this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0);
	}

	private function printHeaderTable($titles, $percentages)
	{
		$this->numberCells = count($titles);
		$this->SetFont('Arial', 'B', $this->fontTitles);
		$this->SetFillColor(255, 255, 255);
		$this->SetTextColor(0, 0, 0);
		$this->printHeaderCell(self::$sizeNumeration, 'No');

		foreach ($titles as $key => $title) {
			$this->printHeaderCell($this->getSizeCell($percentages[$key]), $title);
		}


		$this->resetFontCells();
	    $this->Ln();
    }

    private function printHeaderCell($size, $title)
    {
    	$this->Cell($size, $this->heightCells + 1, utf8_decode($title), 1, 0, 'C', true);
    }

    private function printCell($size, $text, $align = 'L')
    {
    	$this->Cell($size, $this->heightCells, utf8_decode(' ' . $text), 1, 0, $align, false);
    }

    private function printNumeration($number)
    {
    	$this->Cell(self::$sizeNumeration, $this->heightCells, utf8_decode($number), 1, 0, 'C', false);
    }

	private function printTableModels($models, $titles, $cells, $percentages, $aligns = null)
	{
		if(!is_null($aligns))
		{
			array_unshift($aligns, 'C');
			$this->SetAligns($aligns);
		}

		$this->setWidthsWithPercentages($percentages);
		$this->printHeaderTable($titles, $percentages);
	    $count = 1;
	    
	    foreach ($models as $model) 
	    {
    		$data = [];
			array_push($data, $count++);

			foreach ($cells as $key => $text) {
				array_push($data, $model->getAttribute($text));
			}

			$this->Row($data);
			if($this->getY() >= 186)
    		{
    			$this->addPage();
    			$this->printHeaderTable($titles, $percentages);
    		}	
		}

		return $count;
	}

	private function printTableModelsArray($models, $titles, $cells, $percentages, $aligns = null)
	{
		if(!is_null($aligns))
		{
			array_unshift($aligns, 'C');
			$this->SetAligns($aligns);
		}

		$this->setWidthsWithPercentages($percentages);
		$this->printHeaderTable($titles, $percentages);
	    $count = 1;
	    
	    foreach ($models as $model) 
	    {
    		$data = [];
			array_push($data, $count++);

			foreach ($cells as $key => $text) {
				array_push($data, $model[$text]);
			}

			$this->Row($data);
			if($this->getY() >= 186)
    		{
    			$this->addPage();
    			$this->printHeaderTable($titles, $percentages);
    		}	
		}

		return $count;
	}

	private function printTableBlank($titles, $percentages, $numberRows = 20)
	{
		$this->printHeaderTable($titles, $percentages);
	    
	    $count = 1;

	    for($row=1; $row <= $numberRows; $row++) 
	    {	
	    	if($this->getY() >= 190)
    		{
    			$this->addPage();
    			$this->printHeaderTable($titles, $percentages);
    		}

			$this->printNumeration($count++);

			foreach ($titles as $key => $title) {
				$this->printCell($this->getSizeCell($percentages[$key]), '');
			}

			$this->Ln();
		}
	}

	public function blank()
	{
		$percentages = [10, 25, 15, 20, 22, 8];
		$titles = ['Cédula', 'Nombre', 'Teléfono', 'Dirección', 'Email', 'Cumpleaños'];

		$this->printTableBlank($titles, $percentages, 25);
	}

	public function users($users)
	{
		$percentages = [15, 20, 21, 15, 15, 7, 7];
		$titles = ['Usuario', 'Nombre', 'Email', 'Tipo de usuario', 'Fecha de creación', 'Votantes', 'Llamadas'];
		$cells = ['username', 'name', 'email', 'type_name', 'created_at', 'count_voters', 'count_polls'];

		$this->printTableModels($users, $titles, $cells, $percentages);
	}

	public function voterPolls($poll, $voterPolls)
	{
		$this->SetFont('Arial', 'B', 13);
		$this->Cell(30, 9, utf8_decode('Preguntas:'), 0, 1, 'L', false);

		$this->SetFont('Arial', '', 10);
		foreach ($poll->questions as $count => $question) {
			$this->MultiCell($this->getWidth(), 7, utf8_decode($count + 1 . '. ' . $question->text), 0, 'L', false);
		}

		$this->Ln();

		$this->fontCells = 9;
		$percentages = [26, 27, 24, 6, 8, 10];
		$titles = ['Votante', 'Respuestas', 'Observación', 'Celular', 'Usuario', 'Fecha'];
		$cells = ['voter_name_with_roles_and_communities', 'report_answers', 'description', 'voter_telephone', 'user_username', 'created_at'];

		$this->printTableModels($voterPolls, $titles, $cells, $percentages);
	}

	public function voters($voters)
	{
		$this->fontCells = 9;
		$percentages = [7, 15, 7, 12, 18, 18, 18, 5];
		$aligns = ['C', 'L', 'C', 'L', 'L', 'L', 'L', 'C'];
		$titles = ['Cédula', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Observación', 'Puesto de Votación', 'Mesa'];
		$cells = ['doc', 'name', 'tel_ten_numbers', 'location_name',  'address', 'description', 'polling_station_name', 'table_number'];

		$this->printTableModels($voters, $titles, $cells, $percentages, $aligns);
	}

	public function votersPollingStation($voters)
	{
		$this->fontCells = 10;
		$percentages = [25, 8, 19, 8, 15, 18, 3, 4];
		$aligns = ['L', 'C', 'L', 'C', 'L', 'L', 'C', 'C'];
		$titles = ['Referido', 'Cédula', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Ref', 'Mesa'];
		$cells = ['superior_name_with_roles', 'doc', 'name', 'tel_ten_numbers', 'location_name',  'address', 'number_voters', 'table_number'];

		$this->printTableModels($voters, $titles, $cells, $percentages, $aligns);
	}

	public function locations($locations)
	{
		$this->fontCells = 11;
		$percentages = [30,7];
		$aligns = ['L', 'C'];
		$titles = ['Nombre', 'Votantes'];
		$cells = ['name', 'number_voters'];

		$this->printTableModelsArray($locations, $titles, $cells, $percentages, $aligns);
	}

	public function votersWithSuperior($voters)
	{
		$this->fontCells = 9;
		$percentages = [7, 15, 15, 7, 12, 18, 18, 5];
		$aligns = ['C', 'L', 'L', 'C', 'L', 'L', 'L', 'C'];
		$titles = ['Cédula', 'Referido por', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Puesto de Votación', 'CP'];
		$cells = ['doc', 'superior_name', 'name', 'tel_ten_numbers', 'location_name',  'address', 'polling_station_name', 'birth_day_month'];

		$this->printTableModels($voters, $titles, $cells, $percentages, $aligns);
	}

	public function team($team)
	{
		$this->fontCells = 9;

		$percentages = [7, 15, 7, 12, 17, 17, 17, 5, 3];
		$aligns = ['C', 'L', 'C', 'L', 'L', 'L', 'L', 'C', 'C'];
		$titles = ['Cédula', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Email', 'Puesto de Votación', 'CP', 'Ref'];
		$cells = ['doc', 'name', 'tel_ten_numbers', 'location_name',  'address', 'email', 'polling_station_name', 'birth_day_month', 'number_voters'];

		$this->printTableModels($team, $titles, $cells, $percentages, $aligns);
	}

	public function recursiveTeam($team)
	{
		$percentages = [7, 20, 7, 22, 22, 19, 3];
		$aligns = ['C', 'L', 'C', 'L', 'L', 'L', 'C'];
		$titles = ['Cédula', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Puesto de votación', 'Ref.'];
		$cells = ['doc', 'name', 'telephone', 'location_name', 'address', 'polling_station_name', 'number_voters'];

		$this->printTableModels($team, $titles, $cells, $percentages, $aligns);
	}	

	public function teamOfRoles($team)
	{
		$percentages = [23, 6, 17, 6, 10, 20, 15, 3];
		$titles = ['Referido', 'Cédula', 'Nombre', 'Celular', 'Ubicación', 'Dirección', 'Puesto de votación', 'Ref.'];
		$cells = ['superior_name_with_roles', 'doc', 'name', 'telephone', 'location_name', 'address', 'polling_station_name', 'number_voters'];

		$this->printTableModels($team, $titles, $cells, $percentages);
	}	

	public function planblank($numberPlan = 10)
	{
		$percentages = [15, 35, 15, 35];
		$titles = ['Cédula', 'Nombre', 'Teléfono', 'Dirección (Barrio)'];

		$this->SetFont('Arial', 'B', 12);
		$this->Cell(50, 10, utf8_decode('Coordinador'), 0, 1, 'L', false);

		$this->SetFont('Arial', '', 11);
		$this->Cell(17, 8, utf8_decode('Cedula:'), 0, 0, 'L', false);
		$this->Cell(46, 8, utf8_decode('____________________'), 0, 0, 'L', false);
		$this->Cell(17, 8, utf8_decode('Nombre:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode('__________________________________'), 0, 0, 'L', false);
		$this->Cell(19, 8, utf8_decode('Dirección:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode('__________________________________'), 0, 1, 'L', false);
		$this->Cell(17, 8, utf8_decode('Telefono:'), 0, 0, 'L', false);
		$this->Cell(46, 8, utf8_decode('____________________'), 0, 0, 'L', false);
		$this->Cell(17, 8, utf8_decode('Correo:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode('__________________________________'), 0, 0, 'L', false);

		$this->Ln(15);

		$this->printTableBlank($titles, $percentages, $numberPlan);
	}

	public function PlanTeam($colaborator, $plan)
	{
		$percentages = [10, 30, 10, 30, 20];
		$titles = ['Cédula', 'Nombre', 'Teléfono', 'Dirección (Barrio)', 'Puesto de Votación'];
		$cells  = ['doc', 'name', 'telephone', 'address', 'polling_station_name'];

		$this->SetFont('Arial', 'B', 12);
		$this->Cell(50, 10, utf8_decode('Coordinador'), 0, 1, 'L', false);

		$this->SetFont('Arial', '', 11);
		$this->Cell(17, 8, utf8_decode('Cedula:'), 0, 0, 'L', false);
		$this->Cell(46, 8, utf8_decode($colaborator->doc), 0, 0, 'L', false);
		$this->Cell(17, 8, utf8_decode('Nombre:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode($colaborator->name), 0, 0, 'L', false);
		$this->Cell(19, 8, utf8_decode('Dirección:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode($colaborator->address), 0, 1, 'L', false);
		$this->Cell(17, 8, utf8_decode('Telefono:'), 0, 0, 'L', false);
		$this->Cell(46, 8, utf8_decode($colaborator->telephone), 0, 0, 'L', false);
		$this->Cell(17, 8, utf8_decode('Correo:'), 0, 0, 'L', false);
		$this->Cell(75, 8, utf8_decode($colaborator->email), 0, 0, 'L', false);

		$this->Ln(15);

		$count = $this->printTableModels($colaborator->voters, $titles, $cells, $percentages);

		for($count = $count; $count <= $plan; $count++) 
	    {	
	    	if($this->getY() >= 190)
    		{
    			$this->addPage();
    			$this->printHeaderTable($titles, $percentages);
    		}

			$this->printNumeration($count);

			foreach ($titles as $key => $title) {
				$this->printCell($this->getSizeCell($percentages[$key]), '');
			}

			$this->Ln();
		}
	}
}

?>