$("form").validate({
    rules: {
        //CONTROL REGISTRO GRUPO EMPRESAS 
        nombre_usuario: {
            required: true, login: true,minlength: 5, maxlength: 20, remote: "ControladorVerificador.php"
        },
        contrasenia: {
            required: true, minlength: 5, maxlength: 20
        },
        nombres: {
            required: true, minlength: 5, maxlength: 45
        },
        apellidos: {
            required: true, minlength: 5, maxlength: 45
        }
    },
    messages: {
        //MENSAJES REGISTRO GRUPO EMPRESAS
        nombre_usuario: {
            required: "Introduzca el Nombre de Usuario.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
            remote: "nombre de usuario ya registrado",
            login: "el nombre de usuario solo puede contener una palabra."
        }, 
        contrasenia: {
            required: "Introduzca la Contraseña.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
        },
        nombres: {
            required: "Introduzca el Nombre de la persona.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
        },
        apellidos: {
            required: "Introduzca el Apellido de la persona.",
            minlength: "Mínimo {0} Caracteres.",
            maxlength: "Máximo {0} Caracteres.",
        }
    },
    errorElement: 'small',
    errorPlacement: function(error, element) {
        error.html(error.text()).insertAfter(element).hide().fadeIn();
    },
    submitHandler: function(form) {
        form.submit();
    }
});