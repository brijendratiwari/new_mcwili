<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Et_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insertList($data) {

        if (is_array($data) && $data != NULL && (count($data) > 0)) {
            $this->blank_tab('et_list');
            $this->db->insert_batch('et_list', $data);
        }
    }

    public function getList() {
        $this->db->where(array('ListClassification' => 'ExactTargetList'));
        $res = $this->db->get('et_list');
        if ($res->num_rows() > 0) {
            $data = $res->result_array();

            foreach ($data as $key => $value) {
                $cou = $this->db->get_where('et_subscriber_list_rel', 'ListID =' . $value['ListID']);
                $data[$key]['total'] = $cou->num_rows();
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function getListNew() {

        $res = $this->db->get('et_category');
        if ($res->num_rows() > 0) {
            $data = $res->result_array();

            foreach ($data as $key => $value) {
                $this->db->where(array('et_list.Category' => $value['Category_ID']));
                $this->db->from('et_list');
                $this->db->join('et_subscriber_list_rel', 'et_subscriber_list_rel.ListID = et_list.Category');
                $cou = $this->db->get();
                $data[$key]['total'] = $cou->num_rows();
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function blank_tab($table_name) {
        $this->db->truncate($table_name);
    }

    public function get_count($table_name, $storeid = FALSE) {
        if ($storeid != FALSE) {
            $query = "select * from " . $table_name . " where unsubscriber_from REGEXP '" . $storeid . "'";
            $res = $this->db->query($query);
            $manager = $res->result_array();
        }
        else
            $res = $this->db->get($table_name);
        return $res->num_rows();
    }

    public function insert_tab($table_name, $data) {
        if (is_array($data) && $data != NULL && (count($data) > 0)) {
            $this->db->insert_batch($table_name, $data);
        }
    }

    public function update_mdb() {
        $res = $this->db->query('SELECT FirstName,LastName,EmailAddress as email,DOB,CreatedDate,SubscriberID as ET_UID,1 as status FROM et_subscriber WHERE et_subscriber.SubscriberID NOT IN (SELECT ET_UID FROM master_subscriber)');

        if ($res->num_rows() > 0) {
            $data = $res->result_array();

            $rel_data = array();
            foreach ($data as $key => $val) {
                $msres = $this->db->get_where('master_subscriber', array('email' => $val['email']));
                if ($msres->num_rows() > 0) {
                    $this->db->where(array('email' => $val['email']));
                    $this->db->update('master_subscriber', $val);
                } else {
                    $this->db->insert('master_subscriber', $val);
                }
                $rel_data[$key]['subscriber_id'] = $this->db->insert_id();
                $rel_data[$key]['store_id'] = '1';
            }
            $this->db->insert_batch('ms_to_store_rel', $rel_data);
        }
    }

    public function get_etSubscriber() {
        $res = $this->db->get('et_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_UnSubscriber() {

        $query = "SELECT `all_unsubscriber`.`id`, `all_unsubscriber`.`email`, `all_unsubscriber`.`firstname`, `all_unsubscriber`.`lastname`, `all_unsubscriber`.`unsubscribed_date` FROM (`store`) JOIN `all_unsubscriber` ON `all_unsubscriber`.`unsubscriber_from` REGEXP `store`.`id` WHERE `store`.`name` = 'ET' ";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_etFilterSubscriber() {
        $data = array();
        $query = "select * from et_subscriber where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-1 months")) . "-01' and '" . date("Y-m", strtotime("-0 months")) . "-01'";
        $query2 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01'";
        $query3 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
        $query5 = "select * from et_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-7 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";

//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;
        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $res5 = $this->db->query($query5);
        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['last_seven'] = $res5->num_rows();
        return $data;
    }

    public function get_etFilterUnSubscriber() {

        $data = array();
        $query = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-0 hour")) . "-01'";
        $query2 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-2 hour")) . "-01'";
        $query3 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
        $query5 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m-d", strtotime("-7 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";

//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;

        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $res5 = $this->db->query($query5);
        $data['year'] = $res->num_rows();
        $data['hours'] = $res1->num_rows();
        $data['previous_hours'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['last_seven'] = $res5->num_rows();
        return $data;
    }

    public function insert_mastersubscriber($email = FALSE, $data) {
        $this->db->where('email', $email);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            $arr = array('status' => 0);
            $this->db->where('email', $email)
                    ->update('master_subscriber', $arr);
            $data = $res->result_array();
            return $data[0]['id'];
        } else {
            $this->db->insert('master_subscriber', $data);
            return $this->db->insert_id();
        }
    }

    public function insert_all_unsubscriber($data) {

        foreach ($data as $unsubscribed) {
            if ($unsubscribed['unsubscriber_from'] != NULL) {
                $sql = "SELECT * FROM (`all_unsubscriber`) WHERE `email` = '" . $unsubscribed["email"] . "' AND `unsubscriber_from` REGEXP '" . $unsubscribed["unsubscriber_from"] . "'";
                $res = $this->db->query($sql);
                if ($res->num_rows() > 0) {
                    
                } else {
                    $this->db->insert('all_unsubscriber', $unsubscribed);
                }
            }
        }
    }

    public function checkSystemSync() {
        $this->db->select('*');
        $this->db->where('(store.name = "ET")');
        $this->db->from('store');
        $this->db->join('sync_updates', 'store.id=sync_updates.store_id');
        $res = $this->db->get();
        return $res->num_rows();
    }

    public function getLastSystemSyncsub() {
        $query = "select max(sync_updates.SyncTime) as latest_sync from  (`store`) 
                        join `sync_updates` on `store`.`id` = `sync_updates`.`store_id` where `store`.`name` = 'ET' ";
        $res = $this->db->query($query);
//        echo $this->db->last_query();
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            $query1 = "select UnSubscribedCount,SubscribedCount,SyncTime from sync_updates where SyncTime = '" . $data[0]['latest_sync'] . "'";
            $res1 = $this->db->query($query1);
//        var_dump($res1->result_array());die;
            return $res1->result_array();
        }
    }

    public function get_et_subscriber($email) {

        $this->db->where('EmailAddress', $email);
        $res = $this->db->get('et_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function add_etsubscriber($data) {
        $res = $this->db->insert("et_subscriber", $data);
        echo $res;
    }

    public function add_etsubscriber_rel($list_id, $subscriber_id) {
        foreach ($list_id as $val) {
            $this->db->where(array("ListID" => $val, "SubscriberID" => $subscriber_id));
            $res = $this->db->get('et_subscriber_list_rel');
            if ($res->num_rows() > 0) {
                $this->db->where(array("ListID" => $val, "SubscriberID" => $subscriber_id));
                $this->db->update("et_subscriber_list_rel", array("Status" => "Active"));
            } else {
                $this->db->insert('et_subscriber_list_rel', array("ListID" => $val, "SubscriberID" => $subscriber_id, "CreatedDate" => date("Y-m-d h:m:s", time()), "Status" => "Active"));
            }
        }
    }

    public function checkstore($id) {

        $temp = array('351484', '351485', '351486', '351487', '351488');
//        340876
//        $arr ['one'] = 
        $arr = array();
        $this->db->select('ListID');
        $res = $this->db->get_where('et_subscriber_list_rel', array('main_id' => $id));
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            foreach ($data as $val) {
                if ($val['ListID'] != '340876') {
                    if (in_array($val['ListID'], $temp)) {
                        $arr['two'] = 2;
                    } else {
                        $arr['one'] = 1;
                        $arr['five'] = 5;
                    }
                } else {
                    $arr['one'] = 1;
                    $arr['five'] = 5;
                }
            }
        }

        return implode(',', $arr);
    }

    public function unsubscribedfromlist($id) {
        $this->db->select('ListId');
        $this->db->distinct('ListId');
        $this->db->where(array('SubscriberID' => $id, 'Status' => 'Active'));
        $res = $this->db->get('et_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

}

?>
