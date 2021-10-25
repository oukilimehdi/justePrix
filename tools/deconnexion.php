<?php
session_start();

$cnx = "";

$_SESSION['nomUser'] = null;
header('Location: ../index.php');