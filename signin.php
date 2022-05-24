<?php 

    require './include/db.php';


    if(isset($_SESSION['user_id'])){

        header('Location: index.php');

    }

    $message = '';

    if(!empty($_POST['nombre']) && !empty($_POST['edad']) && !empty($_POST['correo']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])){
        
        $sql = "INSERT INTO usuarios(nombre, edad, correo, username, password) VALUES (:nombre, :edad, :correo, :username, :password)";

        $stmt = $conn -> prepare($sql);

        $stmt -> bindParam(':nombre', $_POST['nombre']);
        $stmt -> bindParam(':edad', $_POST['edad']);
        $stmt -> bindParam(':correo', $_POST['correo']);
        $stmt -> bindParam(':username', $_POST['username']);

        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

        $stmt -> bindParam(':password', $password);

        if($stmt -> execute()){

            $message = '¡Registro exitoso!';

        }
        else{

            $message = 'Ha ocurrido un error al registrar el usuario';

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="./assets/css/signin.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
    <div class="container">
        <div class="title">Registrarse</div>
        <?php if(!empty($message)): ?>
            <p class="register-message"><?= $message ?></p>
        <?php endif; ?>
        <form action="signin.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="name-error" id="name-error"></span>
                    <span class="details">Nombre completo</span>
                    <input type="text" placeholder="Ingresar nombre" required id="nombreCompleto" name="nombre">
                </div>
                <div class="input-box">
                    <span class="edad-error" id="edad-error"></span>
                    <span class="details">Edad</span>
                    <input type="number" placeholder="Ingresar edad" required id="edad" name="edad">
                </div>
                <div class="input-box">
                    <span class="email-error" id="email-error"></span>
                    <span class="details">Correo electrónico</span>
                    <input type="email" placeholder="Ingresar correo electrónico" required id="correoElectronico" name="correo">
                </div>
                <div class="input-box">
                    <span class="username-error" id="username-error"></span>
                    <span class="details">Nombre de usuario</span>
                    <input type="text" placeholder="Ingresar nombre de usuario" required id="username" name="username">
                </div>
                <div class="input-box">
                    <span class="password-error" id="password-error"></span>
                    <span class="details">Contraseña</span>
                    <input type="password" placeholder="Ingresar contraseña" required id="password" name="password">
                </div>
                <div class="input-box">
                    <span class="confirm-error" id="confirm-error"></span>
                    <span class="details">Confirmar contraseña</span>
                    <input type="password" placeholder="Confirmar contraseña" required id="confirmPassword" name="confirmPassword">
                </div>
            </div>
            <div class="button">
                <input type="submit" onclick="validadDatos()" id="submit" value="Enviar">
                <input type="reset" value="Cancelar">
            </div>
        </form>
    </div>
    <?php require 'partials/footer.php' ?>
    <script src="./assets/js/app.js"></script>
</body>
</html>