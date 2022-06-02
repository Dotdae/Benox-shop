<?php 



    session_start();

    session_unset();

    unset($_SESSION['cart']);

    session_destroy();

    setcookie("user_id", null, -1, '/');
    setcookie("tamañoFuente", null, -1, '/');
    setcookie("colorFondo", null, -1, '/');
    setcookie("colorLetra", null, -1, '/');
    setcookie("colorHeader", null, -1, '/');
    setcookie("colorFooter", null, -1, '/');

    header('Location: index.php');


?>