const navbar = document.querySelector('.navbar');
const blurScreen = document.querySelector('.blur-screen');
const actions = document.querySelector('.sections-actions');
const objects = document.querySelector('.sections-objects');
const cancelButton = document.querySelector('.cancel-button');
let action = {};
let object = {};


window.scrollTo(0,0)

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

function CreateEventListeners(){
    if (!actions || !objects || !cancelButton) return;

    Object.keys(actions.children).forEach( (key) => {
        const child = actions.children[key];
        child.addEventListener('click', () => {
            console.log("action-click", child);
            window.scrollTo(0, 890);
            action = child;
            object = {};
            cancelButton.classList.add('isActive');
        });
    });

    Object.keys(objects.children).forEach( (key) => {
        const child = objects.children[key];
        child.addEventListener('click', () => {
            console.log("object-click", child);
            window.scrollTo(0, 890*2);
            object = child;
        });
    });

    cancelButton.addEventListener('click', () => {
        cancelButton.classList.remove('isActive');
        window.scrollTo(0, 0);
    });

    blurScreen.addEventListener('click', () => {
        console.log('check');
        document.querySelector('.menu-button').style.backgroundImage = 'url(./assets/menuIcon.png)';
        navbar.classList.remove('isActive');
        blurScreen.classList.remove('isActive');
    });
}



CreateEventListeners();

