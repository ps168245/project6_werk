import Chart from 'chart.js/auto'; // package.json
var labels = _months
var users =  _monthsCount
const data = {
  labels: labels,
  datasets: [{
    label: 'Aantal gebruikers per maand',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(255, 99, 132)',
    data: users,
  }]
};  
const config = {
  type: 'line',
  data: data,
  options: {
    scales: {
      x: {
        title: {
          display: true,
          text: 'Maanden'
        }
      },
      y: {
        beginatzero: true,
        title: {
          display: true,
          text: 'Aantal gebruikers'                
        },
        ticks: {
        precision: 0
       }
      }
    }
  }
};  
const myChart = new Chart(
  document.getElementById('myChart'),
  config
);  
