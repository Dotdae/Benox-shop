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

    } 
    
    else {

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
            <?php if(isset($_SESSION['mensaje'])){?>
                <h2 class="message-<?= $_SESSION['type'] ?>"> <?= $_SESSION['mensaje'] ?></h2>
            <?php unset($_SESSION['mensaje']); } ?>
            <form action="save_info.php" method="POST">
                <div class="form-group">
                    <h4>Imagen del producto</h4>
                    <input type="file" name="img" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <h4>Titulo</h4>
                    <input type="text" name="titulo" class="form-control" placeholder="Título" autofocus required>
                </div>
                <div class="form-group">
                    <h4>Descripcion</h4>
                    <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" autofocus required>
                </div>
                <div class="form-group">
                    <h4>Precio</h4>
                    <input type="number" name="precio" class="form-control" placeholder="Precio" autofocus required>
                </div>
                <div class="form-group">
                    <h4>Status</h4>
                    <select name="status" class="form-control">
                        <option value="activo">Activo</option>
                        <option value="deshabilitado">Deshabilitado</option>
                    </select>
                </div>
                <input type="submit" value="Guardar información" name="guardarInformacion" class="save-info">
            </form>
        </div>
        <div class="table">
            <table class="table-border">
                <thead>
                    <tr>
                        <th id="titulo">Titulo</th>
                        <th id="descripcion">Descripcion</th>
                        <th id="precio">Precio</th>
                        <th id="status">Status</th>
                        <th id="acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    $stmt = $conn -> prepare("SELECT * FROM articulos");

                    $stmt -> execute();

                    $results = $stmt -> fetchaLL();
                    
                    foreach($results as $row){?>

                        <tr>
                            <td><?php echo $row['titulo']?></td>
                            <td><?php echo $row['descripcion']?></td>
                            <td><?php echo "$" . $row['precio']?></td>
                            <td><?php echo $row['status']?></td>
                            <td>
                                <a class="edit-btn" href="edit.php?id=<?php echo $row['id']?>">
                                    <i class="fa-solid fa-pen fa-xl"></i>
                                </a>
                                <a class="delete-btn" href="delete.php?id=<?php echo $row['id']?>">
                                    <i class="fa-solid fa-trash fa-xl"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <?php require 'partials/footer.php' ?>
</body>
</html>