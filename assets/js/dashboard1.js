(function($) {
"use strict";
/*
	$.post( SERVER_API + "Dashboards/spartLine/", function( data ) {
	var data_server = $.parseJSON(data);
	var data_sparkline = data_server.data;
	
	console.log(data_sparkline);
	var sparklineCharts = function() {
        $("#sparkline1").sparkline(data_sparkline, {
            type: 'bar',
            width: '100%',
            height: '100',
			barSpacing :5,
            barColor: '#49b6d6',
			enableTagOptions: true,
            fillColor: "transparent",
			barWidth: 20,
			zeroAxis:true,
			tooltipFormat: "<span style=\"color: {{color}}\">&#9679;</span> {{offset:names}} ({{value}})",
            tooltipValueLookups: {
            names: {
                0: 'Lunes',
                1: 'Martes',
                2: 'Miercoles',
                3: 'Jueves',
                4: 'Viernes',
                5: 'Sabado',
                6: 'Domingo'
            }}
        });
    };
	
	sparklineCharts();

    

    var sparkResize;

    $(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineCharts, 500);
    });

    sparklineCharts();

});
*/
    var chartData = [{
        "year": "2000",
        "cars": 1691,
        "motorcycles": 737

    }, {
        "year": "2001",
        "cars": 1098,
        "motorcycles": 680,
        "bicycles": 910
    }, {
        "year": "2002",
        "cars": 975,
        "motorcycles": 664,
        "bicycles": 670
    }, {
        "year": "2003",
        "cars": 1246,
        "motorcycles": 648,
        "bicycles": 930
    }, {
        "year": "2004",
        "cars": 1218,
        "motorcycles": 637,
        "bicycles": 1010
    }, {
        "year": "2005",
        "cars": 1913,
        "motorcycles": 133,
        "bicycles": 1770
    }, {
        "year": "2006",
        "cars": 1299,
        "motorcycles": 621,
        "bicycles": 820
    }, {
        "year": "2007",
        "cars": 1110,
        "motorcycles": 10,
        "bicycles": 1050
    }, {
        "year": "2008",
        "cars": 765,
        "motorcycles": 232,
        "bicycles": 650
    }, {
        "year": "2009",
        "cars": 1145,
        "motorcycles": 219,
        "bicycles": 780
    }, {
        "year": "2010",
        "cars": 1163,
        "motorcycles": 201,
        "bicycles": 700
    }, {
        "year": "2011",
        "cars": 1780,
        "motorcycles": 85,
        "bicycles": 1470
    }, {
        "year": "2012",
        "cars": 1580,
        "motorcycles": 285
    }];

    var chart = AmCharts.makeChart("chartdiv3", {
        "type": "serial",
        "theme": "dark",

        "fontFamily": "Lato",
        "autoMargins": true,
        "addClassNames": true,
        "zoomOutText": "",
        "defs": {
            "filter": [{
                    "x": "-50%",
                    "y": "-50%",
                    "width": "0",
                    "height": "0",
                    "id": "blur",
                    "feGaussianBlur": {
                        "in": "SourceGraphic",
                        "stdDeviation": "50"
                    }
                },
                {
                    "id": "shadow",
                    "width": "150%",
                    "height": "150%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": "2",
                        "dy": "2"
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": "10"
                    },
                    "feColorMatrix": {
                        "result": "blurOut",
                        "type": "matrix",
                        "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }
            ]
        },
        "fontSize": 15,
        "pathToImages": "../amcharts/images/",
        "dataProvider": chartData,
        "dataDateFormat": "YYYY",
        "marginTop": 0,
        "marginRight": 1,
        "marginLeft": 0,
        "autoMarginOffset": 5,
        "categoryField": "year",
        "categoryAxis": {
            "gridAlpha": 0.07,
            "axisColor": "#DADADA",
            "startOnAxis": true,
            "tickLength": 0,
            "parseDates": true,
            "minPeriod": "YYYY"
        },

        "valueAxes": [{
            "ignoreAxisWidth": true,
            "stackType": "regular",
            "gridAlpha": 0.07,
            "axisAlpha": 0,
            "inside": true
        }],
        "graphs": [{
                "id": "g1",
                "type": "line",
                "title": "Cars",
                "valueField": "cars",
                "fillColors": [
                    "#0066e3",
                    "#802ea9"
                ],
                "lineAlpha": 0,
                "fillAlphas": 0.8,
                "showBalloon": false
            },
            {
                "id": "g2",
                "type": "line",
                "title": "Motorcycles",
                "valueField": "motorcycles",
                "lineAlpha": 0,
                "fillAlphas": 0.8,
                "lineColor": "#5bb5ea",
                "showBalloon": false
            },
            {
                "id": "g3",
                "title": "Bicycles",
                "valueField": "bicycles",
                "lineAlpha": 0.5,
                "lineColor": "#14a4ce",
                "bullet": "round",
                "dashLength": 2,
                "bulletBorderAlpha": 1,
                "bulletAlpha": 1,
                "bulletSize": 15,
                "stackable": false,
                "bulletColor": "#57c7e7",
                "bulletBorderColor": "#14a4ce",
                "bulletBorderThickness": 3,
                "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#14a4ce'>[[value]]</div>"
            }
        ],
        "chartCursor": {
            "cursorAlpha": 1,
            "zoomable": false,
            "cursorColor": "#fff",
            "categoryBalloonColor": "#57c7e7",
            "fullWidth": true,
            "categoryBalloonDateFormat": "YYYY",
            "balloonPointerOrientation": "vertical"
        },
        "balloon": {
            "borderAlpha": 0,
            "fillAlpha": 0,
            "shadowAlpha": 0,
            "offsetX": 40,
            "offsetY": -50
        }
    });

    // we zoom chart in order to have better blur (form side to side)
    chart.addListener("dataUpdated", zoomChart);

    function zoomChart() {
        chart.zoomToIndexes(1, chartData.length - 2);
    }




   var chartData = [
    {
        "date": "2012-01-01",
        "distance": 227,
        "townName": "New York",
        "townName2": "New York",
        "townSize": 25,
        "latitude": 40.71,
        "duration": 408
    },
    {
        "date": "2012-01-02",
        "distance": 371,
        "townName": "Washington",
        "townSize": 14,
        "latitude": 38.89,
        "duration": 482
    },
    {
        "date": "2012-01-03",
        "distance": 433,
        "townName": "Wilmington",
        "townSize": 6,
        "latitude": 34.22,
        "duration": 562
    },
    {
        "date": "2012-01-04",
        "distance": 345,
        "townName": "Jacksonville",
        "townSize": 7,
        "latitude": 30.35,
        "duration": 379
    },
    {
        "date": "2012-01-05",
        "distance": 480,
        "townName": "Miami",
        "townName2": "Miami",
        "townSize": 10,
        "latitude": 25.83,
        "duration": 501
    },
    {
        "date": "2012-01-06",
        "distance": 386,
        "townName": "Tallahassee",
        "townSize": 7,
        "latitude": 30.46,
        "duration": 443
    },
    {
        "date": "2012-01-07",
        "distance": 348,
        "townName": "New Orleans",
        "townSize": 10,
        "latitude": 29.94,
        "duration": 405
    },
    {
        "date": "2012-01-08",
        "distance": 238,
        "townName": "Houston",
        "townName2": "Houston",
        "townSize": 16,
        "latitude": 29.76,
        "duration": 309
    },
    {
        "date": "2012-01-09",
        "distance": 218,
        "townName": "Dalas",
        "townSize": 17,
        "latitude": 32.8,
        "duration": 287
    },
    {
        "date": "2012-01-10",
        "distance": 349,
        "townName": "Oklahoma City",
        "townSize": 11,
        "latitude": 35.49,
        "duration": 485
    },
    {
        "date": "2012-01-11",
        "distance": 603,
        "townName": "Kansas City",
        "townSize": 10,
        "latitude": 39.1,
        "duration": 890
    },
    {
        "date": "2012-01-12",
        "distance": 534,
        "townName": "Denver",
        "townName2": "Denver",
        "townSize": 18,
        "latitude": 39.74,
        "duration": 810
    },
    {
        "date": "2012-01-13",
        "townName": "Salt Lake City",
        "townSize": 12,
        "distance": 425,
        "duration": 670,
        "latitude": 40.75,
        "alpha":0.4
    },
    {
        "date": "2012-01-14",
        "latitude": 36.1,
        "duration": 470,
        "townName": "Las Vegas",
        "townName2": "Las Vegas",
        "bulletClass": "lastBullet"
    },
    {
        "date": "2012-01-15"
    },
    {
        "date": "2012-01-16"
    },
    {
        "date": "2012-01-17"
    },
    {
        "date": "2012-01-18"
    },
    {
        "date": "2012-01-19"
    }
];
var chart = AmCharts.makeChart("chartdiv1", {
  type: "serial",
  theme: "dark",
  dataDateFormat: "YYYY-MM-DD",
  dataProvider: chartData,

  addClassNames: true,
  startDuration: 1,
  color: "#676a6c",
  marginLeft: 0,

  categoryField: "date",
  categoryAxis: {
    parseDates: true,
    minPeriod: "DD",
    autoGridCount: false,
    gridCount: 50,
    gridAlpha: 0.1,
    gridColor: "#676a6c",
    axisColor: "#74d5f2",
    dateFormats: [{
        period: 'DD',
        format: 'DD'
    }, {
        period: 'WW',
        format: 'MMM DD'
    }, {
        period: 'MM',
        format: 'MMM'
    }, {
        period: 'YYYY',
        format: 'YYYY'
    }]
  },

  valueAxes: [{
    id: "a1",
    title: "distance",
    gridAlpha: 0,
    axisAlpha: 0
  },{
    id: "a2",
    position: "right",
    gridAlpha: 0,
    axisAlpha: 0,
    labelsEnabled: false
  },{
    id: "a3",
    title: "duration",
    position: "right",
    gridAlpha: 0,
    axisAlpha: 0,
    inside: true,
    duration: "mm",
    durationUnits: {
        DD: "d. ",
        hh: "h ",
        mm: "min",
        ss: ""
    }
  }],
  graphs: [{
    id: "g1",
    valueField:  "distance",
    title:  "distance",
    type:  "column",
    fillAlphas:  0.9,
    valueAxis:  "a1",
    balloonText:  "[[value]] miles",
    legendValueText:  "[[value]] mi",
    legendPeriodValueText:  "total: [[value.sum]] mi",
    lineColor:  "#74d5f2",
    alphaField:  "alpha",
  },{
    id: "g2",
    valueField: "latitude",
    classNameField: "bulletClass",
    title: "latitude/city",
    type: "line",
    valueAxis: "a2",
    lineColor: "#e35b5a",
    lineThickness: 1,
    legendValueText: "[[description]]/[[value]]",
    descriptionField: "townName",
    bullet: "round",
    bulletSizeField: "townSize",
    bulletBorderColor: "#e35b5a",
    bulletBorderAlpha: 1,
    bulletBorderThickness: 2,
    bulletColor: "#e35b5a",
    labelText: "[[townName2]]",
    labelPosition: "right",
    balloonText: "latitude:[[value]]",
    showBalloon: true,
    animationPlayed: true,
  },{
    id: "g3",
    title: "duration",
    valueField: "duration",
    type: "line",
    valueAxis: "a3",
    lineColor: "#44b6ae",
    balloonText: "[[value]]",
    lineThickness: 1,
    legendValueText: "[[value]]",
    bullet: "square",
    bulletBorderColor: "#44b6ae",
    bulletBorderThickness: 1,
    bulletBorderAlpha: 1,
    dashLengthField: "dashLength",
    animationPlayed: true
  }],

  chartCursor: {
    zoomable: false,
    categoryBalloonDateFormat: "DD",
    cursorAlpha: 0,
    valueBalloonsEnabled: false
  },
  legend: {
    bulletType: "round",
    equalWidths: false,
    valueWidth: 120,
    useGraphSettings: true,
    color: "#74d5f2"
  }
});


 /* initialize the external events
    -----------------------------------------------------------------*/

    $('#external-events .fc-event').each(function() {

      // store data so the calendar knows to render an event upon drop
      $(this).data('event', {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });

/* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

         $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: 500,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d-5),
                    end: new Date(y, m, d-2)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/'
                }
            ]
        });

                  // Flexible table
    var table = $('#proList').DataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false });
   //  external search bar
    $('#search-projects').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

    $('#drop-remove').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                });

})(jQuery);