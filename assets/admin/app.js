import './app.scss';

import Chart from 'chart.js/auto';


var data = [
  { year: 2010, count: 10 },
  { year: 2011, count: 20 },
  { year: 2012, count: 15 },
  { year: 2013, count: 25 },
  { year: 2014, count: 22 },
  { year: 2015, count: 30 },
  { year: 2016, count: 28 },
];

var element = document.getElementById('bar');

const chart = new Chart(
  element,
  {
    type: 'bar',
    data: {
      labels: data.map(row => row.year),
      datasets: [
        {
          label: 'Acquisitions by year',
          data: data.map(row => row.count)
        }
      ]
    }
  }
);
var totalOrderElement = document.getElementById('totalOrder');

const totalOrderElementChart = new Chart(
  totalOrderElement,
  {
    type: 'line',
    options: {
      plugins: {
        legend: false
      }
    },
    data: {
      labels: [100, 200, 300, 400, 500],
      datasets: [{
          data: [10, 30, 40, 50, 60]
      }]
    }
  }
);
