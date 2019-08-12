<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$consulta_update=$con->prepare(' UPDATE encargos SET estado = 1 WHERE idEncargo=:id;');
		$consulta_update->execute(array(':id' =>$id));
        header('Location: mensajeria.php');
	}

?>