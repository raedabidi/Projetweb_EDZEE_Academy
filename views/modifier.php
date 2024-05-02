<?php

include '../Controller/testC.php';

$error = "";

// create client


$c= new testC();


if (isset($_GET['id']))
 {
    
        $Id = $_GET['id'];
        $tab = $c->selectrec($Id);
        if($tab) {
           
            $nomp = $tab['nom'];
            $prenom = $tab['prenom'];
            $role = $tab['role'];
            $num = $tab['numero'];
            $email = $tab['email'];
            $mdp = $tab['mpd'];
            $date = $tab['date_naissance'];
    
        }
       

        
    } 
    else
    $error = "Missing information";




?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Display</title>
</head>

<body>
    <button><a href="index.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    
       <form action="codeupdate.php" method="POST">
        <label>Nom</label>
<input type="text" name="nom" value="<?php echo $nomp;?>" id="nom" placeholder="Nom" required onblur="validateNom(this.value)">
<div id="nomError" style="color: red;"></div>

<script>
    function validateNom(nom) {
        var nomRegex = /^[a-zA-Z\s]+$/;
        var nomError = document.getElementById("nomError");
        if (nom.length > 3 && nomRegex.test(nom)) {
            nomError.textContent = "";
            return true;
        } else {
            nomError.textContent = "Le nom doit contenir au moins 4 lettres et ne doit contenir que des lettres et des espaces.";
            return false;
        }
    }
</script>

            <label>Prénom</label>
            <input type="text" name="prenom" value="<?php echo $prenom;?>" id=prenom placeholder="Prénom" required onblur="validatePrenom(this.value)">
            <div id="prenomError" style="color: red;"></div>
            <script>
    function validatePrenom(nom) {
        var prenomRegex = /^[a-zA-Z\s]+$/;
        var prenomError = document.getElementById("prenomError");
        if (nom.length > 3 && prenomRegex.test(nom)) {
            prenomError.textContent = "";
            return true;
        } else {
            prenomError.textContent = "Le prenom doit contenir au moins 4 lettres et ne doit contenir que des lettres et des espaces.";
            return false;
        }
    }
</script>

<label>Role</label>
<select name="role"  value="<?php echo $role;?>" required>
    <option value="">Sélectionner un rôle</option>
    <option value="admin">Admin</option>
    <option value="client">Client</option>
</select>
<label>Numéro de téléphone</label>
<input type="text" name="numero" value="<?php echo $num;?>" id="numero" placeholder="Numéro téléphone" required>
<div id="numeroError" style="color: red;"></div>

<script>
    function validateNumero(numero) {
        // Expression régulière pour valider le numéro de téléphone
        var numeroRegex = /^(2[0-9]|3[0-1]|5[0-9]|7[0-9]|9[0-9])[0-9]{6}$/;
        var numeroError = document.getElementById("numeroError");
        if (numeroRegex.test(numero)) {
            numeroError.textContent = "";
            return true;
        } else {
            numeroError.textContent = "Le numéro de téléphone doit commencer par 20-31, 50-59, 70-79 ou 90-99 et contenir exactement 8 chiffres.";
            return false;
        }
    }

    // Ajouter un écouteur d'événements pour valider le numéro lorsque l'utilisateur quitte le champ
    var numeroInput = document.getElementById("numero");
    numeroInput.addEventListener("blur", function() {
        validateNumero(this.value);
    });
</script>
                                                                
<label>Email</label>
<input type="email" name="email" value="<?php echo $email;?>" id="email" placeholder="Email" required>
<div id="emailError" style="color: red;"></div>

<script>
    function validateEmail(email) {
        // Expression régulière pour valider une adresse e-mail
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var emailError = document.getElementById("emailError");
        if (emailRegex.test(email)) {
            emailError.textContent = "";
            return true;
        } else {
            emailError.textContent = "Veuillez saisir une adresse e-mail valide.";
            return false;
        }
    }

    // Ajouter un écouteur d'événements pour valider l'e-mail lorsque l'utilisateur quitte le champ
    var emailInput = document.getElementById("email");
    emailInput.addEventListener("blur", function() {
        validateEmail(this.value);
    });
</script>

<label>Mot de passe</label>
<input type="password" name="mot_passe" value="<?php echo $mdp;?>" id="mot_passe" placeholder="Mot de passe" required>
<div id="motPasseStrength" style="margin-top: 5px;"></div>

<script>
    function checkPasswordStrength(password) {
        var strength = 0;
        if (password.match(/[a-z]/)) {
            strength++;
        }
        if (password.match(/[A-Z]/)) {
            strength++;
        }
        if (password.match(/[0-9]/)) {
            strength++;
        }
        if (password.length >= 8) {
            strength++;
        }
        return strength;
    }

    function updatePasswordStrength(password) {
        var strength = checkPasswordStrength(password);
        var strengthIndicator = document.getElementById("motPasseStrength");

        if (strength === 0) {
            strengthIndicator.textContent = "";
            strengthIndicator.style.backgroundColor = "";
        } else if (strength <= 2) {
            strengthIndicator.textContent = "Faible";
            strengthIndicator.style.color = "red";
        } else if (strength === 3) {
            strengthIndicator.textContent = "Moyen";
            strengthIndicator.style.color = "orange";
        } else {
            strengthIndicator.textContent = "Fort";
            strengthIndicator.style.color = "green";
        }
    }

    var passwordInput = document.getElementById("mot_passe");
    passwordInput.addEventListener("input", function() {
        updatePasswordStrength(this.value);
    });
</script>


<label>Date de naissance</label>
<input type="date" name="date_naissance" value="<?php echo $date;?>" id="date_naissance" placeholder="Date de naissance" required>
<div id="dateNaissanceError" style="color: red;"></div>

<script>
    function validateDateNaissance(dateNaissance) {
        var dateNaissanceObj = new Date(dateNaissance);
        var now = new Date();
        var age = now.getFullYear() - dateNaissanceObj.getFullYear();
        if (now.getMonth() < dateNaissanceObj.getMonth() || (now.getMonth() === dateNaissanceObj.getMonth() && now.getDate() < dateNaissanceObj.getDate())) {
            age--;
        }
        return age >= 18;
    }

    function updateDateNaissanceValidation(dateNaissance) {
        var isValid = validateDateNaissance(dateNaissance);
        var dateNaissanceError = document.getElementById("dateNaissanceError");
        if (isValid) {
            dateNaissanceError.textContent = "";
        } else {
            dateNaissanceError.textContent = "Vous devez avoir au moins 18 ans.";
        }
    }

    var dateNaissanceInput = document.getElementById("date_naissance");
    dateNaissanceInput.addEventListener("input", function() {
        updateDateNaissanceValidation(this.value);
    });
</script>

<td>
                    <input type="submit" name ="submit" value="Save">
                </td>

</form> 
</body>

</html>