
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
    new Validator(document.querySelector('#form-register'), function (err, res) {
        console.log('validator: ', err, res);
        return res;
    });

}
