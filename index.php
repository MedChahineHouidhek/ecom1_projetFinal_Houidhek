<?php
require_once 'functions/functions.php';
$produits = getProduit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ac.css">
    <link rel="stylesheet" href="home.css">
    <title>index</title>
</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php'; ?>
        <main>
            <?php foreach ($produits as $produit) { ?>
                <section class="product">
                    <a>
                        <img src="<?php echo $produit['chemin']; ?>" alt="image">
                    </a>
                    <h2><?php echo $produit['titre']; ?></h2>
                    <p><?php echo $produit['descreption']; ?></p>
                    <span class="price"><?php echo $produit['prix']; ?></span>
                </section>
            <?php } ?>
        </main>
    </div>
</body>

</html>