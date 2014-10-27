$(function() {

    var data, chartOptions
//        data = '[';
    var data = [];
    $('#SubscriberList tr').each(function() {
        var listname = $(this).find('td:nth-child(1)').attr('data-listname');
        var count = $(this).find('td:nth-child(2)').attr('data-listcount');
        data[data.length] = {label: listname, data: Math.floor(count * 100 + 250)};
    })

    chartOptions = {
        series: {
            pie: {
                show: true,
                innerRadius: 0,
                stroke: {
                    width: 4
                }
            }
        },
        legend: {
            show: false,
            position: 'ne'
        },
        tooltip: true,
        tooltipOpts: {
            content: '%s: %y'
        },
        grid: {
            hoverable: true
        },
        colors: mvpready_core.layoutColors
    }

    var holder = $('#pie-chart')

    if (holder.length) {
        $.plot(holder, data, chartOptions)
    }


});