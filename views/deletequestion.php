<?php
include '../Controller/questionC.php';
$clientC = new questionC();
$clientC->deletequestion($_GET["id"]);
header('Location:listquestion.php');
?>