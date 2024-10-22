const menuIcon = document.getElementById('menu-icon');
const menu = document.getElementById('menu');


//no introducir numeros en nombre+
window.addEventListener('load' ,() => {
    $('#nombre').bind('keyup blur', function() {
        var node = $(this);
        node.val(node.val().replace(/[^a-z && A-Z]/g,''));
    });
});




// Añade un evento al icono del menú para alternar el menú visible/invisible
menuIcon.addEventListener('click', () => {
    menu.classList.toggle('show');
});

// Cierra el menú automáticamente cuando se selecciona una opción
const menuLinks = document.querySelectorAll('.menu li a');
menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        menu.classList.remove('show');
    });

  
    
});

