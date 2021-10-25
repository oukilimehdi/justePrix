<?php
session_start();

    //je vérifie que tous champs soit remplis
    if(isset($_POST['name']) && !empty($_POST['name']) && 
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['password2']) && !empty($_POST['password2'])) {
        //je nettoie et sécurise les valeurs entrées par l'utilisateur juste avant de  les affécter
        // dans des variables, afin de préparer l'insertion en base de données
        $name = htmlspecialchars($_POST['name']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);


       //je vérifie que les deux mots de passe insérés par le user sont strictement identique
        if($password === $password2) {
            require_once '../tools/maConnexion.php';
            
            //pour respecter le cahier des charges, je vérifie que l'email entré par le user n'existe pas déja en base de données
            $sql = "SELECT email FROM users WHERE email = :email";
            $cnx = Connexion::getPdo();
            $query = $cnx->prepare($sql);
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->execute();
            $emailInsere = $query->fetchAll();
            //si l'email existe déja, je renvois le user vers le formulaire register
            if($emailInsere){
                $_SESSION['emailExistant'] = "Email déja existant";
                header("Location: ../index.php?section=register");
                die(); 
            }

            //pour des raisons de sécurités, je hash le mot de passe du user avant de l'insérer en base de données
            $password = hash('sha256',$password);
            
            //je crée ma requete
            $sql = 'INSERT INTO users (name,lastname,email,password) VALUES (:name,:lastname,:email,:password)';
            //je prépare ma requete
            $query = $cnx->prepare($sql);
            // je fait une derniére vérification sur le types de données entrées par le user    
            $query->bindParam(':name',$name, PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname, PDO::PARAM_STR);
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->bindParam(':password',$password, PDO::PARAM_STR);
            // j'execuse ma requete
            $query->execute();
            //je me déconnecte de la base de données et redirige le user vers la page login
            require_once '../tools/deconnexion.php';
        }

    } else {
        //si tous les champs ne sont pas tous remplis ou que les deux mots de passe du user ne sont pas
        //identique, alors je redirige le user vers le formulaire register
        header('Location: ../index.php?section=register');
    }


        //    //je vérifie que les deux mots de passe insérés par le user sont strictement identique
        //    if($password === $password2) {

            


        //     //pour des raisons de sécurité, je hash le mot de passe du user avant de l'insérer en base de données
        //     $password = hash('sha256',$password);
        //     require_once '../tools/maConnexion.php';
        //     //je crée ma requete
        //     $sql = 'INSERT INTO users (name,lastname,email,password) VALUES (:name,:lastname,:email,:password)';
        //     //je prépare ma requete
        //     $query = $cnx->prepare($sql);
        //     // je fait une derniére vérification sur le types de données entrées par le user    
        //     $query->bindParam(':name',$name, PDO::PARAM_STR);
        //     $query->bindParam(':lastname',$lastname, PDO::PARAM_STR);
        //     $query->bindParam(':email',$email, PDO::PARAM_STR);
        //     $query->bindParam(':password',$password, PDO::PARAM_STR);
        //     // j'execuse ma requete
        //     $query->execute();
        //     //je me déconnecte de la base de données et redirige le user vers la page login
        //     require_once '../tools/deconnexion.php';
        // }