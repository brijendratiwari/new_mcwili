<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mdb_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_mdbSubscriber() {
        $this->db->where("status", 1);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_mdbUnSubscriber() {
        $this->db->where("status", 0);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_mdbFilterSubscriber() {

        $data = array();
        $query = "select * from master_subscriber where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from master_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-1 months")) . "-01' and '" . date("Y-m", strtotime("-0 months")) . "-01'";
        $query2 = "select * from master_subscriber where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01'";
        $query3 = "select * from master_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from master_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
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

    public function get_mdbFilterUnSubscriber() {

        $data = array();
        $query = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-0 hour")) . "-01'";
        $query2 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-2 hour")) . "-01'";
        $query3 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;

        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $data['year'] = $res->num_rows();
        $data['hours'] = $res1->num_rows();
        $data['previous_hours'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        return $data;
    }

    public function getLastSystemSync() {
        $query = "select max(sync_updates.SyncTime) as latest_sync from  (`store`) 
                        join `sync_updates` on `store`.`id` = `sync_updates`.`store_id`";
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

}
