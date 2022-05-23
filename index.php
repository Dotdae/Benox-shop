<?php 

    session_start();

    /*

    if(!(isset($_SESSION['user_id']))){

        header('Location: login.php');

    }

    */

    require 'db.php';

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
            <?php for($i = 0; $i <= 7; $i++) {?>
            <div class="product-box">
                    <div class="product-img">
                        <a class="add-cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <img src="https://i.pinimg.com/originals/a9/c5/3f/a9c53fa1ae331e1ae97c87cfc1e33c93.jpg" >
                    </div>
                    <div class="product-details">
                    <a class="p-name"> Arqueóloga</a>
                    <div class="bills-details">
                        <img src="./assets/img/doge.png">
                        <span class="p-price">$2000</span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php require 'partials/footer.php' ?>
    <script src="./assets/js/slider.js"></script>
</body>
</html>