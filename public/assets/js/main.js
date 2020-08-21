
$(document).ready((evt) => {
    console.log('main js')
    contadorView();
    // MediaQuery
    $(window).resize(function () {
        if ($(window).width() < 992) {
            console.log('main: $(window).width()', $(window).width());
            $('#nav-div').removeClass('container');
        }
    });
    // Funcion que contara las vistas
    function contadorView() {
        let counter = parseInt($('#counter').text());
        let current_url = location.href;
        let view = current_url.substring(base_url.length + 1, current_url.length );
        if( view == ''){
            view = 'login';
        }
        // console.log('main', base_url, current_url);
    
        let data = {
            vista: view,
            counter: counter
        }
        // console.log('post data: ',data)
        fetch('/counterViews', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('input[name="_token"]').val()
            },
            body: JSON.stringify(data)
        }).then((response) => response.json())
            .then(function (myJson) {
                if(myJson.exito){
                    
                    // $('#counter').text(myJson.counter)
                    console.log(myJson);
                }
        }).catch((err)=> console.log('respuesta error',err,err.message));
        
    }

    // autoComplete.js on type event emitter
    // document.querySelector("#autoComplete").addEventListener("autoComplete", function (event) {
    // console.log(event.detail);
    // });
    // Buscador de Amigos con AutoComplete.js
    if (document.querySelector("#autoComplete")) {
        new autoComplete({
            data: {                              // Data src [Array, Function, Async] | (REQUIRED)
                src: async () => {
                    const query = document.querySelector("#autoComplete").value;
                    const source = await fetch(base_url + '/buscar?q=' + query);
                    const data = await source.json();
                    return data.answer;
                },
                key: ["nombre_usuario"],
                cache: false
            },
            trigger: {
                event: ["input", "focusin", "focusout"]
            },
            placeHolder: "Buscar Amigo",     // Place Holder text                 | (Optional)
            selector: "#autoComplete",           // Input field selector              | (Optional)
            threshold: 1,                        // Min. Chars length to start Engine | (Optional)
            debounce: 300,                       // Post duration for engine to start | (Optional)
            searchEngine: "strict",              // Search Engine type/mode           | (Optional)
            resultsList: {                       // Rendered results list object      | (Optional)
                render: true,
                /* if set to false, add an eventListener to the selector for event type
                   "autoComplete" to handle the result */
                container: source => {
                    source.setAttribute("id", "autoComplete_list");
                    source.setAttribute("style", "position: absolute; width: 14.5rem;");
                    // console.log('source: ', source)
                },
                // destination: document.querySelector("#autoComplete"),
                position: "afterend",
                element: "ul"
            },
            maxResults: 5,                         // Max. number of rendered results | (Optional)
            highlight: true,                       // Highlight matching results      | (Optional)
            resultItem: {                          // Rendered result item            | (Optional)
                content: (data, source) => {
                    source.innerHTML = data.match;
                    let perfil = data.value;
                    let nombre = perfil.nombre;
                    data.index = perfil.id;
                    source.setAttribute('data-id', perfil.id);
                    source.className += " row";
                    source.innerHTML = `<div class="col-md-3 p-0">
                                                <img src="${base_url}/imagen/${perfil.foto}" class="circular--square" alt="..." width="48" height="48">
                                            </div>
                                            <div class="col-md-9" style="padding: 0px 0px 0px 5px;">
                                                ${data.match}
                                                <p class="m-0">${nombre.length > 16 ? nombre.substring(0, 15) + "..." : nombre}</p>
                                            </div>`;
                    // console.log('data, source: ', data, source);
                },
                element: "li"
            },
            noResults: () => {                     // Action script on noResults      | (Optional)
                const result = document.createElement("li");
                result.setAttribute("class", "autoComplete_result");
                result.setAttribute("tabindex", "1");
                result.setAttribute("style", "position: absolute; width: 14.5rem;")
                result.innerHTML = "No Results";
                document.querySelector("#autoComplete_list").appendChild(result);
            },
            onSelection: feedback => {             // Action script onSelection event | (Optional)
                document.querySelector("#autoComplete").blur();
                const selection = feedback.selection.value.nombre_usuario;
                // console.log('feedback.selection', feedback.selection)
                // Render selected choice to selection div
                document.querySelector("#autoComplete").value = "";
                // Change placeholder with the selected value
                document.querySelector("#autoComplete").setAttribute("placeholder", selection);
                location.href = base_url + '/user/' + selection;
            }
        });
    }

    //Accion para ocultar Lista
    if (document.querySelector("#autoComplete_list")) {
        ["focus", "blur"].forEach(function (eventType) {
            const resultsList = document.querySelector("#autoComplete_list");
            document.querySelector("#autoComplete").addEventListener(eventType, function () {
                // Hide results list & show other elemennts
                // console.log(eventType);
                if (eventType === "blur") {
                    resultsList.style.display = "none";
                } else if (eventType === "focus") {
                    resultsList.style.display = "block";
                }
            });
        });

    }

    //Mostrar los Seguidores
    $('#btn-seguir').click((evt) => {
        let target = $(evt.target);
        let id_usuario = target.data('id_usuario');
        // class="fa fa-heart-o fa-1x c-black"
        if (target.hasClass('c-black')) {
            // console.log('tiene')
            target.removeClass('fa-heart');
            target.addClass('fa-heart-o');
            target.removeClass('c-black');
        } else {
            // console.log('no tiene')
            target.removeClass('fa-heart-o');
            target.addClass('fa-heart');
            target.addClass('c-black');
            //traemos los seguidores
            traerSeguidores(id_usuario);
        }
        // console.log('click', target, id_usuario);

    });
    $('.dropdown').on('hidden.bs.dropdown', (evt) => {
        let target = $(evt.target);
        let heart = target.find('#btn-seguir');
        heart.removeClass('fa-heart');
        heart.addClass('fa-heart-o');
        heart.removeClass('c-black');
    });

    function inSeconds(d, dd) {
        var t2 = dd.getTime();
        var t1 = d.getTime();
 
        return parseInt((t2-t1)/(1000));
    }

    function inMinutes(d, dd) {
        var t2 = dd.getTime();
        var t1 = d.getTime();
 
        return parseInt((t2-t1)/(1000*60));
    }

    function inHours(d, dd) {
        var t2 = dd.getTime();
        var t1 = d.getTime();
 
        return parseInt((t2-t1)/(1000*60*60));
    }

    function inDays(d, dd) {
        var t2 = dd.getTime();
        var t1 = d.getTime();
 
        return parseInt((t2-t1)/(24*3600*1000));
    }

    function inWeeks(d, dd) {
        var t2 = dd.getTime();
        var t1 = d.getTime();
 
        return parseInt((t2-t1)/(24*3600*1000*7));
    }

    function inMonths(d, dd) {
        var dY = d.getFullYear();
        var ddY = dd.getFullYear();
        var dM = d.getMonth();
        var ddM = dd.getMonth();
 
        return (ddM+12*ddY)-(dM+12*dY);
    }

    function inYears(d, dd) {
        return dd.getFullYear()-d.getFullYear();
    }

    function traerSeguidores(idUsuario) {
        fetch(base_url + '/getseguidores/' + idUsuario).then((response) => response.json()
        ).then(function (myJson) {
            // console.log(myJson);
            $('#list_seguir').empty();
            if (myJson.count > 0) {
                myJson.seguidores.forEach((seguidor) => {
                    let boton;
                    var result='Comenzar a seguir';
                    // console.log(seguidor)
                    if(seguidor.loEstoySiguiendo){
                        var a=seguidor.fecha_hora;
                        var b= a.substr(5,2)-1;
                        var d = new Date(a.substr(0,4),b, a.substr(8,2), a.substr(11,2), a.substr(14,2), a.substr(17,2),0);
                        var dd = new Date();
                        var year=inYears(d,dd);
                        var month=inMonths(d,dd);
                        var week=inWeeks(d,dd);
                        var day=inDays(d,dd);
                        var hour=inHours(d,dd);
                        var minute=inMinutes(d,dd);
                        var second=inSeconds(d,dd);
                        result=0;
                        if(year==1){
                            result='hace '+year+' año';
                        }else{
                            result='hace '+year+' años';
                        }
                        if(second<=59 && second!=0){
                            if(second==1){
                                result='hace '+second+' segundo';
                            }else{
                                result='hace '+second+' segundos';
                            }
                        }
                        if(minute<=59 && minute!=0){
                            if(minute==1){
                                result='hace '+minute+' minuto';
                            }else{
                                result='hace '+minute+' minutos';
                            }
                        }
                        if(hour<=23 && hour!=0){
                            if(hour==1){
                                result='hace '+hour+' hora';
                            }else{
                                result='hace '+hour+' horas';
                            }
                        }
                        if(day<=6 && day!=0){
                            if(day==1){
                                result='hace '+day+' dia';
                            }else{
                                result='hace '+day+' dias';
                            }
                        }
                        if(week<=3 && week!=0){
                            if(week==1){
                                result='hace '+week+' semana';
                            }else{
                                result='hace '+week+' semanas';
                            }
                        }
                        if(month<=11 && month!=0){
                            if(month==1){
                                result='hace '+month+' mes';
                            }else{
                                result='hace '+month+' meses';
                            }
                        }
                    }
                    if (seguidor.loEstoySiguiendo) {
                        boton = `<button data-seguirid="${seguidor.usuario_id}" id="modalDejarDeSeguir" class="btn btn-outline-secondary">Siguiendo</button>`;
                    } else {
                        boton = `<button data-seguirid="${seguidor.usuario_id}" id="btn-seguir-usuario" class="btn btn-primary">Seguir</button>`;
                    }
                    
                    $('#list_seguir').append(`<div class="row bc-white">
                                        <div class="col-md-1">
                                            <img src="${base_url}/Imagen/${seguidor.foto}" class="circular--square" alt="..." width="33" height="33">
                                        </div>
                                        <div class="col-md-7">
                                            <h6>${seguidor.nombre_usuario}</h6>
                                            <!--console.log(fecha.diff(${seguidor.fecha}, 'days'), ' dias de diferencia');-->
                                            <p>${result}</p>
                                            <!--<p>ha comenzado a seguirte. 4sem ago</p>-->
                                        </div>
                                        <div class="offset-md-1"></div>
                                        <div class="col-md-2">  
                                            ${boton}
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>`);
                })
            } else {
                $('#list_seguir').append(`<div class="row bc-white">
                                        <div class="col-md-1">
                                            <i class="fa fa-user-circle fa-1x"></i>
                                        </div>
                                        <div class="col-md-7">
                                            <h6>No hay ningun seguidor</h6>
                                        </div>
                                        <div class="offset-md-1"></div>
                                        <div class="col-md-2">
                                            <button class="btn btn-default">Ir al Buscador</button>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>`);

            }

        }).catch(function (response) {
            console.log('respuesta error', response)

        });
    }

    //Evento para seguir a Usuario
    $('#list_seguir').on('click', '#btn-seguir-usuario', (evt) => {
        let target = $(evt.target);
        let data = {
            usuario_id: loginData.usuario_id,
            usuario_seg_id: target.data('seguirid'), //id de usuario a seguir
            seguir: true
        }
        seguirODejarSeguir(data);

    });
    $('#sugerencia_list').on('click', '#btnSeguir', (evt) => {
        let target = $(evt.target);
        let data = {
            usuario_id: loginData.usuario_id,
            usuario_seg_id: target.data('seguirid'), //id de usuario a seguir
            seguir: true
        }
        // console.log(data);
        seguirODejarSeguir(data);
        target.attr('id','btnDejarSeguir');
        target.text("Siguiendo");
        target.removeClass('btn-primary');
        target.addClass('btn-secondary');
    });
    $('#sugerencia_list').on('click', '#btnDejarSeguir', (evt) => {
        let target = $(evt.target);
        let data = {
            usuario_id: loginData.usuario_id,
            usuario_seg_id: target.data('seguirid'), //id de usuario a seguir
            seguir: false
        }
        // console.log(data);
        seguirODejarSeguir(data);
        // id="btnSeguir" class="btn btn-primary"
        target.attr('id', 'btnSeguir');
        target.text("Seguir");
        target.removeClass('btn-secondary');
        target.addClass('btn-primary');

    });

    //Evento click modal dejar de seguir
    $('#list_seguir').on('click', '#modalDejarDeSeguir', (evt) => {

        let target = $(evt.target);
        // console.log('modalDejarDeSeguir', target, target.data('seguirid'));
        fetch(base_url + '/getseguidor/' + target.data('seguirid')).then((response) => response.json()
        ).then(function (myJson) {
            // console.log(myJson);
            let perfil = myJson.perfil;
            $('#m_body').empty();
            $('#m_body').append(`<div class="col-md-12 mt-2">
                                    <img src="${base_url}/Imagen/${perfil.foto}" class="circular--square" alt="..." width="160" height="160">
                                </div>
                                <div class="col-md-12 mt-4 mb-4">
                                    <h6>Si cambias de opinión, tendrás que volver a enviar una solicitud de seguimiento a <strong id="modal_nombre_usuario"> @${perfil.nombre_usuario}</strong> .</h6>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="col-md-12 mt-4">
                                    <button type="button" data-usuarioid="${perfil.id_usuario}" id="btn-dejar-de-seguir" class="btn btn-outline-danger">Dejar de Seguir</button>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="col-md-12 mt-4">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                                </div>`);

            $('#exampleModalCenter').modal('show');
        }).catch(function (response) {
            console.log('respuesta error', response)

        });
    })
    //Evento click dejar de seguir 
    $('#m_body').on('click', '#btn-dejar-de-seguir', (evt) => {
        let target = $(evt.target);
        // console.log('dejar-de-seguir', target, target.data('usuarioid'));
        let data = {
            usuario_id: loginData.usuario_id,
            usuario_seg_id: target.data('usuarioid'), //id de usuario a seguir
            seguir: false
        }
        seguirODejarSeguir(data);
    })

    function seguirODejarSeguir(data) {
        // console.log(data);
        fetch('/seguidorStore', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('input[name="_token"]').val()
            },
            body: JSON.stringify(data)
        }).then((response) => response.json())
            .then(function (myJson) {
                console.log(myJson);
                if (myJson.exito) {
                    if(loginData.notificaciones == 't'){
                        console.log('entro');
                        if (!myJson.seguir) {
                            console.log('entro1');
                            $('#exampleModalCenter').modal('hide');
                            Toastify({
                                text: `Dejaste de Seguir a @${myJson.seguidor.nombre_usuario}`,
                                duration: -1,
                                close: true,
                                gravity: "bottom",
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                onClick: function () { } // Callback after click
                            }).showToast();
                        } else {
                            console.log('entro2');
                            Toastify({
                                text: `Comezaste a Seguir a @${myJson.seguidor.nombre_usuario}`,
                                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                                duration: -1,
                                close: true,
                                gravity: "bottom",
                                className: "info",
                            }).showToast();
                        }
                    }
                }
            }).catch(function (response) {
                console.log('respuesta error', response)
    
            });

    }
    
});