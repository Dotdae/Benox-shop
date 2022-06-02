<?php 

    require './include/db.php';

    require './include/session_control.php';

    checkAdmSession();


    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $stmt =  $conn -> prepare("DELETE FROM articulos WHERE id = $id");

        $result = $stmt -> execute();

        if(!$result){

            die("Query failed");

        }
        
        $_SESSION['mensaje'] = '¡Artículo eliminado!';
        $_SESSION['type'] = 'danger';

        header("Location: admin.php");

    }

?>