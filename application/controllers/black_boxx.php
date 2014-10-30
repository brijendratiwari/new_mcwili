<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Black_boxx extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('bb_model');
        $this->load->model('et_model');
    }
    
    public function test(){
        $this->et_model->checkstore(0000002);
    }

    public function get_user_list($data=FALSE,$page=1) {
        if($data==FALSE)
           $data=array(); 
//        $res = $this->getListByCurl("users/");
        
         $headers = array(
            'Authorization: Basic ' . BB_API_KEY
        );

        $params_str = array();
        $url = BB_URL ."/users" ;
        $url .= '?' . http_build_query(array('page'=>$page,'per_page'=>20));
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($handle);
        $bb_user_list = json_decode($response, TRUE);
//        var_dump($bb_user_list);die;
        foreach ($bb_user_list as $val){
            $data[]=$val;
        }
//        array_push($data,$bb_user_list);
          if (count($data) == 20 * $page) {
            return $this->get_user_list($data, $page + 1);
        } else {
            return $data;
        }
        
    }

    public function get_merchant_list() {
        $data = array();
        $res = $this->getListByCurl("merchants/");
        $data = json_decode($res, TRUE);
        $merchant_data = array();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $merchant_data[] = array(
                    "completename" => $value['complete_name'],
                    "created" => $value['created_at'],
                    "merchantid" => $value['id'],
                    "name" => $value['name'],
                    "isavailable" => $value['is_available'],
                    "ownerid" => $value['owner_id'],
                    "siteurl" => $value['site_url'],
                    "kind" => $value['kind'],
                );
            }

            $this->bb_model->insert_merchant($merchant_data);
        }
    }

    public function subsriber_mailchimp_lists() {
        $data = array();
        $res = $this->getListByCurl("mailchimp_lists/");
        $data = json_decode($res, TRUE);
        print_r($data);
    }

    public function add_user($data = FALSE) {
//        $data = array();
        $res = $this->getListByCurl("users",$data);
        return $res;
    }

    public function update_user($data, $user_id) {
//        $data = array();
        $res = $this->getListByCurl("users/" . $user_id, $data, "update");
        return $res;
    }

    // get all data by api using curl
    public function getListByCurl($str, $data = FALSE, $update = FALSE) {

        $headers = array(
            'Authorization: Basic ' . BB_API_KEY
        );

        $params_str = array();
        $url = BB_URL . $str;
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        if ($data) {
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        }
        if ($data && $update) {
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        }
        $response = curl_exec($handle);
        return $response;
    }
public function signin($data){
    $res = $this->getListByCurl("sessions/",$data);
        return $res;
}
}
