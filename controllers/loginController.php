<?php
session_start();

$_SESSION['noUser'] = "";
// je vérifie que tous les champs sont bien remplis
if(isset($_POST['btn'])){

    if(isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['password']) && !empty($_POST['password'])) {
        
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        //je hash a nouveau le mot de passe du user pour pouvoir le comparer a celui présent en base de données
        $password = hash('sha256', $password);

        //ma requete vérifie si il y a un user existant en base de donnée qui contient la bonne combinaison email|mot de passe
        $sql= 'SELECT * FROM users WHERE email = :email AND password = :password';
        require_once '../tools/maConnexion.php';
        $cnx = Connexion::getPdo();
        $query = $cnx->prepare($sql);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
       
        $query->execute();
        $user = $query->fetch();
       //si un user existe alors je met son prénom en variable de session afin de l'acceuillir de maniére personaliser sur la base du jeu
        if($user){
            $_SESSION['nomUser'] = $user['lastname'];
            header("Location: ../index.php?section=game");
            
        //si le user est inéxistant je le redirige vers la page d'acceuil et je lui affiche un message
        } else {
            $_SESSION['noUser'] = "email ou mot de passe incorrect";
            header("Location: ../index.php");
        }
    //si tous les champs ne sont pas remplis, je le redirige vers la page d'acceuil
    } else {
        header("Location: ../index.php");
    }
}
