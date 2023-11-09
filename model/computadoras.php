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
            $this->msg = "exitoso";
       } catch (Exception $ex) {
         $this->msg = "error"; 
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

    public function obtenerTotalEquiposDisponibles() {
        try {
            $sql = "SELECT COUNT(*) as total FROM Computadora WHERE Estado = 'disponible'";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $total = $stmt->fetchColumn();
            return $total;
        } catch (Exception $e) {
            return 0; 
        }
    }

    
    public function eliminarComputadora($pcID) {
        try {
            $sql = "DELETE FROM Computadora WHERE PcID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$pcID]);
            $this->msg = "exitoso";
        } catch (Exception $ex) {
            $this->msg = "error";
        }
        return $this->msg;
    }

    public function editarComputadora($pcID, $nombre, $laboratorio) {
        try {
            $sqlLabID = "SELECT LabID FROM laboratorio WHERE Lab_No = ?";
            $stmtLabID = $this->pdo->prepare($sqlLabID);
            $stmtLabID->execute([$laboratorio]);
            $labID = $stmtLabID->fetchColumn();

            $sql = "UPDATE Computadora SET Lab_No = ?, Nombre = ? WHERE PcID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$labID, $nombre, $pcID]);
            $this->msg = "Computadora editada correctamente";
        } catch (Exception $ex) {
            $this->msg = "Error al editar la computadora";
        }
        return $this->msg;
    }
}
?>