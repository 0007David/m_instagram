
$(document).ready((evt) => {
    console.log('estadistica');
    /* ChartJS
     * Here we will create a few charts using ChartJS
     * AREA CHART -
     */

    let labels = Object.keys(dataSetBar);
    let data_m = [];
    let data_f = [];
    Object.entries(dataSetBar).forEach(([key, value]) => {
        data_m.push(value.percent_m)
        data_f.push(value.percent_f)
        // console.log(key + ' ' + value);
    });
    // console.log('dataSet: ', data_f,data_m)
    let areaBarDataEdates = {
        labels: labels,//['Menor 17', '18 - 28', '29 - 48', '49 - 64', 'Mayor 65'],
        datasets: [
            {
                label: 'Maculino',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: data_m//[28, 48, 19, 86, 90]
            },
            {
                label: 'Femenino',
                backgroundColor: '#fdb6d6',//'rgba(210, 214, 222, 1)',
                borderColor: '#fdb6d6',//'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: '#fdb6d6',//'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: data_f//[65, 80, 81, 55, 40]
            },
        ]
    }


    // POST
    let donutDataGenero = {
        labels: dataSetPieChart.parametros,
        datasets: [
            {
                data: dataSetPieChart.porcentajes,
                backgroundColor: ['#3c8dbc', '#fdb6d6'],
            }
        ]
    }

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    let pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    let pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    let pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: donutDataGenero,
        options: pieOptions
    })
    //-------------------------------------------------------------------------------
    //-------------
    //- BAR CHART -
    //-------------
    let barChartCanvas = $('#barChart').get(0).getContext('2d')
    let barChartData = jQuery.extend(true, {}, areaBarDataEdates)
    let temp0 = areaBarDataEdates.datasets[0]
    let temp1 = areaBarDataEdates.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    let barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    let barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    let stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    let stackedBarChartData = jQuery.extend(true, {}, barChartData)

    let stackedBarChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    }

    let stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    });
   
    //Reportes de Usuario
    $('#reporte_selected').change((evt) => {
        let target = $(evt.target);
        let typeReporte = target.val();

        fetch(base_url + '/reportes/' + typeReporte).then((response) => response.json()
        ).then(function (myJson) {
            let dataReporte; let header_tabla;
            if (myJson.count > 0) {
                switch (typeReporte) {
                    case 'posts':
                        dataReporte = myJson.posts;
                        console.log(Object.keys(dataReporte[0]))
                        header_tabla = ['#','Foto','Descripcion','Fecha']
                        $('#tabla_head').empty();
                        $('#tabla_head').append(`<tr>
                                <th scope="col">${header_tabla[0]}</th>
                                <th scope="col">${header_tabla[1]}</th>
                                <th scope="col">${header_tabla[2]}</th>
                                <th scope="col">${header_tabla[3]}</th>
                            </tr>`);
                        $('#tabla_body').empty();
                        Object.entries(dataReporte).forEach(([key, post]) => {
                            $('#tabla_body').append(`<tr>
                                    <td>${parseInt(key) + 1}</td>
                                    <td><img src="${base_url}/Imagen/${post.foto}" width="40" height="40"></td>
                                    <td>${post.descripcion}</td>
                                    <td>${post.fecha}</td>
                                </tr>`);
                        });
                        break;
                    case 'seguidores':
                        dataReporte = myJson.seguidores;
                        // console.log(Object.keys(dataReporte[0]))
                        $('#tabla_head').empty();
                        $('#tabla_head').append(`<tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">Fecha</th>
                            </tr>`);
                        $('#tabla_body').empty();
                        Object.entries(dataReporte).forEach(([key, seguidor]) => {
                            $('#tabla_body').append(`<tr>
                                    <td>${parseInt(key) + 1}</td>
                                    <td><img src="${base_url}/Imagen/${seguidor.foto}" width="40" height="40"></td>
                                    <td>${seguidor.nombre}</td>
                                    <td>${seguidor.nombre_usuario}</td>
                                    <td>${seguidor.fecha_hora}</td>
                                </tr>`);
                        });
                        break;
                    case 'seguidos':
                        dataReporte = myJson.seguidos;
                        // console.log(Object.keys(dataReporte[0]))
                        $('#tabla_head').empty();
                        $('#tabla_head').append(`<tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">Fecha</th>
                            </tr>`);
                        $('#tabla_body').empty();
                        Object.entries(dataReporte).forEach(([key, seguido]) => {
                            $('#tabla_body').append(`<tr>
                                    <td>${parseInt(key) + 1}</td>
                                    <td><img src="${base_url}/Imagen/${seguido.foto}" width="40" height="40"></td>
                                    <td>${seguido.nombre}</td>
                                    <td>${seguido.nombre_usuario}</td>
                                    <td>${seguido.fecha_hora}</td>
                                </tr>`);
                        });
                        break;
                }
            } else {
                $('#tabla_body').empty();
            }
        }).catch(function (response) {
            console.log('respuesta error', response)
        });
    });
    
    //--- ejemplo2
    $('#btnExportPdf').click((evt) => {

        demoFromHTML();
        // let doc = new jsPDF({ putOnlyUsedFonts: true, orientation: "landscape" });
        // doc.table(1, 1, generateData(10), headers, { autoSize: true });

        // var file = $("#row_reporte").val();
        // if (file === undefined) {
        //     file = "demo";
        // }
        // if (typeof doc !== "undefined") {
        //     doc.save(file + ".pdf");
        // } else if (typeof pdf !== "undefined") {
        //     setTimeout(function () {
        //         pdf.save(file + ".pdf");
        //     }, 2000);
        // } else {
        //     alert("Error 0xE001BADF");
        // }
    });
       
    function demoFromHTML() {
        let pdf = new jsPDF('p', 'pt', 'letter');
        // var doc = new jsPDF();

        // doc.autoTable({
        //   html: '#tabla_reporte',
        //   bodyStyles: {minCellHeight: 15},
        //   didDrawCell: function(data) {
        //       if (data.column.index === 1 && data.cell.section === 'body') {
        //         console.log('data-table', data)
        //        let td = data.cell.raw;
        //        let img = td.getElementsByTagName('img')[0];
        //        let dim = data.cell.height - data.cell.padding('vertical');
        //        let textPos = data.cell.textPos;
        //        console.log('textPos:',textPos)
        //        doc.addImage(img.src, data.cell.x,  data.cell.y, dim, dim);
        //     }
        //   }
        // });
      
            // doc.save("table.pdf");
        console.log('export', pdf)
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#row_reporte')[0];
        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        console.log('export', specialElementHandlers)
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 340
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, {// y coord
            'width': margins.width, // max width of content on PDF
            'elementHandlers': specialElementHandlers
        },
            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }
            , margins);
    }

});