<?php
include '../Controller/questionC.php';
$clientC = new questionC();
$clientC->deletequestion($_GET["id_question"]);
header('Location:listquestion.php');
?>