
console.log('validacion.js')



// Validacion del Formulario de Login
if (document.querySelector('#form-login')) {
    new Validator(document.querySelector('#form-login'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}


// Validacion de Form Register form-register
if (document.querySelector('#form-register')) {
    //Valido Nombre Usuario
    $('#nombre_usuario').change((evt)=>{
        let target = $(evt.target),
            value = target.val();
            $('#unique_user').remove();
        if(value.length > 4){
            fetch(base_url + '/buscarby/nombre_usuario/' + value).then((response) => response.json()
            ).then( (myJson) =>{
                // console.log(myJson)
                $('#unique_user').remove();
                console.log('typeof', myJson.answer)
                if( myJson.answer !== null){
                    $('#nombre_usuario').after(`<div id="unique_user" class="error">Nombre de usuario no disponible.</div>`);
                }
            }).catch((response) => console.log('respuesta error', response));
        }
    })
    // email
    $('#email_user').change((evt)=>{
        let target = $(evt.target),
            value = target.val();
            console.log('event change')
        if(value.length > 4){
            fetch(base_url + '/buscarby/email/' + value).then((response) => response.json()
            ).then( (myJson) =>{
                // console.log(myJson)
                console.log('typeof', myJson.answer)
                if( myJson.answer !== null){
                    $('#email_user').after(`<div id="unique_email" class="error">Email ya usado en otro usuario.</div>`);
                }else{
                    $('#unique_email').remove();
                }
            }).catch((response) => console.log('respuesta error', response));
        }
    })
    new Validator(document.querySelector('#form-register'), function (err, res) {
        let salida = res;
        console.log('Len: ',$('#unique_email').length, $('#unique_user').length)
        if($('#unique_email').length > 0 && $('#unique_user').length > 0){
            salida = false;   
        }
        console.log('salida: ', err, salida); 
        return salida;
    });

}

// Validacion de Form InsertPostUsuario form-InsertPostUsuario
if (document.querySelector('#form-InsertPostUsuario')) {
    new Validator(document.querySelector('#form-InsertPostUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form PerfilEditUsuario form-PerfilEditUsuario
if (document.querySelector('#form-PerfilEditUsuario')) {
    //Valido Nombre Usuario
    $('#nombre_usuario').change((evt)=>{
        let target = $(evt.target),
            value = target.val();
            $('#unique_user').remove();
        if(value.length > 4 && value !== loginData.nombre_usuario ){
            fetch(base_url + '/buscarby/nombre_usuario/' + value).then((response) => response.json()
            ).then( (myJson) =>{
                $('#unique_user').remove();
                console.log('typeof', myJson.answer)
                if( myJson.answer !== null){
                    $('#nombre_usuario').after(`<div id="unique_user" class="error">Nombre de usuario no disponible.</div>`);
                }
            }).catch((response) => console.log('respuesta error', response));
        }
    });
    // email
    $('#email_user').change((evt)=>{
        let target = $(evt.target),
            value = target.val();
            console.log('event change')
        if(value.length > 4){
            fetch(base_url + '/buscarby/email/' + value).then((response) => response.json()
            ).then( (myJson) =>{
                // console.log(myJson)
                console.log('typeof', myJson.answer)
                if( myJson.answer !== null){
                    $('#email_user').after(`<div id="unique_email" class="error">Email ya usado en otro usuario.</div>`);
                }else{
                    $('#unique_email').remove();
                }
            }).catch((response) => console.log('respuesta error', response));
        }
    })

    new Validator(document.querySelector('#form-PerfilEditUsuario'), function (err, res) { 
        let salida = res;
        console.log('Len: ',$('#unique_user').length)
        if($('#unique_user').length > 0 && $('#unique_email').length > 0){
            salida = false;   
        }
        console.log('salida: ', err, salida); 
        return salida;
    });

}
// Validacion de Form EditPasswordUsuario form-EditPasswordUsuario
if (document.querySelector('#form-EditPasswordUsuario')) {
    new Validator(document.querySelector('#form-EditPasswordUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditFotoUsuario form-EditFotoUsuario
if (document.querySelector('#form-EditFotoUsuario')) {
    new Validator(document.querySelector('#form-EditFotoUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form ComentarioHome form-ComentarioHome
if (document.querySelector('#form-ComentarioHome')) {
    new Validator(document.querySelector('#form-ComentarioHome'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form CrearContactoUsuario form-CrearContactoUsuario
if (document.querySelector('#form-CrearContactoUsuario')) {
    new Validator(document.querySelector('#form-CrearContactoUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarContactoUsuario form-EditarContactoUsuario
if (document.querySelector('#form-EditarContactoUsuario')) {
    new Validator(document.querySelector('#form-EditarContactoUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarConfiguracionUsuario form-EditarConfiguracionUsuario
if (document.querySelector('#form-EditarConfiguracionUsuario')) {
    new Validator(document.querySelector('#form-EditarConfiguracionUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form ComentarioUsuario form-ComentarioUsuario
if (document.querySelector('#form-ComentarioUsuario')) {
    new Validator(document.querySelector('#form-ComentarioUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarUsuarioAdmi form-EditarUsuarioAdmi
if (document.querySelector('#form-EditarUsuarioAdmi')) {
    new Validator(document.querySelector('#form-EditarUsuarioAdmi'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarPostUsuario form-EditarPostUsuario
if (document.querySelector('#form-EditarPostUsuario')) {
    new Validator(document.querySelector('#form-EditarPostUsuario'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarContactoAdmi form-EditarContactoAdmi
if (document.querySelector('#form-EditarContactoAdmi')) {
    new Validator(document.querySelector('#form-EditarContactoAdmi'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarConfiguracionAdmi form-EditarConfiguracionAdmi
if (document.querySelector('#form-EditarConfiguracionAdmi')) {
    new Validator(document.querySelector('#form-EditarConfiguracionAdmi'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
// Validacion de Form EditarComentarioAdmi form-EditarComentarioAdmi
if (document.querySelector('#form-EditarComentarioAdmi')) {
    new Validator(document.querySelector('#form-EditarComentarioAdmi'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}