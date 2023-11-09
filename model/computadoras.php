<?php

Class Computadoras {
    private $pdo;
    private $msg;
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

    public function agregarComputadora($nombre, $laboratorio) {
       try {
            $sqlLabID = "SELECT LabID FROM laboratorio WHERE Lab_No = ?";
            $stmtLabID = $this->pdo->prepare($sqlLabID);
            $stmtLabID->execute([$laboratorio]);
            $labID = $stmtLabID->fetchColumn();
            $sql = "INSERT INTO computadora (LabID, Nombre, Estado)
            VALUES (?, ?, 'disponible')";
            $parametros = array($labID, $nombre);
            $this->pdo->prepare($sql)->execute($parametros);
            $this->msg = $nombre." Computadora Agregada";
            $this->msg= $nombre." ha sido agregada!";
       } catch (Exception $ex) {
         $msg = "No se pudo agregar la computadora"; 
       }
       return $this->msg;
    }

    public function ObtenerEquiposDisponibles() {
        $pdo = Db::StartUp();
        $sql = "SELECT PcID, Nombre FROM Computadora WHERE Estado = 'disponible'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function mostrarComputadoras() {
        try {
            $query = "SELECT c.PcID, c.Nombre, c.Estado, l.Lab_No
            FROM Computadora c JOIN Laboratorio l ON c.LabID = l.LabID";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return $this->msg = "Error al cargar los datos"." ".$e; 
        }
    } 
}
?>