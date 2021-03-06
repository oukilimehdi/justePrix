<?php

session_start();


    include 'tools/maConnexion.php';

$section = 'home';
if(isset($_GET['section']) && !empty($_GET['section'])){

    $section = htmlspecialchars($_GET['section']);
}

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

