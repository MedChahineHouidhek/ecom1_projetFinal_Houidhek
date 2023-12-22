
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css">
</head>
<body">
    <video autoplay loop muted playes_inline class="back_video">
        <source src="images/mp4.mp4" type="video/mp4">
    </video>
       <nav>
       <div class="logo-c">
            <img src="images/logo1.png" alt="Logo" class="logo">
        </div>
            <ul>
                <?php
                if(isset($_SESSION['utilisateur'])){
                   if($_SESSION["utilisateur"]['titre']==="admin"){?>
                       <li><a href="home.php">Home</a></li>
                       <li><a href="gestionproduit.php">Gestion Produit</a></li>
                       <li><a href="gestioncommande.php">Gestion Commande</a></li>
                       <li><a href="gestionutilisateur.php">Gestion Utilisateur</a></li>
                       <li><a href="panier.php" class="btn btn-secondary"><i class="bi bi-cart3"></i><?php echo countElementsPanier(); ?></i></a></li>
                       <li><a href="deconnecte.php">DECONNEXION</a></li>
                       <?php      
                    }else{ ?>
                       <li><a href="home.php">Home</a></li>
                        <?php if(isset($_SESSION['utilisateur'])){?>
                       <li><a href="profil.php">Profil</a></li>
                       <?php }?>
                       <li><a href="accessoires.php">Accessoires</a></li>
                       <li><a href="panier.php" class="btn btn-secondary"><i class="bi bi-cart3"></i><?php echo countElementsPanier(); ?></i></a></li>
                       <li><a href="deconnecte.php">DECONNEXION</li>
                       <?php
                    }
                }else{?>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="accessoires.php">Accessoires</a></li>
                    <button class="btnlogin_popup">CONNEXION</button> 
               <?php } ?>

               
                
            </ul>  
             
       </nav> 
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>  
</body>
</html>