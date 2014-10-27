<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    function check_login($email, $password){
        
        $this->db->where('email',$email);
        $this->db->where('password',  md5($password));
        $res = $this->db->get('admin');
        return $res->result() ;
    }
}