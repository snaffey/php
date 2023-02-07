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
        <div class="back">
            <a href="index.php">
                <img src="img/back.png" alt="back" />
            </a>
        </div>


        <?php
            include_once './functiondb.php';
        ?>

        <?php 
			if(empty($_GET['id'])){
				//red
				header("Location: index.php");
				exit;
			}
			$imovel = get_imovel($_GET['id']);
		?>

        <main class="imoveis">
            <article class="ver">
                <img class="ver_img" src="<?php echo $imovel['imgPath'] ?>" alt="<?php echo $imovel['altimg']?>" />
                <h2>ID: <span id="id-imovel"><?= $imovel['id']?></span><br><?php echo $imovel['descricao']?></h2>
                <a href="#" id="mais-informacao">Mais informação...</a>
                <div id="info-imovel"></div>
            </article>
        </main>
        <footer class="footer">
            <p>Prog 23</p>
        </footer>
    </body>
</html>
