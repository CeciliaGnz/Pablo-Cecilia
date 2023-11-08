<?php

Class Computadoras {
    private $pdo;

    public function __construct() {
        try
		{
			$this->pdo = Db::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
    }

    public function agregarComputadora($nombre, $laboratorio, $descripcion) {
        $sql = "INSERT INTO Computadoras (LabID, Nombre, Descripcion, Estado)
        VALUES (?, ?, ?, 'disponible')";
        $parametros = array($nombre, $laboratorio);
        $this->pdo->prepare($sql)->execute($parametros);
    }

    public function obtenerComputadoras() {
        try {
            // Consulta SQL para obtener todas las computadoras
            $query = "SELECT id, nombre, laboratorio FROM computadoras";
            $stmt = $this->pdo->prepare($query);

            $computadoras = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $computadoras;
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos aquí
            return array(); // Devuelve un array vacío si hay un error
        }
    }
    

   
}
?>