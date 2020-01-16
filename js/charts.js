google.charts.load('current', { 'packages': ['gauge'] });
google.charts.setOnLoadCallback(drawChart);

// import RadialGauge from 'https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/third-party/canvas-gauges/lib/RadialGauge.js'

function drawChart() {
    drawChart_single("chart_div")
}
function drawChart_single(id_name) {
    var data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['Tesla', 80],
        ['Pfizer', 55],
        ['Gold', 68]
    ]);

    var options = {
        width: 400, height: 120,
        redFrom: 90, redTo: 100,
        yellowFrom: 75, yellowTo: 90,
        minorTicks: 5
    };

    var chart = new google.visualization.Gauge(document.getElementById(id_name));

    chart.draw(data, options);

    setInterval(function () {
        data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
    }, 13000);
    setInterval(function () {
        data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
        chart.draw(data, options);
    }, 5000);
    setInterval(function () {
        data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
        chart.draw(data, options);
    }, 26000);
}

// function animateRadialGauge()
// {
//     var gauge=document.getElementsByTagName('canvas')[0];

//     gauge.setAttribute('data-animation', true);
//     gauge.setAttribute('data-animation-duration', 500);

//     // var gauge = new RadialGauge({
//     //     renderTo: 'gauge-id', // identifier of HTML canvas element or element itself
//     //     width: 400,
//     //     height: 400,
//     //     units: 'Km/h',
//     //     title: false,
//     //     value: 0,
//     //     minValue: 0,
//     //     maxValue: 220,
//     //     majorTicks: [
//     //         '0','20','40','60','80','100','120','140','160','180','200','220'
//     //     ],
//     //     minorTicks: 2,
//     //     strokeTicks: false,
//     //     highlights: [
//     //         { from: 0, to: 50, color: 'rgba(0,255,0,.15)' },
//     //         { from: 50, to: 100, color: 'rgba(255,255,0,.15)' },
//     //         { from: 100, to: 150, color: 'rgba(255,30,0,.25)' },
//     //         { from: 150, to: 200, color: 'rgba(255,0,225,.25)' },
//     //         { from: 200, to: 220, color: 'rgba(0,0,255,.25)' }
//     //     ],
//     //     colorPlate: '#222',
//     //     colorMajorTicks: '#f5f5f5',
//     //     colorMinorTicks: '#ddd',
//     //     colorTitle: '#fff',
//     //     colorUnits: '#ccc',
//     //     colorNumbers: '#eee',
//     //     colorNeedleStart: 'rgba(240, 128, 128, 1)',
//     //     colorNeedleEnd: 'rgba(255, 160, 122, .9)',
//     //     valueBox: true,
//     //     animationRule: 'bounce'
//     // });


//     // var gauge = new RadialGauge({
//     //     renderTo: 'canvas-id'
//     // }).draw();

// }
// Create chart
// var ctx = document.getElementById("chartjs-gauge");
// var chart = new Chart(ctx, {
//     type:"doughnut",
//     data: {
//         labels : ["Red","Blue"],
//         datasets: [{
//             label: "Gauge",
//             data : [10, 190],
//             backgroundColor: [
//                 "rgb(255, 99, 132)",
//                 "rgb(54, 162, 235)",
//                 "rgb(255, 205, 86)"
//             ]
//         }]
//     },
//     options: {
//         circumference: Math.PI,
//         rotation : Math.PI,
//         cutoutPercentage : 80, // precent
//         plugins: {
// 					  datalabels: {
//               backgroundColor: 'rgba(0, 0, 0, 0.7)',
// 						  borderColor: '#ffffff',
//               color: function(context) {
// 							  return context.dataset.backgroundColor;
// 						  },
// 						  font: function(context) {
//                 var w = context.chart.width;
//                 return {
//                   size: w < 512 ? 18 : 20
//                 }
//               },
//               align: 'start',
//               anchor: 'start',
//               offset: 10,
// 						  borderRadius: 4,
// 						  borderWidth: 1,
//               formatter: function(value, context) {
// 							  var i = context.dataIndex;
//                 var len = context.dataset.data.length - 1;
//                 if(i == len){
//                   return null;
//                 }
// 							  return value+' mph';
// 						  }
//             }
//         },
//         legend: {
//             display: false
//         },
//         tooltips: {
//             enabled: false
//         }
//     }
// });


// // DEMO Code: not relevant to example
// function change_gauge(chart, label, data){
//   chart.data.datasets.forEach((dataset) => {
//     if(dataset.label == label){
//       dataset.data = data;
//     }  
//   });
//   chart.update();
// }

// var accelerating = false;
// function accelerate(){
//   accelerating = false;
//   window.setTimeout(function(){
//       change_gauge(chart,"Gauge",[20,140])
//   }, 1000);

//   window.setTimeout(function(){
//       change_gauge(chart,"Gauge",[60,140])
//   }, 2000);

//   window.setTimeout(function(){
//       change_gauge(chart,"Gauge",[100,100])
//   }, 3000);

//   window.setTimeout(function(){
//       change_gauge(chart,"Gauge",[180,20])
//   }, 4000);

//   window.setTimeout(function(){
//       change_gauge(chart,"Gauge",[200,0])
//   }, 5000);
// }

// // Start sequence
// accelerate();
// window.setInterval(function(){
//   if(!accelerating){
//     acelerating = true;
//     accelerate();
//   }
// }, 6000);








function myFunction() {
    window.alert("sometext");
}
