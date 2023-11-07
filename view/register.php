<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<!--pasar a un css despues-->
<style>
		body {
			font-family: 'Poppins', 'Roboto', sans-serif;
		}

		.body-bg {
			background-color: #3498db;
			height: 100vh;
		}
		.form-container {
			background-color: #ffffff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		}
	</style>

<script>
    function ComprobarClave(){
        clave1 = document.formulario.contrasena.value
        clave2 = document.formulario.contrasena2.value

        if (clave1 != clave2){
        alert("Las dos claves no son iguales...");
        return false;}
    } 

</script>

<body class="body-bg p-3">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                    <h2 class="text-center mb-4 mt-3">Registro de Usuario</h2>
                    </div>

                    <div class="card-body">
                        <form name="formulario" method="POST" action="./?op=registrar" onSubmit="return ComprobarClave()">
                            
                        <div class="text-center pt-4">
                        <p class="<?php if (isset ($_GET['msg'])) echo $_GET['t'];?>"> <?php if (isset ($_GET['msg'])) echo $_GET['msg'];?> </p>
                        </div>

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="contrasena2" name="contrasena2" required>
                            </div>

                            <div class="text-center pt-3"> <!-- Envolvemos el botón en su propia <div> -->
                                <button type="submit" class="btn btn-primary" onClick="comprobarClave()" >Registrarse</button>
                            </div>

                            <div class="mt-3 text-center">
                                <p>Ya tienes una cuenta? <a href="?op=acceder">Iniciar sesión</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>

         <!-- Footer con Bootstrap -->
		 <footer class="bg text-white text-center p-5">
        <div class="container">
            <p>Integrantes: Pablo Delgado 8-992-2046, Cecilia González 8-990-1469. ILS132</p>
        </div>
    </footer>
    </div>
</body>
</html>
