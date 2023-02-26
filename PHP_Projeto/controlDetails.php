<?php include_once './functionDB.php'; ?>
<? $artigo_details = get_artigo_details($_POST['id']); ?>
<?php
	echo "<ul>";
		echo "<li>Valor: ".$artigo_details['Valor']."</li>";
		echo "<li>Velocidade: ".$artigo_details['Velocidade']."</li>"; 
	echo "</ul>";
?>