
const divVies = document.querySelector('.vies');
const message = document.getElementById('message');
const formulaire = document.getElementById('inputBox');
const input = document.getElementById('number');
const essayerBtn = document.getElementById('essayerBtn');
const rejouerBtn = document.getElementById('rejouer');
const body = document.getElementsByTagName('body')[0];


const coeurVide = '<ion-icon name="heart-outline"></ion-icon>';
const coeurPlein = '<ion-icon name="heart"></ion-icon>';



const bgFroid = 'linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%)';
const bgTiede = 'linear-gradient(120deg, #f6d365 0%, #fda085 100%)';
const bgChaud = 'linear-gradient(120deg, #ff5858 0%, #f09819 100%)';
const bgBrulant = 'linear-gradient(120deg, #ff0844 0%, #ffb199 100%)';

const bgWin = 'linear-gradient(-225deg, #231557 0%, #44107A 29%, #ff1361 67%, #fff800 100%)';
const bgLoose = 'linear-gradient(60deg, #29323c 0%, #485563 100%)';


const play = () => {
   
    const randomNumber = Math.floor(Math.random()*101);
    
    const totalVies = 6;
    
    let vies = totalVies; 
    console.log(randomNumber);


    
    formulaire.addEventListener('submit', (e) => { 
        e.preventDefault();
        
        const valeurInput = parseInt(input.value);

       
        if(valeurInput <0 || valeurInput > 100) {
            return;
        }

  
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
        vies--;
      
        verifyLoose();
        
        actualiseCoeurs(vies);
    })

    
    const verifyLoose = () => {
        if(vies === 0){
            body.style.backgroundImage = "bgLoose";
            body.style.color = "#900";
           
            essayerBtn.setAttribute("disabled", ""); 
            message.textContent = `Vous avez perdu. La réponse etait ${randomNumber}`;
          
            rejouerBtn.style.display="block";
        }
    }

   
    const actualiseCoeurs = (vies) => {
        divVies.innerHTML = "";
        let tableauDeVies = [];
        
        for(let i = 0; i<vies; i++){ 
            tableauDeVies.push(coeurPlein);
        }
     
        for(let i = 0; i<totalVies- vies; i++){
            tableauDeVies.push(coeurVide);
        }
        
        tableauDeVies.forEach(coeur => {
            divVies.innerHTML += coeur;
        })
    }

    actualiseCoeurs(vies);

    
    rejouerBtn.addEventListener("click", (e) => {
        document.location.reload(true);
    })

}

play();



