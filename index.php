<?php
//j'ouvre la session afin de pouvoir passer des variables entre les différentes pages de mon application
session_start();

    // j'inclus la connexion a la base de données
    include 'tools/maConnexion.php';

$section = 'home';
if(isset($_GET['section']) && !empty($_GET['section'])){

    $section = htmlspecialchars($_GET['section']);
}
//a l'aide du switch, je redirige le user vers la bonne page, en récupérant l'url avec la super global $_GET
switch ($section) {
    case "home":
        include_once 'views/login.php';
        break;
    
    case "register":
        include_once 'views/register.php';
        break;
    
    case "game":
        include_once 'views/game.php';
        break;

    case "logout":
        include_once 'tools/deconnexion.php';
        break;

    case "contact":
        include_once 'views/contact.php';
        break;
    
    default:
        include_once 'views/login.php';  

}

