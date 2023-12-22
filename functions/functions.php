<?php
session_start();
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
//-----------fonction pour ce connecte a la base de donnee------------------------------
function Connexion_BD()
{
    $serveur = "localhost";
    $utilisateur = "root";
    $motdepasse = "";
    $basededonne = "textsite";

    //connexion a la base de donnee
    $connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $basededonne);
    // verifier si la connexion marche
    if (!$connexion) {
        die("Echec de la connexion a la base de donnees: " . mysqli_connect_error());
    }
    return $connexion;
}
//------------fonction inscreption----------------------------------------------------
function inscription($nom, $email, $mot_de_passe)
{
    //connexion a la base de donnee
    $connexion = Connexion_BD();
    //Eviter les attaques par injection sql
    $nom = mysqli_real_escape_string($connexion, $nom);
    $email = mysqli_real_escape_string($connexion, $email);
    $mot_de_passe = mysqli_real_escape_string($connexion, $mot_de_passe);
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $select = mysqli_query($connexion, "SELECT * FROM personne WHERE email='$email'");
    if (mysqli_num_rows($select) == 1) {
        echo ('This email address is already used!');
    } else {
        $sql1 = 'INSERT INTO personne (nom,email,mot_de_passe) values (?,?,?)';
        $stmtt = $connexion->prepare($sql1);
        $stmtt->bind_param("sss", $nom, $email, $mot_de_passe_hash);
        $result = $stmtt->execute();
        if ($result) {
            $id = $connexion->insert_id;
            insertRole($id);
            header('Location:./accessoires.php');
        } else {
            echo "Une erreur est survenue";
        }
    }
}
function insertRole($id)
{
    $connexion = Connexion_BD();
    $requete = 'INSERT INTO personnerole (id_personne,id_role) VALUES (?,?)';
    $stmt = $connexion->prepare($requete);
    $id_client = 2;
    $stmt->bind_param('ii', $id, $id_client);
    $stmt->execute();
}
//------------fonction pour ajouter un produit-----------------------------------------
function Ajouter_Produit($titre, $descreption, $prix, $quantite, $chemin = " ")
{
    $conn = Connexion_BD();
    $requete = 'INSERT INTO produit(titre,descreption,prix,quantite) Values(?,?,?,?)';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('ssdi', $titre, $descreption, $prix, $quantite);
    $resultat = $stmt->execute();
    $id_produit = $conn->insert_id;
    $stmt->close();
    $conn->close();

    if ($resultat) {
        if (!empty($chemin)) {
            enregistrerImage($chemin, $id_produit);
        }
        header('Location: ./gestionproduit.php');
    } else {
        echo 'echec d ajout';
    }
    $stmt->close();
    $conn->close();
}
function getProduit()
{
    $conn = Connexion_BD();
    $requete = 'SELECT p.id, p.titre,p.descreption, p.prix, p.quantite, i.chemin from produit p JOIN image i on p.id =i.id_produit';
    $stmt = $conn->prepare($requete);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $produits = array();

    foreach ($resultats as $produit) {
        $produits[] = $produit;
    }
    return $produits;
}
function getCommandeProduitById($id)
{
    $conn = Connexion_BD();
    $requete = 'SELECT * from commandeproduit where id_commande=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $commandes = array();

    foreach ($resultats as $commande) {
        $commandes[] = $commande;
    }
    return $commandes;
}
//-----------fonction recuperer un produit avec son id----------------------------
function getProduitById($id)
{
    $conn = Connexion_BD();
    $requete = 'SELECT p.id, p.titre,p.descreption, p.prix, p.quantite, i.chemin from produit p JOIN image i on p.id =i.id_produit where p.id = ?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $resultat = $stmt->get_result();
    $produit = $resultat->fetch_assoc();
    return $produit;
}
//----------fonction modifier un produit------------------------------------------------------
function modifier_Produit($id, $titre, $descreption, $prix, $quantite)
{
    $conn = Connexion_BD();
    $requete = 'UPDATE produit set titre=?,descreption=?,prix=?,quantite=? where id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("ssdii", $titre, $descreption, $prix, $quantite, $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        // header('Location: ./gestionproduit.php');
        if (!empty($image_destination)) {
            modifierImage($id, $image_destination);
        } else {
            header('Location: gestionproduit.php');
        }
    } else {
        echo " Une erreur lors de la modification";
    }
}
//-----------fonction supprimer un produit-------------------------------------------------------
function supprimerProduit($id)
{
    $conn = Connexion_BD();
    $requete = 'DELETE FROM produit WHERE id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id);
    $resultat = $stmt->execute();
    $stmt->close();
    $conn->close();

    if ($resultat) {
        header('Location: gestionproduit.php');
    } else {
        echo 'erreur lors de la supprission';
    }
}
//----------fonction ajouter au panier-----------------------------------
function ajouterPanier($id, $quantitedemander)
{
    $_SESSION['panier'][$id] = $quantitedemander;
    header('Location: ./panier.php');
}
function countElementsPanier()
{
    $taillePanier = count($_SESSION['panier']);
    return $taillePanier;
}
function modifierImage($image_destination, $id_produit)
{
    $conn = Connexion_BD();
    $sql = "UPDATE image set chemin = ? where id_produit=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $image_destination, $id_produit);
    $resultatup = $stmt->execute();
    if ($resultatup) {
        header('Location:./gestionproduit.php');
    }
}
function getPanier()
{
    return $_SESSION['panier'];
}

function enregistrerImage($chemin, $id_produit)
{
    $conn = Connexion_BD();
    $sql = 'INSERT INTO  image(chemin,id_produit) Values(?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $chemin, $id_produit);
    $result = $stmt->execute();
    if ($result) {
        header("Location: ./gestionproduit.php");
    } else {
        echo "Une erreur c'est produit";
    }
}
function viderPanier($id)
{
    unset($_SESSION['panier'][$id]);
}

function getDateAc()
{
    return $date_commande = date("Y-m-d H:m:s");
}

// fonction pour ajouter une commande 
function AjouterCommande($totale, $id_personne)
{
    $conn = Connexion_BD();
    $sql = 'INSERT INTO  commande(totale,date_commande,id_personne) Values(?,?,?)';
    $stmt = $conn->prepare($sql);
    $date_commande =  getDateAc();
    $stmt->bind_param('dsi', $totale, $date_commande, $id_personne);
    $result = $stmt->execute();
    if ($result) {
        $id_commande = $conn->insert_id;
        $monPanier = getPanier();
        foreach ($monPanier as $id_produit => $quantite) {
            AjouterCommandeProduit($id_commande, $id_produit, $quantite);
        }
        header('Location: ./gestioncommande.php');
    }
}
function getAllCommandes()
{
    $conn = Connexion_BD();
    $requete = 'SELECT * from commande';
    $stmt = $conn->prepare($requete);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $commandes = array();
    foreach ($resultats as $commande) {
        $commandes[] = $commande;
    }
    return $commandes;
}
function AjouterCommandeProduit($id_commande, $id_produit, $quantite)
{
    $conn = Connexion_BD();

    $sql = 'INSERT INTO  commandeproduit(id_commande,id_produit,quantite) Values(?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $id_commande, $id_produit, $quantite);
    $result = $stmt->execute();
}
function getPersonneById($id)
{
    $conn = Connexion_BD();
    $requete = 'SELECT p.id, p.nom, p.email,p.mot_de_passe, r.titre from personne as p JOIN personnerole as pr on p.id=pr.id_personne JOIN role as r on pr.id_role=r.id where p.id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $resultat = $stmt->get_result();
    $personne = $resultat->fetch_assoc();
    return $personne;
}
function modifier_Profil($nom, $email, $mot_de_passe, $id)
{
    $conn = Connexion_BD();
    $requete = 'UPDATE personne set nom=?,email=?,mot_de_passe=? where id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("sssi", $nom, $email, $mot_de_passe, $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        header('Location: ./profil.php');
    } else {
        echo " Une erreur lors de la modification";
    }
}
function getPersonne()
{
    $conn = Connexion_BD();
    $requete = 'SELECT p.id, p.nom, p.email, r.titre from personne as p JOIN personnerole as pr on p.id=pr.id_personne JOIN role as r on pr.id_role=r.id';
    $stmt = $conn->prepare($requete);
    $stmt->execute();
    $resultats = $stmt->get_result();
    $personne = array();
    foreach ($resultats as $personne) {
        $personnes[] = $personne;
    }
    return $personnes;
}
function supprimerPersonne($id)
{
    $conn = Connexion_BD();
    $requete = 'DELETE FROM personne WHERE id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param('i', $id);
    $resultat = $stmt->execute();
    $stmt->close();
    $conn->close();

    if ($resultat) {
        header('Location: gestionutilisateur.php');
    } else {
        echo 'erreur lors de la supprission';
    }
}
function modifierrole($id, $titre)
{
    $conn = Connexion_BD();
    $requete = 'UPDATE role as r set r.titre=? join personnerole as pr on r.id=pr.id_role join personne as p on pr.id_personne=p.id where p.id=?';
    $stmt = $conn->prepare($requete);
    $stmt->bind_param("si", $titre, $id);
    $resultat = $stmt->execute();
    if ($resultat) {
        header('Location: ./gestionutilisateur.php');
    } else {
        echo " Une erreur lors de la modification";
    }
}
