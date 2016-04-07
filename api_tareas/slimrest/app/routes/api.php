<?php
if(!defined("ACTIVO")) die("Acceso denegado");//para que no se pueda acceder directamente

//var_dump($app);

//SERVICIO GET BUSCAR TODAS LAS TAREAS
$app->get("/tareas/", function() use($app)
{
	try{
		$connection = conectar();
		$dbh = $connection->prepare("SELECT * FROM tareas");
		$dbh->execute();
		$tareas = $dbh->fetchAll();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($tareas));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

// SERVICIO GET BUSCAR POR POR ID DE TAREA
$app->get("/tareas/:id_tarea", function($id_tarea) use($app)
{
	try{
		$connection = conectar();
		$dbh = $connection->prepare("SELECT * FROM tareas WHERE id_tarea = ?");
		$dbh->bindParam(1, $id_tarea);
		$dbh->execute();
		$tarea = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($tarea));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

//SERVICIO POST INSERTAR
$app->post("/tareas/:nombre_tarea/:fecha_tarea", function($nombre_tarea,$fecha_tarea) use($app)
{
	try{
		$conexion = conectar();
		$dbh = $conexion->prepare("INSERT INTO tareas (nombre_tarea,fecha_tarea) VALUES(?,?)");
		$dbh->bindParam(1, $nombre_tarea);
		$dbh->bindParam(2, $fecha_tarea);
		$dbh->execute();
		$newID = $conexion->lastInsertId();
		$conexion = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($newID));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}

});


//SERVICIO PUT ACTUALIZAR
/*
$app->put("/tareas/:id_tarea/:nombre_tarea/:fecha_tarea", function($id_tarea,$nombre_tarea,$fecha_tarea) use($app)
{
	try{
		$conexion = conectar();
		$dbh = $conexion->prepare("UPDATE tareas SET nombre_tarea = ?, fecha_tarea = ?, fecha_ult_modific = NOW() WHERE id_tarea = ? ");
		$dbh->bindParam(1, $nombre_tarea);
		$dbh->bindParam(2, $fecha_tarea);
		$dbh->bindParam(3, $id_tarea);
		$dbh->execute();
		$conexion = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("modificado" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});
*/

$app->put("/tareas/:id", function($id) use($app)
{
	//$nombre_tarea = $app->request->put("TAREA");	
    $request = $app->request();
    $body = $request->getBody();
    $input = json_decode($body); 
    $tarea=$input->TAREA;
	//var_dump($input->TAREA);
	//echo json_encode(array("TAREA" => $input->TAREA);
	//echo json_encode($input->TAREA);

	try{
		$conexion = conectar();
		$dbh = $conexion->prepare("UPDATE tareas SET nombre_tarea = ?, fecha_ult_mod = NOW() WHERE id_tarea = ? ");
		$dbh->bindParam(1, $tarea);
		$dbh->bindParam(2, $id);
		$dbh->execute();
		$conexion = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("modificado" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});


//SERVICIO DELETE
$app->delete("/tareas/:id_tarea", function($id_tarea) use($app)
{
	try{
		$conexion = conectar();
		$dbh = $conexion->prepare("DELETE FROM tareas WHERE id_tarea = ?");
		$dbh->bindParam(1, $id_tarea);
		$dbh->execute();
		$conexion = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("eliminado" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

