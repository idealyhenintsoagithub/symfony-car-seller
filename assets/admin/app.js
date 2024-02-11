import './app.scss';

import Chart from 'chart.js/auto';


// var data = [
//   { year: 2010, count: 10 },
//   { year: 2011, count: 20 },
//   { year: 2012, count: 15 },
//   { year: 2013, count: 25 },
//   { year: 2014, count: 22 },
//   { year: 2015, count: 30 },
//   { year: 2016, count: 28 },
// ];

function parseData(rawData) {
  var labels = [];
  var data = [];

  for (var ele in rawData) {
    labels.push(Object.keys(rawData[ele])[0]);
    data.push(Object.values(rawData[ele])[0]);
  }

  return {
    'labels': labels,
    'data': data
  };
}

var element = document.getElementById('productPerVendor');
var rawData = JSON.parse(element.dataset.data);
var labels = parseData(rawData).labels;
var data = parseData(rawData).data;

const chart = new Chart(
  element,
  {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          backgroundColor: ['#ff00006e', '#00ff006e', '#ffc1076e', '#0000ff6e'],
          borderWidth: 2,
          borderColor: ['#ff0000ff', '#00ff00ff', '#ffc107ff', '#0000ffff'],
          // label: 'Nombre des voitures',
          data: data
        }
      ]
    }
  }
);
var totalOrderElement = document.getElementById('totalOrder');

const pieConfig = {
  type: 'doughnut',
  data: {
    datasets: [
      {
        // backgroundColor: ['#ff00006e', '#00ff006e', '#ffc1076e', '#0000ff6e'],
        // borderWidth: 2,
        // borderColor: ['#ff0000ff', '#00ff00ff', '#ffc107ff', '#0000ffff'],
        data: [100, 200],
      }
    ],
  },
};

const totalOrderElementChart = new Chart(
  totalOrderElement,
  pieConfig
);
