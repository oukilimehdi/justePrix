<?php
session_start();
// je coupe la connexion a la base de données
$cnx = "";
//je détruit la varibale de session
$_SESSION['nomUser'] = null;
header('Location: ../index.php');