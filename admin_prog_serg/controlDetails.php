<?php include_once './functionDB.php'; ?>
<? $imovel_details = get_imovel_details($_POST['id']); ?>
<?php
	echo "<ul>";
		echo "<li>Quartos: ".$imovel_details['n_quartos']."</li>";
		echo "<li>Salas: ".$imovel_details['n_salas']."</li>"; 
	echo "</ul>";
?>