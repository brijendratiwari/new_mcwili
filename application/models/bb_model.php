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

    public function get_bbSubscriber() {
        $list_id = array('351484', '351485','351487');
        $this->db->where_in('ListID', $list_id);
        $res = $this->db->get('et_subscriber_list_rel');
        if ($res->num_rows() > 0) {
            return $res->result_array();
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

    public function get_bbFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` IN('351484', '351485','351487') ";
        $query1 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 MONTH) and  `ListID` IN('351484', '351485','351487')";
        $query2 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01' and `ListID` IN('351484', '351485','351487')";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID` IN('351484', '351485','351487')";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID` IN('351484', '351485','351487')";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 DAY) and `ListID` IN('351484', '351485','351487')";
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
        $query6 = "select * from et_subscriber_list_rel where `ListID` = '" . $list_id . "' ";
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` = '" . $list_id . "' ";
        $query1 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 MONTH) and `ListID`  = '" . $list_id . "'";
        $query2 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01' and `ListID`  = '" . $list_id . "'";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID`  = '" . $list_id . "'";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID`  = '" . $list_id . "'";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 DAY) and  `ListID`  = '" . $list_id . "'";

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

        $query6="SELECT * FROM et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` WHERE et1.`ListID` = '" . $list_id . "' AND et2.`ListID` = '352396'";
        $query = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and et1.`ListID` = '352396' and et2.`ListID` = '" . $list_id . "' ";
        $query1 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 MONTH) and et1.`ListID` = '352396'  and  et2.`ListID`  = '" . $list_id . "'";
        $query2 = "select * from et_subscriber_list_rel  et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and '" . date("Y-m", strtotime("-1 months")) . "-01' and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query3 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query4 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and et1.`ListID` = '352396'  and et2.`ListID`  = '" . $list_id . "'";
        $query5 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 DAY) and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";


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
        $this->db->join('et_subscriber','et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
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
        $this->db->join('et_subscriber','et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
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
                $now['customer_id'] = $val['id'];
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
                
            } else {

                $now['CreatedDate'] = $val['created_at'];
                $now['email'] = $val['email'];
                $now['firstname'] = $val['first_name'];
                $now['lastname'] = $val['last_name'];
                $now['Status'] = '1';

                $this->db->insert('master_subscriber', $now);
            }
        }
    }
    
     public function get_bpSubscriber(){
        $this->db->select('*');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('352396'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber','et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }
    
        public function get_bpallFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` = '352396' ";
        $query1 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 MONTH) and `ListID` = '352396'";
        $query2 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and `ListID` = '352396' and '" . date("Y-m", strtotime("-1 months")) . "-01' ";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID` = '352396' ";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID` = '352396' ";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 DAY) and `ListID` = '352396'";
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
        $query = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y", strtotime("-1 year")) . "-01-01' and '" . date("Y", strtotime("-0 year")) . "-01-01' and `ListID` = '352396' and `ListID` IN('351487', '351484', '351488', '351486') ";
        $query1 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 MONTH) and `ListID` = '352396' and  `ListID` IN('351487', '351484', '351488', '351486')";
        $query2 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m", strtotime("-2 months")) . "-01' and `ListID` = '352396' and '" . date("Y-m", strtotime("-1 months")) . "-01' and `ListID` IN('351487', '351484', '351488', '351486')";
        $query3 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-30 days")) . "' and '" . date("Y-m-d", strtotime("-0 days")) . "' and `ListID` = '352396' and `ListID` IN('351487', '351484', '351488', '351486')";
        $query4 = "select * from et_subscriber_list_rel where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and `ListID` = '352396' and `ListID` IN('351487', '351484', '351488', '351486')";
        $query5 = "select * from et_subscriber_list_rel where `CreatedDate` > DATE_SUB(NOW(), INTERVAL 1 DAY) and `ListID` = '352396' and  `ListID` IN('351487', '351484', '351488', '351486')";
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
}