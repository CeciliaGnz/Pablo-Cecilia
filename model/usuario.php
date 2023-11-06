<?php
class Usuario
{
	private $pdo;
	private $msg;
    
    public $Nombre;
    public $Apellido;  
    public $CorreoElectronico;
    public $Contrasena;
    public $TipoUsuario;


	public function __CONSTRUCT()
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


	public function Registrar(usuario $data)
{
    try 
    {
        $sql = "INSERT INTO usuario (Nombre,Apellido,CorreoElectronico,Contrasena,TipoUsuario) 
                VALUES (?, ?, ?, ?)";

        $this->pdo->prepare($sql)
             ->execute(
                array( 
                    $data->Nombre,
                    $data->Apellido, 
                    $data->CorreoElectronico, 
                    $data->Contrasena,
                    $data->TipoUsuario
                )
            );
        echo "Registro exitoso.<br>";
        $this->msg="Su registro se ha guardado exitosamente!&t=text-success";
    } catch (Exception $e) 
    {
        if ($e->errorInfo[1] == 1062) {
            echo "Error: El correo electrónico ya está registrado en el sistema.<br>";
            $this->msg="Correo electrónico ya está registrado en el sistema&t=text-danger";
        } else {
            echo "Error al guardar los datos: " . $e->getMessage() . "<br>";
            $this->msg="Error al guardar los datos&t=text-danger";
        }
    }
    return $this->msg;
}

    public function Consultar(usuario $data)
    {
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE CorreoElectronico = ? AND Contrasena=?");
            $stm->execute(array($data->CorreoElectronico, $data->Contrasena));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) 
        {
            die($e->getMessage());
        }
    }



}