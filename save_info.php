<?php 

    require './include/db.php';
    require './include/session_control.php';

    checkAdmSession();

    if(isset($_POST['guardarInformacion'])){

        $titulo = $_POST['titulo'];
        $desc = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $status = $_POST['status'];

        $sql = "INSERT INTO articulos(titulo, descripcion, precio, status) VALUES ('$titulo', '$desc', '$precio', '$status')";

        $stmt = $conn -> prepare($sql);

        if($stmt -> execute()){

            $_SESSION['mensaje'] = '¡Artículo guardado!';
            $_SESSION['type'] = 'alert';

            header('Location: admin.php');

        }
        else{

            $_SESSION['mensaje'] = 'Error al guardar el artículo';
            $_SESSION['type'] = 'danger';

            echo 'Error al insertar datos';

        }

    }

?>