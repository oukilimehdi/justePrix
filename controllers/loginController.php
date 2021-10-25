<?php
session_start();

$_SESSION['noUser'] = "";

if(isset($_POST['btn'])){

    if(isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['password']) && !empty($_POST['password'])) {
        
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
       
        $password = hash('sha256', $password);

      
        $sql= 'SELECT * FROM users WHERE email = :email AND password = :password';
        require_once '../tools/maConnexion.php';
        $cnx = Connexion::getPdo();
        $query = $cnx->prepare($sql);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
       
        $query->execute();
        $user = $query->fetch();
      
        if($user){
            $_SESSION['nomUser'] = $user['lastname'];
            header("Location: ../index.php?section=game");
            
       
        } else {
            $_SESSION['noUser'] = "email ou mot de passe incorrect";
            header("Location: ../index.php");
        }
    
    } else {
        header("Location: ../index.php");
    }
}
