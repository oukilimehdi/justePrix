<?php
session_start();
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


    if(isset($_POST['nom']) && !empty($_POST['nom']) && 
    isset($_POST['email']) && !empty($_POST['email']) && 
    isset($_POST['sujet']) && !empty($_POST['sujet']) && 
    isset($_POST['message']) && !empty($_POST['message'])) {

        $nom = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $sujet = htmlspecialchars($_POST['sujet']);
        $message = htmlspecialchars($_POST['message']);

        require "../vendor/autoload.php"; 
        
        
        $mail = new PHPMailer();

        try{
           
            $mail->isSMTP();
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'mettre son adresse email';                     
            $mail->Password   = 'mettre son mot de passe';   
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;

            $mail->Charset = "utf-8";

            $mail->addAddress("mettre son adresse email");
            $mail->addCC("copier@hotmail.com"); 
            $mail->addBCC("copieCachee@hotmail.com"); 

            $mail->setFrom($email,$nom);

            //contenu
            $mail->Subject = $sujet;
            $mail->Body = $message;

            
            $mail->send();
            $_SESSION['messageEnvoye'] = 'votre message a bien été envoyé';
            header('Location: ../index.php?section=contact');

        } catch(Exception $e){
         
            header('Location: ../index.php?section=contact');
            $_SESSION['erreurMessageEnvoye'] = 'une érreure est survenue';
           
        }


    } else {
        header('Location: ../index.php?section=contact');
    }




?>