//function qui check que toute les contraintes du formulaire sont réspéctées, avant de le soumettre dynamiquement
document.getElementById('btnRegister').addEventListener('click', verifyInputRegister); 
 
 function verifyInputRegister(){

    //je récupere les élements du DOM
    let name = document.getElementById('name').value;
    let lastname = document.getElementById('lastname').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let password2 = document.getElementById('password2').value;

    let pName = document.getElementById('messageErreur');
    pName.innerHTML="";
    let mdpLength = document.getElementById('mdpLength');
    mdpLength.innerHTML="";
    let mdpSame = document.getElementById('mdpSame');
    mdpSame.innerHTML="";
    
    //je crée une variable soumettre qui va servir de flag
    let soumettre = true;

    //si un des champs est vide, j'affiche un message a l'utilisateur
    if(name.length == 0 || lastname.length == 0 || email.length == 0 || password.length == 0 || password2.length == 0) {
        pName.innerHTML="veuillez remplir tous les champs";
        soumettre = false;
    }
    
    //si les mots de passe ne contiennent pas au moins 5 caractères, j'affiche un message a l'utilisateur
    if((password.length || password2.length) < 5) {
        mdpLength.innerHTML="votre mot de passe doit contenir au moins 5 caratéres";
        soumettre = false;

        //je vérifie si les deux mots de passe sont identique
            if(password != password2) {
                mdpSame.innerHTML="veuillez saisir deux mots de passe identique";
                soumettre = false;
            }
    }

    //si soumettre = true alors toute les contraintes sont respéctées, je submit le formulaire
    if(soumettre){
       document.getElementById('form').submit();
    }
}