<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Home PaGE</title>
		<link rel="stylesheet" href="./css/estilo.css" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script src="./js/home.js">
		</script>
	</head>
	<body>
		 <header class="header">
			<img src="./img/logo.jpg" alt="Logo empresa" />
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
	<?	$lista = get_imoveis_list(); ?>		
		 <main class="imoveis">
		 <?php foreach ($lista as $data): ?>
			<article>
				<img src="<?=$data['imgPath'] ?>"alt="<?=$data['altimg'] ?>" />
				<h2><?=$data['descricao'] ?></h2>
				<a href="ver.php?id=<?=$data['id'] ?>">mais informação...</a>
			</article>
		<?php endforeach; ?> 
		 </main>
		 <footer>
			<div>
				Copyright Prog&deg;2
			</div>
		 </footer>
	</body>
</html>