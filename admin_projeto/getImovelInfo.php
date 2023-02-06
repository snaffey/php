<?php
include_once './functiondb.php';

if (isset($_POST['id'])) {
  $imovel_info = getImovelInfo($_POST['id']);
  echo "Valor: " . $imovel_info['valor'] . "<br>";
  echo "Localidade: " . $imovel_info['localidade'];
}
?>
