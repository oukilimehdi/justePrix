// je récupere les élements du dom
const divVies = document.querySelector('.vies');
const message = document.getElementById('message');
const formulaire = document.getElementById('inputBox');
const input = document.getElementById('number');
const essayerBtn = document.getElementById('essayerBtn');
const rejouerBtn = document.getElementById('rejouer');
const body = document.getElementsByTagName('body')[0]; //renvoie un array, on selectionne le 1er élement du array

//je met les deux différents icon dans des constantes
const coeurVide = '<ion-icon name="heart-outline"></ion-icon>';
const coeurPlein = '<ion-icon name="heart"></ion-icon>';


//je met les différents fond d'écran que je vais utiliser dans des constantes
const bgFroid = 'linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%)';
const bgTiede = 'linear-gradient(120deg, #f6d365 0%, #fda085 100%)';
const bgChaud = 'linear-gradient(120deg, #ff5858 0%, #f09819 100%)';
const bgBrulant = 'linear-gradient(120deg, #ff0844 0%, #ffb199 100%)';

//je crée deux background-color , un en cas de victoire et l'autre en cas de défaite
const bgWin = 'linear-gradient(-225deg, #231557 0%, #44107A 29%, #ff1361 67%, #fff800 100%)';
const bgLoose = 'linear-gradient(60deg, #29323c 0%, #485563 100%)';

// function play qui va se jouer lors du click sur le bouton essayer
const play = () => {
     // nombre aléatoire entre 1 et 100 inclus.
    const randomNumber = Math.floor(Math.random()*101);
    //constante qui représente le nom de vie total pour trouver le bon nombre
    const totalVies = 6;
     //nombre de vie au départ du joueur, le nombre va évoluer a chaque tentatives
    let vies = totalVies; 
    console.log(randomNumber);

    //actualisation a chaque essai -(toute la logique du jeux)
    //j'empeche l'envoie du formulaire (j'empeche le comportement par default)
    formulaire.addEventListener('submit', (e) => { 
        e.preventDefault();
        //je récupere la valeur insérer ds l'input par le joueur et je la convertis en integer
        const valeurInput = parseInt(input.value);

        // si la valeur est en dessous de 0 et au dessus de 100 on arréte le code
        if(valeurInput <0 || valeurInput > 100) {
            return;
        }

        //si la valeur entrée est égale au numéro aléatoire alors joue le code entre les accolades
        if(valeurInput === randomNumber){
            body.style.backgroundImage = bgWin;
            message.textContent = `BRAVO !!!!  le nombre etait bien ${randomNumber}`
            rejouerBtn.style.display="block";
            essayerBtn.setAttribute("disabled", ""); 
        }

        if(valeurInput != randomNumber){
            if(randomNumber < valeurInput + 3 && randomNumber > valeurInput - 3){
                body.style.backgroundImage = bgBrulant;
                message.textContent = "c'est Brulant !!!" ;
                
            } else if(randomNumber < valeurInput + 6 && randomNumber > valeurInput - 6){
                body.style.backgroundImage = bgChaud;
                message.textContent = "c'est Chaud !";

            } else if(randomNumber < valeurInput + 11 && randomNumber > valeurInput - 11){
                body.style.backgroundImage = bgTiede;
                message.textContent = "c'est Tiéde !" ;
            
            } else {
                body.style.backgroundImage = bgFroid;
                message.textContent = "c'est Froid !" ;
            }
        }
        //j'enléve 1 au nombre de vies a chaque mauvaise réponse
        vies--;
        //je vérifie si le joueur a encore des vies
        verifyLoose();
        //j'actualise le array d'icon
        actualiseCoeurs(vies);
    })

    // fonction qui vérifie si le joeur a perdu (si il n'a plus de vies)
    const verifyLoose = () => {
        if(vies === 0){
            body.style.backgroundImage = "bgLoose";
            body.style.color = "#900";
            // si le joueur n'a plus de vies je désactive le button essayer avec setAttribute()
            essayerBtn.setAttribute("disabled", ""); 
            message.textContent = `Vous avez perdu. La réponse etait ${randomNumber}`;
            //je fait apparaitre le button qui lui permet de rejouer
            rejouerBtn.style.display="block";
        }
    }

    // function qui va actualiser le nombre de coeurs
    const actualiseCoeurs = (vies) => {
        divVies.innerHTML = "";
        let tableauDeVies = [];
        // a chaque tour de boucles on ajoute un coeur plein au array, jusqu'a ce qu'il n'ai plus de vies
        for(let i = 0; i<vies; i++){ 
            tableauDeVies.push(coeurPlein);
        }
        //a chaque tour de boucles j'ajoute un coeur vide au array, tant qu'il reste des tentatives au joueur 
        for(let i = 0; i<totalVies- vies; i++){
            tableauDeVies.push(coeurVide);
        }
        // je parcours le array et j'affiche les coeurs dans le html (dans la divVies)
        tableauDeVies.forEach(coeur => {
            divVies.innerHTML += coeur;
        })
    }

    actualiseCoeurs(vies);

     // je force le rechergement de la page, pour recommencer la partie a zéro
    rejouerBtn.addEventListener("click", (e) => {
        document.location.reload(true);
    })

}

play();



