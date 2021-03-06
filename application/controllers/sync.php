<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sync extends CI_Controller {

    public function __construct() {
        parent::__construct();
        set_time_limit(0);
        $this->load->model('sync_model');
        $this->load->model('et_model');
        $this->load->model('bb_model');
        $this->load->model('bp_model');
        require_once('exact_target.php');
        require_once('black_boxx.php');
        require_once('login.php');
        require_once('home.php');
    }

    public function StartAutoSync() {
        $status = $this->sync_model->stratautosync();
        if ($status == 1) {
            echo 'yes';
        }
        die();
    }

    public function StopAutoSyc() {
        $status = $this->sync_model->stopautosync();
        if ($status == 1) {
            echo 'yes';
        }
        die();
    }

    public function StartSync() {
        $storeid = $this->input->post('sync');
        $type = $this->input->post('type');
        $str_id = $this->sync_model->setTempSync($storeid);
        $this->ExactTargetSync($str_id, $type, $storeid);
    }

    public function StopSync() {
        $storeid = $this->input->post('sync');
        $str_id = $this->sync_model->delTempSync($storeid);
    }

    public function ExactTargetSync($id, $type, $storeid, $flag = FALSE) {

        $controller_et = new Exact_target();
        $data = array();

        if ($this->sync_model->check($id))
            $et_list = $controller_et->getList();
        else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }
        if ($this->sync_model->check($id))
            $get_Subscriber_detail = $controller_et->get_Subscriber_detail();
        else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }

        if ($this->sync_model->check($id))
            $getSubscribersbylist = $controller_et->getSubscribersbylist();
        else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }

        if ($this->sync_model->check($id)) {
            $get_unSubscribe_list = $controller_et->get_unSubscribe_list();
            $unsublist = $controller_et->get_SpecificUnSubscribe_list();
        } else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }

        if (count($unsublist) && is_array($unsublist)) {
            foreach ($unsublist as $key => $value) {

                $this->db->select('ET_UID,	BB_UID,	BP_UID');
                $this->db->where('ET_UID', $value->SubscriberKey);
                $this->db->or_where('BP_UID', $value->SubscriberKey);
                $data_res = $this->db->get('master_subscriber');

                if ($data_res->num_rows() > 0) {
                    $res = $data_res->result_array();
                    $mdb = 0;
                    if (strlen($res[0]['ET_UID']) > 0) {
                        $et = 0;
                    } else {
                        $et = 2;
                    }
                    if (strlen($res[0]['BB_UID']) > 0) {
                        $bb = 0;
                    } else {
                        $bb = 2;
                    }
                    if (strlen($res[0]['BP_UID']) > 0) {
                        $bp = 0;
                    } else {
                        $bp = 2;
                    }
                } else {
                    $bp = 2;
                    $bb = 2;
                    $et = 2;
                    $mdb = 2;
                }

                $unsub = array();
                $unsub['SubscriberKey'] = $value->SubscriberKey;
                $unsub['ListId'] = $value->List->ID;
                $unsub['CreatedDate'] = $value->CreatedDate;
                $unsub['IsMasterUnsubscribed'] = $value->IsMasterUnsubscribed;
                $unsub['created'] = date("Y-m-d H:i:s");
                $unsub['BB'] = $bb;
                $unsub['BP'] = $bp;
                $unsub['ET'] = $et;
                $unsub['MDB'] = $mdb;


                $result_count = $this->bb_model->get_where_count('unsub_record', array('SubscriberKey' => $value->SubscriberKey, 'ListId' => $value->List->ID));

                if (!$result_count) {
                    $this->db->insert('unsub_record', $unsub);
                }
            }
        }


        if ($this->sync_model->check($id)) {
            $this->et_model->insertList($et_list);  // updating the list

            $old_sub = $this->et_model->get_count('et_subscriber');    // counting the old sub data
            $this->et_model->blank_tab('et_subscriber');    // updating the sus
            $this->et_model->insert_tab('et_subscriber', $get_Subscriber_detail);

            if (count($get_Subscriber_detail) > 0) {
                $data['SubscribedCount'] = count($get_Subscriber_detail) - $old_sub;
            } else {
                $data['SubscribedCount'] = 0;
            }
            $this->et_model->blank_tab('et_subscriber_list_rel');
            $this->et_model->insert_tab('et_subscriber_list_rel', $getSubscribersbylist);

            if (count($get_unSubscribe_list) && is_array($get_unSubscribe_list)) {
                foreach ($get_unSubscribe_list as $key => $value) {

                    $arr[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['email'] = $value->EmailAddress;

                    $arr[$key]['unsubscribed_date'] = $value->UnsubscribedDate;
                    $arr1[$key]['status'] = 0;
                    $arr1[$key]['ET_UID'] = $value->SubscriberKey;
                    $arr[$key]['unsubscriber_from'] = $this->et_model->checkstore($value->ID);
                    $arr[$key]['SubscriberID'] = $value->SubscriberKey;

                    if (is_array($value->Attributes)) {
                        foreach ($value->Attributes as $val) {

                            if ($val->Name == 'Date of Birth') {
                                $arr[$key]['DOB'] = $val->Value;
                                $arr1[$key]['DOB'] = $val->Value;
                            }
                            if ($val->Name == 'First Name') {
                                $arr[$key]['firstname'] = $val->Value;
                                $arr1[$key]['firstname'] = $val->Value;
                            }
                            if ($val->Name == 'Last Name') {
                                $arr[$key]['lastname'] = $val->Value;
                                $arr1[$key]['lastname'] = $val->Value;
                            }
                        }
                    }
                    $mid = $this->et_model->insert_mastersubscriber($value->EmailAddress, $arr1[$key]);
                    $controller_et->unsubscribe_email($value->EmailAddress, $value->SubscriberKey);
                    $arr[$key]['ms_id'] = $mid;
                }
            }

            $this->db->select('SubscriberKey');
            $this->db->where('ET', 0);
            $unsub_count = $this->db->get('unsub_record');
            if ($unsub_count->num_rows() > 0) {
                $data['UnSubscribedCount'] = $unsub_count->num_rows();

//               $subs_key = $unsub_count->result_array();
                $this->db->where('ET', 0)->update('unsub_record', array('ET' => 1));
            }

            $old_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');
            $this->et_model->insert_all_unsubscriber($arr);
//            if (count($arr) > 0) {
//                $data['UnSubscribedCount'] = count($arr) - $old_unsub;
//            } else {
//                $data['UnSubscribedCount'] = 0;
//            }
            $data['type'] = $type;
            $data['SyncTime'] = date("Y-m-d H:i:s");
            $data['store_id'] = $storeid;

            $controller_et->et_mdb_update();
            $this->sync_model->delTempSync($storeid);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date_format(date_create(date("Y-m-d H:i:s")), 'g:i A');
        } else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }
        if ($flag) {
            return $data;
        } else {
            echo json_encode($data);
            die;
        }
    }

    public function BBSync() {
        $storeid = $this->input->post('sync');
        $type = $this->input->post('type');
        $str_id = $this->sync_model->setTempSync($storeid);
        $this->BlackBoxxSync($str_id, $type, $storeid);
    }

    public function BlackBoxxSync($id, $type, $storeid, $flag = FALSE) {

        $bb = new Black_boxx();
        $controller_et = new Exact_target();

        $data = array();

        if ($this->sync_model->check($id)) {
            $user = $bb->get_user_list();
//            $data_val = $this->bb_model->get_where('bb_customer');
//            $count = count($data_val);
//            $new_count = count($user);
            $this->bb_model->update_bb($user);
            $this->bb_model->update_mdb($user);

            $data_val = $this->bb_model->get_where_count('bb_customer', array('count_status' => 0));

            $this->db->update('bb_customer', array('count_status' => 1), array('count_status' => 0));

            $count = $data_val;

            $bbUI = array();
            if ($user != NULL) {

                foreach ($user as $val) {
                    $bbUI[$val['email']] = $val['id'];
                }
            }

            $sub_diff = $count;

            if ($sub_diff > 0) {
                $data['SubscribedCount'] = $sub_diff;
            } else {
                $data['SubscribedCount'] = 0;
            }

            $old_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');

            if ($this->sync_model->check($id)) {
                $get_unSubscribe_list = $controller_et->get_unSubscribe_list();
                $unsublist = $controller_et->get_SpecificUnSubscribe_list();
            } else {
                $type->sync_model->delTempSync($id);
                echo 'stop';
                die;
            }

            if (count($unsublist) && is_array($unsublist)) {
                foreach ($unsublist as $key => $value) {

                    $this->db->select('ET_UID,	BB_UID,	BP_UID');
                    $this->db->where('ET_UID', $value->SubscriberKey);
                    $this->db->or_where('BP_UID', $value->SubscriberKey);
                    $data_res = $this->db->get('master_subscriber');

                    if ($data_res->num_rows() > 0) {
                        $res = $data_res->result_array();
                        $mdb = 0;
                        if (strlen($res[0]['ET_UID']) > 0) {
                            $et = 0;
                        } else {
                            $et = 2;
                        }
                        if (strlen($res[0]['BB_UID']) > 0) {
                            $bb = 0;
                        } else {
                            $bb = 2;
                        }
                        if (strlen($res[0]['BP_UID']) > 0) {
                            $bp = 0;
                        } else {
                            $bp = 2;
                        }
                    } else {
                        $bp = 2;
                        $bb = 2;
                        $et = 2;
                        $mdb = 2;
                    }

                    $unsub = array();
                    $unsub['SubscriberKey'] = $value->SubscriberKey;
                    $unsub['ListId'] = $value->List->ID;
                    $unsub['CreatedDate'] = $value->CreatedDate;
                    $unsub['IsMasterUnsubscribed'] = $value->IsMasterUnsubscribed;
                    $unsub['created'] = date("Y-m-d H:i:s");
                    $unsub['BB'] = $bb;
                    $unsub['BP'] = $bp;
                    $unsub['ET'] = $et;
                    $unsub['MDB'] = $mdb;


                    $result_count = $this->bb_model->get_where_count('unsub_record', array('SubscriberKey' => $value->SubscriberKey, 'ListId' => $value->List->ID));

                    if (!$result_count) {
                        $this->db->insert('unsub_record', $unsub);
                    }
                }
            }

            if (count($get_unSubscribe_list) && is_array($get_unSubscribe_list)) {
                foreach ($get_unSubscribe_list as $key => $value) {

                    $arr[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['ET_UID'] = $value->SubscriberKey;
                    if (isset($bbUI[$value->EmailAddress]))
                        $arr1[$key]['BB_UID'] = $bbUI[$value->EmailAddress];

                    $arr[$key]['unsubscribed_date'] = $value->UnsubscribedDate;
                    $arr1[$key]['status'] = 0;
                    $arr[$key]['unsubscriber_from'] = $this->et_model->checkstore($value->ID);
                    $arr[$key]['SubscriberID'] = $value->SubscriberKey;

                    if (is_array($value->Attributes)) {
                        foreach ($value->Attributes as $val) {

                            if ($val->Name == 'Date of Birth') {
                                $arr[$key]['DOB'] = $val->Value;
                                $arr1[$key]['DOB'] = $val->Value;
                            }
                            if ($val->Name == 'First Name') {
                                $arr[$key]['firstname'] = $val->Value;
                                $arr1[$key]['firstname'] = $val->Value;
                            }
                            if ($val->Name == 'Last Name') {
                                $arr[$key]['lastname'] = $val->Value;
                                $arr1[$key]['lastname'] = $val->Value;
                            }
                        }
                    }
                    $mid = $this->et_model->insert_mastersubscriber($value->EmailAddress, $arr1[$key]);

                    $controller_et->unsubscribe_email($value->EmailAddress, $value->SubscriberKey);

                    $arr[$key]['ms_id'] = $mid;
                }
            }

            $this->db->select('SubscriberKey');
            $this->db->where('BB', 0);
            $unsub_count = $this->db->get('unsub_record');
            if ($unsub_count->num_rows() > 0) {
                $data['UnSubscribedCount'] = $unsub_count->num_rows();

//               $subs_key = $unsub_count->result_array();
                $this->db->where('BB', 0)->update('unsub_record', array('BB' => 1));
            }

            $this->et_model->insert_all_unsubscriber($arr);
            $this->bb_model->bb_mdb_update();
            $new_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);
//            $data['UnSubscribedCount'] = $new_unsub - $old_unsub;
            $data['type'] = $type;
            $data['SyncTime'] = date("Y-m-d H:i:s");
            $data['store_id'] = $storeid;

            $this->sync_model->delTempSync($storeid);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date_format(date_create(date("Y-m-d H:i:s")), 'g:i A');
            if ($flag) {
                return $data;
            } else {
                echo json_encode($data);
                die;
            }
        } else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }
    }

    public function bpSync() {
//        $storeid = $this->input->post('sync');
        $storeid = 3;
        $type = 'Manual';
        $str_id = $this->sync_model->setTempSync($storeid);
        $this->BepozSync($str_id, $type, $storeid);
    }

    public function BepozSync($id, $type, $storeid, $flag = FALSE) {


        $controller_et = new Exact_target();

        $data = array();
        $data['SyncTime'] = date("Y-m-d H:i:s");
        if ($this->sync_model->check($id)) {
            $maindata = $controller_et->syncBepoz();

            $user = $maindata['list'];


//            $new_count = count($user);
            $this->bp_model->update_bp($user);
            $this->bp_model->update_mdb($user);

            $data_val = $this->bb_model->get_where_count('bp_customer', array('count_status' => 0));

            $this->db->update('bp_customer', array('count_status' => 1), array('count_status' => 0));

            $count = $data_val;

            $sub_diff = $count;
            if ($sub_diff > 0) {
                $data['SubscribedCount'] = $sub_diff;
            } else {
                $data['SubscribedCount'] = 0;
            }

            $old_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');

            if ($this->sync_model->check($id)) {
                $get_unSubscribe_list = $controller_et->get_unSubscribe_list('352396');
                $unsublist = $controller_et->get_SpecificUnSubscribe_list();
            } else {
                $type->sync_model->delTempSync($id);
                echo 'stop';
                die;
            }
            $arr = array();


            if (count($unsublist) && is_array($unsublist)) {
                foreach ($unsublist as $key => $value) {

                    $this->db->select('ET_UID,	BB_UID,	BP_UID');
                    $this->db->where('ET_UID', $value->SubscriberKey);
                    $this->db->or_where('BP_UID', $value->SubscriberKey);
                    $data_res = $this->db->get('master_subscriber');

                    if ($data_res->num_rows() > 0) {
                        $res = $data_res->result_array();
                        $mdb = 0;
                        if (strlen($res[0]['ET_UID']) > 0) {
                            $et = 0;
                        } else {
                            $et = 2;
                        }
                        if (strlen($res[0]['BB_UID']) > 0) {
                            $bb = 0;
                        } else {
                            $bb = 2;
                        }
                        if (strlen($res[0]['BP_UID']) > 0) {
                            $bp = 0;
                        } else {
                            $bp = 2;
                        }
                    } else {
                        $bp = 2;
                        $bb = 2;
                        $et = 2;
                        $mdb = 2;
                    }

                    $unsub = array();
                    $unsub['SubscriberKey'] = $value->SubscriberKey;
                    $unsub['ListId'] = $value->List->ID;
                    $unsub['CreatedDate'] = $value->CreatedDate;
                    $unsub['IsMasterUnsubscribed'] = $value->IsMasterUnsubscribed;
                    $unsub['created'] = date("Y-m-d H:i:s");
                    $unsub['BB'] = $bb;
                    $unsub['BP'] = $bp;
                    $unsub['ET'] = $et;
                    $unsub['MDB'] = $mdb;


                    $result_count = $this->bb_model->get_where_count('unsub_record', array('SubscriberKey' => $value->SubscriberKey, 'ListId' => $value->List->ID));

                    if (!$result_count) {
                        $this->db->insert('unsub_record', $unsub);
                    }
                }
            }


            if (count($get_unSubscribe_list) && is_array($get_unSubscribe_list)) {
                foreach ($get_unSubscribe_list as $key => $value) {

                    $arr[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['ET_UID'] = $value->SubscriberKey;
//                    if(isset($bbUI[$value->EmailAddress]))
//                    $arr1[$key]['BB_UID'] = $bbUI[$value->EmailAddress];

                    $arr[$key]['unsubscribed_date'] = $value->UnsubscribedDate;
                    $arr1[$key]['status'] = 0;
                    $arr[$key]['unsubscriber_from'] = $this->et_model->checkstore($value->ID);
                    $arr[$key]['SubscriberID'] = $value->SubscriberKey;

                    if (is_array($value->Attributes)) {
                        foreach ($value->Attributes as $val) {

                            if ($val->Name == 'Date of Birth') {
                                $arr[$key]['DOB'] = $val->Value;
                                $arr1[$key]['DOB'] = $val->Value;
                            }
                            if ($val->Name == 'First Name') {
                                $arr[$key]['firstname'] = $val->Value;
                                $arr1[$key]['firstname'] = $val->Value;
                            }
                            if ($val->Name == 'Last Name') {
                                $arr[$key]['lastname'] = $val->Value;
                                $arr1[$key]['lastname'] = $val->Value;
                            }
                        }
                    }
                    $mid = $this->et_model->insert_mastersubscriber($value->EmailAddress, $arr1[$key]);

                    $controller_et->unsubscribe_email($value->EmailAddress, $value->SubscriberKey);

                    $arr[$key]['ms_id'] = $mid;
                }
            }

            $this->db->select('SubscriberKey');
            $this->db->where('BP', 0);
            $unsub_count = $this->db->get('unsub_record');
            if ($unsub_count->num_rows() > 0) {
                $data['UnSubscribedCount'] = $unsub_count->num_rows();

//               $subs_key = $unsub_count->result_array();
                $this->db->where('BP', 0)->update('unsub_record', array('BP' => 1));
            }


            $this->et_model->insert_all_unsubscriber($arr);
            $this->bp_model->bp_mdb_update();
            $new_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);
//            $data['UnSubscribedCount'] = $new_unsub - $old_unsub;
            $data['type'] = $type;

            $data['store_id'] = $storeid;

            $this->sync_model->delTempSync($storeid);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date_format(date_create(date("Y-m-d H:i:s")), 'g:i A');
            if ($flag) {
                return $data;
            } else {
                echo json_encode($data);
                die;
            }
        } else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
        }
    }

    // syncing for auto sync 
    public function mdbSync() {
        set_time_limit(0);
//        $subs = $this->sync_model->get_master_subscriber();
//        $unsubs = $this->sync_model->get_master_unsubscriber();
        $storeid = $this->input->get('sync');
        $type = $this->input->get('type');

        $auto_detail = $this->db->get('autosyncdetail');

//        var_dump($sync_flag);die;
        if ($auto_detail->num_rows() > 0) {
            $sync_flag = $auto_detail->result_array();
            if ($sync_flag[0]['sync_flag'] == 1) {

                try {
                    $this->db->insert('cron', array('date' => date("Y-m-d H:i:s"), 'state' => 'First'));

                    $str_id = $this->sync_model->setTempSync(2);
                    $response = $this->BlackBoxxSync($str_id, $type, $storeid, $flag = 1);

                    if ($response) {

                        $this->db->insert('cron', array('date' => date("Y-m-d H:i:s"), 'state' => '1'));

                        $storeid = $this->input->get('sync');
                        $str_id = $this->sync_model->setTempSync(1);
                        $et_response = $this->ExactTargetSync($str_id, $type, $storeid, $flag = 1);
                        if ($et_response) {

                            $this->db->insert('cron', array('date' => date("Y-m-d H:i:s"), 'state' => '2'));
                            $storeid = $this->input->get('sync');
                            $str_id = $this->sync_model->setTempSync(3);
                            $bepoz_response = $this->BepozSync($str_id, $type, $storeid, $flag = 1);
                        }
                        if ($bepoz_response) {

                            $this->db->insert('cron', array('date' => date("Y-m-d H:i:s"), 'state' => '3'));

                            $data_val = $this->bb_model->get_where_count('master_subscriber', array('count_status' => 0));
                            $this->db->update('master_subscriber', array('count_status' => 1), array('count_status' => 0));

                            $this->db->select('SubscriberKey');
                            $this->db->where('MDB', 0);
                            $unsub_count = $this->db->get('unsub_record');
                            if ($unsub_count->num_rows() > 0) {
                                $data['UnSubscribedCount'] = $unsub_count->num_rows();

//               $subs_key = $unsub_count->result_array();
                                $this->db->where('MDB', 0)->update('unsub_record', array('MDB' => 1));
                            }

//                            $new_unsubs = $this->sync_model->get_master_unsubscriber();
//                            $sub_diff = $data_val;
//                            if ($sub_diff > 0) {
//                                $data['SubscribedCount'] = $sub_diff;
//                            } else {
//                                $data['SubscribedCount'] = 0;
//                            }

                            $data['SyncTime'] = date('h:ma', time());
//                            $data['UnSubscribedCount'] = $new_unsubs - $unsubs;
                            $data['type'] = $type;
                            $data['SyncTime'] = date("Y-m-d H:i:s");
                            $data['store_id'] = $storeid;
                            $this->sync_model->delTempSync($storeid);
                            $this->sync_model->insert_sync_updates($data);
                            $data['SyncTime'] = date_format(date_create(date("Y-m-d H:i:s")), 'g:i A');
                        }
                        $login = new Login();
                        $login->new_csv_upload();
                        $to = 'andy@laststrategy.com';
                        $from = 'McWilliams';
                        $subject = 'Cron Informations';
                        $message = 'Cron is executed successfully.';
                        mymail($to, $subject, $message, FALSE, $from);

                        $this->db->insert('cron', array('date' => date("Y-m-d H:i:s"), 'state' => '4'));
                        echo json_encode($data);
                        die;
                    }
                } catch (Exception $e) {

                    $home = new Home();
                    $home->fail_message('Auto sync Failed', $e->getMessage());
                    $to = 'yogesh@ignisitsolutions.com';
                    $from = 'McWilliams';
                    $subject = 'Cron Informations';
                    $message = 'Auto sync failed' . $e->getMessage();
                    mymail($to, $subject, $message, FALSE, $from);
                }
            }
//            else {
//                $to = 'ankit@ignisitsolutions.com';
//                $from = 'McWilliams';
//                $subject = 'Cron Informations';
//                $message = 'Autosync button is deactivated';
////                $headers = 'From: mcwilliamssendmail@gmail.com' . "\r\n" .
////                        'Reply-To: webmaster@example.com' . "\r\n" .
////                        'X-Mailer: PHP/' . phpversion();
//
//                mymail($to, $subject, $message, FALSE, $from);
//            }
        }
    }

    // syncing for MDB 
    public function mdbManualSync() {
        set_time_limit(0);
//        $subs = $this->sync_model->get_master_subscriber();
//        $unsubs = $this->sync_model->get_master_unsubscriber();
        $storeid = $this->input->get('sync');
        $type = $this->input->get('type');



        $str_id = $this->sync_model->setTempSync(2);
        $response = $this->BlackBoxxSync($str_id, $type, $storeid, $flag = 1);

        if ($response) {

            $storeid = $this->input->get('sync');
            $str_id = $this->sync_model->setTempSync(1);
            $et_response = $this->ExactTargetSync($str_id, $type, $storeid, $flag = 1);
            if ($et_response) {

                $storeid = $this->input->get('sync');
                $str_id = $this->sync_model->setTempSync(3);
                $bepoz_response = $this->BepozSync($str_id, $type, $storeid, $flag = 1);
            }
            if ($bepoz_response) {

                $data_val = $this->bb_model->get_where_count('master_subscriber', array('count_status' => 0));
                $this->db->update('master_subscriber', array('count_status' => 1), array('count_status' => 0));

                $this->db->select('SubscriberKey');
                $this->db->where('MDB', 0);
                $unsub_count = $this->db->get('unsub_record');
                if ($unsub_count->num_rows() > 0) {
                    $data['UnSubscribedCount'] = $unsub_count->num_rows();

//               $subs_key = $unsub_count->result_array();
                    $this->db->where('MDB', 0)->update('unsub_record', array('MDB' => 1));
                }

//                $new_unsubs = $this->sync_model->get_master_unsubscriber();
//                $sub_diff = $data_val;
//                if ($sub_diff > 0) {
//                    $data['SubscribedCount'] = $sub_diff;
//                } else {
//                    $data['SubscribedCount'] = 0;
//                }

                $data['SyncTime'] = date('h:ma', time());
//                $data['UnSubscribedCount'] = $new_unsubs - $unsubs;
                $data['type'] = $type;
                $data['SyncTime'] = date("Y-m-d H:i:s");
                $data['store_id'] = $storeid;
                $this->sync_model->delTempSync($storeid);
                $this->sync_model->insert_sync_updates($data);
                $data['SyncTime'] = date_format(date_create(date("Y-m-d H:i:s")), 'g:i A');
            }
            $login = new Login();
            $login->new_csv_upload();

            echo json_encode($data);
            die;
        }
    }

}
