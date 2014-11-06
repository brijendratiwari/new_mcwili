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

function stopallsync(id){
 var base_url = $('#base_url').val();
     $.ajax({
        url: base_url + "sync/StopSync",
        type: "POST",
        data: {sync: id},
        beforeSend: function() {
             var n = noty({layout: 'topCenter', type: 'warning', text: 'Please wait', timeout: 5000});
            if(id == 1){
                $('#et_stopsync').addClass('disabled');
            }
            if(id==2){
                $('#bb_stopsync').addClass('disabled');
            }
        }
    }).done(function(msg) {
         
    }).fail(function(jqXHR, textStatus) {
         
    });
}

function startsync(id) {

    var base_url = $('#base_url').val();
    $('#et_startsync').addClass('disabled');
    $('#bp_startsync').addClass('disabled');
    $('#mdb_startsync').addClass('disabled');
    $('#bb_startsync').addClass('disabled');
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
                percentVal += 5;
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
        if (msg != 'stop')
        {
            var data = JSON.parse(msg);
            $('#et_subscribe').text(data.SubscribedCount);
            $('#et_unsubscribe').text(data.UnSubscribedCount);
            $('#et_lastsync').text(data.SyncTime);

            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#et_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#bb_startsync').removeClass('disabled');
            $('#mdb_startsync').removeClass('disabled');
            $('#et_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#exact_progessbar .progress-bar").attr("style", "width: 100%");
            $("#exact_progessbar").siblings('.progress-stat-value').html('100%');
            $("#exact_progessbar span").html('100%');
            $("#exact_progessbar").parent('.progress-stat').addClass('hide');
        }
        else {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Manual Sync Stoped', timeout: 2000});
            $('#et_startsync').removeClass('disabled');
            $('#et_stopsync').addClass('disabled');
            clearInterval(stopper);
        $(document).find("#exact_progessbar .progress-bar").attr("style", "width: 0%");
            $("#exact_progessbar").siblings('.progress-stat-value').html('0%');
            $("#exact_progessbar span").html('0%');
            $("#exact_progessbar").parent('.progress-stat').addClass('hide');
        }
    }).fail(function(jqXHR, textStatus) {
        var n = noty({layout: 'topCenter', type: 'error', text: 'Manual Sync Stoped', timeout: 2000});
        $('#et_startsync').removeClass('disabled');
        $('#bp_startsync').removeClass('disabled');
        $('#bb_startsync').removeClass('disabled');
        $('#mdb_startsync').removeClass('disabled');
        $('#et_stopsync').addClass('disabled');
        clearInterval(stopper);
        $(document).find("#exact_progessbar .progress-bar").attr("style", "width: 0%");
            $("#exact_progessbar").siblings('.progress-stat-value').html('0%');
            $("#exact_progessbar span").html('0%');
            $("#exact_progessbar").parent('.progress-stat').addClass('hide');
    });
}

function startblackboxxsync(id) {

    var base_url = $('#base_url').val();
    $('#bb_startsync').addClass('disabled');
    $('#bp_startsync').addClass('disabled');
    $('#et_startsync').addClass('disabled');
    $('#mdb_startsync').addClass('disabled');
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
        if (msg != 'stop')
        {
            var data = JSON.parse(msg);
            $('#bb_subscribe').text(data.SubscribedCount);
            $('#bb_unsubscribe').text(data.UnSubscribedCount);
            $('#bb_lastsync').text(data.SyncTime);

            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#bb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#mdb_startsync').removeClass('disabled');
            $('#bb_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#bb_progessbar .progress-bar").attr("style", "width: 100%");
            $("#bb_progessbar").siblings('.progress-stat-value').html('100%');
            $("#bb_progessbar span").html('100%');
            $("#bb_progessbar").parent('.progress-stat').addClass('hide');
        }
         else {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Manual Sync Stoped', timeout: 2000});
            $('#bb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#mdb_startsync').removeClass('disabled');
            $('#bb_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#bb_progessbar .progress-bar").attr("style", "width: 0%");
            $("#bb_progessbar").siblings('.progress-stat-value').html('0%');
            $("#bb_progessbar span").html('0%');
            $("#bb_progessbar").parent('.progress-stat').addClass('hide');
        }
    }).fail(function(jqXHR, textStatus) {
        $('#bb_startsync').removeClass('disabled');
        $('#bb_stopsync').addClass('disabled');
         clearInterval(stopper);
            $(document).find("#bb_progessbar .progress-bar").attr("style", "width: 0%");
            $("#bb_progessbar").siblings('.progress-stat-value').html('0%');
            $("#bb_progessbar span").html('0%');
            $("#bb_progessbar").parent('.progress-stat').addClass('hide');
    });
}
function startbepozsync(id) {

    var base_url = $('#base_url').val();
    $('#bb_startsync').addClass('disabled');
    $('#et_startsync').addClass('disabled');
    $('#mdb_startsync').addClass('disabled');
    $('#bb_startsync').addClass('disabled');
    $('#bp_stopsync').removeClass('disabled');
    var percentVal = 0;
    var stopper;
    $.ajax({
        url: base_url + "sync/bpSync",
        type: "POST",
        data: {sync: id, type: 'Manual'},
        beforeSend: function() {
            $("#bp_progessbar").parent('.progress-stat').removeClass('hide');
            console.log("test");
            stopper = setInterval(function() {
                percentVal += 5;
                if (percentVal <= 90)
                {
                    $(document).find("#bp_progessbar .progress-bar").attr("style", "width:" + percentVal + '%').siblings('.progress-stat-value').html(percentVal + '%');
                    $("#bp_progessbar").siblings('.progress-stat-value').html(percentVal + '%');
                    $("#bp_progessbar span").html(percentVal + '%');
                } else {
                    clearInterval(stopper);
                }
            }, 2000);

        }
    }).done(function(msg) {
        if (msg != 'stop')
        {
            var data = JSON.parse(msg);
            $('#bp_subscribe').text(data.SubscribedCount);
            $('#bp_unsubscribe').text(data.UnSubscribedCount);
            $('#bp_lastsync').text(data.SyncTime);

            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#bb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#mdb_startsync').removeClass('disabled');
            $('#bp_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#bp_progessbar .progress-bar").attr("style", "width: 100%");
            $("#bp_progessbar").siblings('.progress-stat-value').html('100%');
            $("#bp_progessbar span").html('100%');
            $("#bp_progessbar").parent('.progress-stat').addClass('hide');
        }
         else {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Manual Sync Stoped', timeout: 2000});
            $('#bb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#mdb_startsync').removeClass('disabled');
            $('#bp_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#bb_progessbar .progress-bar").attr("style", "width: 0%");
            $("#bp_progessbar").siblings('.progress-stat-value').html('0%');
            $("#bp_progessbar span").html('0%');
            $("#bp_progessbar").parent('.progress-stat').addClass('hide');
        }
    }).fail(function(jqXHR, textStatus) {
        $('#bp_startsync').removeClass('disabled');
        $('#bp_stopsync').addClass('disabled');
         clearInterval(stopper);
            $(document).find("#bp_progessbar .progress-bar").attr("style", "width: 0%");
            $("#bp_progessbar").siblings('.progress-stat-value').html('0%');
            $("#bp_progessbar span").html('0%');
            $("#bp_progessbar").parent('.progress-stat').addClass('hide');
    });
}
function startmdbsync(id) {

    var base_url = $('#base_url').val();
    $('#mdb_startsync').addClass('disabled');
       $('#et_startsync').addClass('disabled');
    $('#bb_startsync').addClass('disabled');
    $('#bp_startsync').addClass('disabled');
    $('#mdb_stopsync').removeClass('disabled');
    var percentVal = 0;
    var stopper;
    $.ajax({
        url: base_url + "sync/mdbSync",
        type: "GET",
        data: {sync: id, type: 'Manual'},
        beforeSend: function() {
            $("#mdb_progessbar").parent('.progress-stat').removeClass('hide');
            console.log("test");
            stopper = setInterval(function() {
                percentVal += 5;
                if (percentVal <= 90)
                {
                    $(document).find("#mdb_progessbar .progress-bar").attr("style", "width:" + percentVal + '%').siblings('.progress-stat-value').html(percentVal + '%');
                    $("#mdb_progessbar").siblings('.progress-stat-value').html(percentVal + '%');
                    $("#mdb_progessbar span").html(percentVal + '%');
                } else {
                    clearInterval(stopper);
                }
            }, 2000);

        }
    }).done(function(msg) {
        if (msg != 'stop')
        {
            var data = JSON.parse(msg);
            $('#mdb_subscribe').text(data.SubscribedCount);
            $('#mdb_unsubscribe').text(data.UnSubscribedCount);
            $('#mdb_lastsync').text(data.SyncTime);

            var n = noty({layout: 'topCenter', type: 'information', text: 'Manual Sync Successfully', timeout: 2000});

            $('#mdb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#bb_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#mdb_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#mdb_progessbar .progress-bar").attr("style", "width: 100%");
            $("#mdb_progessbar").siblings('.progress-stat-value').html('100%');
            $("#mdb_progessbar span").html('100%');
            $("#mdb_progessbar").parent('.progress-stat').addClass('hide');
        }
         else {
            var n = noty({layout: 'topCenter', type: 'error', text: 'Manual Sync Stoped', timeout: 2000});
            $('#mdb_startsync').removeClass('disabled');
            $('#et_startsync').removeClass('disabled');
            $('#bb_startsync').removeClass('disabled');
            $('#bp_startsync').removeClass('disabled');
            $('#mdb_stopsync').addClass('disabled');
            clearInterval(stopper);
            $(document).find("#mdb_progessbar .progress-bar").attr("style", "width: 0%");
            $("#mdb_progessbar").siblings('.progress-stat-value').html('0%');
            $("#mdb_progessbar span").html('0%');
            $("#mdb_progessbar").parent('.progress-stat').addClass('hide');
        }
    }).fail(function(jqXHR, textStatus) {
        $('#mdb_startsync').removeClass('disabled');
        $('#mdb_stopsync').addClass('disabled');
         clearInterval(stopper);
            $(document).find("#mdb_progessbar .progress-bar").attr("style", "width: 0%");
            $("#mdb_progessbar").siblings('.progress-stat-value').html('0%');
            $("#mdb_progessbar span").html('0%');
            $("#mdb_progessbar").parent('.progress-stat').addClass('hide');
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
//            $("#exact_target_timer").text(min + "Min : " + sec + "Secs");
//        }
//
//    }, 1000);
//})