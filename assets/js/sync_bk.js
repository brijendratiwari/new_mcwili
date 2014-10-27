function stratsync() {

    var base_url = $('#base_url').val();

    $.ajax({
        url: base_url + "sync/StartAutoSync",
        type: "POST"
    }).done(function(msg) {
//            alert(msg);
        if (msg == 'yes') {
            var n = noty({layout: 'topCenter', type: 'information', text: 'Auto Sync Started Successfully', timeout: 2000});
            $('#syncstrat').addClass('disabled');
            $('#syncstop').removeClass('disabled');
        }
    }).fail(function(jqXHR, textStatus) {

    });

}
function stopsync() {

    var base_url = $('#base_url').val();

    $.ajax({
        url: base_url + "sync/StopAutoSyc",
        type: "POST"
    }).done(function(msg) {
//            alert(msg);
        if (msg == 'yes') {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Auto Sync Stopped Successfully', timeout: 2000});
            $(document).find('#syncstop').addClass('disabled');
            $(document).find('#syncstrat').removeClass('disabled');
        }
    }).fail(function(jqXHR, textStatus) {
        alert(textStatus);
    });

}

function startsync(id) {

    var base_url = $('#base_url').val();
    $('#et_startsync').addClass('disabled');
    $('#et_stopsync').removeClass('disabled');
    var percentVal = 0;
    var stopper;
    $.ajax({
        url: base_url + "sync/StartSync",
        type: "POST",
        data: {sync: id, type: 'Manual'},
        beforeSend: function() {
            $("#exact_progessbar").parent('.progress-stat').removeClass('hide');
            console.log("test");
            stopper = setInterval(function() {
                percentVal += 1;
                if (percentVal <= 90)
                {
                    $(document).find("#exact_progessbar .progress-bar").attr("style", "width:" + percentVal + '%').siblings('.progress-stat-value').html(percentVal + '%');
                    $("#exact_progessbar").siblings('.progress-stat-value').html(percentVal + '%');
                    $("#exact_progessbar span").html(percentVal + '%');
                } else {
                    clearInterval(stopper);
                }
            }, 2000);

        }
    }).done(function(msg) {

        var data = JSON.parse(msg);
        $('#et_subscribe').text(data.SubscribedCount);
        $('#et_unsubscribe').text(data.UnSubscribedCount);
        $('#et_lastsync').text(data.SyncTime);

        var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

        $('#et_startsync').removeClass('disabled');
        $('#et_stopsync').addClass('disabled');
        clearInterval(stopper);
        $(document).find("#exact_progessbar .progress-bar").attr("style", "width: 100%");
        $("#exact_progessbar").siblings('.progress-stat-value').html('100%');
        $("#exact_progessbar span").html('100%');
        $("#exact_progessbar").parent('.progress-stat').addClass('hide');
    }).fail(function(jqXHR, textStatus) {
        $('#et_startsync').removeClass('disabled');
    });
}

function startblackboxxsync(id) {

    var base_url = $('#base_url').val();
    $('#bb_startsync').addClass('disabled');
    $('#bb_stopsync').removeClass('disabled');
    var percentVal = 0;
    var stopper;
    $.ajax({
        url: base_url + "sync/BBSync",
        type: "POST",
        data: {sync: id, type: 'Manual'},
        beforeSend: function() {
            $("#bb_progessbar").parent('.progress-stat').removeClass('hide');
            console.log("test");
            stopper = setInterval(function() {
                percentVal += 5;
                if (percentVal <= 90)
                {
                    $(document).find("#bb_progessbar .progress-bar").attr("style", "width:" + percentVal + '%').siblings('.progress-stat-value').html(percentVal + '%');
                    $("#bb_progessbar").siblings('.progress-stat-value').html(percentVal + '%');
                    $("#bb_progessbar span").html(percentVal + '%');
                } else {
                    clearInterval(stopper);
                }
            }, 2000);

        }
    }).done(function(msg) {

        var data = JSON.parse(msg);
        $('#bb_subscribe').text(data.SubscribedCount);
        $('#bb_unsubscribe').text(data.UnSubscribedCount);
        $('#bb_lastsync').text(data.SyncTime);

        var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

        $('#bb_startsync').removeClass('disabled');
        $('#bb_stopsync').addClass('disabled');
        clearInterval(stopper);
        $(document).find("#bb_progessbar .progress-bar").attr("style", "width: 100%");
        $("#bb_progessbar").siblings('.progress-stat-value').html('100%');
        $("#bb_progessbar span").html('100%');
        $("#bb_progessbar").parent('.progress-stat').addClass('hide');
    }).fail(function(jqXHR, textStatus) {
        $('#et_startsync').removeClass('disabled');
    });
}

//$(document).ready(function() {
//    var countdown = $("#auto_sync_time").val() * 60 * 1000;
//    var timerId = setInterval(function() {
//        countdown -= 1000;
//        var min = Math.floor(countdown / (60 * 1000));
//        //var sec = Math.floor(countdown - (min * 60 * 1000));  // wrong
//        var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct
//
//        if (countdown <= 0) {
//            clearInterval(timerId);
//            //doSomething();
//        } else {
//            $("#exact_target_timer").text(min + "Min : " + sec+"Secs");
//        }
//
//    }, 1000);
//})