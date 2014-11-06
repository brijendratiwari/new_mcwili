<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bb_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_customer($customer_data) {
        $this->blank_tab('bb_customer');
        $this->db->insert_batch('bb_customer', $customer_data);
    }

    public function insert_merchant($merchant_data) {
        $this->blank_tab('merchant');
        $this->db->insert_batch('merchant', $merchant_data);
    }

    public function blank_tab($table_name) {
        $this->db->truncate($table_name);
    }

    public function insert_bb_customer($customer_data) {
//          $this->blank_tab('bb_customer');
        $res = $this->db->insert('bb_customer', $customer_data);
        return $res;
    }

    public function insert_bb_customer_rel($list_ids, $email, $customer_id) {
//          $this->blank_tab('bb_customer');
        foreach ($list_ids as $ids) {
            $this->db->insert('bb_customer_rel', array("list_id" => $ids, "customer_id" => $customer_id, "email" => $email));
        }
    }

    public function get_where($table_name, $where = FALSE) {
//          $this->blank_tab('bb_customer');
        $this->db->from($table_name);
//         $this->db->from($table_name);
        if ($where != FALSE) {
            $this->db->where($where);
        }
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }

    public function update_bb_customer($email, $data) {
        $this->db->where('email', $email);
        $res = $this->db->update('bb_customer', $data);
        return $res;
    }

    public function get_bbcustomer() {
//        $list_id = array('351484', '351485','351487');
//        $this->db->where_in('ListID', $list_id);
        $res = $this->db->get('bb_customer');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }
    public function get_bbcustomerCount() {
//        $list_id = array('351484', '351485','351487');
//        $this->db->where_in('ListID', $list_id);
        $res = $this->db->get('bb_customer');
        if ($res->num_rows() > 0) {
            return $res->num_rows();
        } else {
            return NULL;
        }
    }

    public function get_bbUnSubscriber() {

        $query = "SELECT `all_unsubscriber`.`id`, `all_unsubscriber`.`email`, `all_unsubscriber`.`firstname`, `all_unsubscriber`.`lastname`, `all_unsubscriber`.`unsubscribed_date` FROM (`store`) JOIN `all_unsubscriber` ON `all_unsubscriber`.`unsubscriber_from` REGEXP `store`.`id` WHERE `store`.`name` = 'BB' ";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_bbFilterCustomer() {

        $data = array();
        $query = "select * from bb_customer where `created` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01'";
        $query1 = "select * from bb_customer where  MONTH( CURDATE( ) ) = MONTH( created )";
        $query2 = "select * from bb_customer where MONTH(`created`) = (MONTH(CURDATE())-1)";
        $query3 = "select * from bb_customer where `created` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "'";
        $query4 = "select * from bb_customer where `created` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
        $query5 = "select * from bb_customer where `created` > CURDATE()";
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
        $data['today'] = $res5->num_rows();
        return $data;
    }

    public function get_bbListFilterSubscriber($list_id) {
//        echo date("Y-m", strtotime("-0 months"));die;
        $data = array();
        $query6 = "select * from et_subscriber_list_rel 
            JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
            JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID   
            where et_subscriber_list_rel.`ListID` = '" . $list_id . "' ";



        $query = "select * from et_subscriber_list_rel 
                  JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
                  JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID 
                  where et_subscriber_list_rel.`CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and et_subscriber_list_rel.`ListID` = '" . $list_id . "' ";
        $query1 = "select * from et_subscriber_list_rel 
                   JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
                   JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID 
                   where MONTH( CURDATE( ) ) = MONTH(et_subscriber_list_rel.CreatedDate ) and et_subscriber_list_rel.`ListID`  = '" . $list_id . "'";
        $query2 = "select * from et_subscriber_list_rel 
                   JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
                   JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID  
                   where  MONTH(et_subscriber_list_rel.`CreatedDate`) = (MONTH(CURDATE())-1) and et_subscriber_list_rel.`ListID`  = '" . $list_id . "'";
        $query3 = "select * from et_subscriber_list_rel 
                   JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID
                   JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID 
                   where et_subscriber_list_rel.`CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and et_subscriber_list_rel.`ListID`  = '" . $list_id . "'";
        $query4 = "select * from et_subscriber_list_rel 
                   JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID
                   JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID
                   where et_subscriber_list_rel.`CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and et_subscriber_list_rel.`ListID`  = '" . $list_id . "'";
        $query5 = "select * from et_subscriber_list_rel 
                   JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID
                   JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID
                   where et_subscriber_list_rel.`CreatedDate` > CURDATE() and  et_subscriber_list_rel.`ListID`  = '" . $list_id . "'";

//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;
        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $res5 = $this->db->query($query5);
        $res6 = $this->db->query($query6);
        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['today'] = $res5->num_rows();
        $data['total'] = $res6->num_rows();

        return $data;
    }

    public function get_bpListFilterSubscriber($list_id) {
//        echo date("Y-m", strtotime("-0 months"));die;
        $data = array();

        $query6 = "SELECT * FROM et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` WHERE et1.`ListID` = '" . $list_id . "' AND et2.`ListID` = '352396'";
        $query = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and et1.`ListID` = '352396' and et2.`ListID` = '" . $list_id . "' ";
        $query1 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where MONTH( CURDATE( ) ) = MONTH(et1.CreatedDate) and et1.`ListID` = '352396'  and  et2.`ListID`  = '" . $list_id . "'";
        $query2 = "select * from et_subscriber_list_rel  et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where  MONTH(et1.`CreatedDate`) = (MONTH(CURDATE())-1) and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query3 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query4 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and et1.`ListID` = '352396'  and et2.`ListID`  = '" . $list_id . "'";
        $query5 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` > CURDATE() and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";


//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;
//        echo $query;
//        die;
        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $res5 = $this->db->query($query5);
        $res6 = $this->db->query($query6);

        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['today'] = $res5->num_rows();
        $data['total'] = $res6->num_rows();

        return $data;
    }

    public function get_bbSubscriberDetail() {
        $this->db->select('*');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('351484', '351485', '351487'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_bpSubscriberDetail() {
        $this->db->select('*');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('352396'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function update_bb($data) {

        $email = array();

        foreach ($data as $val) {
            $now = array();

            $res = $this->db->get_where('bb_customer', array('email' => $val['email']));
            if ($res->num_rows() > 0) {
                
            } else {

                $now['created'] = $val['created_at'];
                $now['email'] = $val['email'];
                $now['firstname'] = $val['first_name'];
                $now['lastname'] = $val['last_name'];
                $now['merchant_id'] = $val['merchant_id'];
                $now['BB_UID'] = $val['id'];
                $now['bb_id'] = 2;
                $now['Status'] = 'Active';

                $this->db->insert('bb_customer', $now);
            }
        }
    }

    public function update_mdb($data) {

        $email = array();

        foreach ($data as $val) {
            $now = array();

            $res = $this->db->get_where('master_subscriber', array('email' => $val['email']));
            if ($res->num_rows() > 0) {
                $this->db->where(array('email' => $val['email']));
                $this->db->update('master_subscriber', array('BB_UID' => $val['id']));
            } else {

                $now['CreatedDate'] = $val['created_at'];
                $now['email'] = $val['email'];
                $now['firstname'] = $val['first_name'];
                $now['lastname'] = $val['last_name'];
                $now['Status'] = '1';
                $now['BB_UID'] = $val['id'];

                $this->db->insert('master_subscriber', $now);
            }
        }
    }

    public function get_bpSubscriber() {
        $this->db->select('*');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('352396'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }
    public function get_bpSubscriberCount() {
        $this->db->select('*');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('352396'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->num_rows();
        } else {
            return NULL;
        }
    }

    public function get_bpallFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` = '352396' ";
        $query1 = "select * from et_subscriber_list_rel where MONTH( CURDATE( ) ) = MONTH(CreatedDate)  and `ListID` = '352396'";
        $query2 = "select * from et_subscriber_list_rel where MONTH(`CreatedDate`) = (MONTH(CURDATE())-1) and `ListID` = '352396'";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID` = '352396' ";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID` = '352396' ";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > CURDATE() and `ListID` = '352396'";
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
        $data['today'] = $res5->num_rows();
        return $data;
    }

    public function get_bpFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` IN('352396','351487', '351484', '351488', '351486') ";
        $query1 = "select * from et_subscriber_list_rel  where MONTH( CURDATE( ) ) = MONTH(CreatedDate) and  `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query2 = "select * from et_subscriber_list_rel where MONTH(`CreatedDate`) = (MONTH(CURDATE())-1) and `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > CURDATE() and  `ListID` IN('352396','351487', '351484', '351488', '351486')";
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
        $data['today'] = $res5->num_rows();
        return $data;
    }

    public function bb_mdb_update() {
        $res = $this->db->query('SELECT firstname,lastName,email,created as CreatedDate,BB_UID,1 as status FROM bb_customer WHERE bb_customer.BB_UID NOT IN (SELECT BB_UID FROM master_subscriber)');

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
                $rel_data[$key]['store_id'] = '2';
            }
            $this->db->insert_batch('ms_to_store_rel', $rel_data);
        }
    }

    public function getLastSystemSyncsub() {
        $query = "select max(sync_updates.SyncTime) as latest_sync from  (`store`) 
                        join `sync_updates` on `store`.`id` = `sync_updates`.`store_id` where `store`.`name` = 'BB' ";
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