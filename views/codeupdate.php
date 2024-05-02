

<?php 
require '../controller/testC.php';
    if(isset($_POST['submit'])) {
        $l=new testC();
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $role = $_POST['role'];
        $num = $_POST['numero'];    
        $email = $_POST['email'];    
        $mdp = $_POST['mot_passe'];    
        $date = $_POST['date_naissance'];    
        $l->updatetest($nom, $prenom, $role, $num, $email, $mdp, $date);
        header("Location: index.php");

}
    
    
    
    
    ?>