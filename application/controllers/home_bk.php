<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('et_model');
        $this->load->model('sync_model');
        $this->load->model('mdb_model');
        $this->load->model('bb_model');
    }

    public function index() {

        if ($this->session->userdata('logged_in')) {
            redirect('home/master');
//            $this->load->view('/common/header.php');
//            $this->load->view('/common/navbar.php');
//            $this->load->view('/common/sub_navbar.php');
//            $this->load->view('/master.php');
//            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function sync() {
        if ($this->session->userdata('logged_in')) {
            $data['autosync'] = $this->sync_model->checkautosync();
            $data['getLastSystemSyncsub'] = $this->sync_model->getLastSystemSyncsub('ET');
            $data['bbSyncsub'] = $this->sync_model->getLastSystemSyncsub('BB');
            $data['UnSubscriber'] = $this->sync_model->get_UnSubscriber();
            $data['AllUnSubscriber'] = $this->sync_model->get_AllUnSubscriber();
            $data['getAutoSyncUpdate'] = $this->sync_model->get_getAutoSyncUpdate();
//            var_dump($data['getAutoSyncUpdate']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/sync.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function exact_target() {

        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->et_model->get_etSubscriber();
            $data['UnSubscriber'] = $this->et_model->get_UnSubscriber();
            $data['FilterSubscriber'] = $this->et_model->get_etFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/exact_target.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function black_boxx() {

        if ($this->session->userdata('logged_in')) {
            $data['list'] = $this->et_model->getList();
            $data['Subscriberdetail'] = $this->bb_model->get_bbSubscriberDetail();
            $data['Subscriber'] = $this->bb_model->get_bbSubscriber();
            $data['mcSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351487);
            $data['brandsSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351484);
            $data['celldoorSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351485);
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterSubscriber'] = $this->bb_model->get_bbFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/blackboxx.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function master() {
        if ($this->session->userdata('logged_in')) {

            $data['list'] = $this->et_model->getList();
            $data['Subscriber'] = $this->mdb_model->get_mdbSubscriber();
            $data['UnSubscriber'] = $this->mdb_model->get_mdbUnSubscriber();
            $data['FilterSubscriber'] = $this->mdb_model->get_mdbFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->mdb_model->getLastSystemSync();
//            var_dump($data['UnSubscriber']);
//            var_dump($data['UnSubscriber']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/master.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

    public function bepoz() {
        if ($this->session->userdata('logged_in')) {
            $data['list'] = $this->et_model->getList();
            $data['Subscriberdetail'] = $this->bb_model->get_bbSubscriberDetail();
            $data['Subscriber'] = $this->bb_model->get_bpSubscriber();
            $data['mcSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351487); //McWilliams Wine
            $data['brandsSubscriber'] = $this->bb_model->get_bbListFilterSubscriber(351484); //Brands Laira
            $data['mount'] = $this->bb_model->get_bbListFilterSubscriber(351488); //Mount Pleasant
            $data['Evans'] = $this->bb_model->get_bbListFilterSubscriber(351486); //Evans & Tate
//            var_dump($data['Subscriberdetail']);die;
            $data['UnSubscriber'] = $this->bb_model->get_bbUnSubscriber();
            $data['FilterSubscriber'] = $this->bb_model->get_bbFilterSubscriber();
            $data['FilterUnSubscriber'] = $this->et_model->get_etFilterUnSubscriber();
            $data['checkSystemSync'] = $this->et_model->checkSystemSync();
            $data['getLastSystemSyncsub'] = $this->et_model->getLastSystemSyncsub();
//            var_dump($data['getLastSystemSyncsub']);die;
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/common/sub_navbar.php');
            $this->load->view('/bepoz.php', $data);
            $this->load->view('/common/footer.php');
        } else {
            redirect('login/index');
        }
    }

}
