<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sync_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function stratautosync() {
        $this->db->truncate('autosyncdetail');
        $this->db->insert('autosyncdetail', array('sync_flag' => 1));
        return $this->db->insert_id();
    }

    public function stopautosync() {
        $this->db->truncate('autosyncdetail');
        $this->db->insert('autosyncdetail', array('sync_flag' => 0));
        return $this->db->insert_id();
    }

    public function checkautosync() {

        $res = $this->db->select('sync_flag')
                ->from('autosyncdetail')
                ->get();
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            return $data[0]['sync_flag'];
        } else {
            return 0;
        }
    }

    public function setTempSync($store_id) {
        $user = $this->session->userdata('logged_in');
        $res = $this->db->get_where('temp_sync_check', array('store_id' => $store_id));
        if ($res->num_rows() == 0) {
            $this->db->insert('temp_sync_check', array('store_id' => $store_id, 'status' => 1,'user_id'=>$user['id']));
            return $this->db->insert_id();
        } else {
            $this->db->update('temp_sync_check', array('status' => 1), array('store_id' => $store_id,'user_id'=>$user['id']));
            $data = $res->result_array();
            return $data[0]['id'];
        }
    }

    public function delTempSync($id) {
        $user = $this->session->userdata('logged_in');
        $this->db->delete('temp_sync_check', array('store_id' => $id,'user_id'=>$user['id']));
    }

    public function check($id) {
        $res = $this->db->get_where('temp_sync_check', array('id' => $id,'status' => 1));
        if ($res->num_rows > 0) {
            $data = $res->result_array();
            return $data[0]['status'];
        } else
            return 0;
    }

    public function insert_sync_updates($data) {
        $this->db->insert("sync_updates", $data);
    }

    public function getLastSystemSyncsub($name) {
        $query = "select max(sync_updates.id) as latest_sync from  (`store`) 
                        join `sync_updates` on `store`.`id` = `sync_updates`.`store_id` where `store`.`name` = '".$name."' ";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            $data = $res->result_array();
            $query1 = "select UnSubscribedCount,SubscribedCount,SyncTime from sync_updates where id = '" . $data[0]['latest_sync'] . "'";
            $res1 = $this->db->query($query1);
            return $res1->result_array();
        }
    }

    public function get_UnSubscriber() {
        $this->db->select('master_subscriber.id,master_subscriber.firstname,master_subscriber.lastname,master_subscriber.email,store.name as storename');
        $this->db->where('master_subscriber.status', 0);
        $this->db->from('master_subscriber');
        $this->db->join('all_unsubscriber', 'master_subscriber.email=all_unsubscriber.email');
        $this->db->join('store', 'all_unsubscriber.unsubscriber_from=store.id');
        $res = $this->db->get();
        $result = array();
        if ($res->num_rows() > 0) {
            $data['unsubscriber_detail'] = $res->result_array();
            foreach ($data['unsubscriber_detail'] as $unsubscribe_deatail) {
//                $this->db->where('id',$unsubscribe_deatail['unsubscriber_from']);
//                $res1=$this->db->get('store');
//                if($res1->num_rows() > 0){
//                   $data['store_name'] = $res1->result_array();    

                if (isset($result[$unsubscribe_deatail['email']]['storename'])) {
                    $result[$unsubscribe_deatail['email']]['storename'] = $result[$unsubscribe_deatail['email']]['storename'] . ',' . $unsubscribe_deatail['storename'];
//                    echo $result[$unsubscribe_deatail['email']]['storename'];
                } else {
                    $result[$unsubscribe_deatail['email']] = $unsubscribe_deatail;
                }

//                var_dump($result[$unsubs  cribe_deatail['email']]['storename']);
            }
            return $result;
        } else {
            return NULL;
        }
    }

    public function get_getAutoSyncUpdate() {
        $res = $this->db->get('autosyncdetail');
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function get_AllUnSubscriber() {
        $res = $this->db->get("all_unsubscriber");
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return NULL;
        }
    }

}
