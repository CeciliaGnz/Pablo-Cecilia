<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../public/bootstrap/css/bootstrap.min.css">

	<title>Iniciar Sesión</title>
	<style>
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
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6 form-container">
				<h2 class="text-center mb-3">Iniciar Sesión</h2>
				<div class="image-container w-25 mx-auto">
					<img src="../public/images/user.png" alt="Imagen" class="img-fluid">
				</div>

				<form>
					<div class="form-group">
						<label for="email">Correo Electrónico</label>
						<input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico" required>
					</div>
					<div class="form-group">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>
					</div>
					<div class="text-center"> <!-- Envolvemos el botón en su propia <div> -->
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
				</form>

				<div class="mt-3 text-center">
					<p>¿No tienes una cuenta? <a href="?=register">Regístrate aquí</a></p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
