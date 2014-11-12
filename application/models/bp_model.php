<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Bp_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_customer($customer_data) {
        $this->blank_tab('bp_customer');
        $this->db->insert_batch('bp_customer', $customer_data);
    }

    public function blank_tab($table_name) {
        $this->db->truncate($table_name);
    }

    public function insert_bp_customer($customer_data) {
//          $this->blank_tab('bp_customer');
        $res = $this->db->insert('bp_customer', $customer_data);
        return $res;
    }

    public function insert_bp_customer_rel($list_ids, $email, $customer_id) {
//          $this->blank_tab('bp_customer');
        foreach ($list_ids as $ids) {
            $this->db->insert('bp_customer_rel', array("list_id" => $ids, "customer_id" => $customer_id, "email" => $email));
        }
    }

    public function get_where($table_name, $where = FALSE) {
//          $this->blank_tab('bp_customer');
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

    public function update_bp_customer($email, $data) {
        $this->db->where('email', $email);
        $res = $this->db->update('bp_customer', $data);
        return $res;
    }

    public function get_bpUnSubscriber() {

        $query = "SELECT `all_unsubscriber`.`id`, `all_unsubscriber`.`email`, `all_unsubscriber`.`firstname`, `all_unsubscriber`.`lastname`, `all_unsubscriber`.`unsubscribed_date` FROM (`store`) JOIN `all_unsubscriber` ON `all_unsubscriber`.`unsubscriber_from` REGEXP `store`.`id` WHERE `store`.`name` = 'BB' ";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

  public function get_bpListFilterSubscriber($list_id) {
//        echo date("Y-m", strtotime("-0 months"));die;
        $data = array();

        $query9 = "SELECT * FROM et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` WHERE et1.`ListID` = '" . $list_id . "' AND et2.`ListID` = '352396'";
        $query = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where YEAR(et1.`CreatedDate`) = (YEAR(CURDATE())-1)  and et1.`ListID` = '352396' and et2.`ListID` = '" . $list_id . "' ";
        $query1 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where MONTH( CURDATE( ) ) = MONTH(et1.CreatedDate) and et1.`ListID` = '352396'  and  et2.`ListID`  = '" . $list_id . "'";
        $query2 = "select * from et_subscriber_list_rel  et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where  MONTH(et1.`CreatedDate`) = (MONTH(CURDATE())-1) and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query3 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY) and et1.`ListID` = '352396' and et2.`ListID`  = '" . $list_id . "'";
        $query4 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "' and et1.`ListID` = '352396'  and et2.`ListID`  = '" . $list_id . "'";
        $query5 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where DATE(et1.`CreatedDate`) = DATE(CURDATE()) and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";
        $query6 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where DATE(et1.`CreatedDate`) = DATE(CURDATE() - 1) and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";
        $query7 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY ) and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";
        $query8 = "select * from et_subscriber_list_rel et1 JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID` where et1.`CreatedDate` between (DATE_SUB( CURDATE( ) , INTERVAL 14 DAY ) and DATE_SUB( CURDATE( ) , INTERVAL 7 DAY )) and et1.`ListID` = '352396' and  et2.`ListID`  = '" . $list_id . "'";


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
        $res7 = $this->db->query($query7);
        $res8 = $this->db->query($query7);
        $res9 = $this->db->query($query9);

        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['today'] = $res5->num_rows();
        $data['yesterday'] = $res6->num_rows();
        $data['total'] = $res9->num_rows();
        $data['last_seven'] = $res7->num_rows();
        $data['previous_seven'] = $res8->num_rows();

        return $data;
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

    public function update_bp($data) {

        $email = array();

        foreach ($data as $val) {
            $now = array();

            $res = $this->db->get_where('bp_customer', array('email' => $val['EmailAddress']));
            if ($res->num_rows() > 0) {
                
            } else {

                $now['BP_UID'] = $val['SubscriberID'];
                $now['email'] = $val['EmailAddress'];
                $now['Status'] = 'Active';
                $now['firstname'] = $val['FirstName'];
                $now['lastname'] = $val['LastName'];
                $now['mobile_number'] = $val['Mobile'];
                $now['dob'] = $val['DOB'];
                $now['created'] = $val['CreatedDate'];
                $this->db->insert('bp_customer', $now);
            }
        }
    }

    public function update_mdb($data) {

        $email = array();

        foreach ($data as $val) {
            $now = array();

            $res = $this->db->get_where('master_subscriber', array('email' => $val['EmailAddress']));
            if ($res->num_rows() > 0) {
                $this->db->where(array('email' => $val['EmailAddress']));
                $this->db->update('master_subscriber', array('BP_UID' => $val['SubscriberID']));
            } else {

                $now['CreatedDate'] = $val['CreatedDate'];
                $now['email'] = $val['EmailAddress'];
                $now['firstname'] = $val['FirstName'];
                $now['lastname'] = $val['LastName'];
                $now['Status'] = '1';
                $now['BP_UID'] = $val['SubscriberID'];
                $now['DOB'] = $val['DOB'];
//                $now['ET_UID'] = $val['SubscriberID'];

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

    public function get_bpallFilterSubscriber() {

              $data = array();
        
          $query = "select * from bp_customer where YEAR(created) = (YEAR(CURDATE())-1)";
        $query1 = "select * from bp_customer where MONTH(created) = (MONTH(CURDATE())-1) ";
        $query2 = "select * from bp_customer where MONTH(created) = (MONTH(CURDATE())-2) ";
        $query3 = "select * from bp_customer where created >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY) ";
        $query4 = "select * from bp_customer where `created` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
        $query5 = "select * from bp_customer where `created` >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY) ";
        $query6 = "select * from bp_customer where `created` between DATE_SUB( CURDATE( ) , INTERVAL 14 DAY) and DATE_SUB( CURDATE( ) , INTERVAL 7 DAY) ";
        $query7 = "select * from bp_customer where DATE(`created`) = CURDATE( ) ";
        $query8 = "select * from bp_customer where DATE(`created`) = DATE_SUB( CURDATE( ) , INTERVAL 1 DAY) ";
//   echo $query8;die;
//        $query1 = "select count(id) from et_subscriber where CreatedDate >= DATEADD(MONTH, -1, GETDATE()) " ;
        $res = $this->db->query($query);
        $res1 = $this->db->query($query1);
        $res2 = $this->db->query($query2);
        $res3 = $this->db->query($query3);
        $res4 = $this->db->query($query4);
        $res5 = $this->db->query($query5);
        $res6 = $this->db->query($query6);
        $res7 = $this->db->query($query7);
        $res8 = $this->db->query($query8);
        $data['year'] = $res->num_rows();
        $data['month'] = $res1->num_rows();
        $data['previous_month'] = $res2->num_rows();
        $data['last_thirty'] = $res3->num_rows();
        $data['previous_thirty'] = $res4->num_rows();
        $data['last_seven'] = $res5->num_rows();
        $data['previous_seven'] = $res6->num_rows();
        $data['today'] = $res7->num_rows();
        $data['yesterday'] = $res8->num_rows();

        return $data;
    }

    public function get_bpFilterSubscriber() {

        $data = array();
        $query = "select * from et_subscriber_list_rel where YEAR(`CreatedDate`) = (YEAR(CURDATE())-1) and `ListID` IN('352396','351487', '351484', '351488', '351486') ";
        $query1 = "select * from et_subscriber_list_rel  where MONTH( CURDATE( ) ) = MONTH(CreatedDate) and  `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query2 = "select * from et_subscriber_list_rel where MONTH(`CreatedDate`) = (MONTH(CURDATE())-1) and `ListID` IN('352396','351487', '351484', '351488', '351486')";
        $query3 = "select * from et_subscriber_list_rel where  CreatedDate >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY)  and `ListID` IN('352396','351487', '351484', '351488', '351486')";
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

    public function bp_mdb_update() {
        $res = $this->db->query('SELECT firstname,lastname,email,created as CreatedDate,BP_UID,dob as DOB, 1 as status FROM bp_customer WHERE bp_customer.BP_UID NOT IN (SELECT BP_UID FROM master_subscriber)');

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
                $rel_data[$key]['store_id'] = '3';
            }
            $this->db->insert_batch('ms_to_store_rel', $rel_data);
        }
    }

}
