/*
 *  Document   : widgetsStats.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Statistic Widgets page
 */

var WidgetsStats = function() {

    return {
        init: function() {
            /* Mini Bar/Line Charts with jquery.sparkline plugin, for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-about */
            var miniChartBarOptions = {
                type: 'bar',
                barWidth: 38,
                barSpacing: 66,
                height: '80px',
                tooltipOffsetX: -25,
                tooltipOffsetY: 20,
                barColor: '#0AA03C',
                tooltipPrefix: '+ ',
                tooltipSuffix: ' Viajes',
                tooltipFormat: '{{prefix}}{{value}}{{suffix}}'
            };
            $('#widget-mini-chart-bar1').sparkline('html', miniChartBarOptions);

            miniChartBarOptions['barColor'] = '#1bbae1';
            miniChartBarOptions['tooltipPrefix'] = '';
            miniChartBarOptions['tooltipSuffix'] = ' Projects';
            $('#widget-mini-chart-bar2').sparkline('html', miniChartBarOptions);

            miniChartBarOptions['barColor'] = '#e74c3c';
            miniChartBarOptions['tooltipPrefix'] = '+ ';
            miniChartBarOptions['tooltipSuffix'] = ' Photos';
            $('#widget-mini-chart-bar3').sparkline('html', miniChartBarOptions);

            miniChartBarOptions['barColor'] = '#9b59b6';
            miniChartBarOptions['tooltipPrefix'] = '';
            miniChartBarOptions['tooltipSuffix'] = ' Tickets';
            $('#widget-mini-chart-bar4').sparkline('html', miniChartBarOptions);

            var miniChartLineOptions = {
                type: 'line',
                width: '270px',
                height: '150px',
                tooltipOffsetX: -25,
                tooltipOffsetY: 20,
                lineWidth: 1,
                lineColor: '#3b3f40',
                fillColor: '#399399',
                spotColor: '#ffffff',
                minSpotColor: '#ffffff',
                maxSpotColor: '#ffffff',
                highlightSpotColor: '#ffffff',
                highlightLineColor: '#ffffff',
                spotRadius: 5,
                tooltipPrefix: '$ ',
                tooltipSuffix: '',
                tooltipFormat: '{{prefix}}{{y}}{{suffix}}'
            };
            $('#widget-mini-chart-line1').sparkline('html', miniChartLineOptions);

            miniChartLineOptions['lineColor'] = '#333333';
            miniChartLineOptions['fillColor'] = '#777777';
            miniChartLineOptions['tooltipPrefix'] = '+ ';
            miniChartLineOptions['tooltipSuffix'] = ' Sales';
            $('#widget-mini-chart-line2').sparkline('html', miniChartLineOptions);

            miniChartLineOptions['lineColor'] = '#4a2e2b';
            miniChartLineOptions['fillColor'] = '#b33c2e';
            miniChartLineOptions['tooltipPrefix'] = '';
            miniChartLineOptions['tooltipSuffix'] = ' Downloads';
            $('#widget-mini-chart-line3').sparkline('html', miniChartLineOptions);

            /*
             * Flot Jquery plugin is used for charts
             *
             * For more examples or getting extra plugins you can check http://www.flotcharts.org/
             * Plugins included in this template: pie, resize, stack, time
             */

            // Get the elements where we will attach the charts
            var chartWidget1 = $('#chart-widget1');
            var chartWidget2 = $('#chart-widget2');

            // Random data for the charts
            var dataEarnings = [[1, 23], [2, 26], [3, 30], [4, 32], [5, 42]];
            var dataSales = [[1, 18], [2, 27], [3, 23], [4, 35], [5, 40]];

            // Array with month labels used in both charts
            var chartMonths = [[1, '2011'], [2, '2012'], [3, '2013'], [4, '2014'], [5, '2015']];

            // Widget 1 Chart
            $.plot(chartWidget1,
                [
                    {
                        data: dataEarnings,
                        lines: {show: true, fill: false},
                        points: {show: true, radius: 6, fillColor: '#cccccc'}
                    },
                    {
                        data: dataSales,
                        lines: {show: true, fill: false},
                        points: {show: true, radius: 6, fillColor: '#ffffff'}
                    }
                ],
                {
                    colors: ['#ffffff', '#353535'],
                    legend: {show: false},
                    grid: {borderWidth: 0, hoverable: true, clickable: true},
                    yaxis: {show: false},
                    xaxis: {show: false, ticks: chartMonths}
                }
            );

            // Widget 2 Chart
            $.plot(chartWidget2,
                [
                    {
                        data: dataEarnings,
                        lines: {show: true, fill: false},
                        points: {show: true, radius: 6, fillColor: '#000000'}
                    },
                    {
                        data: dataSales,
                        lines: {show: true, fill: false},
                        points: {show: true, radius: 6, fillColor: '#ffffff'}
                    }
                ],
                {
                    colors: ['#ffffff', '#000000'],
                    legend: {show: false},
                    grid: {borderWidth: 0, hoverable: true, clickable: true},
                    yaxis: {show: false},
                    xaxis: {show: false, ticks: chartMonths}
                }
            );

            // Creating and attaching a tooltip to both charts
            var previousPoint = null, ttlabel = null;
            chartWidget1.add(chartWidget2).bind('plothover', function(event, pos, item) {

                if (item) {
                    if (previousPoint !== item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $('#chart-tooltip').remove();
                        var x = item.datapoint[0], y = item.datapoint[1];

                        // Get xaxis label
                        var monthLabel = item.series.xaxis.options.ticks[item.dataIndex][1];

                        if (item.seriesIndex === 1) {
                            ttlabel = '<strong>' + y + '</strong> sales in <strong>' + monthLabel + '</strong>';
                        } else {
                            ttlabel = '$ <strong>' + y + '</strong> in <strong>' + monthLabel + '</strong>';
                        }

                        $('<div id="chart-tooltip" class="chart-tooltip">' + ttlabel + '</div>')
                            .css({top: item.pageY - 50, left: item.pageX - 50}).appendTo("body").show();
                    }
                }
                else {
                    $('#chart-tooltip').remove();
                    previousPoint = null;
                }
            });
        }
    };
}();