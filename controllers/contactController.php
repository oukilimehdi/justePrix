<?php
session_start();
//j'importe les class que je vais utiliser
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

        //je require l'autoload pour que le chargement des class se fasse automatiquement
        require "../vendor/autoload.php"; 
        
        //j'instancie un nouvel objet PHPMailer
        $mail = new PHPMailer();

        try{
            //configuration
            // je veux les informations de debug
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 

            //configure le SMTP (protocole de transfert de mail, équivalent au camion de la poste)
            //je configure les attributs et les méthodes de mon objet
            $mail->isSMTP();
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'oukili.mehdi@gmail.com';                     
            $mail->Password   = 'mehdidu93600';   
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;

            //charset
            $mail->Charset = "utf-8";

            //destinataires
            $mail->addAddress("oukili.mehdi@gmail.com");
            $mail->addCC("copier@hotmail.com"); // pour avoir une copie
            $mail->addBCC("copieCachee@hotmail.com"); // pour avoir une copie cachée

            //expediteur
            $mail->setFrom($email,$nom);

            //contenu
            $mail->Subject = $sujet;
            $mail->Body = $message;

            //si tout est , j'envoie le mail et confirme à  l'utilisateur le succès de l'envoi
            $mail->send();
            $_SESSION['messageEnvoye'] = 'votre message a bien été envoyé';
            header('Location: ../index.php?section=contact');

        } catch(Exception $e){
            // j'informe l'utilisateur en cas d'erreurs lors de l'envoi
            header('Location: ../index.php?section=contact');
            $_SESSION['erreurMessageEnvoye'] = 'une érreure est survenue';
            //echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
        }


    } else {
        header('Location: ../index.php?section=contact');
    }




?>