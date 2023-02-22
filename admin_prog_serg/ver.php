<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Ver PaGE</title>
		<link rel="stylesheet" href="./css/estilo.css" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script src="./js/home.js">
		</script>
	</head>
	<body>
		 <header class="header">
			<img src="./img/logo.jpg" alt="Logo empresa" />
			Menu
		 </header>
		 <section class="section_banner">
			<h1>Aqui encontra as melhores casas</h1>
		 </section>
		 <div class="admin">
			<a href="admin.php">
			<img src="./img/admin.png" alt="Login" />
			</a>
		 </div>
		 
<?php include_once './functionDB.php'; ?>
<?		 if (empty($_GET['id'])) {
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
				<span id="details">mais informação...</span>
				<div id="conteudo">
				</div>
			</article>
		 </main>
		 <div class="wrapper">
			<div>
				<a href="./index.php">
				<img src="./img/arrow.png"/></a>
			</div>
		</div>
		 <footer>
			<div>
				Copyright Prog&deg;2
			</div>
		 </footer>
	</body>
</html>