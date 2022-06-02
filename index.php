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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
    <div class="container">
        <div class="slider-container">
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="https://areajugones.sport.es/wp-content/uploads/2020/01/one-piece-967-roger-riendo.jpg" style="width: 100%;">
                    <div class="text">Caption</div>
                </div>
                <div class="mySlides fade">
                    <img src="https://tierragamer.com/wp-content/uploads/2021/06/One-Piece-Gol-D-Roger-Rayleigh-Oden.jpg" style="width: 100%;">
                    <div class="text">Caption</div>
                </div>
                <div class="mySlides fade">
                    <img src="https://areajugones.sport.es/wp-content/uploads/2020/01/one-piece-967-roger-riendo.jpg" style="width: 100%;">
                    <div class="text">Caption</div>
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <div style="text-align: center;">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
        <div class="product-container">
            <?php 
                $stmt = $conn -> prepare("SELECT * FROM articulos");
                $stmt -> execute();

                $results = $stmt -> fetchAll();

                foreach($results as $row){ 
                    
                    if($row['status'] == 'activo' && $row['stock'] != '0'){?>
                    <form action="cart.php?action=add&id=<?php echo $row['id']?>" method="post">
                        <div class="product-box">
                            <div class="product-img">
                                <img src="./assets/img/<?php echo $row['img'] ?>" >
                            </div>
                            <div class="product-details">
                                <a class="p-name" name='name'> <?php echo $row['titulo']; ?></a>
                                <p class="p-desc"><?php echo $row['descripcion'] ?></p>
                                <p class="p-disp" name='quantity'>Disponibles: <?php echo $row['stock'];?></p>
                                <input type="hidden" id="cant" value="<?php echo $row['stock'];?>">
                                <div class="counter">
                                    <span class="down" onClick='decreaseCount(event, this)'>-</span>
                                    <input type="text" value="1" name="quantity"  min="1">
                                    <span class="up" onClick='increaseCount(event, this, <?php echo $row['stock'];?>)'>+</span>
                                </div>
                                <input type="hidden" name="name" value="<?= $row['titulo']?>">
                                <input type="hidden" name="price" value="<?= $row['precio']?>">
                                <input type="submit" name="add_cart" class="btn-submit" value="Agregar al carrito">
                                <div class="bills-details">
                                    <img src="./assets/img/doge.png">
                                    <span class="p-price" name='price'>$ <?php echo $row['precio'] ?></span>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                <?php 
                    } // End IF.
                } //End foreach.?>
        </div>
    </div>
    <?php require 'partials/footer.php' ?>
    <script src="./assets/js/slider.js"></script>
    <script type="text/javascript" src="./assets/js/config.js"></script>
    <script src="./assets/js/cart.js"></script>
</body>
</html>