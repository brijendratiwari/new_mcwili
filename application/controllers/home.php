<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('et_model');
        $this->load->model('sync_model');
        $this->load->model('mdb_model');
        $this->load->model('bb_model');
    }

    public function index() {

        if ($this->session->userdata('logged_in')) {
            redirect('home/master');
//            $this->load->view('/common/header.php');
//            $this->load->view('/common/navbar.php');
//            $this->load->view('/common/sub_navbar.php');
//            $this->load->view('/master.php');
//            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function sync() {
        if ($this->session->userdata('logged_in')) {
            $data['autosync'] = $this->sync_model->checkautosync();
            $data['Subscriber'] = $this->mdb_model->get_mdbSubscriber();
            $data['bpSubscriber'] = $this->sync_model->get_bpSubscriber();
            $data['mdbSubscriber'] = $this->sync_model->get_mdbSubscriber();
            //get all recently added subscriber and unsubscriber.
            $data['getLastSystemSyncsub'] = $this->sync_model->getLastSystemSyncsub();
            
            $data['etSyncsub'] = $this->sync_model->getallListSubsciberCount(1);
            $data['bbSyncsub'] = $this->sync_model->getallListSubsciberCount(2);
            $data['mdbSyncsub'] = $this->sync_model->getallListSubsciberCount(5);
            $data['bpSyncsub'] = $this->sync_model->getallListSubsciberCount(3);
            
            // get last three subscriber
            $data['lastSubscriber'] = $this->sync_model->getLastSubscriber();
           // get last three unsubscriber
            $data['lastUnSubscriber'] = $this->sync_model->getLastUnSubscriber();

            $data['UnSubscriber'] = $this->sync_model->get_UnSubscriber();
           
            $data['AllUnSubscriber'] = $this->sync_model->get_AllUnSubscriber();

            $data['getAutoSyncUpdate'] = $this->sync_model->get_getAutoSyncUpdate();

            //get specific list data for ET 
            $data['mcSubscriber'] = $this->sync_model->getEt_SpecificListData(351487);
            $data['brandsSubscriber'] = $this->sync_model->getEt_SpecificListData(351484);
            $data['evans'] = $this->sync_model->getEt_SpecificListData(351486);
            $data['mount'] = $this->sync_model->getEt_SpecificListData(351488);
            $data['et_celldoorSubscriber'] = $this->sync_model->getEt_SpecificListData(351485);
            //get specific list data for ET 
            $data['bb_brandsSubscriber'] = $this->sync_model->getBb_SpecificListData(351484);
            $data['bb_celldoorSubscriber'] = $this->sync_model->getBb_SpecificListData(351485);



            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/sync.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function exact_target() {

        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->et_model->get_etSubscriber();
            $data['UnSubscriber'] = $this->et_model->get_UnSubscriber();
            $data['FilterSubscriber'] = $this->et_model->get_etFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/exact_target.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function black_boxx() {

        if ($this->session->userdata('logged_in')) {
            $data['list'] = $this->et_model->getList();
            $data['Subscriberdetail'] = $this->bb_model->get_bbSubscriberDetail();
            $data['Customer'] = $this->bb_model->get_bbcustomer();
//            var_dump($data['Customer']);die;
            $data['mcSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351487);
            $data['brandsSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351484);
            $data['celldoorSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351485);
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterCustomer'] = $this->bb_model->get_bbFilterCustomer();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->bb_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/blackboxx.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function master() {
        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->mdb_model->get_mdbSubscriber();
            $data['UnSubscriber'] = $this->mdb_model->get_mdbUnSubscriber();
            $data['FilterSubscriber'] = $this->mdb_model->get_mdbFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->mdb_model->getLastSystemSync();
//            var_dump($data['UnSubscriber']);
//            var_dump($data['UnSubscriber']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/master.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function bepoz() {
        if ($this->session->userdata('logged_in')) {
            $data['list'] = $this->et_model->getList();
            $data['Subscriberdetail'] = $this->bb_model->get_bpSubscriberDetail();
            $data['Subscriber'] = $this->bb_model->get_bpSubscriber();
            $data['mcSubscriber'] = $this->bb_model->get_bpListFilterSubscriber(351487); //McWilliams Wine
            $data['brandsSubscriber'] = $this->bb_model->get_bpListFilterSubscriber(351484); //Brands Laira
            $data['mount'] = $this->bb_model->get_bpListFilterSubscriber(351488); //Mount Pleasant
            $data['Evans'] = $this->bb_model->get_bpListFilterSubscriber(351486); //Evans & Tate
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterSubscriber'] = $this->bb_model->get_bpallFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/bepoz.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function get_all_mdb() {         //Ajax table data for MDB.
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;
        $getLastSystemSyncsub = $this->mdb_model->getLastSystemSync();
        if (isset($getLastSystemSyncsub[0]['SyncTime'])) {
            $sync = $getLastSystemSyncsub[0]['SyncTime'];
        } else {
            $sync = 0;
        }

        $col_sort = array("id", "firstname", "lastname", "email");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select('id,firstname,lastname,email');

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {

                $this->mdb_model->db->or_like($col_sort[$i], $words, "both");
            }
        }

        $this->mdb_model->db->order_by($order_by, $temp);

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->mdb_model->db->get("master_subscriber", $lenght, $str_point);
        } else {
            $records = $this->mdb_model->db->get("master_subscriber");
        }
        $total_record = $this->db->count_all('master_subscriber');
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        $i = 0;
        $final = array();
        foreach ($result as $val) {

            $output['aaData'][] = array("DT_RowId" => $val['firstname'], $val['firstname'], $val['lastname'], $val['email'], $sync, 'Active');
        }

        echo json_encode($output);
        die;
    }

    public function get_all_et() {   // ajax table data for ET.
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $getLastSystemSyncsub = $this->et_model->getLastSystemSyncsub();

        if (isset($getLastSystemSyncsub[0]['SyncTime'])) {
            $sync = $getLastSystemSyncsub[0]['SyncTime'];
        } else {
            $sync = 0;
        }

        $col_sort = array("ID", "FirstName", "LastName", "EmailAddress", "CreatedDate");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select($col_sort);

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {

                $this->mdb_model->db->or_like($col_sort[$i], $words, "both");
            }
        }

        $this->mdb_model->db->order_by($order_by, $temp);

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->mdb_model->db->get("et_subscriber", $lenght, $str_point);
        } else {
            $records = $this->mdb_model->db->get("et_subscriber");
        }
        $total_record = $this->db->count_all('et_subscriber');
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        $i = 0;
        $final = array();
        foreach ($result as $val) {

            $output['aaData'][] = array("DT_RowId" => $val['FirstName'], $val['FirstName'], $val['LastName'], $val['EmailAddress'], $val['CreatedDate'], $sync, 'Active');
        }

        echo json_encode($output);
        die;
    }

    public function get_all_bb() {   // ajax table data for BlackBoxx.
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $getLastSystemSyncsub = $this->bb_model->getLastSystemSyncsub();

        if (isset($getLastSystemSyncsub[0]['SyncTime'])) {
            $sync = $getLastSystemSyncsub[0]['SyncTime'];
        } else {
            $sync = 0;
        }

        $col_sort = array("id", "firstname", "lastname", "email", "created");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select($col_sort);

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {

                $this->mdb_model->db->or_like($col_sort[$i], $words, "both");
            }
        }

        $this->mdb_model->db->order_by($order_by, $temp);

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->mdb_model->db->get("bb_customer", $lenght, $str_point);
        } else {
            $records = $this->mdb_model->db->get("bb_customer");
        }
        $total_record = $this->db->count_all('bb_customer');
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        $i = 0;
        $final = array();
        foreach ($result as $val) {

            $output['aaData'][] = array("DT_RowId" => $val['firstname'], $val['firstname'], $val['lastname'], $val['email'], $val['created'], $sync, 'Active');
        }

        echo json_encode($output);
        die;
    }

    public function get_all_bp() {   // ajax table data for BePoz.
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;
//SELECT * FROM (`et_subscriber_list_rel`) JOIN `et_subscriber` ON `et_subscriber`.`SubscriberID`=`et_subscriber_list_rel`.`SubscriberID` WHERE `ListID` IN ('352396') GROUP BY `et_subscriber_list_rel`.`SubscriberID`
        $getLastSystemSyncsub = $this->bb_model->getLastSystemSyncsub();

        if (isset($getLastSystemSyncsub[0]['SyncTime'])) {
            $sync = $getLastSystemSyncsub[0]['SyncTime'];
        } else {
            $sync = 0;
        }

        $col_sort = array("id", "firstname", "lastname", "email", "created");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select("*");

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            for ($i = 0; $i < count($col_sort); $i++) {

                $this->mdb_model->db->or_like($col_sort[$i], $words, "both");
            }
        }

        $this->mdb_model->db->order_by($order_by, $temp);

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->mdb_model->db->get("bb_customer", $lenght, $str_point);
        } else {
            $records = $this->mdb_model->db->get("bb_customer");
        }
        $total_record = $this->db->count_all('bb_customer');
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        $i = 0;
        $final = array();
        foreach ($result as $val) {

            $output['aaData'][] = array("DT_RowId" => $val['firstname'], $val['firstname'], $val['lastname'], $val['email'], $val['created'], $sync, 'Active');
        }

        echo json_encode($output);
        die;
    }

}
