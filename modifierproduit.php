<?php
include 'fun/functions.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $produit=getProduitById($id);
    if(isset($_POST['modifier'])){
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
                    modifier_Produit($id,$titre,$descreption,$prix,$quantite,$image_destination);
                }
            }
            
        } 
            modifier_Produit($id,$titre,$descreption,$prix,$quantite);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div class="hero">
    <?php  include 'nav.php' ?>
    <div class="form-box register">
              
              <form method="post">
                  <div>
                     <h2>Modifier Produit</h2>
                  </div>
                  <div class="input-box">
                      <span class="icon"></span>
                      <input type="text" name="titre"  value="<?php echo $produit['titre']; ?>">
                      <label>Titre</label>
                   </div>
                   <div class="input-box">
                       <span class="icon"></span>
                       <input type="text" name="desc" value="<?php echo $produit['descreption'];?>">
                       <label>Descreption</label>
                   </div>
                   <div class="input-box">
                       <span class="icon"></span>
                       <input type="real" name="prix" value="<?php echo $produit['prix'];?>">
                       <label>Prix</label>
                   </div>
                   <div class="input-box">
                       <span class="icon"></ion-icon></span>
                       <input type="number" name="quantite" value="<?php echo $produit['quantite'];?>">
                       <label>Quantite</label>
                   </div>
                   <div class="input-box">
                       <input type="file" name="image" id="image">
                       <label for="image">Selectionner une image : </label>
                   </div>
                   <button type="submit" name="modifier" class="btn btn-secondary">Modifier</button>
               </form>
         </div>
    </div>
</body>
</html>