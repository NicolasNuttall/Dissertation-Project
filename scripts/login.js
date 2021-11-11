const phrases = ["Reading.","Notes.","Ideas."];
let i = 0;
let j = 0;
let currentPhrase = [];
let wordEnded = false;
let isEnd = false;

function charLoop (){
    isEnd = false;
    
    if(i < phrases.length){
      
        if(!wordEnded && j <= phrases[i].length){
            currentPhrase.push(phrases[i][j]);           
            j++;
            $("#loginSpan").text(currentPhrase.join(''));
        }

        if(wordEnded && j <= phrases[i].length){
            currentPhrase.pop();
            j--;
            $("#loginSpan").text(currentPhrase.join(''));
        }

        if(j == phrases[i].length){
            isEnd = true;
            wordEnded = true;
        }

        if(wordEnded && j === 0){
            currentPhrase = [];
            wordEnded = false;
            i++;
            if(i === phrases.length){
                i=0;
            }
        }
        
    }
    const spedUp = Math.random() * (80 -50) + 50;
    const normalSpeed = Math.random() * (200 -100) + 100;
    const time = isEnd ? 2000 : wordEnded ? spedUp : normalSpeed;
    setTimeout(charLoop, time);
}

$(document).ready(function(){
    charLoop();
})