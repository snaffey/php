<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My Page</title>
        <link rel="stylesheet" href="css/home.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/home.js"></script>
    </head>

    <body>
        <nav class="nav">
            <ul>
                <li><a href="index.php" class="home-link">Home</a></li>
                <li><a href="#" class="contact-link">Contactos</a></li>
            </ul>
        </nav>
        <header class="header">
            <img src="./img/logo.png" alt="logo" class="logo" />
        </header>
        <section class="location_banner">
            <h1>Melhores casas e apartamentos em um só lugar</h1>
        </section>
        <div class="admin">
            <a href="admin.php">
                <img src="img/admin.png" alt="admin" />
            </a>
        </div>

        <?php
            include_once './functiondb.php';
        ?>

        <?php
            $lista = get_imoveis_list();         
        ?>
        <main class="imoveis">
            <?php foreach ($lista as $data) : ?>
                <article>
                    <img src=<?php echo $data['imgPath'] ?> alt=<?php echo $data['altimg'] ?> />
                    <h2><? echo $data['descricao'] ?></h2>
                    <a href="ver.php?id=<?php echo $data['id'] ?>">Ver mais</a>
                </article>
            <?php endforeach; ?>
        </main>
        <footer class="footer">
            <p>Prog 23</p>
        </footer>
    </body>
</html>