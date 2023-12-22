<?php
require_once 'functions/functions.php';
if (isset($_SESSION["utilisateur"])) {
    $id = $_SESSION['utilisateur']['id'];
    $personne = getPersonneById($id);
    if (isset($_POST['modifier'])) {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        if (empty($nom) || empty($email) || empty($mot_de_passe)) {
            echo 'remplir tous les champs svp';
        } else {
            modifier_Profil($nom, $email, $mot_de_passe, $id);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <title>Profil</title>
</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php'; ?>
        <div class="form-box register">
            <form method="post">
                <div>
                    <h2>Profil</h2>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input type="name" name="nom" required value="<?php echo $personne['nom']; ?>">
                    <label>Nom</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required value="<?php echo $personne['email']; ?>">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="mot_de_passe" required value="<?php echo $personne['mot_de_passe']; ?>">
                    <label>Mot de passe</label>
                </div>
                <button type="submit" name="modifier" class="btn btn-secondary">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>