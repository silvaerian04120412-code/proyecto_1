/* ---------------------------------------------------------
   VALIDACIONES DEL FORMULARIO DE REGISTRO
--------------------------------------------------------- */

// Referencias a los campos
const nombre    = document.getElementById("nombre");
const apellido  = document.getElementById("apellido");
const phone     = document.getElementById("phone");
const email     = document.getElementById("email");
const password  = document.getElementById("password");

// Referencias a los mensajes de error
const errNombre   = document.getElementById("errNombre");
const errApellido = document.getElementById("errApellido");
const errPhone    = document.getElementById("errPhone");
const errEmail    = document.getElementById("errEmail");
const errPassword = document.getElementById("errPassword");

// Expresiones regulares
const regexPhone = /^[0-9]{7,15}$/;
const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Función principal de validación
function validarFormulario(e) {
    let ok = true;

    // Nombre
    if (!nombre || nombre.value.trim() === "") {
        if (errNombre) errNombre.textContent = "El nombre es obligatorio.";
        ok = false;
    } else if (errNombre) {
        errNombre.textContent = "";
    }

    // Apellido
    if (!apellido || apellido.value.trim() === "") {
        if (errApellido) errApellido.textContent = "El apellido es obligatorio.";
        ok = false;
    } else if (errApellido) {
        errApellido.textContent = "";
    }

    // Teléfono (opcional)
    if (phone && phone.value.trim() !== "" && !regexPhone.test(phone.value)) {
        if (errPhone) errPhone.textContent = "El teléfono debe tener entre 7 y 15 números.";
        ok = false;
    } else if (errPhone) {
        errPhone.textContent = "";
    }

    // Email
    if (!email || !regexEmail.test(email.value.trim())) {
        if (errEmail) errEmail.textContent = "Ingresa un correo válido.";
        ok = false;
    } else if (errEmail) {
        errEmail.textContent = "";
    }

    // Contraseña
    if (!password || password.value.trim().length < 6) {
        if (errPassword) errPassword.textContent = "La contraseña debe tener al menos 6 caracteres.";
        ok = false;
    } else if (errPassword) {
        errPassword.textContent = "";
    }

    if (!ok) {
        e.preventDefault();
    }
}

// Asociar al formulario
const form = document.querySelector("form");
if (form) {
    form.addEventListener("submit", validarFormulario);
}