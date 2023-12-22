<?php
//--------------------- CONNEXION ----------------------------------
//importer
require_once 'functions/functions.php';
//les information pour se connecte a la base de donnee
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonne = "textsite";

//creation d'une variable et  la stoker dans ma session
$_SESSION['email'] = $serveur;

//connecte a la base de donnee avec Mysqli
if (isset($_POST['envoyer'])) {
    //connexion a la base de donnee
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $basededonne);
    // verifier si la connexion marche
    if (!$connexion) {
        die("Echec de la connexion a la base de donnees: " . mysqli_connect_error());
    }
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $email = mysqli_real_escape_string($connexion, $email);
    $mot_de_passe = mysqli_real_escape_string($connexion, $mot_de_passe); //echapper les caractaire speciaux
    //Verifivation de l'exestence de l'utilisateur
    if (!empty($email) && !empty($mot_de_passe)) {
        //requete pour verifier si les informations de connexion de l'utilisteur a la base de donne
        // $requete="SELECT * FROM Personne WHERE email=? ";
        $requete = 'SELECT p.*, r.titre FROM personne p 
        inner join personnerole pr on p.id=pr.id_personne
         inner join role r on r.id = pr.id_role where p.email = ? ';
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultaf = $stmt->get_result();

        if ($resultaf->num_rows >= 1) {
            $utilisateur = mysqli_fetch_assoc($resultaf);
            // si les informations sont valid 
            if (password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                unset($utilisateur['mot_de_passe']);
                $_SESSION["utilisateur"] = $utilisateur;
                header('Location: ./home.php');
            } else {
                echo '<script>alert ("mot de passe incorrect")</script>';
            }
        } else {
            //si les information sont invalide
            echo "Utilisateur avec l'email $email n'existe pas";
        }
    }
}

?>
<?php
//---------------------- INSCRIPTION -----------------------

//les information pour se connecte a la base de donnee
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonne = "site";
$port = "3306";

if (isset($_POST['cree'])) {
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['password'];
    $c_mot_de_passe = $_POST['c-password'];
    if (!empty($nom) && !empty($email) && !empty($mot_de_passe) && !empty($c_mot_de_passe)) {
        if ($mot_de_passe === $c_mot_de_passe) {
            inscription($nom, $email, $mot_de_passe);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php' ?>
        <div class="wrapper">
            <span class="icon-close">
                <ion-icon name="close-outline"></ion-icon>
            </span>
            <div class="form-box login">
                <h2>Connexion</h2>
                <form method="post">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="email" required value="aaa@gmail.com" onfocus="clearThis(this)">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" name="password" required value="12345678" onfocus="clearThis(this)">
                        <label>Mot de passe</label>
                    </div>
                    <button type="submit" name="envoyer" class="btn btn-secondary">Connecte</button>
                    <div class="login-register">
                        <p>Vous n'avez pas de compte? <a href="#" class="register-link">Cree Compte</a></p>
                    </div>
                </form>
            </div>
            <div class="form-box register">
                <h2>Cree compte</h2>
                <form method="post">
                    <div class="input-box ">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <input type="name" name="name" required value="nom complet" onfocus="clearThis(this)">
                        <label>Nom</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="email" required value="exemple@gmail.com" onfocus="clearThis(this)">
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" name="password" required value="12345678" onfocus="clearThis(this)">
                        <label>Mot de passe</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                        <input type="password" name="c-password" required value="12345678" onfocus="clearThis(this)">
                        <label>Confirmer Mot de passe</label>
                    </div>
                    <button type="submit" name="cree" class="btn btn-secondary">Cree</button>
                    <div class="login-register">
                        <p>Vous avez deja un Compte? <a href="#" class="login-link">Connecte</a></p>
                    </div>
                </form>
            </div>
        </div>

        <h3 data-text=""></h3>
        <script src="home.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>