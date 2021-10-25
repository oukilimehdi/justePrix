<?php
    ob_start();
?>

    <div class="container">
           <h1>Créer un compte</h1>
    </div>
 
    <div  class="formulaires col-md-5">
        <form action="../controllers/registerController.php" id="form" method="post" class="form-group">
            <p style="color: red" id="messageErreur"></p>
            <input class="form-control mb-2" type="text" name="name" id="name"  placeholder="Saisir votre nom" autofocus >
            <input class="form-control mb-2" type="text" name="lastname" id="lastname"  placeholder="Saisir votre prénom" >
           <input class="form-control mb-2" type="email" name="email" id="email" placeholder="Saisir votre email" >
           <input class="form-control mb-2" type="password" name="password" id="password"  placeholder="Saisir votre mot de passe">
           <p style="color: red" id='mdpLength'> </p>
           <input class="form-control mb-2" type="password" name="password2" id="password2"  placeholder="Répéter votre mot de passe" >
           <p style="color: red" id='mdpSame'> </p>
           <button class="btn btn-warning btn-block" id="btnRegister" name='btn' type="button"> s'enregistrer</button> <br>
           <?php 
                if(!empty($_SESSION['emailExistant'])) {
                echo '<p class="alert alert-danger">'. $_SESSION['emailExistant'] . "</p>";
                $_SESSION['emailExistant'] = "";
           } ?>

           <p >Vous avez déja un compte?<a href="index.php?section=login" class="small"> connexion</a></p> 
           
        </form>
    </div>
  
<?php
$content = ob_get_clean();
include "template.php";
?>