<?php
    ob_start();
?>

<div class="container">
<h1 style="margin-bottom: 50px;">Se connecter</h1>

    <div class="formulaires" class=" col-md-4">
        <form action="../controllers/loginController.php" method="post" class="form-group">
            <input class="form-control mb-2" type="email" name="email" id="email" placeholder="Saisir votre email" autofocus>
            <input class="form-control" type="password" name="password" id="password"  placeholder="Saisir votre mot de passe" >
            <button name='btn' class="btn btn-warning btn-block  mt-2" type="submit">Connexion</button> <br>
                <p>
                     <?php if(!empty($_SESSION['noUser'])) {
                        echo '<p class="alert alert-danger">'. $_SESSION['noUser'] . '</p>';
                        $_SESSION['noUser'] = "";
                    }?>  
                </p>
            <p>Vous n'avez pas de compte?<a href="index.php?section=register" class="small"> créer un compte</a></p> 
        
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include "template.php";
?>

