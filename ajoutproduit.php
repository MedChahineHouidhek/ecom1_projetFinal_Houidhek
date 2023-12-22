<?php
require_once 'functions/functions.php';
// include 'uploadimage.php';
if(isset($_POST['ajouter'])){
    $titre=$_POST['titre'];
    $descreption=$_POST['desc'];
    $prix=$_POST['prix'];
    $quantite=$_POST['quantite'];
    if(empty($titre)||empty($descreption)||empty($prix)||empty($quantite)){
        echo'remplir tous les champs svp';
    }else{
        if (isset($_FILES["image"]) && $_FILES["image"]["error"]=== UPLOAD_ERR_OK) {
            $image_name=$_FILES["image"]["name"];
            $image_tmp=$_FILES["image"]["tmp_name"];
            $image_destination="images/". basename($image_name);
        
            $image_type = strtolower(pathinfo($image_destination,PATHINFO_EXTENSION));
            if(!in_array($image_type,array("jpg","jpeg","png","png","gif"))){
                echo "Seules les image jpg, pnj, jpeg, png et gif sont autorisees";
                exit();
            }
        
            if(move_uploaded_file($image_tmp, $image_destination)){
                Ajouter_Produit($titre,$descreption,$prix,$quantite,$image_destination);
            }
        }
        Ajouter_Produit($titre,$descreption,$prix,$quantite);
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
    <title>Ajout Produit</title>
</head>
<body>
    <div class="hero">
        <?php include 'nav.php'; ?>
          <div class="form-box ajout">
              <form method="post"  enctype="multipart/form-data">
                  <div>
                     <h2>Ajouter Produit</h2>
                  </div>
                  <div class="input-box">
                      <input type="text" name="titre" required value="" onfocus="clearThis(this)">
                      <label>Titre</label>
                   </div>
                   <div class="input-box">
                       <input type="text" name="desc" required value="" onfocus="clearThis(this)">
                       <label>Descreption</label>
                   </div>
                   <div class="input-box">
                       <input type="real" name="prix" required value="" onfocus="clearThis(this)">
                       <label>Prix</label>
                   </div>
                   <div class="input-box">
                       <input type="number" name="quantite" required min=0 value="" onfocus="clearThis(this)">
                       <label>Quantite</label>
                   </div>
                   <div class="input-box">
                       <input type="file" name="image" id="image">
                       <label for="image">Selectionner une image : </label>
                   </div>
                   <button type="submit" name="ajouter" class="btn btn-secondary">Ajouter Produit</button>
               </form>
          </div>
   </div>
</body>
</html>