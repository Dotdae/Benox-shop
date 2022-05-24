<?php 


    function checkSession(){

        if(!(isset($_SESSION['user_id']))){

            header('Location: login.php');

        }

    }

    function checkAdmSession(){

        require './include/db.php';

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

    }


?>