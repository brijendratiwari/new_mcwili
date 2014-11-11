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
    public function get_mdbSubscriberCount() {
        $this->db->where("status", 1);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            return $res->num_rows();
        } else {
            return NULL;
        }
    }

    public function get_csvSubscriber() {
//        $res = $this->db->query('SELECT firstname,lastname,email,BP_UID,DOB,status,CreatedDate FROM master_subscriber WHERE master_subscriber.email NOT IN (SELECT email FROM csv_subscriber)');
        $res = $this->db->query('
            SELECT m1 . firstname ,m1 . firstname ,m1 . lastname ,m1 . email ,m1 . DOB ,m1 . status ,m1 . CreatedDate, 
if((SELECT if( et1.`ID` IS NULL , "n", "y" ) AS id
FROM et_subscriber_list_rel et1
JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
WHERE et1.`ListID` = "352396"
AND et2.`ListID` = "351487"
AND et1.`SubscriberID` = m1.`ET_UID`)
IS NULL , "n", "y" ) AS BR,
if(
(SELECT if( et1.`ID` IS NULL , "n", "y" ) AS id
FROM et_subscriber_list_rel et1
JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
WHERE et1.`ListID` = "352396"
AND et2.`ListID` = "351484"
AND et1.`SubscriberID` = m1.`ET_UID`)
IS NULL , "n", "y" ) AS BO,

if(
(SELECT if( et1.`ID` IS NULL , "n", "y" ) AS id
FROM et_subscriber_list_rel et1
JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
WHERE et1.`ListID` = "352396"
AND et2.`ListID` = "351488"
AND et1.`SubscriberID` = m1.`ET_UID`)
IS NULL , "n", "y" ) AS BQ,

if(
(SELECT if( et1.`ID` IS NULL , "n", "y" ) AS id
FROM et_subscriber_list_rel et1
JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
WHERE et1.`ListID` = "352396"
AND et2.`ListID` = "351486"
AND et1.`SubscriberID` = m1.`ET_UID`)
IS NULL , "n", "y" ) AS BP,

if(
(SELECT if( et1.`ID` IS NULL , "n", "y" ) AS id
FROM et_subscriber_list_rel et1
JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
WHERE et1.`ListID` = "352396"
AND et2.`ListID` = "351485"
AND et1.`SubscriberID` = m1.`ET_UID`)
IS NULL , "n", "y" ) AS BN 
FROM `master_subscriber` AS m1 WHERE m1.email NOT IN (SELECT email FROM csv_subscriber)
');

        if ($res->num_rows() > 0) {
            $data = $res->result_array();
//              var_dump($data);die;
            return $data;
//            $rel_data = array();
//            foreach ($data as $key => $val) {
//                $msres = $this->db->get_where('csv_subscriber', array('email' => $val['email']));
//                if ($msres->num_rows() > 0) {
//                    $this->db->where(array('email' => $val['email']));
//                    $this->db->update('csv_subscriber', $val);
//                } else {
//                    $this->db->insert('csv_subscriber', $val);
//                }
//            }
//        $res1 = $this->db->get('csv_subscriber');
//        if ($res1->num_rows() > 0) {
//            return $res1->result_array();
//            var_dump($res1->result_array());die;
//        } else {
//            return NULL;
//        }
        } else {
            return NULL;
        }
    }

    public function update_csvSubscriber($data) {

        $this->db->insert_batch('csv_subscriber', $data);
    }

    public function insert_cvs($data) {
        $this->db->insert('csv_subscriber', $data);
    }

    public function get_mdbUnSubscriber() {
          $query = "SELECT `all_unsubscriber`.`id`, `all_unsubscriber`.`email`, `all_unsubscriber`.`firstname`, `all_unsubscriber`.`lastname`, `all_unsubscriber`.`unsubscribed_date` FROM (`store`) JOIN `all_unsubscriber` ON `all_unsubscriber`.`unsubscriber_from` REGEXP `store`.`id` WHERE `store`.`name` = 'MDB' ";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

    public function get_mdbFilterSubscriber() {

        $data = array();
        $query = "select * from master_subscriber where YEAR(CreatedDate) = (YEAR(CURDATE())-1)";
        $query1 = "select * from master_subscriber where MONTH(CreatedDate) = (MONTH(CURDATE())-1) ";
        $query2 = "select * from master_subscriber where MONTH(CreatedDate) = (MONTH(CURDATE())-2) ";
        $query3 = "select * from master_subscriber where CreatedDate >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY) ";
        $query4 = "select * from master_subscriber where `CreatedDate` between '" . date("Y-m-d", strtotime("-60 days")) . "' and '" . date("Y-m-d", strtotime("-30 days")) . "'";
        $query5 = "select * from master_subscriber where `CreatedDate` >= DATE_SUB( CURDATE( ) , INTERVAL 7 DAY) ";
        $query6 = "select * from master_subscriber where `CreatedDate` between DATE_SUB( CURDATE( ) , INTERVAL 14 DAY) and DATE_SUB( CURDATE( ) , INTERVAL 7 DAY) ";
        $query7 = "select * from master_subscriber where `CreatedDate` >= CURDATE( ) ";
        $query8 = "select * from master_subscriber where `CreatedDate` >= CURDATE( ) - 1 ";
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

    public function get_mdbFilterUnSubscriber() {

        $data = array();
        $query = "select * from all_unsubscriber where YEAR(unsubscribed_date) = (YEAR(CURDATE())-1) ";
        $query1 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-0 hour")) . "-01'";
        $query2 = "select * from all_unsubscriber where `unsubscribed_date` between '" . date("Y-m", strtotime("-4 hour")) . "-01' and '" . date("Y-m", strtotime("-2 hour")) . "-01'";
        $query3 = "select * from all_unsubscriber where unsubscribed_date >= DATE_SUB( CURDATE( ) , INTERVAL 30 DAY)";
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

//SELECT m1 . * ,
//if(
//(SELECT if( et1.`ID` IS NULL , 'n', 'y' ) AS id
//FROM et_subscriber_list_rel et1
//JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
//WHERE et1.`ListID` = '352396'
//AND et2.`ListID` = '351487'
//AND et1.`SubscriberID` = m1.`ET_UID`)
//IS NULL , 'n', 'y' ) AS BR,
//if(
//(SELECT if( et1.`ID` IS NULL , 'n', 'y' ) AS id
//FROM et_subscriber_list_rel et1
//JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
//WHERE et1.`ListID` = '352396'
//AND et2.`ListID` = '351484'
//AND et1.`SubscriberID` = m1.`ET_UID`)
//IS NULL , 'n', 'y' ) AS BO,
//
//if(
//(SELECT if( et1.`ID` IS NULL , 'n', 'y' ) AS id
//FROM et_subscriber_list_rel et1
//JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
//WHERE et1.`ListID` = '352396'
//AND et2.`ListID` = '351488'
//AND et1.`SubscriberID` = m1.`ET_UID`)
//IS NULL , 'n', 'y' ) AS BQ,
//
//if(
//(SELECT if( et1.`ID` IS NULL , 'n', 'y' ) AS id
//FROM et_subscriber_list_rel et1
//JOIN et_subscriber_list_rel et2 ON et1.`SubscriberID` = et2.`SubscriberID`
//WHERE et1.`ListID` = '352396'
//AND et2.`ListID` = '351486'
//AND et1.`SubscriberID` = m1.`ET_UID`)
//IS NULL , 'n', 'y' ) AS BP 
//FROM `master_subscriber` AS m1
#######################
