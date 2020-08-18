

$(document).ready((evt) => {

    console.log('contactojs');
    $('#btn-contacto').click((evt) => {
        let target = $(evt.target);
        console.log(target);
        fetch(base_url + '/compararcontacto').then((response) => response.json())
            .then(function (myJson) {
                console.log(myJson);
                let contactos = myJson.respuesta;
                if(contactos.length>0){
                    let i=0;
                    contactos.forEach((contacto)=>{
                        i++;
                        $('#tabla_content').append(`<tr>
                        <th scope="row">${i}</th>
                        <td>${contacto.nombre}</td>
                        <td>${contacto.nombre_usuario}</td>
                        <td>${contacto.telefono}</td>
                        <td><button class="btn btn-primary">Seguir</button></td>
                      </tr>`);
                    })
                }else{

                }


            })
            .catch(function (response) {
                console.log('respuesta error', response)

            });
        $("#exampleModal").modal('show');

    });


})
