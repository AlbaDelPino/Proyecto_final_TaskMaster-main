<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/login/index.css">
    <script src="/login/script.js" defer></script>
</head>
<body>
    <div class="form-wrap">
		<div class="tabs">
			<h3 class="signup-tab"><a class="active" href="#login-tab-content">Login</a></h3>
			<h3 class="login-tab"><a href="#signup-tab-content">Sign Up</a></h3>
		</div><!-- .tabs -->

		<div class="tabs-content">
			<div id="login-tab-content" class="active">
				<form class="login-form" action="/login/login.php" method="post">
					<input type="text" class="input" id="usuario" name="usuario" placeholder="Email or Username">
					<input type="password" class="input" id="contra" name="contra" placeholder="Password">
					
					<input type="submit" class="button" value="Login">
				</form><!-- .login-form -->
				<div class="help-text">
					<p>Forget your password?</p>
				</div><!-- .help-text -->
			</div><!-- #login-tab-content -->
			<div id="signup-tab-content" >
				<form class="signup-form" action="login/registrar.php" method="post">
					<input type="text" class="input" name="nombre" autocomplete="off" placeholder="Nombre">
					<input type="text" class="input" name="apellido" autocomplete="off" placeholder="Apellido">
					<input type="email" class="input" name="correo" autocomplete="off" placeholder="Email">
					<label >Ciudad</label>
                    <select  name="ciudad" >
                        <option   selected disabled>Seleccione la ciudad</option>
                        <?php
                        include("login/conexion.php");
                        mysqli_select_db($conn, "practicas");
                        $consultar = "SELECT * FROM ciudad";
                        $sql = mysqli_query($conn, $consultar);
                        if ($sql) {
                            while ($resultado = mysqli_fetch_assoc($sql)) {
                                echo "<option value='" . $resultado['id_ciudad'] . "'>" . $resultado['nombre_ciudad'] . "</option>";
                            }
                        } else {
                            echo "Error en la consulta: " . mysqli_error($conn);
                        }
                        ?>
                    </select>
					<input type="password" class="input" name="contra" autocomplete="off" placeholder="Password">
					<input type="submit" class="button" value="Sign Up">
				</form><!-- .signup-form -->
				<div class="help-text">
					<p>By signing up, you agree to our</p>
					<p><a href="#">Terms of service</a></p>
				</div><!-- .help-text -->
			</div><!-- .signup-tab-content -->
		</div><!-- .tabs-content -->
	</div><!-- .form-wrap -->
</body>
</html>
