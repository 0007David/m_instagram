
$(document).ready((evt) => {
    console.log('estadistica');
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //--------------
    //- AREA CHART -
    //--------------

    let labels = Object.keys(dataSetBar);
    let data_m =[];
    let data_f =[];
    Object.entries(dataSetBar).forEach(([key, value]) => {
        data_m.push(value.percent_m)
        data_f.push(value.percent_f)
        // console.log(key + ' ' + value);
    });
    // console.log('dataSet: ', data_f,data_m)
    var areaBarDataEdates = {
        labels  : labels,//['Menor 17', '18 - 28', '29 - 48', '49 - 64', 'Mayor 65'],
        datasets: [
          {
            label               : 'Maculino',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : data_m//[28, 48, 19, 86, 90]
          },
          {
            label               : 'Femenino',
            backgroundColor     : '#fdb6d6',//'rgba(210, 214, 222, 1)',
            borderColor         : '#fdb6d6',//'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : '#fdb6d6',//'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : data_f//[65, 80, 81, 55, 40]
          },
        ]
      }

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
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
    var donutDataGenero = {
        labels: dataSetPieChart.parametros,
        datasets: [
            {
                data: dataSetPieChart.porcentajes,
                backgroundColor: ['#3c8dbc','#fdb6d6' ],
            }
        ]
    }

    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: donutDataGenero,
        options: pieOptions
    })
//-------------------------------------------------------------------------------
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaBarDataEdates)
    var temp0 = areaBarDataEdates.datasets[0]
    var temp1 = areaBarDataEdates.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
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

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    })
});