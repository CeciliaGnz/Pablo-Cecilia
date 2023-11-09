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
    
    public function ObtenerMisReservas($usuarioID)
    {
        try {
            $sql = "SELECT r.ReservaID AS id_reserva, 
                        c.Nombre AS nombre_equipo, 
                        l.Lab_No AS no_laboratorio, 
                        CONCAT(u.Nombre, ' ', u.Apellido) AS reservado_por, 
                        DATE_FORMAT(r.FechaReserva, '%Y-%m-%d') AS fecha_reserva, 
                        TIME_FORMAT(r.HoraInicio, '%H:%i') AS hora_inicial, 
                        TIME_FORMAT(r.HoraFinalizacion, '%H:%i') AS hora_final,
                        r.Descripcion AS descripcion
                    FROM Reserva r
                    JOIN Computadora c ON r.PcID = c.PcID
                    JOIN Laboratorio l ON c.LabID = l.LabID
                    JOIN Usuario u ON r.UsuarioID = u.UsuarioID
                    WHERE r.UsuarioID = ?";
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$usuarioID]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener las reservas del usuario: " . $e->getMessage();
        }
    }

    public function eliminarReserva($reservaID) {
        try {
            $sql = "DELETE FROM Reserva WHERE ReservaID = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$reservaID]);
            $this->msg = "Reserva eliminada correctamente";
        } catch (Exception $ex) {
            $this->msg = "Error al eliminar la reserva";
        }
        return $this->msg;
    }
    

}
