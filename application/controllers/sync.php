<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sync extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sync_model');
        $this->load->model('et_model');
        $this->load->model('bb_model');
        require_once('exact_target.php');
        require_once('black_boxx.php');
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

        if ($this->sync_model->check($id))
            $get_unSubscribe_list = $controller_et->get_unSubscribe_list();
        else {
//            $type->sync_model->delTempSync($id);
            echo 'stop';
            die;
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
                    $controller_et->unsubscribe_email($value->EmailAddress,$value->SubscriberKey);
                    $arr[$key]['ms_id'] = $mid;
                }
            }

            $old_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');
            $this->et_model->insert_all_unsubscriber($arr);
            if (count($arr) > 0) {
                $data['UnSubscribedCount'] = count($arr) - $old_unsub;
            } else {
                $data['UnSubscribedCount'] = 0;
            }
            $data['type'] = $type;
            $data['SyncTime'] = date('Y-m-d h:m:s', time());
            $data['store_id'] = $storeid;

            $controller_et->et_mdb_update();
            $this->sync_model->delTempSync($storeid);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date('h:ma', time());
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
            $data_val = $this->bb_model->get_where('bb_customer');
            $count = count($data_val);
            $new_count = count($user);
            $this->bb_model->update_bb($user);
            $this->bb_model->update_mdb($user);

            $bbUI = array();
            if ($user != NULL) {

                foreach ($user as $val) {
                    $bbUI[$val['email']] = $val['id'];
                }
            }
            
            $sub_diff = $new_count - $count;
            if ($sub_diff > 0) {
                $data['SubscribedCount'] = $sub_diff;
            } else {
                $data['SubscribedCount'] = 0;
            }

            $old_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);    // counting the old sub data
//            $this->et_model->blank_tab('all_unsubscriber');

            if ($this->sync_model->check($id))
                $get_unSubscribe_list = $controller_et->get_unSubscribe_list();
            else {
                $type->sync_model->delTempSync($id);
                echo 'stop';
                die;
            }

            if (count($get_unSubscribe_list) && is_array($get_unSubscribe_list)) {
                foreach ($get_unSubscribe_list as $key => $value) {

                    $arr[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['email'] = $value->EmailAddress;
                    $arr1[$key]['ET_UID'] = $value->SubscriberKey;
                    if(isset($bbUI[$value->EmailAddress]))
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


            $this->et_model->insert_all_unsubscriber($arr);
            $this->bb_model->bb_mdb_update();
            $new_unsub = $this->et_model->get_count('all_unsubscriber', $storeid);
            $data['UnSubscribedCount'] = $new_unsub - $old_unsub;
            $data['type'] = $type;
            $data['SyncTime'] = date('Y-m-d h:m:s', time());
            $data['store_id'] = $storeid;

            $this->sync_model->delTempSync($storeid);
            $this->sync_model->insert_sync_updates($data);
            $data['SyncTime'] = date('h:ma', time());
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

    // syncing for MDB 
    public function mdbSync() {
        $subs = $this->sync_model->get_master_subscriber();
        $unsubs = $this->sync_model->get_master_unsubscriber();
        $storeid = $this->input->post('sync');
        $type = $this->input->post('type');
        $str_id = $this->sync_model->setTempSync(2);
        $response = $this->BlackBoxxSync($str_id, $type, $storeid, $flag = 1);
        if ($response) {
            $storeid = $this->input->post('sync');
            $str_id = $this->sync_model->setTempSync(1);
            $et_response = $this->ExactTargetSync($str_id, $type, $storeid, $flag = 1);
            if ($et_response) {
                $new_subs = $this->sync_model->get_master_subscriber();
                $new_unsubs = $this->sync_model->get_master_unsubscriber();
                $sub_diff = $new_subs - $subs;
                if ($sub_diff > 0) {
                    $data['SubscribedCount'] = $sub_diff;
                } else {
                    $data['SubscribedCount'] = 0;
                }

                $data['SyncTime'] = date('h:ma', time());
                $data['UnSubscribedCount'] = $new_unsubs - $unsubs;
                $data['type'] = $type;
                $data['SyncTime'] = date('Y-m-d h:m:s', time());
                $data['store_id'] = $storeid;
                $this->sync_model->delTempSync($storeid);
                $this->sync_model->insert_sync_updates($data);
                $data['SyncTime'] = date('h:ma', time());
            }
            echo json_encode($data);
            die;
        }
    }

}
