<?php session_start();

	include_once 'conexion.php';

	$varsession = $_SESSION['usuario'];

	if($varsession == null || $varsession == '' || $varsession != 'admin'){

		//echo "<script>alert('Espacio reservado para administradores');</script>";
		header('Location: index.php');
		die();
	}
	
	
	$resultado=$con->query('
		SELECT encargos.idEncargo, producto.nombre, clientes.nombre, clientes.telefono, clientes.direccion, encargos.estado FROM encargos, clientes, producto WHERE encargos.idCliente=clientes.nombre AND encargos.idProducto = producto.codigo'
	);
	

	

	
	if(isset($_POST['guardar'])){
		$nombre_producto=$_POST['nombre_producto'];
		$codigo_producto=$_POST['codigo_producto'];
		$descripcion=$_POST['descripcion'];
		$categoria=$_POST['categoria'];
        $precio=$_POST['precio'];
        

		if(!empty($nombre_producto) && !empty($codigo_producto) && !empty($descripcion) && !empty($precio) ){
			if($categoria !='Sistema Respiratorio' && $categoria != 'Sistema Digestivo' && $categoria != 'Sistema Nervioso'){
				echo "<script> alert('Categoría invalida');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO producto(nombre,codigo,descripcion,categoria,precio) VALUES(:nombre_producto,:codigo_producto,:descripcion,:categoria,:precio)');
				$consulta_insert->execute(array(
					':nombre_producto' =>$nombre_producto,
					':codigo_producto' =>$codigo_producto,
					':descripcion' =>$descripcion,
					':categoria' =>$categoria,
					':precio' =>$precio
				));
                echo "<script> alert('Producto Guardado');</script>";
				//header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Agregar Producto</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>BIENVENIDO ADMINISTRADOR, AQUÍ PUEDES AGREGAR PRODUCTOS</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre_producto" placeholder="Nombre de Producto" class="input__text">
				<input type="text" name="codigo_producto" placeholder="Codigo de Producto" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="descripcion" placeholder="Descripción Corta" class="input__text">
				<input type="text" name="categoria" placeholder="Categoría" class="input__text">
                <input type="text" name="precio" placeholder="Precio" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Inicio</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>

	<div class="contenedor">


<h2>Todos los Pedidos</h2>
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
			<td><?php if($fila[5] == 0){echo "**En espera";}else{echo "Entregado";} ?></td>
			
		</tr>
	<?php } ?>

</table>
</div>
	



</body>
</html>
