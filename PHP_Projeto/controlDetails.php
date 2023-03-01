<?php include_once './calls.php'; ?>
<? $artigo_details = $artigoInfo; ?>
<?php
	echo "<ul>";
		echo "<li>Valor: ".$artigo_details['Valor']."</li>";
		echo "<li>Velocidade: ".$artigo_details['Velocidade']."</li>"; 
	echo "</ul>";
?>