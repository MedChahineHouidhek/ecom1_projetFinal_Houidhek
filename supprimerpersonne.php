<?php
require_once 'functions/functions.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    supprimerPersonne($id);
}
