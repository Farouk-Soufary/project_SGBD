const navbar = document.querySelector('.navbar');
const blurScreen = document.querySelector('.blur-screen');
const sectionsWrapper = document.querySelector('.sections-wrapper'); 
const actions = document.querySelector('.sections-actions');
const objects = document.querySelector('.sections-objects');
const cancelButton = document.querySelector('.cancel-button');
const consultChoiceBar = document.getElementsByClassName('choose-bar');
const consultChoiceButton = document.getElementsByClassName('choose-button');
let action = {};
let object = {};


function activateNavbar(){
    if (!navbar.classList.contains('isActive')){
        document.querySelector('.menu-button').style.backgroundImage = 'url(./assets/crossIcon.png)';
        navbar.classList.add('isActive');
        blurScreen.classList.add('isActive');
    } else {
        document.querySelector('.menu-button').style.backgroundImage = 'url(./assets/menuIcon.png)';
        navbar.classList.remove('isActive');
        blurScreen.classList.remove('isActive');
    }
}

function CreateEventListenersModify(){
    if (!actions || !objects || !cancelButton || !sectionsWrapper) return;


    Object.keys(actions?.children).forEach( (key) => {
        const child = actions?.children[key];
        child.addEventListener('click', () => {
            console.log("action-click", child);
            sectionsWrapper.classList.add('choose');
            action = child;
            object = {};
            cancelButton.classList.add('isActive');
        });
    });

    Object.keys(objects?.children).forEach( (key) => {
        const child = objects?.children[key];
        child.addEventListener('click', () => {
            console.log("object-click", child);
            sectionsWrapper.classList.remove('choose');
            sectionsWrapper.classList.add('form');
            object = child;
        });
    });

    cancelButton.addEventListener('click', () => {
        cancelButton.classList.remove('isActive');
        sectionsWrapper.classList.remove('form');
        sectionsWrapper.classList.remove('choose');
    });

    blurScreen.addEventListener('click', () => {
        document.querySelector('.menu-button').style.backgroundImage = 'url(./assets/menuIcon.png)';
        navbar.classList.remove('isActive');
        blurScreen.classList.remove('isActive');
    });

}

function CreateEventListenersConsult(){
    if (!consultChoiceBar || !consultChoiceButton) return;
    
    Object.keys(consultChoiceButton).forEach((choiceButtonIndex) => {
        consultChoiceButton[choiceButtonIndex].addEventListener('click', () => {

            if (consultChoiceBar[choiceButtonIndex].classList.contains('isVisible')){
                consultChoiceBar[choiceButtonIndex].classList.remove('isVisible');
            } else {
                consultChoiceBar[choiceButtonIndex].classList.add('isVisible');
            }
        });
    });

}

function CreateEventListenersStats(){
}

CreateEventListenersModify();
CreateEventListenersConsult();
CreateEventListenersStats();