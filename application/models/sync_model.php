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
            $this->db->insert('temp_sync_check', array('store_id' => $store_id, 'status' => 1, 'user_id' => $user['id']));
            return $this->db->insert_id();
        } else {
            $this->db->update('temp_sync_check', array('status' => 1), array('store_id' => $store_id, 'user_id' => $user['id']));
            $data = $res->result_array();
            return $data[0]['id'];
        }
    }

    public function delTempSync($id) {
        $user = $this->session->userdata('logged_in');
        $this->db->delete('temp_sync_check', array('store_id' => $id, 'user_id' => $user['id']));
    }

    public function check($id) {
        $res = $this->db->get_where('temp_sync_check', array('id' => $id, 'status' => 1));
        if ($res->num_rows > 0) {
            $data = $res->result_array();
            return $data[0]['status'];
        }
        else
            return 0;
    }

    public function insert_sync_updates($data) {
        $this->db->insert("sync_updates", $data);
    }

    public function getLastSystemSyncsub() {
        $this->db->select('max(id) as id');
        $res = $this->db->get('sync_updates');
        if ($res->num_rows() > 0) {
            $id = $res->result_array();
            $this->db->select('store_id,SubscribedCount,UnSubscribedCount,SyncTime');
            $this->db->where('id', $id[0]['id']);
            $res1 = $this->db->get('sync_updates');
            if ($res1->num_rows() > 0) {
                return $res1->result_array();
            } else {
                return NULL;
            }
        }
    }

    public function getallListSubsciberCount($store_id) {
//        $query = "select max(sync_updates.SyncTime) as latest_sync from  (`store`) 
//                        join `sync_updates` on `store`.`id` = `sync_updates`.`store_id` where `store`.`name` = '" . $name . "' ";
        $this->db->select('max(id) as latest_id');
        $this->db->where('store_id', $store_id);
        $res = $this->db->get('sync_updates');
        if ($res->num_rows() > 0) {
            $id = $res->result_array();
            $this->db->select('UnSubscribedCount,SubscribedCount,SyncTime');
            $this->db->where('id', $id[0]['latest_id']);
            $res1 = $this->db->get('sync_updates');
            if ($res1->num_rows() > 0) {
//                var_dump($res1->result_array());die;
                return $res1->result_array();
            } else {
                return NULL;
            }
        } else {
            return NULL;
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

    public function get_bb_customer() {
        $this->db->select('email');
        $res = $this->db->get('bb_customer');
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                foreach ($value as $email) {
                    $data['email'][] = $email;
                }
            }
            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_etSubscriber() {
        $this->db->select('EmailAddress');
        $res = $this->db->get('et_subscriber');
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                foreach ($value as $email) {
                    $data['email'][] = $email;
                }
            }
            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_mdbSubscriber() {
        $this->db->select('email');
        $this->db->where('status', 1);
        $res = $this->db->get('master_subscriber');
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                $data[] = $value['email'];
            }
//            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_bpSubscriber() {
        $this->db->select('et_subscriber.EmailAddress');
        $this->db->group_by('`et_subscriber_list_rel`.`SubscriberID`');
        $this->db->where_in('ListID', array('352396'));
        $this->db->from('et_subscriber_list_rel');
        $this->db->join('et_subscriber', 'et_subscriber.SubscriberID=et_subscriber_list_rel.SubscriberID');
        $res = $this->db->get();
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                foreach ($value as $email) {
                    $data[] = $email;
                }
            }
//            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_master_subscriber() {
        $res = $this->db->get_where('master_subscriber', array('status' => 1));
        return $res->num_rows();
    }

    public function get_master_unsubscriber() {
        $res = $this->db->get_where('master_subscriber', array('status' => 0));
        return $res->num_rows();
    }

    // get specific list data for BB
    public function getBb_SpecificListData($list_id) {
        $query = "select master_subscriber.email from et_subscriber_list_rel 
            JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
            JOIN bb_customer ON bb_customer.BB_UID = master_subscriber.BB_UID   
            where et_subscriber_list_rel.`ListID` = '" . $list_id . "' and master_subscriber.status = 1 ";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                $data[] = $value['email'];
            }
//            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    // get specific list data for ET
    public function getEt_SpecificListData($list_id) {
        $query = "select master_subscriber.email from et_subscriber_list_rel 
            JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
           JOIN et_subscriber ON et_subscriber.SubscriberID = master_subscriber.ET_UID   
            where et_subscriber_list_rel.`ListID` = '" . $list_id . "' and master_subscriber.status = 1 ";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                $data[] = $value['email'];
            }
//            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function getEt_SpecificListDataKey($list_id, $key) {


        $query = "select master_subscriber.email from et_subscriber_list_rel 
            JOIN master_subscriber ON master_subscriber.ET_UID = et_subscriber_list_rel.SubscriberID   
            where et_subscriber_list_rel.`ListID` = '" . $list_id . "' and master_subscriber.status = 1 and et_subscriber_list_rel.SubscriberID in (" . $key . ")";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            foreach ($res->result_array() as $key => $value) {
                $data[] = $value['email'];
            }
//            $data['email'] = implode(",", $data['email']);
            return $data;
        } else {
            return NULL;
        }
    }

    public function getLastSubscriber() {

        $this->db->select('max(id) as id');
        $res = $this->db->get('sync_updates');
        if ($res->num_rows() > 0) {
            $id = $res->result_array();
            $this->db->select('store_id,SubscribedCount');
            $this->db->where('id', $id[0]['id']);
            $res1 = $this->db->get('sync_updates');
            if ($res1->num_rows() > 0) {
                $store_id = $res1->result_array();
                $this->db->select('name');
                $this->db->where('id', $store_id[0]['store_id']);
                $res2 = $this->db->get('store');
                if ($res2->num_rows() > 0) {
                    $sync_table = $res2->result_array();
                    if ($sync_table[0]['name'] == "MDB") {
                        $this->db->order_by('CreatedDate', 'DESC');

                        if ($store_id[0]['SubscribedCount'] >= 3) {
                            $this->db->limit('3');
                        } else {
                            $this->db->limit($store_id[0]['SubscribedCount']);
                        }
                        $this->db->select('firstname,lastname,email,CreatedDate');
                        $res3 = $this->db->get('master_subscriber');
                    }
                    if ($sync_table[0]['name'] == "ET") {
                        $this->db->order_by('CreatedDate', 'DESC');
                        if ($store_id[0]['SubscribedCount'] >= 3) {
                            $this->db->limit('3');
                        } else {
                            $this->db->limit($store_id[0]['SubscribedCount']);
                        }
                        $this->db->select('FirstName as firstname,LastName as lastname, EmailAddress as email,CreatedDate');
                        $res3 = $this->db->get('et_subscriber');
                    }
                    if ($sync_table[0]['name'] == "BB") {
                        $this->db->order_by('CreatedDate', 'DESC');
                        if ($store_id[0]['SubscribedCount'] >= 3) {
                            $this->db->limit('3');
                        } else {
                            $this->db->limit($store_id[0]['SubscribedCount']);
                        }
                        $this->db->select('firstname,lastname,email,created as CreatedDate');
                        $res3 = $this->db->get('bb_customer');
                    }
                    if ($sync_table[0]['name'] == "BP") {
                        $this->db->order_by('id', 'DESC');
                        if ($store_id[0]['SubscribedCount'] >= 3) {
                            $this->db->limit('3');
                        } else {
                            $this->db->limit($store_id[0]['SubscribedCount']);
                        }
                        $this->db->select('firstname,lastname,email,created as CreatedDate');
                        $res3 = $this->db->get('bp_customer');
                    }
                    if ($res3->num_rows() > 0) {
                        return $res3->result_array();
                    } else {
                        return NULL;
                    }
                }
            } else {
                return NULL;
            }
        }
    }

    public function getLastUnSubscriber() {
        $this->db->select('max(id) as id');
        $res = $this->db->get('sync_updates');
        if ($res->num_rows() > 0) {
            $id = $res->result_array();
            $this->db->select('store_id,UnSubscribedCount');
            $this->db->where('id', $id[0]['id']);
            $res1 = $this->db->get('sync_updates');
            if ($res1->num_rows() > 0) {
                $store_id = $res1->result_array();
                $this->db->select('name');
                $this->db->where('id', $store_id[0]['store_id']);
                $res2 = $this->db->get('store');
                if ($res2->num_rows() > 0) {
                    $sync_table = $res2->result_array();
//                        $this->db->order_by('id', 'DESC');
                    $query = "select firstname,lastname,email,unsubscribed_date from all_unsubscriber where unsubscriber_from REGEXP '" . $store_id[0]['store_id'] . "' order by unsubscribed_date DESC ";
                    if ($store_id[0]['UnSubscribedCount'] >= 3) {
//                            $this->db->limit('3');
                        $query .= "Limit 3";
                    } else {
                        $query .= "Limit " . $store_id[0]['UnSubscribedCount'] . "";
                    }
                    $res3 = $this->db->query($query);
                    return $res3->result_array();
                }
            } else {
                return NULL;
            }
        }
    }

    public function getLastLatsetUnSubscriber() {
        $this->db->select('max(id) as id');
        $res = $this->db->get('sync_updates');
        if ($res->num_rows() > 0) {
            $id = $res->result_array();
            $this->db->select('store_id,UnSubscribedCount');
            $this->db->where('id', $id[0]['id']);
            $res1 = $this->db->get('sync_updates');
            if ($res1->num_rows() > 0) {
                $store_id = $res1->result_array();
                if ($store_id[0]['store_id'] == 3) {
                    $this->db->where('BP', 1);
                }
                if ($store_id[0]['store_id'] == 2) {
                    $this->db->where('BB', 1);
                }
                if ($store_id[0]['store_id'] == 1) {
                    $this->db->where('ET', 1);
                }
                if ($store_id[0]['store_id'] == 5) {
                    $this->db->where('MDB', 1);
                }
                $this->db->select('master_subscriber.firstname,master_subscriber.lastname,master_subscriber.email,unsub_record.CreatedDate');
                $this->db->from('unsub_record');
//                $this->db->distinct();
                $this->db->order_by('unsub_record.created','desc');
                if ($store_id[0]['UnSubscribedCount'] >= 3) {
                $this->db->limit(3);
                }else{
                    $this->db->limit($store_id[0]['UnSubscribedCount']);
                }
                $this->db->join('master_subscriber', 'master_subscriber.ET_UID = unsub_record.SubscriberKey or master_subscriber.BP_UID = unsub_record.SubscriberKey');
                $res = $this->db->get();
                if ($res->num_rows() > 0) {
                    return $res->result_array();
                } else {
                    return NULL;
                }
            } else {
                return NULL;
            }
        }
    }

}
