var userConversionOptions = {
  series: [{
  name: 'Net Profit',
  data: [300, 400, 200, 100, 250]
}, {
  name: 'Revenue',
  data: [400, 100, 550, 320, 220]
}],
  chart: {
  type: 'bar',
  height: 300
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    endingShape: 'rounded'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  categories: ['9:00', '11:00', '13:00', '15:00', '17:00'],
},
yaxis: {
},
fill: {
  opacity: 1
},
tooltip: {
  y: {
    formatter: function (val) {
      return "$ " + val + " thousands"
    }
  }
}
};

var chart = new ApexCharts(document.querySelector("#userConversion"), userConversionOptions);
chart.render();


var userActivityOptions = {
  series: [{
    name: "User",
    data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
  },
  {
    name: "User",
    data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
  },
  {
    name: 'User',
    data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
  }
],
  chart: {
  height: 250,
  type: 'line',
  zoom: {
    enabled: false
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  width: [2, 2, 2],
  curve: 'straight',
},
legend: {
  tooltipHoverFormatter: function(val, opts) {
    return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>'
  }
},
markers: {
  size: 0,
  hover: {
    sizeOffset: 6
  }
},
xaxis: {
  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Dec'],
},
tooltip: {
  y: [
    {
      title: {
        formatter: function (val) {
          return val + " (mins)"
        }
      }
    },
    {
      title: {
        formatter: function (val) {
          return val + " per session"
        }
      }
    },
    {
      title: {
        formatter: function (val) {
          return val;
        }
      }
    }
  ]
},
grid: {
  borderColor: '#f1f1f1',
}
};

var chart = new ApexCharts(document.querySelector("#userActivity"), userActivityOptions);
chart.render();