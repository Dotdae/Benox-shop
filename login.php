<?php  
    
    require './include/db.php';

    if(isset($_SESSION['user_id'])){

        header('Location: index.php');

    }


    if(!empty($_POST["username"]) && !empty($_POST["password"])){

        $records = $conn -> prepare("SELECT id, username, password FROM usuarios WHERE username = :username");

        $records -> bindParam(":username", $_POST['username']);

        $records -> execute();

        $results = $records -> fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){

            $_SESSION['user_id'] = $results['id'];

            header('Location: index.php');

        }
        else{

            $message = 'Usuario no encontrado';

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="./assets/css/login.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <?php if(!empty($message)): ?>
            <p class="register-message"><?= $message ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="text_field">
                <input type="text" required name="username">
                <span></span>
                <label>Nombre de usuario</label>
            </div>
            <div class="text_field">
                <input type="password" required name="password">
                <span></span>
                <label>Contraseña</label>
            </div>
            <input type="submit" value="Iniciar sesión">
            <input type="reset" value="Reiniciar formulario">
            <div class="sign-up">
                ¿Aún no tienes una cuenta?
                <a href="signin.php">Registrarse</a>
            </div>
        </form>
    </div>
    <?php require 'partials/footer.php' ?>
</body>
</html>