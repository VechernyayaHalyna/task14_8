function myFunction() {
    
    let btnMenu = document.querySelector('#myDropdown');
    if (btnMenu.classList.contains('show')) {
        btnMenu.classList.remove('show');
    } else {
        btnMenu.classList.toggle("show");
    }
}

window.onclick = function (event) {
    if (!event.target.matches('.barbtn')) {
        let btnMenu = document.querySelector('#myDropdown');
        if (btnMenu.classList.contains('show')) {
            btnMenu.classList.remove('show');
        }
    }
}

document.querySelector('#btnLink').addEventListener('click', myFunction);