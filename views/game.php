<?php
    ob_start();
    //la page game est accéssible uniquement aux users qui se sont connécté
    if(!isset($_SESSION['nomUser'])) {
       header('Location: ../index.php');
    }
?>
   <div class="main-container">

     <div class="container">
        <h1 class="h1">salut <?= $_SESSION['nomUser']; ?>, Trouve le bon nombre !</h1>
        <p>trouve le bon nombre entre 0 et 100. tu as 6 essais</p>
        <div class="vies">
            <ion-icon name="heart-outline"></ion-icon>
            <ion-icon name="heart"></ion-icon>
        </div>

        <form id="inputBox">
            <label for="number">Entrez un nombre :</label>
            <input type="number" id="number" min="0" max="100" required>
            <button id="essayerBtn" type="submit">Essayer</button>
            <p id="message"></p>
            <button id="rejouer">Rejouer</button>
        </form>
        <p id="details">* Brulant = &plusmn; 2 ; Chaud = &plusmn; 5 ; Tiède = &plusmn; 10 ; Froid = + de 10 </p>
    </div>
   
   </div>
     <p class="btn btn-success btn-sm" > <a style="color:white; text-decoration:none" href="../tools/deconnexion.php">déconnexion</a> </p>
<?php
$content = ob_get_clean();
include "templateGame.php";
?>

