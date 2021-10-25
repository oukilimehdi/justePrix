<?php
session_start();

   
    if(isset($_POST['name']) && !empty($_POST['name']) && 
    isset($_POST['lastname']) && !empty($_POST['lastname']) &&
    isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['password2']) && !empty($_POST['password2'])) {
      
        $name = htmlspecialchars($_POST['name']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);


    
        if($password === $password2) {
            require_once '../tools/maConnexion.php';
            
            
            $sql = "SELECT email FROM users WHERE email = :email";
            $cnx = Connexion::getPdo();
            $query = $cnx->prepare($sql);
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->execute();
            $emailInsere = $query->fetchAll();
           
            if($emailInsere){
                $_SESSION['emailExistant'] = "Email déja existant";
                header("Location: ../index.php?section=register");
                die(); 
            }

            $password = hash('sha256',$password);
            
            
            $sql = 'INSERT INTO users (name,lastname,email,password) VALUES (:name,:lastname,:email,:password)';
           
            $query = $cnx->prepare($sql);
          
            $query->bindParam(':name',$name, PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname, PDO::PARAM_STR);
            $query->bindParam(':email',$email, PDO::PARAM_STR);
            $query->bindParam(':password',$password, PDO::PARAM_STR);
           
            $query->execute();
           
            require_once '../tools/deconnexion.php';
        }

    } else {
        
        header('Location: ../index.php?section=register');
    }

