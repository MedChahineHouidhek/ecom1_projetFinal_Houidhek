<?php
require_once 'functions/functions.php';
$personnes = getPersonne();
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
    <title>Gestion utilisateur</title>
</head>

<body>
    <div class="hero">
        <?php require_once 'nav.php'; ?>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col" class="bg-transparent">#</th>
                    <th scope="col" class="bg-transparent">Nom</th>
                    <th scope="col" class="bg-transparent">Email</th>
                    <th scope="col" class="bg-transparent">Role</th>
                    <th scope="col" class="bg-transparent">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($personnes as $personne) { ?>
                    <tr>
                        <th scope="row" class="bg-transparent"><?php echo $personne['id'] ?></th>
                        <td class="bg-transparent"><?php echo $personne['nom'] ?></td>
                        <td class="bg-transparent"><?php echo $personne['email'] ?></td>
                        <td class="bg-transparent"><?php echo $personne['titre'] ?></td>
                        <td class="row bg-transparent">
                            <div class="col-10">
                                <a href="supprimerpersonne.php?id=<?php echo $personne['id']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i>
                                </a>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-10">
                                <a href="modifierrole.php?id=<?php echo $personne['id']; ?>" class="btn btn-success"><i class="bi bi-pencil-square"></i>
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