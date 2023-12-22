<?php
include 'fun/functions.php';
$totals = 0;
$tab = getPanier();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="ac.css">
    <link rel="stylesheet" href="product.css">
    <title>Panier</title>
</head>

<body>
    <div class="hero">
        <?php include 'nav.php';
        //echo getDateAc();
        ?>
        <table class="table table-dark">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="bg-transparent">#</th>
                    <th scope="col" class="bg-transparent">Image</th>
                    <th scope="col" class="bg-transparent">Titre</th>
                    <th scope="col" class="bg-transparent">Description</th>
                    <th scope="col" class="bg-transparent">Prix</th>
                    <th scope="col" class="bg-transparent">Quantite</th>
                    <th scope="col" class="bg-transparent">Total</th>
                    <th scope="col" class="bg-transparent">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $total = 0;
                foreach ($tab as $key => $quantite) {
                    $produit = getProduitById($key);
                    $total = $quantite * $produit['prix'];
                    $totals += $total; ?>
                    <form action="ajouterpanier.php" method="post">
                        <tr>
                            <th scope="row" class="bg-transparent"><?php echo $produit['id']; ?></th>
                            <td class="bg-transparent">
                                <a href="produit.php?id=<?php echo $produit['id']; ?>">
                                    <img src="<?php echo $produit['chemin']; ?>" alt="image" width="50px" height="50px">
                                </a>
                            </td>
                            <td class="bg-transparent"><?php echo $produit['titre']; ?></td>
                            <td class="bg-transparent"><?php echo $produit['descreption']; ?></td>
                            <td class="bg-transparent"><?php echo $produit['prix']; ?></td>
                            <td class="bg-transparent">

                                <input type="number" name="quantitedemander" min="0" max="<?php echo $produit['quantite']; ?>" value="<?php echo $quantite; ?>">
                            </td>
                            <td><?php echo $total ?></td>

                            <td class="row bg-transparent">
                                <div class="col-12">
                                    <input type="submit" value="Modifier" class="btn btn-success" name="envoyer">
                                    <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">
                                </div>
                                <div class="col-2"></div>
                                <div class="col-12">
                                    <a href="viderpanier.php?id=<?php echo $produit['id']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                    </form>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form method="post">
            <div class="modifier">
                <a>Totals: <?php echo $totals; ?></a>
                <button type="submit" class="btn btn-warning" name="payer">Payer</button>
            </div>

        </form>


        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST['payer'])) {
    if (isset($_SESSION["utilisateur"])) {
        $id_personne = $_SESSION['utilisateur']['id'];
        AjouterCommande($totals, $id_personne);
    } else {
        header('Location:home.php');
    }
}
?>