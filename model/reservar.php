<?php
class Reservar
{
    private $pdo;

    public function __construct()
    {
        try
        {
            $this->pdo = Db::StartUp();
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function RealizarReserva($equipo, $desde, $hasta, $descripcion, $usuarioID)
    {
        try {
            $sql = "INSERT INTO Reserva (UsuarioID, PcID, FechaReserva, HoraInicio, HoraFinalizacion, Descripcion) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $pcID = $equipo;
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$usuarioID, $pcID, $desde, $desde, $hasta, $descripcion]);
        
                return "Reserva exitosa.";
            } catch (Exception $e) {
                return "Error al realizar la reserva: " . $e->getMessage();
            }
    }
    


}
