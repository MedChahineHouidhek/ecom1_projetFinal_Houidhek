<?php
require_once 'functions/functions.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = getProduitById($id);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <!-- <link rel="stylesheet" href="home.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">-->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="ac.css">

</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php' ?>
        <form action="ajouterpanier.php" method="post">
            <main>
                <section class="product">
                    <a href="produit.php?id=<?php echo $produit['id']; ?>">
                        <img src="<?php echo $produit['chemin']; ?>" alt="image">
                    </a>
                    <h2><?php echo $produit['titre']; ?></h2>
                    <p><?php echo $produit['descreption']; ?></p>
                    <span class="price"><?php echo $produit['prix']; ?></span>
                    <label for="quantitedemander">Quantite</label>
                    <input type="number" name="quantitedemander" min=0 max=<?php echo $produit['quantite']; ?>>
                </section>
                <input type="submit" value="Ajouter au panier" class="btn btn-warning" name="envoyer">
                <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">

            </main>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</body>

</html>