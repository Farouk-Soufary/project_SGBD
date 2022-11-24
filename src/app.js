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
const dbKeys = { JEUX : ["NOM_JEU", "EDITEUR", "DATE_PARUTION", "DUREE", "TYPE_JEU", "NOMBRE_JOUEURS", "STAND_ALONE"],
                JOUEURS : ["PSEUDONYME", "NOM_JOUEUR", "PRENOM_JOUEUR", "ADRESSE_MAIL"],
                NOTES :["ID_NOTE", "COMMENTAIRE", "DATE_NOTE", "VALEUR", "NOMBRE_JOUEURS"]};

let selectedAction, selectedObject, selectedSubmitButton;

let action = {};
let object = {};
const QUERY = document.querySelectorAll('.QUERY');

Object.keys(QUERY).forEach( (key) => {
    QUERY[key].value = "";
});

window.onload = () =>{
    setTimeout( () =>{
        document.querySelector(".loading-page").classList.remove("isActive");
        document.querySelector(".loading-motion").classList.remove("isActive");
    }, 700)
};

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
    let mode, table, query, acc, id;
    let updateList = [];
    acc = formName.split(".")[2] + formName.split(".")[3];
    switch(acc){
        case 'addgame':
            mode = "INSERT";
            table = "JEUX";
            id = "NOM_JEU";
            break;
        case 'modifygame':
            mode = "UPDATE";
            table = "JEUX";
            id = "NOM_JEU";
            break;
        case 'deletegame':
            mode = "DELETE";
            table = "JEUX";
            id = "NOM_JEU";
            break;
        case 'addplayer':
            mode = "INSERT";
            table = "JOUEURS";
            id = "PSEUDONYME";
            break;
        case 'modifyplayer':
            mode = "UPDATE";
            table = "JOUEURS";
            id = "PSEUDONYME";
            break;
        case 'deleteplayer':
            mode = "DELETE";
            table = "JOUEURS";
            id = "PSEUDONYME";
            break;
        case 'addcomment':
            mode = "INSERT";
            table = "NOTES";
            id = "ID_NOTE";
            break;
        case 'modifycomment':
            mode = "UPDATE";
            table = "NOTES";
            id = "ID_NOTE";
            break;
        case 'deletecomment':
            mode = "DELETE";
            table = "NOTES";
            id = "ID_NOTE";
            break;
        default:
            mode = "";
            table = "";
            break;                                
    }

    if (mode === "INSERT"){
        query = mode + " INTO " + table + " VALUES ( ";
    } else if (mode === "UPDATE"){
        query = mode + " " + table + " SET  ";
    } else if (mode === "DELETE"){
        query = mode + " FROM " + table + " WHERE "+ id + "=";
    } else {
        query = "";
    }

    const formInputs = document.querySelector(formName).getElementsByTagName("input");
    Object.keys(formInputs).forEach( (key) => {
        if (mode !== "UPDATE" && (formInputs[key].value === "" || formInputs[key].value === ". . ." || formInputs[key].value.includes("Choix"))){
            alert("Please fill all the information correctly");
            throw new console.error("error");
        }

        if (mode !== "UPDATE"){
            if ("email checkbox text button date".includes(formInputs[key].type)){
                query += "'" + formInputs[key].value.split("--")[0] + "'" + ",";
            } else {
                query += formInputs[key].value.split("--")[0] + ",";
            }
        } else {
            let i = updateList.push(formInputs[key].value.split("--")[0]);
        }
    });

    query = query.slice(0, -1);

    if (mode === "INSERT"){
        query += ")";
    } else if (mode === "UPDATE"){
        console.log(updateList);
        updateList.forEach( (el, i) => {
            if (el.includes("Choix")){
                alert("Please fill all the information correctly");
                throw new console.error("error");
            } else if (el !== ""){
                    if (isNumeric(el)){
                        query += " " + dbKeys[`${table}`][i] + "=" + el + ",";
                    } else {
                        query += " " + dbKeys[`${table}`][i] + "='" + el + "',";
                    }
                }
        });
        query = query.slice(0, -1);
        if (table !== "NOTES"){
            query += " WHERE " + dbKeys[`${table}`][0] + "='" + updateList[0] + "'";
        } else {
            query += " WHERE " + dbKeys[`${table}`][0] + "=" + updateList[0];
        }
    }
    query += ";";

    // RUN QUERY
    Object.keys(QUERY).forEach( (key) => {
        QUERY[key].value = query;
    });

    alert("Your changes are processed successfully\nChanges applied.\nThe applied query is : " + query);
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
   el.parentElement.parentElement.children[0].value = el.innerHTML.split("-")[0];
   hideAllChooseBars();
}

function hideAllChooseBars(){
    const chooseBars = document.querySelectorAll(".choose-bar");
    Object.keys(chooseBars).forEach( (key) => {
        chooseBars[key].classList.remove('isVisible')
    });
}

function isNumeric(num){
    return !isNaN(num);
}

CreateEventListenersModify();
CreateEventListenersConsult();
CreateEventListenersStats();