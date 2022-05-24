<?php 

    session_start();

    require 'db.php';

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