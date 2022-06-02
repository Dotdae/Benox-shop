<div class="navigation">
    <header class="header" id="header">
        <nav class="nav">
            <a href="index.php" class="main">Inicio</a>
            <ul class="nav-menu">
                <?php if(!empty($user)):?>
                    <?php  if($user['id'] == 1):?>
                        <li class="nav-item"><a class="nav-item-link"> <?= $user['username']?></a></li>
                        <li class="nav-item"><a href="admin.php" class="nav-item-link">Administrar sitio</a></li>
                        <li class="nav-item"><a href="contacto.php" class="nav-item-link">Contacto</a></li>
                        <li class="nav-item"><a href="config.php" class="nav-item-link">Configuración</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-item-link">Cerrar sesión</a></li>
                    <?php else:?>
                        <li class="nav-item"><a class="nav-item-link"> <?= $user['username']?></a></li>
                        <li class="nav-item"><a href="contacto.php" class="nav-item-link">Contacto</a></li>
                        <li class="nav-item"><a href="config.php" class="nav-item-link">Configuración</a></li>
                        <li class="nav-item"><a href="logout.php" class="nav-item-link">Cerrar sesión</a></li>
                    <?php endif; ?>
                <?php else:?>
                    <li class="nav-item"><a href="login.php" class="nav-item-link">Iniciar sesión</a></li>
                    <li class="nav-item"><a href="signin.php" class="nav-item-link">Registrarse</a></li>
                    <li class="nav-item"><a href="contacto.php" class="nav-item-link">Contacto</a></li>
                    <li class="nav-item"><a href="config.php" class="nav-item-link">Configuración</a></li>
                <?php endif;?>
                <li class="nav-item">
                    <a href="cart.php" class="nav-item-link">
                        <i class="fas fa-shopping-cart">
                        </i>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
</div>