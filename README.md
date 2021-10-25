# justePrix
jeux ou il faut trouver le bon nombre entre 1 et 100 en un nombre d'éessaies limités
il faut créer un compte user et se connecter pour avoir accès a la page de jeux.
sinon enlever dans views/game.php  
    if(!isset($_SESSION['nomUser'])) {
        header('Location: ../index.php');
    }
