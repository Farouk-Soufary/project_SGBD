const navbar = document.querySelector('.navbar');
const blurScreen = document.querySelector('.blur-screen');
const sectionsWrapper = document.querySelector('.sections-wrapper'); 
const actions = document.querySelector('.sections-actions');
const objects = document.querySelector('.sections-objects');
const cancelButton = document.querySelector('.cancel-button');
const consultChoiceBar = document.getElementsByClassName('choose-bar');
const consultChoiceButton = document.getElementsByClassName('choose-button');
const commentList = document.querySelectorAll(".choose-bar.comment");
const playerList = document.querySelectorAll(".choose-bar.player");
const contributorList = document.querySelectorAll(".choose-bar.contributor");
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
        if (document.querySelector(".paragraph.slide")){
            document.querySelector(".paragraph.slide")?.classList.add('isVisible');
        }
    }, 700);


};

function movePages(pos){
    const pages = document.querySelector('.pages');
    const goButtons = document.querySelectorAll('.go-button');

    Object.keys(goButtons).forEach( (key) => {
        goButtons[key].classList.remove('isActive');
    });
    if (pos === 'up'){
        pages.classList.remove('down');
        document.querySelector(`.go-button.down`).classList.add('isActive');
    } else {
        pages.classList.add('down');
        document.querySelector(`.go-button.up`).classList.add('isActive');
    }
}

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
    Object.keys(consultChoiceButton).forEach((choiceButtonIndex) => {
        consultChoiceButton[choiceButtonIndex]?.addEventListener('click', () => {

            if (consultChoiceBar[choiceButtonIndex]?.classList.contains('isVisible')){
                consultChoiceBar[choiceButtonIndex]?.classList.remove('isVisible');
            } else {
                consultChoiceBar[choiceButtonIndex]?.classList.add('isVisible');
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

function slideOnScroll(){
    const slides = document.querySelectorAll('.paragraph.slide'); 
    window.onscroll = (event) => {
        if (window.scrollY >= 400 && window.scrollY <= 1000){
            slides['1']?.classList.add("isVisible");
        } else if (window.scrollY >= 1100){
            let i = 1;
            ['2', '3', '4'].forEach((idx) =>{
                setTimeout( () => {
                    slides[idx]?.classList.add("isVisible");
                }, i*200);
                i++;
            });
        }
    };
}


function showInfo(gameName, buttonDOM){
    hideAllInfo();
    buttonDOM.classList.add('isSelected');
    let comment, player, contributor;
    Object.keys(commentList).forEach((key) => {
        if (commentList[key]?.id == gameName){
            comment = commentList[key];
        }
    });
    Object.keys(playerList).forEach((key) => {
        if (playerList[key]?.id == gameName){
            player = playerList[key]
        }
    });
    Object.keys(contributorList).forEach((key) => {
        if (contributorList[key]?.id == gameName){
            contributor = contributorList[key];
        }
    });

    comment.classList.add('isVisible');
    player.classList.add('isVisible');
    contributor.classList.add('isVisible');
}

function hideAllInfo(){
    Object.keys(document.querySelectorAll(".test-bar.game")).forEach((key) => {
        document.querySelectorAll(".test-bar.game")[key].classList.remove('isSelected');
    });

    Object.keys(commentList).forEach((key) => {
        commentList[key].classList.remove('isVisible');
    });
    Object.keys(playerList).forEach((key) => {
        playerList[key].classList.remove('isVisible');
    });
    Object.keys(contributorList).forEach((key) => {
        contributorList[key].classList.remove('isVisible');
    });
}

function showFavoriteGames(DOM){
    hideAllChooseBars();
    DOM.classList.add('isVisible');
}

function applyPC2(name, DOM, isPlayer){
    if (isPlayer){
        DOM.parentElement.parentElement.children[0].innerHTML = name.slice(1);
        showFavoriteGames(document.querySelector("#"+name));
    } else {
        DOM.parentElement.parentElement.children[0].children[0].innerHTML = name;
        document.querySelector(".choose-button-pc2.submit").value = name;
        hideAllChooseBars();
    }
}

CreateEventListenersModify();
CreateEventListenersConsult();
CreateEventListenersStats();
slideOnScroll();