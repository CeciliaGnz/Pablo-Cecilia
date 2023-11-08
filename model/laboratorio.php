
<? 
class Laboratorio {

    public function obtenerLaboratorios() {
        $db = Db::StartUp();
        $query = "SELECT LabID, Lab_No  FROM laboratorio";
        $stmt = $db->query($query);
        $laboratorios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $laboratorios;
    }

}
    
?>