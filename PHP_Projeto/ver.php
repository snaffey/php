<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Details</title>
		<link rel="stylesheet" href="./css/style.css" >
		
	</head>
	<body>
	<header class="header">
      <img src="./img/logo.webp" alt="Logo">
      <nav class="menu">
        <div class="admin">
          <a href="./login/admin.php">
            <img src="./img/admin.png" alt="Login">
          </a>
        </div>
      </nav>
    </header>
		 
		<?php include_once './lib/calls.php'; ?>
		<?if (empty($_GET['id'])) {
			header("Location: index.php");
			exit;
		 }
		 
		$Artigo = array_values($getArtigo);
		$Artigo = $Artigo[0];
		?>
		 <main class="Artigos">
			<article class="ver">
				<img class="ver_img" src="<?=$Artigo['Img']?>" alt="<?=$Artigo['AltImg']?>" />
				<h2><?=$Artigo['Nome']?></h2>
				<h2 class="desc" ><?=$Artigo['Descrição']?></h2>
				<h2>Preço: <?=$Artigo['Valor']?>€</h2>
				<h2>ID: <span id="ArtigoID"><?=$Artigo['ID']?></span></h2>
				<div id="conteudo">
				</div>
			</article>
		 </main>
		 <div class="article-arrow">
			<div>
				<a href="./index.php">
				<img src="./img/arrow.png"/></a>
			</div>
		</div>
		<footer>
      <div class="footer-bottom">
        <p>&copy; 2021 Tiago</p>
      </div>
    </footer>
	</body>
</html>