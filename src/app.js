const navbar = document.querySelector('.navbar')


function activateNavbar(){
    if (!navbar.classList.contains('isActive')){
        navbar.classList.add('isActive');
    } else {
        navbar.classList.remove('isActive');
    }
}