<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    // ET
    public $mcSubscriber;
    public $brandsSubscriber;
    public $evans;
    public $mount;
    public $et_celldoorSubscriber;
    // BB 
    public $bb_brandsSubscriber;
    public $bb_celldoorSubscriber;

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
//            $data['bpSubscriber'] = $this->sync_model->get_bpSubscriber();
//            
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
//            $data['mcSubscriber'] = $this->sync_model->getEt_SpecificListData(351487);
//            $data['brandsSubscriber'] = $this->sync_model->getEt_SpecificListData(351484);
//            $data['evans'] = $this->sync_model->getEt_SpecificListData(351486);
//            $data['mount'] = $this->sync_model->getEt_SpecificListData(351488);
//            $data['et_celldoorSubscriber'] = $this->sync_model->getEt_SpecificListData(351485);
//            //get specific list data for ET 
//            $data['bb_brandsSubscriber'] = $this->sync_model->getBb_SpecificListData(351484);
//            $data['bb_celldoorSubscriber'] = $this->sync_model->getBb_SpecificListData(351485);



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
            $data['Subscriber'] = $this->et_model->get_etSubscriberCount();
            $data['UnSubscriber'] = $this->et_model->get_UnSubscriber();
            $data['FilterSubscriber'] = $this->et_model->get_etFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
//            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
            $data['getLastSystemSyncsub'] = $this->sync_model->getallListSubsciberCount(1);
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
//            $data['Subscriberdetail'] = $this->bb_model->get_bbSubscriberDetail();
            $data['Customer'] = $this->bb_model->get_bbcustomerCount();
//            var_dump($data['Customer']);die;
            $data['mcSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351487);
            $data['brandsSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351484);
            $data['celldoorSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351485);
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterCustomer'] = $this->bb_model->get_bbFilterCustomer();
//            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
//            $data['getLastSystemSyncsub'] = $this->bb_model->getLastSystemSyncsub();
            $data['getLastSystemSyncsub'] = $this->sync_model->getallListSubsciberCount(2);
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
            $data['Subscriber'] = $this->mdb_model->get_mdbSubscriberCount();
            $data['UnSubscriber'] = $this->mdb_model->get_mdbUnSubscriber();
            $data['FilterSubscriber'] = $this->mdb_model->get_mdbFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->mdb_model->get_mdbFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
//            $data['getLastSystemSyncsub'] = $this->mdb_model->getLastSystemSync();
            $data['getLastSystemSyncsub'] = $this->sync_model->getallListSubsciberCount(5);
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
//            $data['Subscriberdetail'] = $this->bb_model->get_bpSubscriberDetail();
            $data['Subscriber'] = $this->bb_model->get_bpSubscriberCount();
            $data['mcSubscriber'] = $this->bb_model->get_bpListFilterSubscriber(351487); //McWilliams Wine
            $data['brandsSubscriber'] = $this->bb_model->get_bpListFilterSubscriber(351484); //Brands Laira
            $data['mount'] = $this->bb_model->get_bpListFilterSubscriber(351488); //Mount Pleasant
            $data['Evans'] = $this->bb_model->get_bpListFilterSubscriber(351486); //Evans & Tate
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterSubscriber'] = $this->bb_model->get_bpallFilterSubscriber();
//            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
//            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
             $data['getLastSystemSyncsub'] = $this->sync_model->getallListSubsciberCount(3);
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
            $this->mdb_model->db->like('status', 1);
            $records = $this->mdb_model->db->get("master_subscriber", $lenght, $str_point);
        } else {
            $this->mdb_model->db->like('status', 1);
            $records = $this->mdb_model->db->get("master_subscriber");
        }
//         $this->db->select('status',1);
        $this->db->select('*');
        $this->db->from('master_subscriber');
        $this->db->where('status', 1);
        $total_record = $this->db->count_all_results();
//        $total_record = $this->db->count_all('master_subscriber');
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

        $col_sort = array("et_subscriber.ID", "et_subscriber.FirstName", "et_subscriber.LastName", "et_subscriber.EmailAddress", "et_subscriber.CreatedDate");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select("*");
//        $this->mdb_model->db->from("*");
        $this->mdb_model->db->where('et_subscriber_list_rel.ListID', '352396');
        $this->mdb_model->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
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
            $records = $this->mdb_model->db->get("et_subscriber_list_rel", $lenght, $str_point);
        } else {
            $records = $this->mdb_model->db->get("et_subscriber_list_rel");
        }
        $this->db->where('ListID', '352396');
        $total_record = $this->db->count_all_results('et_subscriber_list_rel');
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

    public function get_all_sync() {
        $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $mdbSubscriber = $this->sync_model->get_mdbSubscriber();
        $bpSubscriber = $this->sync_model->get_bpSubscriber();

//        var_dump($bpSubscriber);
//        die;

        $getLastSystemSyncsub = $this->mdb_model->getLastSystemSync();
        if (isset($getLastSystemSyncsub[0]['SyncTime'])) {
            $sync = $getLastSystemSyncsub[0]['SyncTime'];
        } else {
            $sync = 0;
        }

        $col_sort = array("firstname", "lastname", "email");

        $order_by = "id";
        $temp = 'asc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];
        }
        $this->mdb_model->db->select('id,ET_UID,firstname,lastname,email');

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
            $this->mdb_model->db->like('status', 1);
            $records = $this->mdb_model->db->get("master_subscriber", $lenght, $str_point);
        } else {
            $this->mdb_model->db->like('status', 1);
            $records = $this->mdb_model->db->get("master_subscriber");
        }
        $this->db->select('*');
        $this->db->from('master_subscriber');
        $this->db->where('status', 1);
        $total_record = $this->db->count_all_results();
//        $total_record = $this->db->count_all('master_subscriber');
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        $i = 0;
        $final = array();
        $key = array(0);
        for ($i = 0; $i < count($result); $i++) {
            if ($result[$i]['ET_UID'] != "")
                $key[] = "'" . $result[$i]['ET_UID'] . "'";
        }

        $strkey = implode(',', $key);


        //get specific list data for ET 
        $mcSubscriber = $this->sync_model->getEt_SpecificListDataKey(351487, $strkey);
        $brandsSubscriber = $this->sync_model->getEt_SpecificListDataKey(351484, $strkey);
        $evans = $this->sync_model->getEt_SpecificListDataKey(351486, $strkey);
        $mount = $this->sync_model->getEt_SpecificListDataKey(351488, $strkey);
        $et_celldoorSubscriber = $this->sync_model->getEt_SpecificListDataKey(351485, $strkey);

        //get specific list data for BB 

        $bb_brandsSubscriber = $this->sync_model->getEt_SpecificListDataKey(351484, $strkey);
//            $bb_celldoorSubscriber = $this->sync_model->getEt_SpecificListDataKey(351485,$strkey);
        $bb_celldoorSubscriber = $et_celldoorSubscriber;






        foreach ($result as $val) {
            $mdb = "";
            $bepoz = "";
            $mdb = "y";


            if (!empty($bpSubscriber)) {
                if (in_array($val['email'], $bpSubscriber)) {
                    $bepoz = "y";
                } else {
                    $bepoz = "n";
                }
            } else {
                $bepoz = "n";
            }

            $blackboxx = "<div class='subcol_BB'>";
            if (!empty($bb_celldoorSubscriber)) {
                if (in_array($val['email'], $bb_celldoorSubscriber)) {
                    $blackboxx .= "y";
                } else {
                    $blackboxx .= "n";
                }
            } else {
                $blackboxx .= "n";
            }
            $blackboxx .= '</div><div class="subcol_BB">';
            if (!empty($bb_celldoorSubscriber)) {
                if (in_array($val['email'], $bb_celldoorSubscriber)) {
                    $blackboxx .= "y";
                } else {
                    $blackboxx .= "n";
                }
            } else {
                $blackboxx .= "n";
            }
            $blackboxx .= '</div><div class="subcol_BB">';
            if (!empty($bb_brandsSubscriber)) {
                if (in_array($val['email'], $bb_brandsSubscriber)) {
                    $blackboxx .= "y";
                } else {
                    $blackboxx .= "n";
                }
            } else {
                $blackboxx .= "n";
            }
            $blackboxx .= '</div>';

            $exacttarget = '<div class="subcol">';
            if (!empty($mcSubscriber)) {
                if (in_array($val['email'], $mcSubscriber)) {
                    $exacttarget .= "y";
                } else {
                    $exacttarget .= "n";
                }
            } else {
                $exacttarget .= "n";
            }
            $exacttarget .= '</div><div class="subcol">';
            if (!empty($mount)) {
                if (in_array($val['email'], $mount)) {
                    $exacttarget .= "y";
                } else {
                    $exacttarget .= "n";
                }
            } else {
                $exacttarget .= "n";
            }
            $exacttarget .= '</div><div class="subcol">';
            if (!empty($brandsSubscriber)) {
                if (in_array($val['email'], $brandsSubscriber)) {
                    $exacttarget .= "y";
                } else {
                    $exacttarget .= "n";
                }
            } else {
                $exacttarget .= "n";
            }
            $exacttarget .= '</div><div class="subcol">';
            if (!empty($evans)) {
                if (in_array($val['email'], $evans)) {
                    $exacttarget .= "y";
                } else {
                    $exacttarget .= "n";
                }
            } else {
                $exacttarget .= "n";
            }
            $exacttarget .= '</div><div class="subcol">';
            if (!empty($et_celldoorSubscriber)) {
                if (in_array($val['email'], $et_celldoorSubscriber)) {
                    $exacttarget .= "y";
                } else {
                    $exacttarget .= "n";
                }
            } else {
                $exacttarget .= "n";
            }
            $exacttarget .= '</div>';

            $output['aaData'][] = array("DT_RowId" => $val['firstname'], $val['firstname'], $val['lastname'], $val['email'], $mdb, $exacttarget, $blackboxx, $bepoz);
        }

        echo json_encode($output);
        die;
    }
    public function fail_message($message = FALSE,$response = FALSE){
        
        if($message == FALSE){
            $message = $this->input->post('message');
            $response = $this->input->post('res');
        }
        
        $this->db->insert('sync_fail', array('fail_time'=>  date('Y-m-d H:i:s'),'message'=>$message,'response'=>$response));
        
    }
}
