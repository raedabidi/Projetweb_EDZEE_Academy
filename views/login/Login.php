<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=utilisateur', 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode d'affichage des erreurs PDO
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
if(isset($_POST['valider'])) {
    if (!empty($_POST['email']) && !empty($_POST['mot_passe'])) {
        $email = htmlspecialchars($_POST['email']);
        $mot_passe = $_POST['mot_passe']; // Ne pas utiliser htmlspecialchars pour le mot de passe

        // Préparation de la requête SQL pour récupérer le rôle et le mot de passe hashé
        $req = $connection->prepare("SELECT role, mpd FROM user WHERE email = ?");
        $req->execute(array($email));

        // Vérification du nombre de lignes retournées
        $cpt = $req->rowCount();

        if ($cpt > 0) {
            // Récupération de la ligne de résultat sous forme de tableau associatif
            $result = $req->fetch(PDO::FETCH_ASSOC);
            $role = $result['role'];
            $passwordHash = $result['mpd'];

            // Vérification du mot de passe
            if (password_verify($mot_passe, $passwordHash)) {

                $_SESSION['user']= $email;
                if ($role === "admin") {
                    header('Location: index.php');
                    exit(); // Important pour arrêter l'exécution du script après la redirection
                } else {
                    header('Location: Front/index.html');
                    exit(); // Idem ici
                }
            } else {
                echo "Mot de passe incorrect";
            }
        } else {
            echo "Utilisateur non trouvé";
        }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form in HTML and CSS | Codehal</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper">
        <form action="" method="POST">
            <h1>Login</h1>
            <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
                

                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
            <input type="password" name="mot_passe" id="mot_passe" placeholder="Password" required>
               
                <i class='bx bxs-lock-alt'></i>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="email.php">Forgot password?</a>
            </div>
           <button type="submit" name="valider" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="../sign up.php">Sign Up</a></p>
            </div>
        </form>
    </div>

</body>

</html>