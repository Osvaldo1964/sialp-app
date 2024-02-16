<?php 

class ContactosModel extends Mysql{

	public function selectContactos()
	{
		$sql = "SELECT idContacto, nomContacto, emaContacto, DATE_FORMAT(creContacto, '%d/%m/%Y') as creContacto
				FROM contacto ORDER BY idContacto DESC";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectMensaje(int $idmensaje){
		$sql = "SELECT idContacto, nomContacto, emaContacto, DATE_FORMAT(creContacto, '%d/%m/%Y') as creContacto, msgContacto
				FROM contacto WHERE idContacto = {$idmensaje}";
		$request = $this->select($sql);
		return $request;
	}

}
 ?>