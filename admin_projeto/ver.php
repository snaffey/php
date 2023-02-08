
        <section class="location_banner">
            <h1>Melhores casas e apartamentos em um só lugar</h1>
        </section>
        
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
        