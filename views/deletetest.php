<?php
include '../Controller/testC.php';
$clientC = new testC();
$clientC->deletetest($_GET["id"]);
header('Location:indexe.php');
?>