<?php


$Mnome = $_POST['Mnome'];
$Mqtd = $_POST['Mqtd'];
$Mmarca = $_POST['Mmarca'];
$Mcategoria = $_POST['Mcategoria'];
$numero = $_POST['numero'];

include_once("config.php");

$sqlalterar = "update tbmedicamentos set Mqtd = '$Mqtd', 
Mmarca = '$Mmarca', Mnome = '$Mnome', Mcategoria = '$Mcategoria' where numero = '$numero';";

if(mysqli_query($link,$sqlalterar)){
	header("Location: index.php");
} else {
	echo "Erro ao alterar Medicamento.<br>".mysqli_error($conexao); 
	echo "<br><a href='update.php'>Voltar</a>";
}
	
?>
