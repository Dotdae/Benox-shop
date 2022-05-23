<?php

session_start();

require 'db.php';

if (isset($_SESSION['user_id'])) {

    $records = $conn->prepare("SELECT id, username, password FROM usuarios WHERE id = :id");
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();

    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {

        $user = $results;
        if ($results['id'] != 1) {

            header('Location: index.php');
        }
    }
} else {

    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="./assets/css/admin.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
    <div class="container">
        <div class="card">
            <form action="">
                <div class="form-group">
                    <h4>Imagen del producto</h4>
                    <input type="file" name="titulo" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <h4>Titulo</h4>
                    <input type="text" name="titulo" class="form-control" placeholder="Título" autofocus>
                </div>
                <div class="form-group">
                    <h4>Descripcion</h4>
                    <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" autofocus>
                </div>
                <div class="form-group">
                    <h4>Precio</h4>
                    <input type="text" name="precio" class="form-control" placeholder="Precio" autofocus>
                </div>
                <div class="form-group">
                    <h4>Status</h4>
                    <input type="text" name="status" class="form-control" placeholder="Status" autofocus>
                </div>
                <input type="submit" value="Guardar información" name="guardarInformacion" class="save-info">
            </form>
        </div>
    </div>
    <?php require 'partials/footer.php' ?>
</body>
</html>