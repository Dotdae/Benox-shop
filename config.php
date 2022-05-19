<?php 

    session_start();

    if(!(isset($_SESSION['user_id']))){

        header('Location: login.php');

    }

    require 'db.php';

    if(isset($_SESSION['user_id'])){

        $records = $conn->prepare("SELECT id, username, password FROM usuarios WHERE id = :id");
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0){

            $user = $results;

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <link rel="stylesheet" href="./assets/css/config.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
        <div class="container">
            <form action="#">
                <div class="config">
                    <div class="fuente">
                        <h1>Tamaño de la fuente</h1>
                        <select name="fuente" id="fuente">
                            <option value="chica">Chica</option>
                            <option value="mediana">Mediana</option>
                            <option value="grande">Grande</option>
                        </select>
                    </div>
                </div>
                <div class="config">
                    <div class="temas">
                        <h1>Temas</h1>
                        <h4>Color de fondo</h4>
                        <input type="color" id="color_fondo">
                        <h4>Color de letra</h4>
                        <input type="color" id="color_letra">
                        <h4>Fondo del header</h4>
                        <input type="color" id="color_header">
                        <h4>Fondo del footer</h4>
                        <input type="color" id="color_footer">
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit">Guardar configuración</button>
                    <button type="submit">Eliminar configuración</button>
                </div>
            </form>
        </div>
    <?php require 'partials/footer.php' ?>
</body>
</html>