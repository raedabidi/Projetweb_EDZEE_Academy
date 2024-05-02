<?php

include '../Controller/testC.php';


$error = "";


$test = null;


$testC = new testC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["numero"]) &&
    isset($_POST["email"]) &&
    isset($_POST["mot_passe"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["numero"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["mot_passe"])
    ) {
        $test = new test(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['numero'],
            $_POST['email'],
            $_POST['mot_passe']

        );
        $testC->addtest($test);
        header('Location:indexe.php');
    } else
        $error = "Missing information";
}


?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up EDZEE_ACADEMY</title>
    <link rel="stylesheet" href="source/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper">
        <form action="" method="POST">
            <h1>Sign up</h1>
            <div class="input-box">
                <input type="text" name="nom"  id="nom" placeholder="Firstname" required onblur="validateNom(this.value)">
                <div id="nomError" style="color: black;"></div>
                <i class='bx bxs-user'></i>
                <script>
                              function validateNom(nom) {
                                 var nomRegex = /^[a-zA-Z\s]+$/;
                                  var nomError = document.getElementById("nomError");
                                        if (nom.length > 3 && nomRegex.test(nom)) {
                                                nomError.textContent = "";
                                                return true;
                                        } else {
                                                     nomError.innerHTML = "<h3 style='font-family: Arial, sans-serif;'>Le Nom doit contenir au moins 4 lettres</h3>";
                                                    return false;
                                         }
                                }
                </script>
            </div>
            <div class="input-boxe"></div>

            <div class="input-box">
                <input type="text" name="prenom" placeholder="Lastname" required required onblur="validatePrenom(this.value)">
            <div id="prenomError" style="color: black;"></div>
            <script>
                        function validatePrenom(nom) {
                              var prenomRegex = /^[a-zA-Z\s]+$/;
                              var prenomError = document.getElementById("prenomError");
                                  if (nom.length > 3 && prenomRegex.test(nom)) {
                                        prenomError.textContent = "";
                                           return true;
                                     } else {
                                        prenomError.innerHTML = "<h3 style='font-family: Arial, sans-serif;'>Le prénom doit contenir au moins 4 lettres</h3>";

                                                 return false;
                                         }
                            }
            </script>
                <i class='bx bxs-user'></i>
            </div>
            
            <div class="input-boxe"></div>
            <div class="input-box">
                <input type="numero" name="numero" id="numero" placeholder="Numero" required>
                <div id="numeroError" style="color: black;"></div>

                                     <script>
                                                 function validateNumero(numero) {
                                                        // Expression régulière pour valider le numéro de téléphone
                                                        var numeroRegex = /^(2[0-9]|3[0-1]|5[0-9]|7[0-9]|9[0-9])[0-9]{6}$/;
                                                        var numeroError = document.getElementById("numeroError");
                                                                if (numeroRegex.test(numero)) {
                                                                        numeroError.textContent = "";
                                                                                    return true;
                                                                } else {
                                                                        numeroError.innerHTML = "<h3 style='font-family: Arial, sans-serif;'>Le numéro de téléphone doit contenir exactement 8 chiffres.<h3>";
                                                                                        return false;
                                                                                }
                                                            }

                                                                        // Ajouter un écouteur d'événements pour valider le numéro lorsque l'utilisateur quitte le champ
                                                                     var numeroInput = document.getElementById("numero");
                                                                     numeroInput.addEventListener("blur", function() {
                                                                validateNumero(this.value);
                                                                 });
                                     </script>

                
            </div>
            <div class="input-boxe"></div>
            <div class="input-box">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <div id="emailError" style="color: black;"></div>

                                    <script>
                                                        function validateEmail(email) {
                                                          // Expression régulière pour valider une adresse e-mail
                                                          var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                                              var emailError = document.getElementById("emailError");
                                                              if (emailRegex.test(email)) {
                                                                      emailError.textContent = "";
                                                                          return true;
                                                              } else {
                                                                           emailError.innerHTML = "<h3 style='font-family: Arial, sans-serif;'>Veuillez saisir une adresse e-mail valide.<h3>";
                                                                              return false;
                                                                                 }
                                                                     }

                                                                             // Ajouter un écouteur d'événements pour valider l'e-mail lorsque l'utilisateur quitte le champ
                                                                                 var emailInput = document.getElementById("email");
                                                                     emailInput.addEventListener("blur", function() {
                                                                             validateEmail(this.value);
                                                                                      });
                                    </script>

                <i class='bx bxs-user'></i>
            </div>
            <div class="input-boxe"></div>
            <div class="input-box">
                <input type="password" name="mot_passe" id="mot_passe" placeholder="Password" required>
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

                <i class='bx bxs-lock-alt'></i>
            </div>
           
            <div class="input-boxe"></div>
            <div class="input-boxe"></div>
            <div class="input-boxe"></div>
            <button type="submit" class="btn">Sign Up</button>

            <div class="register-link">
                <p>You have an account? <a href="login/Login.php">Login</a></p>
            </div>
        </form>
    </div>

</body>

</html>
