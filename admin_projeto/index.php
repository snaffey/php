<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My Page</title>
        <link rel="stylesheet" href="css/main.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/home.js"></script>
    </head>

    <body>
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
                    <img src="<? echo $data['imgPath'] ?>" alt="<? echo $data['altImg'] ?>" />
                    <h2><? echo $data['descricao'] ?></h2>
                    <a href="ver.php?id=<? echo $data['id'] ?>">Ver mais</a>
                </article>
            <?php endforeach; ?>
        </main>     
        <main class="main">
            <?php
                foreach ($lista as $imovel) {
                    echo '<article>';
                    echo '<img src="./img/casa.jpg" alt="casa" class="casa" />';
                    echo '<h2>'.$imovel['descricao'].'</h2>';
                    echo '<a href="ver.html">Ver mais</a>';
                    echo '</article>';
                }
            ?>
        <main>
            <article>
                <img src="./img/casa.jpg" alt="casa" class="casa" />
                <h2>Casa com jardim</h2>
                <a href="ver.html">Ver mais</a>
            </article>
            <article>
                <img src="./img/casa.jpg" alt="casa" class="casa" />
                <h2>Casa com jardim</h2>
                <a href="ver.html">Ver mais</a>
            </article>
            <article>
                <img src="./img/casa.jpg" alt="casa" class="casa" />
                <h2>Casa com jardim</h2>
                <a href="ver.html">Ver mais</a>
            </article>
            <article>
                <img src="./img/casa.jpg" alt="casa" class="casa" />
                <h2>Casa com jardim</h2>
                <a href="ver.html">Ver mais</a>
            </article>
            <article>
                <img src="./img/casa.jpg" alt="casa" class="casa" />
                <h2>Casa com jardim</h2>
                <a href="ver.html">Ver mais</a>
            </article>
        </main>
        <footer class="footer">
            <p>Prog 23</p>
        </footer>
    </body>
</html>