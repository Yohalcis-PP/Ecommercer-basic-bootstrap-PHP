<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['registrar'])){
		$nombre=$_POST['nombre'];
		$avatar=$_POST['avatar'];
		$telefono=(int)$_POST['telefono'];
		$direccion=$_POST['direccion'];
		$email=$_POST['email'];

		if(!empty($nombre) && !empty($avatar) && !empty($telefono) && !empty($direccion) && !empty($email) ){
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO clientes(nombre,avatar,telefono,email,direccion) VALUES(:nombre,:avatar,:telefono,:email,:direccion)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':avatar' =>$avatar,
					':telefono' =>$telefono,
					':direccion' =>$direccion,
					':email' =>$email
				));
				echo "<script> alert('Bienvendo, ahora formas parte de nuestra familia');</script>";
				header('Location: login.php');
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
	<title>Registro</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>Bienvenido, tal parece que no tienes una cuenta</h2>
		<h2>Puedes llenar el siguiente formulario para registrarte o pulsar en login para volver a intentarlo.</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Avatar" class="input__text">
				<input type="text" name="avatar" placeholder="Claver" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Teléfono" class="input__text">
				<input type="text" name="direccion" placeholder="Direccion" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="email" placeholder="Correo electrónico" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Inicio</a>
                <a href="login.php" class="btn btn__danger">Login</a>
				<input type="submit" name="registrar" value="Registrar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>