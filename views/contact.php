 <?php
    ob_start();
   
?> 

    <h1>Nous contacter</h1>

 <div class=" container">
     <div class=" formulaires col-md-6">
        <form action="../controllers/contactController.php" method="post" class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" class="form-control" autofocus required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Entrez votre email" class="form-control" required>
            <label for="sujet">Sujet:</label>
            <input type="text" name="sujet" id="sujet" placeholder="Entrez votre sujet" class="form-control" required>
            <label for="message">Message:</label>
            <textarea rows="4" name="message" id="message" placeholder="Entrez votre message" class="form-control mb-2" required> </textarea>

            <button class='btn btn-success btn-block' type="submit" name="btn">Envoyer</button>
            <p>
                <?php if(!empty($_SESSION['messageEnvoye'])) {
                echo '<p class="alert alert-danger">'. $_SESSION['messageEnvoye'] . '</p>';
                $_SESSION['messageEnvoye'] = "";
                }?>  
            </p>
            <p>
                <?php if(!empty($_SESSION['erreurMessageEnvoye'])) {
                echo '<p class="alert alert-danger">'. $_SESSION['erreurMessageEnvoye'] . '</p>';
                $_SESSION['erreurMessageEnvoye'] = "";
                }?>  
            </p>
        

        </form>
    </div>
 </div>





<?php

    $content = ob_get_clean();
    include "template.php";

?>

