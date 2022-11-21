const navbar = document.querySelector('.navbar');
const blurScreen = document.querySelector('.blur-screen');
const sectionsWrapper = document.querySelector('.sections-wrapper'); 
const actions = document.querySelector('.sections-actions');
const objects = document.querySelector('.sections-objects');
const cancelButton = document.querySelector('.cancel-button');
const consultChoiceBar = document.getElementsByClassName('choose-bar');
const consultChoiceButton = document.getElementsByClassName('choose-button');

const formSubmitButtons = document.querySelectorAll(".form-submit");
// const formFieldsAdd = document.querySelectorAll(".form-fields.add");
// const formFieldsModify = document.querySelectorAll(".form-fields.modify");
// const formFieldsDelete = document.querySelectorAll(".form-fields.delete");
// const formFieldsSections = [formFieldsAdd, formFieldsModify, formFieldsDelete];

const actionsList = ["add", "modify", "delete"];
const objectsList = ["game", "player", "comment"];

let selectedAction, selectedObject;

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
            sectionsWrapper.classList.add('choose');
            action = child;
            object = {};
            cancelButton.classList.add('isActive');
            formSubmitButtons[key].classList.add('isActive');
            selectedAction = actionsList[key];
        });
    });

    Object.keys(objects?.children).forEach( (key) => {
        const child = objects?.children[key];
        child.addEventListener('click', () => {
            sectionsWrapper.classList.remove('choose');
            sectionsWrapper.classList.add('form');
            object = child;
            selectedObject = objectsList[key];
            document.querySelector(`.form-fields.${selectedAction}.${selectedObject}`).classList.add("isActive");
        });
    });

    cancelButton.addEventListener('click', () => {
        cancelButton.classList.remove('isActive');
        sectionsWrapper.classList.remove('form');
        sectionsWrapper.classList.remove('choose');

        Object.keys(formSubmitButtons).forEach( (key) => {
            formSubmitButtons[key].classList.remove('isActive');
        });

        actionsList.forEach( (act) => {
            objectsList.forEach( (obj) => {
                const selectedFields = document.querySelector(`.form-fields.${act}.${obj}`);
                selectedFields.classList.remove("isActive");
            });
        });

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

function showTable(n){
    for (let i = 1; i <= 6; i++){
        document.querySelector(`.page-${i}`).style.zIndex = "-1";
        document.querySelector(`.page-${i}`).childNodes[1].childNodes[1].classList.remove("isActive");
    }
    const DOMelement = document.querySelector(`.page-${n}`);
    DOMelement.style.zIndex = "1";
    DOMelement.childNodes[1].childNodes[1].classList.add("isActive");
}

function showQuery(){
    console.log(selectedAction, selectedObject);
}


CreateEventListenersModify();
CreateEventListenersConsult();
CreateEventListenersStats();