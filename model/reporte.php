<?php
class Reporte
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Db::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

        public function ObtenerReporteReservas()
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
                    JOIN Usuario u ON r.UsuarioID = u.UsuarioID";
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener el reporte de reservas: " . $e->getMessage();
        }
    }

    public function obtenerTotalReservas() {
        try {
            $sql = "SELECT COUNT(*) as total_reservas FROM Reserva";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_reservas'];
        } catch (Exception $e) {
            return "Error al obtener el total de reservas: " . $e->getMessage();
        }
    }
    

}
