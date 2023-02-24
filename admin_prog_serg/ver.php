<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Details</title>
		<link rel="stylesheet" href="./css/style.css" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script src="./js/home.js">
		</script>
	</head>
	<body>
	<header class="header">
      <img src="./img/logo.webp" alt="Logo">
      <nav class="menu">
        <div class="admin">
          <a href="admin.php">
            <img src="./img/admin.png" alt="Login">
          </a>
        </div>
      </nav>
    </header>
		 
		<?php include_once './functionDB.php'; ?>
		<?if (empty($_GET['id'])) {
			/* header("Location: home.php");
			exit;*/
		 }
		 $imovel = get_imovel($_GET['id']);
		 //print_r($imovel);
		?>
		 <main class="imoveis">
			<article class="ver">
				<img class="ver_img" src="<?=$imovel['imgPath']?>"alt="<?=$imovel['altimg']?>" />
				<h2>ID: <span id="imovelId"><?=$imovel['id']?></span><br><?=$imovel['descricao']?></h2>
				<span class="btn" id="details">mais informação...</span>
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