
const api = new XMLHttpRequest();
api.open('GET', 'http://localhost/unidadfomento-app/app/controller/grafico.controller.php', true);
api.send();

let myChart;

api.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    const datosOriginales = JSON.parse(this.responseText);
    
    
    mostrarGrafico(datosOriginales);
    

    const filtroForm = document.getElementById('filtro-fechas');
    filtroForm.addEventListener('submit', (event) => {
      event.preventDefault();
      const fechaDesde = new Date(filtroForm.elements['fecha-desde'].value);
      const fechaHasta = new Date(filtroForm.elements['fecha-hasta'].value);
      const datosFiltrados = filtrarDatosPorFechas(datosOriginales, fechaDesde, fechaHasta);
      mostrarGrafico(datosFiltrados);
    });
  }
};

function mostrarGrafico(datos) {
  datos.sort(function(a, b) {
    return new Date(a.fecha) - new Date(b.fecha);
  });
  
  if (myChart) {
    myChart.destroy();
  }
  
  var ctx = document.getElementById('graficouf').getContext('2d');
  
  myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: datos.map(dato => dato.fecha),
      datasets: [{
        label: 'Valor en pesos $',
        data: datos.map(dato => dato.valor),
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
}

function filtrarDatosPorFechas(datos, fechaDesde, fechaHasta) {
  return datos.filter((dato) => {
    const fechaDato = new Date(dato.fecha);
    return fechaDato >= fechaDesde && fechaDato <= fechaHasta;
  });
}

