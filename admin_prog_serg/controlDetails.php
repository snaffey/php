<?php include_once './functionDB.php'; ?>
<? $imovel_details = get_imovel_details($_POST['id']); ?>
<?php
	echo "<ul>";
		echo "<li>Valor: ".$imovel_details['valor']."</li>";
		echo "<li>Local: ".$imovel_details['localidade']."</li>"; 
	echo "</ul>";
?>