<?php 
include 'fun/functions.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    viderPanier($id);
    header('Location: panier.php');
}
?>