<?php
require_once 'functions/functions.php';
$produits = getProduit();
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
    <title>Gestion Produits</title>
</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php'; ?>
        <table class="table table-dark">
            <caption><a href="ajoutproduit.php" class="btn btn-secondary">Ajouter Produit</a></caption>
            <thead>
                <tr>
                    <th scope="col" class="bg-transparent">#</th>
                    <th scope="col" class="bg-transparent">Image</th>
                    <th scope="col" class="bg-transparent">Titre</th>
                    <th scope="col" class="bg-transparent">Description</th>
                    <th scope="col" class="bg-transparent">Prix</th>
                    <th scope="col" class="bg-transparent">Quantite</th>
                    <th scope="col" class="bg-transparent">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produits as $produit) { ?>
                    <tr>
                        <th scope="row" class="bg-transparent"><?php echo $produit['id'] ?></th>
                        <td class="bg-transparent"><img src="<?php echo $produit['chemin']; ?>" alt="image" width="50px" height="50px"></td>
                        <td class="bg-transparent"><?php echo $produit['titre'] ?></td>
                        <td class="bg-transparent"><?php echo $produit['descreption'] ?></td>
                        <td class="bg-transparent"><?php echo $produit['prix'] ?></td>
                        <td class="bg-transparent"><?php echo $produit['quantite'] ?></td>
                        <td class="row bg-transparent">
                            <div class="col-5">
                                <a href="modifierproduit.php?id=<?php echo $produit['id']; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <a href="supprimerproduit.php?id=<?php echo $produit['id']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>