<?php

    require './include/db.php';
    require './include/session_control.php';

    checkAdmSession();

    // Check user data.

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

    // Get from DB data.

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $stmt =  $conn -> prepare("SELECT * FROM articulos WHERE id = $id");

        $stmt -> execute();

        $results = $stmt -> fetch(PDO::FETCH_ASSOC);


        if(count($results) > 0){

            $titulo = $results['titulo'];
            $desc = $results['descripcion'];
            $precio = $results['precio'];
            $stock = $results['stock'];
            $status = $results['status'];

        }


    }

    // Update DB data.

    if(isset($_POST['actualizarInformacion'])){

        $id = $_GET['id'];
        $titulo = $_POST['titulo'];
        $desc = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $status = $_POST['status'];


        $stmt = $conn -> prepare("UPDATE articulos SET titulo = '$titulo', descripcion = '$desc', precio = '$precio', status = '$status', stock = '$stock' WHERE id = '$id'");

        $stmt -> execute();


        $_SESSION['mensaje'] = '¡Artículo actualizado!';
        $_SESSION['type'] = 'alert';

        header('Location: admin.php');


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Artículo</title>
    <link rel="stylesheet" href="./assets/css/edit.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php'?>
</head>
<body>
    <?php require 'partials/nav.php'?>
    <div class="container">
        <div class="card">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                    <div class="form-group">
                        <h4>Titulo</h4>
                        <input type="text" name="titulo" class="form-control" placeholder="Título" autofocus required value="<?php echo $titulo; ?>">
                    </div>
                    <div class="form-group">
                        <h4>Descripcion</h4>
                        <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" autofocus required value="<?php echo $desc; ?>">
                    </div>
                    <div class="form-group">
                        <h4>Precio</h4>
                        <input type="number" name="precio" class="form-control" placeholder="Precio" autofocus required value="<?php echo $precio; ?>">
                    </div>
                    <div class="form-group">
                        <h4>Stock</h4>
                        <input type="number" name="stock" class="form-control" placeholder="Precio" autofocus required value="<?php echo $stock; ?>">
                    </div>
                    <div class="form-group">
                        <h4>Status</h4>
                        <select name="status" class="form-control">
                            <option value="act">Actual: <?php echo $status; ?></option>
                            <option value="activo">Activo</option>
                            <option value="deshabilitado">Deshabilitado</option>
                        </select>
                    </div>
                    <input type="submit" value="Guardar información" name="actualizarInformacion" class="save-info">
                </form>
            </div>
    </div>
    <?php require 'partials/footer.php'?>
    <script type="text/javascript" src="./assets/js/config.js"></script>
</body>
</html>