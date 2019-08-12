<?php session_start();
include_once'conexion.php';

$cod = $_REQUEST['cod'];
$varsession = $_SESSION['usuario'];

$resultado = $con -> prepare('INSERT INTO encargos(idCliente, idProducto, estado ) VALUES (:varsession, :cod, 0 )'); 
$resultado -> execute(array(
    ':varsession' =>$varsession,
    ':cod' => $cod

));

echo "<script> alert('Compra exitosa');</script>";

header('Location: index2.php');

?>