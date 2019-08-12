<?php session_start();
if(isset($_SESSION['usuario'])){
	header('Location: index.php');
}

if($_SERVER['REQUEST_METHOD']=='POST'){

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    require('conexion.php');
    $consulta = $con -> prepare('SELECT * FROM CLIENTES WHERE NOMBRE=:usuario AND AVATAR=:clave');
    $consulta -> execute(array(
        ':usuario' => $usuario,
        ':clave' => $clave
    ));
    
    $resultado = $consulta -> fetch();

    if($resultado != false){

    $_SESSION['usuario'] = $usuario;
    header('Location: index.php'); 

    }else{
        echo "<script> alert('Usuario no registrado');</script>";
        header('Location: registro.php');
    }
}
?>