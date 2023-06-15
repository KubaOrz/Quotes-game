import {openPopup} from './popUp.js';

export function validateAnswer(answer, correctAnswer) {
    if (answer === correctAnswer) {
        console.log("Dobra odpowiedź");
        handleGoodAnswer(correctAnswer);
    } else {
        console.log("Zła odpowiedź");
        handleBadAnswer(correctAnswer);
    }
}

function handleGoodAnswer(correctAnswer) {
    document.getElementById("answer").innerHTML="Dobrze!";
    let desc = correctAnswer ? "To był prawdziwy cytat" : "To nie był prawdziwy cytat";
    document.getElementById("desc").innerHTML=desc;
    openPopup();
}

function handleBadAnswer(correctAnswer) {
    document.getElementById("answer").innerHTML="Źle!";
    let desc = correctAnswer ? "To był prawdziwy cytat" : "To nie był prawdziwy cytat";
    document.getElementById("desc").innerHTML=desc;
    openPopup();
}