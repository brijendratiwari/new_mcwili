
$(document).ready(function(){
    var base_url = $('#base_url').val();
//alert(base_url);

    $("#table-1").dataTable();
    $("#table-2").dataTable();
    $("#table-bepoz").dataTable();
    
    $("#table-exact-target").dataTable({
         "ordering": false,
        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": base_url + "home/get_all_mdb", "bDeferRender": true,
        "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
//        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "bDestroy": true, //!!!--- for remove data table warning.
        "aoColumnDefs": [
            {"aTargets": [0]},
            {"sClass": " aligncenter", "aTargets": [1]},
            {"sClass": "eamil_conform aligncenter", "aTargets": [2]},
            {"sClass": "hidden-phone", "aTargets": [3]},
            {"sClass": "hidden-phone", "aTargets": [4]},
//            {"sClass": "hidden-phone", "aTargets": [5]},
            
        ]}
        );
    $("#exact-target").dataTable({
         "ordering": false,
        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": base_url + "home/get_all_et", "bDeferRender": true,
        "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
//        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "bDestroy": true, //!!!--- for remove data table warning.
        "aoColumnDefs": [
            {"aTargets": [0]},
            {"sClass": " aligncenter", "aTargets": [1]},
            {"sClass": "eamil_conform aligncenter", "aTargets": [2]},
            {"sClass": "hidden-phone", "aTargets": [3]},
            {"sClass": "hidden-phone", "aTargets": [4]},
            {"sClass": "hidden-phone", "aTargets": [5]},
            
        ]}
        );
    $("#black-boxx").dataTable({
         "ordering": false,
        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": base_url + "home/get_all_bb", "bDeferRender": true,
        "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
//        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "bDestroy": true, //!!!--- for remove data table warning.
        "aoColumnDefs": [
            {"aTargets": [0]},
            {"sClass": " aligncenter", "aTargets": [1]},
            {"sClass": "eamil_conform aligncenter", "aTargets": [2]},
            {"sClass": "hidden-phone", "aTargets": [3]},
            {"sClass": "hidden-phone", "aTargets": [4]},
            {"sClass": "hidden-phone", "aTargets": [5]},
            
        ]}
        );
    $("#unSubscriber").dataTable();
});

 