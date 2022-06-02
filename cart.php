<?php 

    require './include/db.php';
    require './include/session_control.php';

    checkSession();

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

    // Add articles

    if(isset($_POST['add_cart'])){
    
        if(isset($_SESSION['cart'])){

            $session_array_id = array_column($_SESSION['cart'], 'id');

            if(!in_array($_GET['id'], $session_array_id)){

                $session_array = array(

                    'id' => $_GET['id'],
                    'name' => $_POST['name'],
                    'quantity' => $_POST['quantity'],
                    'price' => $_POST['price']
    
                );
    
                $_SESSION['cart'][] = $session_array;

            }
            else{

                '<script>alert("Artículo ya agregado!")</script>';

            }


        }
        else{

            $session_array = array(

                'id' => $_GET['id'],
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price']

            );

            $_SESSION['cart'][] = $session_array;


        }

    }

    // Remove article

    if(isset($_GET['action'])){

        if($_GET['action'] == "delete"){

            foreach($_SESSION['cart'] as $key => $value){

                if($value['id'] == $_GET['id']){

                    unset($_SESSION['cart'][$key]);

                }


            }

        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="./assets/css/cart.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
        <div class="container">
            <h1>Carrito de compras</h1>
            <div class="cart">
                <div class="products">
                    <?php 
        
                        if(!empty($_SESSION['cart'])){

                            foreach($_SESSION['cart'] as $key => $value){

                                $id = $value['id'];
                                $stmt = $conn -> prepare("SELECT * FROM articulos WHERE id = $id");
                                $stmt -> execute();

                                $results = $stmt -> fetch(PDO::FETCH_ASSOC);

                                if(count($results) > 0){

                                    $titulo = $results['titulo'];
                                    $desc = $results['descripcion'];
                                    $precio = $results['precio'];
                                    $img = $results['img'];

                                    $total = $total + $value['quantity'] * $precio;
                                    $totalArticles = $totalArticles + $value['quantity'];

                                    ?>

                                    <div class="product">
                                        <img src="./assets/img/<?php echo $img?>">
                                        <div class="product-info">
                                            <h3 class="product-name"><?php echo $titulo?></h3>
                                            <h3 class="product-price">$<?php echo $precio?></h3>
                                            <p class="product-quantity">
                                                Cantidad
                                                <div class="counter">
                                                    <span class="down" onClick='decreaseCount(event, this)'>-</span>
                                                    <input type="text" value="<?php echo $value['quantity'];?>">
                                                    <span class="up" onClick='increaseCount(event, this)'>+</span>
                                                </div>
                                            </p>
                                            <p class="product-remove">
                                                <i class="fa-solid fa-trash"></i>
                                                <a href="cart.php?action=delete&id=<?php echo $id ?>" class="remove">Eliminar</a>
                                            </p>
                                        </div>
                                    </div>


                                <?php } // End IF

                            } // End foreach

                        } // End session if
                        ?>
                </div>
                <div class="cart-total">
                    <p>
                        <span>Total:</span>
                        <span>$<?php echo $total?></span>
                    </p>
                    <p>
                        <span>Número de artículos:</span>
                        <span><?php echo $totalArticles?></span>
                    </p>
                    <a href="#" class="btn-shop">Comprar</a>
                </div>
            </div>
        </div>
    <?php require 'partials/footer.php' ?>
    <script src="./assets/js/cart.js"></script>
</body>
</html>