<?php
include 'fun/functions.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $personne=getPersonneById($id);
    if(isset($_POST['modifier'])){
      $role=$_POST['role'];
      modifierrole($id,$role);
      header('Location: gestionutilisateur.php');
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
    <link rel="stylesheet" href="ac.css">
    <title>Profil</title>
</head>
<body>
    <div class="hero">
        <?php include 'nav.php'; ?>
        <div class="form-box register">
           
            <form method="post">
               <div>
                  <h2>Modifier</h2>
               </div>
                <div class="input-box">
                <span class="icon"><ion-icon name="person-outline"></span>
                    <input type="name" name="nom" required value="<?php echo $personne['nom'];?>">
                    <label>Nom</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></span>
                    <input type="email" name="email" required value="<?php echo $personne['email'];?>">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></span>
                    <input type="text" name="role" required value="<?php echo $personne['titre'];?>">
                    <label>Role</label>
                </div>
                <button type="submit" name="modifier" class="btn btn-secondary">Modifier</button>
          </form> 
        </div>
   </div>    
</body>
</html>