<?php
include 'fun/functions.php';
$commandes=getAllCommandes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="ac.css">
    <title>Gestion Commande</title>
</head>
<body>
    <div class="hero">
    <?php include 'nav.php';?>
        <table class="table table-dark">
            <thead>
                <caption><h2>Gestion Commande</h2></caption>
                <tr>
                    <th scope="col" class="bg-transparent">#</th>
                    <th scope="col" class="bg-transparent">Utilisateur</th>
                    <th scope="col" class="bg-transparent">Date Commande</th>
                    <th scope="col" class="bg-transparent">Les Produits => Quantite</th>
                    <th scope="col" class="bg-transparent">Totale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($commandes as $commande){
                    $id= $commande['id_personne'];
                    $personne = getPersonneById($id);
                    ?>
                <tr>
                    <th scope="row" class="bg-transparent"><?php echo $commande['id_commande'];?></th>
                    <td class="bg-transparent"><?php echo $personne['nom'];?></td>
                    <td class="bg-transparent"><?php echo $commande['date_commande'];?></td>
                    <td class="bg-transparent">
                        <?php
                            $tab_commande_produit= getCommandeProduitById($commande['id_commande']);
                            foreach($tab_commande_produit as $key => $value){
                                $produit=getProduitById($value['id_produit'])
                                ?>
                                <?php echo $produit['titre'] ." => ".$value['quantite']."<br>";?> 
                            <?php } ?>
                    </td>
                    <td class="bg-transparent"><?php echo $commande['totale'];?></td>
               </tr>
               <?php } ?>
            </tbody>
        </table>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>