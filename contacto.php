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
    <title>Contacto</title>
    <link rel="stylesheet" href="./assets/css/contact.css?v=<?php echo time(); ?>">
    <?php require 'partials/head.php' ?>
</head>
<body>
    <?php require 'partials/nav.php' ?>
    <div class="container">
        <div class="contact-box">
            <div class="contact-left">
                <h3>Envía tu mensaje</h3>
                <form>
                    <div class="input-row">
                        <div class="input-group">
                            <label>Nombre</label>
                            <input type="text" required>
                        </div>
                        <div class="input-group">
                            <label>Correo</label>
                            <input type="email" required>
                        </div>
                    </div>
                    <div class="message-group">
                        <label>Mensaje</label>
                        <textarea rows="8"></textarea>
                    </div>
                    <div class="button-group">
                        <button type="submit">Enviar</button>
                        <button type="reset">Limpiar</button>
                    </div>
                </form>
            </div>
            <div class="contact-right">
                <h3>Sobre nosotros</h3>
                <div class="contact-info">
                    <ul>
                        <li><i class="fas fa-building"></i> Benox Inc</li>
                        <li><i class="fas fa-user-tie"></i> CEO: Benox Ortega</li>
                        <li><i class="fas fa-map-marker-alt"></i> Calle: Si #123</li>
                        <li><i class="fas fa-phone"></i> 6556456564</li>
                        <li><i class="fas fa-envelope-open-text"></i> Benoxloco@gmail.com</li>
                    </ul>
                    <p>Nos dedicamos a hacer aún más rico al patrón Benito dueño de todo lo que ves.</p>
                    <p id="x">BENOX FAMILY 2022</p>
                </div>
            </div>
        </div>
    </div>
    <?php require 'partials/footer.php' ?>
</body>
</html>