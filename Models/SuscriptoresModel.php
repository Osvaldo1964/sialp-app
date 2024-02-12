<?php 

class SuscriptoresModel extends Mysql{

	public function selectSuscriptores()
	{
		$sql = "SELECT idSuscripcion, nomSuscripcion, emaSuscripcion, DATE_FORMAT(creSuscripcion, '%d/%m/%Y') as creSuscripcion
				FROM suscripciones ORDER BY idSuscripcion DESC";
		$request = $this->select_all($sql);
		return $request;
	}

}
 ?>