
<? 
class Laboratorio {
    private $msg;
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

    public function mostrarLaboratorios(){
        try {
            $query = "SELECT Lab_No FROM laboratorio";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            $this->msg = "Error al mostrar los laboratorios ".$ex; 
        }
    }
}

    
?>