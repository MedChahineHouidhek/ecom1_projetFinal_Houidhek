<?php
include 'fun/functions.php';
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        supprimerPersonne($id);
    }     
?>