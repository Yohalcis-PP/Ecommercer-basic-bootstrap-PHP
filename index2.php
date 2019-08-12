<?php session_start();

	$varsession = $_SESSION['usuario'];
	
	if($varsession == null || $varsession == ''){

		//echo "<script>alert('Espacio reservado para administradores');</script>";
		header('Location: login.php');
		die();
	}


	if($varsession == 'admin'){

		//echo "<script>alert('Espacio reservado para administradores');</script>";
		header('Location: insert.php');
		die();
	}

	
	if($varsession == 'mensajeria'){

		//echo "<script>alert('Espacio reservado para administradores');</script>";
		header('Location: mensajeria.php');
		die();
	}
	
	include_once 'conexion.php';

	$bdusuario = $con -> prepare('SELECT * FROM clientes WHERE nombre=:varsession LIMIT 1');
	$bdusuario -> execute(array(
		':varsession' => $varsession
	));

	$usuario = $bdusuario->fetch(); 

	$select_buscar=$con->prepare('
		SELECT encargos.idEncargo, producto.nombre, clientes.nombre, clientes.telefono, clientes.direccion, encargos.estado FROM encargos, clientes, producto WHERE encargos.idCliente = :varsession AND encargos.idCliente=clientes.nombre AND encargos.idProducto = producto.codigo'
	);
	$select_buscar->execute(array(
		':varsession' =>$usuario[0]
	));
	
	
	$resultado=$select_buscar->fetchAll();

	

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">

		<h2>Propietario de la cuenta: <?php echo $usuario[0]?> con Numero de Telefono: <?php echo $usuario[2]?></h2>
		<h2>Mis Pedidos</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar producto" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="cerrar.php" class="btn btn__danger">Cerrar Sesion</a>
				<a href="index.php" class="btn btn__new">Inicio</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id Pedido</td>
				<td>Nombre Producto</td>
				<td>Nombre Cliente</td>
				<td>Teléfono</td>
				<td>Direccion</td>
				<td colspan="2">Estado</td>
			</tr>
			<?php foreach($resultado as $fila){?>
				<tr >
					<td><?php echo $fila[0]; ?></td>
					<td><?php echo $fila[1]; ?></td>
					<td><?php echo $fila[2]; ?></td>
					<td><?php echo $fila[3]; ?></td>
					<td><?php echo $fila[4]; ?></td>
					<td><?php if($fila[5] == 0){echo "En espera";}else{echo "Entregado";} ?></td>
					
				</tr>
			<?php } ?>

		</table>
	</div>
</body>
</html>