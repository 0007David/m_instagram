
$(document).ready((evt) => {
  moment.locale('es');
  //-- Varibles Dona Char
  let views = new Object();
  let background = [];
  let sumaTotal = 0;
  //----- Varibles Bar Char
  let labelsBarGrafica = new Object(); // meses => "HH:mm:ss"
  let labelsBar2Grafica = new Object();// meses => "14"

  console.log('logaccess js');
  // $('#summernote').summernote('disable');
  $("#summernote").summernote("enable");
  $('.note-editable').css('font-size', '18px');
  if (typeof logBar !== 'undefined') {
    generarDatosGrafica(logBar.historiales);
    console.log(logBar);
    generarDatosGraficoBarra(logBar.sesiones)
  }

  // Decimal round
  function round10(numero, decimales) {
    numeroRegexp = new RegExp('\\d\\.(\\d){' + decimales + ',}');   // Expresion regular para numeros con un cierto numero de decimales o mas
    if (numeroRegexp.test(numero)) {         // Ya que el numero tiene el numero de decimales requeridos o mas, se realiza el redondeo
      return Number(numero.toFixed(decimales));
    } else {
      return Number(numero.toFixed(decimales)) === 0 ? 0 : numero;  // En valores muy bajos, se comprueba si el numero es 0 (con el redondeo deseado), si no lo es se devuelve el numero otra vez.
    }
  }

  // funcion 
  function generarDatosGrafica(logData) {
    let salida = new Object(), finalViews = new Object();
    logData.forEach((item) => {
      // console.log(item);
      Object.entries(item.user).forEach(([key, value]) => {
        if (salida.hasOwnProperty(key)) {
          salida[key] = salida[key] + value;
        } else {
          salida[key] = value;
        }
      });
    })
    // console.log('salida: ',salida)
    Object.entries(salida).forEach(([key, value]) => {
      finalViews[value] = key + '-' + value;
    });
    // console.log('views: ',finalViews)
    let backgroundInit = ['#d2d6de', '#3c8dbc', '#00c0ef', '#f39c12', '#00a65a', '#f56954'];
    if (Object.keys(finalViews).length > 6) {
      let i = Object.keys(finalViews).length - 6;
      Object.entries(finalViews).forEach(([key, value]) => {
        i--;
        if (i < 0) {
          views[key] = value;
          sumaTotal += parseInt(key);
        }
      });
      background = backgroundInit;
      //total 
    } else {
      views = finalViews;
      Object.entries(finalViews).forEach(([key, value]) => sumaTotal += parseInt(key));
      for (let index = 0; index < Object.keys(views).length; index++) {
        background[index] = backgroundInit[index];
      }

    }
  }

  function generarDatosGraficoBarra(logDataSesiones) {

    let fechaBegin = "", fechaEnd = "", mesBegin = "", mesEnd = "", horaBegin, horaDiff, horaInt;
    for (let index = 0; index < logDataSesiones.length - 1;) {
      fechaBegin = logDataSesiones[index].fecha;
      fechaEnd = logDataSesiones[index + 1].fecha;
      mesBegin = moment(fechaBegin).format('MMMM');
      mesEnd = moment(fechaEnd).format('MMMM');
      if (!labelsBarGrafica.hasOwnProperty(mesBegin)) {
        horaDiff = moment.utc(moment(fechaEnd).diff(moment(fechaBegin))).format("HH:mm:ss")
        horaInt = round10(moment(horaDiff, "HH:mm:ss").hour() + (moment(horaDiff, "HH:mm:ss").minute() / 60), 2);
        labelsBarGrafica[mesBegin] = horaDiff;
        labelsBar2Grafica[mesBegin] = horaInt;
      } else {
        horaDiff = moment.utc(moment(fechaEnd).diff(moment(fechaBegin))).format("HH:mm:ss")
        horaBegin = moment(labelsBarGrafica[mesBegin], "HH:mm:ss");
        console.log('horaDiff', horaDiff, horaBegin.hour(), horaBegin.minute(), horaBegin.hour() + (horaBegin.minute() / 60))
        horaBegin.add(moment.duration(horaDiff));
        horaInt = horaBegin.hour() + (horaBegin.minute() / 60);
        labelsBarGrafica[mesBegin] = horaBegin.format("HH:mm:ss");
        labelsBar2Grafica[mesBegin] = round10(horaInt, 2);
      }
      index += 2;
    }
    console.log('labelsBarGrafica', labelsBarGrafica)
    console.log('labelsBar2Grafica', labelsBar2Grafica)
  }

  // console.log('views: ',views, sumaTotal)
  let labels = Object.values(views);
  let data = Object.keys(views);
  let dataPercent = [];
  data.forEach((ele) => {
    dataPercent.push(Math.round((parseInt(ele) * 100 / parseInt(sumaTotal))));
  })
  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: labels,
    datasets: [
      {
        data: dataPercent,
        backgroundColor: background,
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
  //--------------
  var areaChartData = {
    labels: Object.keys(labelsBar2Grafica),//['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Horas',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: Object.values(labelsBar2Grafica)//[28, 48, 40, 19, 86, 27, 90]
      },
      // {
      //   label: 'Horas',
      //   backgroundColor: 'rgba(210, 214, 222, 1)',
      //   borderColor: 'rgba(210, 214, 222, 1)',
      //   pointRadius: false,
      //   pointColor: 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor: '#c1c7d1',
      //   pointHighlightFill: '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data: Object.values(labelsBar2Grafica)//[65, 59, 80, 81, 56, 55, 40]
      // },
    ]
  }
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  // var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp0
  // barChartData.datasets[1] = temp0

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

  // Reportes
  $('#btnReporteAcceso').click((evt) => {
    logBar.navegacion.forEach((ele, key) => {
      $('#tablaAcceso').append(`
       <tr>
          <th scope="row">${key + 1}</th>
          <td>${ moment(ele.fecha).format('DD/MM/YYYY')}</td>
          <td>${ele.view}</td>
          <td>${ele.user.nombre_usuario}</td>
          <td>${ele.user.user_agent}</td>
          <td>${ele.user.ip_address}</td>
          <td>${ele.user.location.city}-${ele.user.location.country}</td>
      </tr>
       `);
    })
  })
  $('#btnAccesoFail').click((evt) => {
    logBar.objsAccessFails.forEach((ele, key) => {
      // console.log(ele);
      
      $('#tablaAccesFail').append(`
      <tr>
         <th scope="row">${key + 1}</th>
         <td>${ moment(ele.fecha).format('DD/MM/YYYY')}</td>
         <td>${ele.user.usuario_email}</td>
         <td>${ele.user.password}</td>
         <td>${ele.user.user_agent}</td>
         <td>${ele.user.ip_address}</td>
         <td>${ele.user.location.city}-${ele.user.location.country}</td>
     </tr>
      `);
    })


  })

});