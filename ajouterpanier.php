<?php 
include 'fun/functions.php';
if(isset($_POST['id'])){
    $id = $_POST['id'];
    
    $quantiteDemander=$_POST['quantitedemander'];
    
    ajouterPanier($id,$quantiteDemander);
}
?>