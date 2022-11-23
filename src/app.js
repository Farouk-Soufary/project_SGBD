const navbar = document.querySelector('.navbar');
const blurScreen = document.querySelector('.blur-screen');
const sectionsWrapper = document.querySelector('.sections-wrapper'); 
const actions = document.querySelector('.sections-actions');
const objects = document.querySelector('.sections-objects');
const cancelButton = document.querySelector('.cancel-button');
const consultChoiceBar = document.getElementsByClassName('choose-bar');
const consultChoiceButton = document.getElementsByClassName('choose-button');

const formSubmitButtons = document.querySelectorAll(".form-submit");


const actionsList = ["add", "modify", "delete"];
const objectsList = ["game", "player", "comment"];

let selectedAction, selectedObject, selectedSubmitButton;

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
            selectedSubmitButton = formSubmitButtons[key];
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
            selectedSubmitButton.setAttribute('form', selectedAction+selectedObject);
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

function showQuery(formName){
formName.split(".")[formName.length -1]
    let mode, table, query, acc;
    acc = formName.split(".")[2] + formName.split(".")[3];
    switch(acc){
        case 'addgame':
            mode = "INSERT";
            table = "JEUX";
            break;
        case 'modifygame':
            mode = "UPDATE";
            table = "JEUX";
            break;
        case 'deletegame':
            mode = "DELETE";
            table = "JEUX";
            break;
        case 'addplayer':
            mode = "INSERT";
            table = "JOUEURS";
            break;
        case 'modifyplayer':
            mode = "UPDATE";
            table = "JOUEURS";
            break;
        case 'deleteplayer':
            mode = "DELETE";
            table = "JOUEURS";
            break;
        case 'addcomment':
            mode = "INSERT";
            table = "NOTES";
            break;
        case 'modifycomment':
            mode = "UPDATE";
            table = "NOTES";
            break;
        case 'deletecomment':
            mode = "DELETE";
            table = "NOTES";
            break;
        default:
            mode = "";
            table = "";
            break;                                
    }

    if (mode === "INSERT"){
        query = mode + " INTO " + table + " VALUES ( ";
    } else if (mode === "UPDATE"){
        query = mode + " " + table + " SET";
    } else if (mode === "DELETE"){
        query = mode + " FROM " + table + " WHERE ";
    } else {
        query = "";
    }

    const formInputs = document.querySelector(formName).getElementsByTagName("input");
    Object.keys(formInputs).forEach( (key) => {
        if (formInputs[key].value === "" || formInputs[key].value === ". . ."){
            alert("Please fill all the information correctly");
            throw new console.error("error");
        }
        if ("email checkbox text button".includes(formInputs[key].type)){
            query += "'" + formInputs[key].value + "'" + ",";
        } else {
            query += formInputs[key].value + ",";
        }
    });

    if (mode === "INSERT"){
        query = query.slice(0, -1) + ");";
    } else if (mode === "UPDATE"){
    } else if (mode === "DELETE"){
    } else {
        query = "";
    }

    // RUN QUERY
    alert(query);
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

function selectValue(el){
   el.parentElement.parentElement.children[0].value = el.innerHTML;
   hideAllChooseBars();
}

function hideAllChooseBars(){
    const chooseBars = document.querySelectorAll(".choose-bar");
    Object.keys(chooseBars).forEach( (key) => {
        chooseBars[key].classList.remove('isVisible')
    });
}

CreateEventListenersModify();
CreateEventListenersConsult();
CreateEventListenersStats();