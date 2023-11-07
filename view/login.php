<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">
	<link rel="shortcut icon" href="public/images/utp-logo.png" type="image/x-icon">

	<title>Iniciar Sesión</title>

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

</head>
<body class="body-bg p-5">
	<div class="container mt-3">
		<div class="row justify-content-center">
			<div class="col-md-5 form-container">
				<h2 class="text-center mb-4 mt-3">Iniciar Sesión</h2>
				<div class="image-container w-25 mx-auto">
					<img src="../public/images/user.png" alt="Imagen" class="img-fluid">
				</div>
				
				<div class="container">
				<form method="POST" action="./?op=acceder">	

				<div class="text-center">
				<p class="text-danger">
					<?php if (isset($_GET['msg'])) echo $_GET['msg'];?>
				</p>
				</div>
				
					<div class="form-group pb-3">
						<label for="email">Correo Electrónico</label>
						<input type="email" class="form-control" id="correo" name="correo" autocomplete="username" placeholder="Ingresa tu correo electrónico" required>
					</div>
					<div class="form-group">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
					</div>
					<div class="text-center pt-3"> <!-- Envolvemos el botón en su propia <div> -->
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>

					<div class="mt-4 text-center">
					<p>¿No tienes una cuenta? <a href="?op=crear">Regístrate aquí</a></p>
				</div>

				</form>
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
