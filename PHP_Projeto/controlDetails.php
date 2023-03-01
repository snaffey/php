<?php
include_once './calls.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $artigoID = $_GET['id'];
    $artigo_details = $func->get_artigo_details($artigoID);
} else {
	print_r($_GET);
	print_r($_POST);
    echo "Internal error: Artigo not exist - control";
    exit();
}

?>

<?php
if(!empty($artigo_details)) {
    $artigo_details = $artigo_details[0];
    echo "<ul>";
    echo "<li>Valor: ".$artigo_details['Valor']."</li>";
    echo "<li>Velocidade: ".$artigo_details['Velocidade']."</li>"; 
    echo "</ul>";
} else {
    echo "Internal error: Artigo not exist - view";
}
?>
