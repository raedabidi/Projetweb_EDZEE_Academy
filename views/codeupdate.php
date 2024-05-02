

<?php 
require '../controller/testC.php';
    if(isset($_POST['submit'])) {
        $l=new testC();
        $id = $_POST['id'];
        $nom = $_POST['nom_prenom'];
        $prenom = $_POST['type_reclamation'];
        $email = $_POST['descrip'];
        $mdp = $_POST['date_reclamation'];    
        $l->updatetest($id,$nom, $prenom, $email, $mdp);
        header("Location: listtest.php");

}
    
    
    
    
    ?>