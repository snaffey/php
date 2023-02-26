<?
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['UserID'])) {
	session_destroy();
	header("Location: index.php");
    exit;
}

include_once './functionDB.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>Admin Back-office</title>
		<link rel="stylesheet" href="./css/estilo.css" >
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script src="./js/home.js">
		</script>
	</head>
	<body>
		<h3>
			Página restrita: <? 
echo "Sessão: ".$_SESSION['UserNome'];
echo "<br /><a href=\"logout.php\">Sair</a>";
			?>
		</h3>
		<form action="" method="post">
 <table class="form-table">
	<tr>
		<td>Alt Img: </td>
		<td>
		<input type="text" name="form_imovel_alt" value="<?
			if (isset($altimg))
				echo htmlentities($altimg);
		?>" />
		</td>
	</tr>
	
	<tr>
		<td>Descrição: </td>
		<td>
		<input type="text" name="form_imovel_descricao" value="<?
			if (isset($ArtigoDesc))
				echo htmlentities($ArtigoDesc);
		?>" />
		</td>
	</tr>
	<tr>
		<td>Img path: </td>
		<td>
		<input type="text" name="form_imovel_img" value="<?
			if (isset($ArtigoImg))
				echo htmlentities($ArtigoImg);
		?>" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="hidden" name="save" value="<?php echo $ArtigoID; ?>">
			<input type="submit" value="save" />
		</td>
	</tr>
	
 </table>
        </form>
		
		<?
		$lista = get_imoveis_list();
		?>
		<table>
			<thead>
                <tr>
					<th>ID</th>
                    <th>Alt</th>
                    <th>Descrição</th>
                    <th>Img</th>
					<th>Edição</th>
				</tr>
			</thead>
	<tbody>
<?php foreach ($lista as $imovel): ?>
		<tr>
		<td><?php echo $imovel['id'] ?></td>
		<td><?=$imovel['altimg'] ?></td>
		<td><?=$imovel['descricao'] ?></td>
		<td><?=$imovel['imgPath'] ?></td>
		<td>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="edit" value="<?php echo $imovel['id'] ?>" />
				<input type="submit" name="submit" value="Edit">
			</form>
			<a href="<?php echo HOME_URI; ?>?del=<?php echo $imovel['id'] ?>">Del</a>
		</td>
		</tr>
<?php endforeach; ?>			
	</tbody>
		</table>
    </body>
</html>
