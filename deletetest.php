<?php
include '../Controller/testC.php';
$clientC = new testC();
$clientC->deletetest($_GET["id_test"]);
header('Location:listtest.php');
?>