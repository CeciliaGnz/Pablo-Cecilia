<?php

Class Computadoras {
    private $pdo;
    private $msg;
    private $nombreComputadora;
    private $ID;
    private $noLaboratorio;

    private $estado= 'reservado';

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

    // public function agregarComputadora($nombre, $laboratorio, $descripcion) {
    //     $sql = "INSERT INTO Computadoras (LabID, Nombre, Descripcion, Estado)
    //     VALUES (?, ?, ?, 'disponible')";
    //     $parametros = array($nombre, $laboratorio);
    //     $this->pdo->prepare($sql)->execute($parametros);
    // }

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