document.getElementById('imagen').addEventListener('change', function (event) {
    const archivo = event.target.files[0]; // Obtiene el archivo seleccionado por el usuario

    if (archivo) {
        const lector = new FileReader(); // Crea un FileReader para leer el archivo

        lector.onload = function (e) {
            const vistaPrevia = document.getElementById('vistaPrevia');
            vistaPrevia.src = e.target.result; // Establece el resultado de la lectura como la fuente de la imagen
        };

        lector.readAsDataURL(archivo); // Lee el archivo como una URL de datos
    }
});

document.getElementById('imagen1').addEventListener('change', function (event) {
    const archivo = event.target.files[0]; // Obtiene el archivo seleccionado por el usuario

    if (archivo) {
        const lector = new FileReader(); // Crea un FileReader para leer el archivo

        lector.onload = function (e) {
            const vistaPrevia = document.getElementById('vistaPrevia1');
            vistaPrevia.src = e.target.result; // Establece el resultado de la lectura como la fuente de la imagen
        };

        lector.readAsDataURL(archivo); // Lee el archivo como una URL de datos
    }
});



function habilitarInput() {
    // Obtén el elemento por su ID
    var btn = document.getElementById("username");
    var input2 = document.getElementById("username2");

    input2.removeAttribute("readonly");
    input2.readOnly = false;
};

function habilitarInput2() {
    // Obtén el elemento por su ID
    var btn = document.getElementById("nombre");
    var input2 = document.getElementById("nombre2");

    input2.removeAttribute("readonly");
    input2.readOnly = false;
};

function habilitarInput3() {
    // Obtén el elemento por su ID
    var btn = document.getElementById("telefono");
    var input2 = document.getElementById("telefono2");

    input2.removeAttribute("readonly");
    input2.readOnly = false;
};

function deshabilitarInput() {
    // Obtén el elemento por su ID
    var btn = document.getElementById("update");
    var input2 = document.getElementById("telefono2");
    var input3 = document.getElementById("nombre2");
    var input4 = document.getElementById("username2");

    input2.setAttribute("readonly");
    input3.setAttribute("readonly");
    input4.setAttribute("readonly");
};

function filtro() {
    var btn = document.getElementById('filtrar');
    var tipo = document.getElementById("tipos");
    var selectedValue = tipo.value;

    var def = document.getElementById('default');
    var jardin = document.getElementById('Jardineria');
    var plomero = document.getElementById('Plomeria');
    var facha = document.getElementById('Fachada');
    var carpin = document.getElementById('Carpinteria');
    var electro = document.getElementById('Electronica');
    var otro = document.getElementById('Otro');


    console.log("la categoria es: " + selectedValue);

    if (selectedValue === jardin.id) {
        def.setAttribute("hidden", "");
        jardin.removeAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /* console.log("cambio a jardin"); */
    } else if (selectedValue === plomero.id) {
        def.setAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.removeAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /* console.log("cambio a plomero"); */
    } else if (selectedValue === facha.id) {
        def.setAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.removeAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /* console.log("cambio a fachada"); */
    } else if (selectedValue === carpin.id) {
        def.setAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.removeAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /* console.log("cambio a plomero"); */
    } else if (selectedValue === electro.id) {
        def.setAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.removeAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /* console.log("cambio a plomero"); */
    } else if (selectedValue === otro.id) {
        def.setAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.removeAttribute("hidden", "");
        /* console.log("cambio a plomero"); */
    } else if (selectedValue === def.id) {
        def.removeAttribute("hidden", "");
        jardin.setAttribute("hidden", "");
        plomero.setAttribute("hidden", "");
        facha.setAttribute("hidden", "");
        carpin.setAttribute("hidden", "");
        electro.setAttribute("hidden", "");
        otro.setAttribute("hidden", "");
        /*  console.log("cambio a default"); */
    }
}

document.getElementById('imagen').addEventListener('change', function (event) {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (file) {
        const allowedTypes = ['image/jpg', 'image/png', 'image/jpeg'];

        if (!allowedTypes.includes(file.type)) {
            alert('Tipo de archivo no permitido. Se permiten solo archivos JPG, PNG o JPEG.');
            fileInput.value = ''; // Limpia el campo de entrada
            document.getElementById('vistaPrevia').src = ''; // Limpia la vista previa
        } else {
            // Muestra la vista previa de la imagen
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('vistaPrevia').src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    }
});

function check(){
    var che = document.getElementById('precio');
    var surg = document.getElementById('sugerido');
    var tex = document.getElementById('tex');
    console.dir(che);
    if(che.checked === true){
        surg.removeAttribute("hidden", "");
        tex.setAttribute("hidden", "");
    }else if(che.checked === false){
        surg.setAttribute("hidden", "");
        tex.removeAttribute("hidden", "");
    }
}

function terminos() {
    var ter = document.getElementById('termino');
    var posta = document.getElementById('posta');

    if (ter.checked) {
        posta.removeAttribute("disabled");
    } else {
        posta.setAttribute("disabled", "disabled");
    }
}