<?php 

    require './include/db.php';
    require './include/session_control.php';

    checkAdmSession();

    if(isset($_POST['guardarInformacion'])){

        $titulo = $_POST['titulo'];
        $desc = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $status = $_POST['status'];

        // IMG Upload.

        $img = $_FILES['file'];
        $imgName = $img['name'];
        $imgType = $img['type'];

        $imgTypes = array("image/jpg", "image/jpeg", "image/png");

        if(in_array($imgType, $imgTypes)){

            move_uploaded_file($img['tmp_name'], "assets/img/".$imgName);
            
        }

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