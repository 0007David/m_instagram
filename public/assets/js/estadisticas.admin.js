
$(document).ready((evt) => {
    console.log('estadistica admin');

    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //--------------
    //- AREA CHART -
    //--------------

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

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    let donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    let donutData = {
        labels: [
            'Chrome',
            'IE',
            'FireFox',
            'Safari',
            'Opera',
            'Navigator',
        ],
        datasets: [
            {
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }
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

    let donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    let donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

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
    })
    //Actualizamos la Grafica
    $('#user_selected').change((evt) => {
        let target = $(evt.target);
        let usuarioId = target.val();
        console.log('target', target, target.val());
        fetch(base_url + '/generoSeguidor/' + usuarioId).then((response) => response.json()
        ).then(function (myJson) {
            console.log(myJson);
            if (myJson.exito) {
                //---- Redenrizamos el PieChart---//
                let dataPie = myJson.respuesta.genero;
                let dataBart = myJson.respuesta.edades;
                pieChart.destroy() // eliminamos los datos anteriores;
                donutDataGenero = {
                    labels: dataPie.parametros,
                    datasets: [{ data: dataPie.porcentajes, backgroundColor: ['#3c8dbc', '#fdb6d6'], }]
                }
                pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: donutDataGenero,
                    options: pieOptions
                })
                //---- Redenrizamos el BartChart---//
                labels = Object.keys(dataBart);
                data_m = [];
                data_f = [];
                Object.entries(dataBart).forEach(([key, value]) => {
                    data_m.push(value.percent_m)
                    data_f.push(value.percent_f)
                });
                areaBarDataEdates = {
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
                barChart.destroy() // eliminamos los datos anteriores;

                // let barChartCanvas = $('#barChart').get(0).getContext('2d')
                barChartData = jQuery.extend(true, {}, areaBarDataEdates)
                temp0 = areaBarDataEdates.datasets[0]
                temp1 = areaBarDataEdates.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                }

                barChart = new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })
                //--- STACKEB BAR CHAR--//
                stackedBarChart.destroy()
                stackedBarChartData = jQuery.extend(true, {}, barChartData)
                
                stackedBarChartOptions = {
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
                stackedBarChart = new Chart(stackedBarChartCanvas, {
                    type: 'bar',
                    data: stackedBarChartData,
                    options: stackedBarChartOptions
                })
            }

        }).catch(function (response) {
            console.log('respuesta error', response)

        });

    })
    function addData(chart, label, data) {
        console.log(data)
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            console.log('dataset: ', dataset.data)
            dataset.data.push(data.pop());
        });
        chart.update();
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });
        chart.update();
    }
});