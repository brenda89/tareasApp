<?php if(!defined("ACTIVO")) die("Acceso denegado");

function conectar()
{
	try{
		$db_username = "root";
		$db_password = "";
		$connection = new PDO("mysql:host=localhost;dbname=bd_tareas", $db_username, $db_password);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
	return $connection;
}