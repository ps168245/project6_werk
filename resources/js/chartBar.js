import Chart from 'chart.js/auto'; // package.json
var labels = _years
var users =  _yearsCount
const ctx = document.getElementById('myChart2');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      label: 'Aantal gebruikers geboren in dit jaar',
      data: users,
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});