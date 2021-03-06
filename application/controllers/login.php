<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        ob_start();
        
        $this->load->model('login_model');
        $this->load->model('bb_model');
        $this->load->model('bp_model');
        $this->load->model('mdb_model');
        require_once('black_boxx.php');
        require_once('exact_target.php');
    }

    public function cus_mail() {
        $to = 'andy@laststrategy.com';
        $from = 'test@laststrategy.com';
        $subject = 'the subject';
        $message = 'hello';
//        $headers = 'From: ankit@ignisitsolutions.com' . "\r\n" .
//                'Reply-To: webmaster@example.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();

        mymail($to, $subject, $message, FALSE, $from);
    }

    public function new_csv_upload() {       // New code for uploading the file.
        $csv_data = $this->mdb_model->get_csvSubscriber();

        $list = array();
        $i = 1;
        if (!empty($csv_data)) {
            $list[0] = array("AccountID", "AccNumber", "CardNumber", "AccountGroupID", "AccountGroupName", "Title", "FirstName", "LastName", "Status", "OtherName_1", "OtherName_2", "Street_1", "Street_2", "Street_3", "City", "State", "Country", "PCode", "PhoneHome", "PhoneWork", "Fax", "Mobile", "Email1st", "Email2nd", "PostalStreet_1", "PostalStreet_2", "PostalStreet_3", "PostalCity", "PostalState", "PostalCountry", "PostalPCode", "Comment", "DateJoined", "DateNextRenewal", "DateLastRenewal", "DateExpiry", "MembershipID", "RenewalID", "DateBirth", "Gender", "DoNotPost", "DoNotEmail", "DoNotSMS", "DoNotPhone", "ExportCode_1", "ExportCode_2", "CreditLimit", "DiscountLimit", "StopCredit", "CashOnly", "PointsEarnOK", "PointsRedeemOK", "PointsPercent", "UseCALinkPnts", "AccountType", "AllowedVenueID", "AllowedOperatorID", "PriceNumber", "PricingMode", "PricingSortType", "PricingPercent", "DiscNumber", "UseGroupSettings", "StatemtComment", "OrderNumReqd", "CustomFlag_1", "CustomFlag_2", "CustomFlag_3", "CustomFlag_4", "CustomFlag_5", "CustomFlag_6", "CustomFlag_7", "CustomFlag_8", "CustomFlag_9", "CustomFlag_10", "CustomNum_1", "CustomNum_2", "CustomNum_3", "CustomNum_4", "CustomNum_5", "CustomDate_1", "CustomDate_2", "CustomDate_3", "CustomDate_4", "CustomDate_5", "CustomText_1", "CustomText_2", "CustomText_3", "CustomText_4", "CustomText_5", "CustomText_6", "CustomText_7", "CustomText_8", "CustomText_9", "CustomText_10", "CustomText_11", "CustomText_12", "CustomText_13", "CustomText_14", "CustomText_15", "CustomText_16", "CustomText_17", "CustomText_18", "CustomText_19", "CustomText_20", "Account Balance", "GrossTurnover", "NettTurnover", "PointsEarned", "PointsRedeemed", "Joining Fees Paid", "Renewals Paid", "Count of Visits", "DateLastTrans");
            foreach ($csv_data as $record) {
                $list[$i] = array("", "", "", "", "", "", $record["firstname"], $record["lastname"], 1, "", "", "", "", "", "", "", "", "", "", "", "", "", $record["email"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $record["DOB"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $record['BN'], $record['BO'], $record['BP'], $record['BQ'], $record['BR'], "", "", "", "", "", "", "", "", "", "", $record["CreatedDate"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
                $i++;
            }


            $request = curl_init('http://mcwilliams.dev-iis.com/api.php');

// send a file
            curl_setopt($request, CURLOPT_POST, true);
            curl_setopt(
                    $request, CURLOPT_POSTFIELDS, array(
                'data' => json_encode($list),
                'action' => 'Export'
            ));

// output the response
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            echo curl_exec($request);

// close the session
            curl_close($request);
            $this->mdb_model->update_csvSubscriber($csv_data);
        }
    }

    public function new_csv_BepozUpload($data, $lists) {       // New code for uploading the file.
//        $csv_data = $this->mdb_model->get_csvSubscriber();
        $list = array();
        $i = 1;
        if (!empty($data)) {
            if (in_array("351486", $lists)) {
                $BP = "y";
            } else {
                $BP = 'n';
            }
            if (in_array("351488", $lists)) {
                $BQ = "y";
            } else {
                $BQ = 'n';
            }
            if (in_array("351487", $lists)) {
                $BR = "y";
            } else {
                $BR = 'n';
            }
            if (in_array("351484", $lists)) {
                $BO = "y";
            } else {
                $BO = 'n';
            }
            $list[0] = array("AccountID", "AccNumber", "CardNumber", "AccountGroupID", "AccountGroupName", "Title", "FirstName", "LastName", "Status", "OtherName_1", "OtherName_2", "Street_1", "Street_2", "Street_3", "City", "State", "Country", "PCode", "PhoneHome", "PhoneWork", "Fax", "Mobile", "Email1st", "Email2nd", "PostalStreet_1", "PostalStreet_2", "PostalStreet_3", "PostalCity", "PostalState", "PostalCountry", "PostalPCode", "Comment", "DateJoined", "DateNextRenewal", "DateLastRenewal", "DateExpiry", "MembershipID", "RenewalID", "DateBirth", "Gender", "DoNotPost", "DoNotEmail", "DoNotSMS", "DoNotPhone", "ExportCode_1", "ExportCode_2", "CreditLimit", "DiscountLimit", "StopCredit", "CashOnly", "PointsEarnOK", "PointsRedeemOK", "PointsPercent", "UseCALinkPnts", "AccountType", "AllowedVenueID", "AllowedOperatorID", "PriceNumber", "PricingMode", "PricingSortType", "PricingPercent", "DiscNumber", "UseGroupSettings", "StatemtComment", "OrderNumReqd", "CustomFlag_1", "CustomFlag_2", "CustomFlag_3", "CustomFlag_4", "CustomFlag_5", "CustomFlag_6", "CustomFlag_7", "CustomFlag_8", "CustomFlag_9", "CustomFlag_10", "CustomNum_1", "CustomNum_2", "CustomNum_3", "CustomNum_4", "CustomNum_5", "CustomDate_1", "CustomDate_2", "CustomDate_3", "CustomDate_4", "CustomDate_5", "CustomText_1", "CustomText_2", "CustomText_3", "CustomText_4", "CustomText_5", "CustomText_6", "CustomText_7", "CustomText_8", "CustomText_9", "CustomText_10", "CustomText_11", "CustomText_12", "CustomText_13", "CustomText_14", "CustomText_15", "CustomText_16", "CustomText_17", "CustomText_18", "CustomText_19", "CustomText_20", "Account Balance", "GrossTurnover", "NettTurnover", "PointsEarned", "PointsRedeemed", "Joining Fees Paid", "Renewals Paid", "Count of Visits", "DateLastTrans");
            $list[1] = array("", "", "", "", "", "", $data["firstname"], $data["lastname"], $data["Status"], "", "", "", "", "", "", "", "", "", "", "", "", "", $data["email"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $data["dob"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "n", $BO, $BP, $BQ, $BR, "", "", "", "", "", "", "", "", "", "", $data["created"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

//die;
            $request = curl_init('http://mcwilliams.dev-iis.com/api.php');

// send a file
            curl_setopt($request, CURLOPT_POST, true);
            curl_setopt(
                    $request, CURLOPT_POSTFIELDS, array(
                'data' => json_encode($list),
                'action' => 'Export'
            ));

// output the response
            curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
            echo curl_exec($request);

// close the session
            curl_close($request);

            $csv_data = array(
                'email' => $data["email"],
                'firstname' => $data["firstname"],
                'lastname' => $data["lastname"],
                'DOB' => $data["dob"],
                'status' => $data["Status"],
                'BP_UID' => $data['BP_UID'],
                'CreatedDate' => $data["created"],
                'BR' => $BR,
                'BO' => $BO,
                'BP' => $BP,
                'BQ' => $BQ,
                'BN' => 'n'
            );

            $this->mdb_model->insert_cvs($csv_data);
        }
    }

    public function test() {
        $black_boxx = new Black_boxx();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $signin = array('email' => 'mayank@ignisitsolution.com', 'password' => '12345', 'ip_address' => $ip);
        $res = $black_boxx->signin($signin);
        var_dump($res);
    }

    public function index() {


        $this->form_validation->set_rules('email_address', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check');
        if ($this->form_validation->run() == FALSE && $this->session->userdata('logged_in') == FALSE) {
            $this->load->view('/common/header.php');
            $this->load->view('/common/navbar.php');
            $this->load->view('/login.php');
            $this->load->view('/common/footer.php');
        } else {
//               var_dump($this->session->userdata('logged_in'));
//                $this->session->unset_userdata('logged_in');  
            redirect('home/index');
        }
    }

    public function check($password) {
        //Field validation succeeded.&nbsp; Validate against database
        $email = $this->input->post('email_address');

        //query the database
        $result = $this->login_model->check_login($email, $password);

        if (!empty($result)) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'email' => $row->email,
                );

                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check', 'Invalid username or password');
            return false;
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login/index');
    }

    public function sign_up() {
        $this->load->view('sign-up/bb_signup');
    }

//    public function bepoz_sign_up() {
//        $this->load->view('sign-up/bepoz_signup_new.php');
//    }

    public function bepoz_sign_up($formfor = FALSE) {
        $this->load->view('sign-up/bepoz_signup_new.php', array('form' => $formfor));
    }

    public function thank_you() {
        $this->load->view('sign-up/thankyou.php');
    }

    public function bepoz_thank() {
        $this->load->view('sign-up/thankyou_new.php');
    }

   public function createuser() {
        $black_boxx = new Black_boxx();
        $exact_target = new Exact_target();
        if (isset($_POST['pref'])) {
            array_push($_POST['pref'], '351485');
        } else {
            $_POST['pref'] = array('351485');
        }
        $res = $this->bb_model->get_where('bb_customer', array("email" => $_POST['email']));
        if ($res) {

            $this->session->set_flashdata('msg', "Email has already been taken");
            redirect('login/sign_up');
            //update subscriber if exist in BB..
//            $data = array("firstname" => $_POST['firstname'], "lastname" => $_POST['lastname'], "dob" => $_POST['birthDay'] . " . $_POST['birthMonth'] . " . $_POST['birthYear'], "mobile_number" => $_POST['mobile_number']);
//            $update_info = $this->bb_model->update_bb_customer($_POST['email'], $data);
//            //*********************************
//            if ($update_info) {
//                $signin = array('email' => $_POST['email'],);
//                $black_boxx->signin($signin);
////                redirect('login/thank_you');
//            }

            $data = array("firstname" => $_POST['firstname'], "lastname" => $_POST['lastname'], "dob" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] ."/" . $_POST['birthYear'], "mobile_number" => $_POST['mobile_number']);
            $update_info = $this->bb_model->update_bb_customer($_POST['email'], $data);
            //*********************************
            if ($update_info) {
                redirect('login/thank_you');
            }
        } else {
            // add customer in BB .....
            $data = array("first_name" => $_POST['firstname'], "last_name" => $_POST['lastname'], "date_of_birth" => $_POST['birthDay'] ."/". $_POST['birthMonth'] ."/". $_POST['birthYear'], "password" => $_POST['password'], "email" => $_POST['email'], "phone_number" => "", "mobile_number" => $_POST['mobile_number']);
            $response = $black_boxx->add_user($data);
            //********************** 
            $user_data = json_decode($response, TRUE);
//            var_dump($user_data);
            $bb_customer = array(
                "BB_UID" => $user_data["id"],
                "firstname" => $user_data["first_name"],
                "lastname" => $user_data["last_name"],
                "merchant_id" => $user_data["merchant_id"],
                "email" => $user_data["email"],
                "dob" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] ."/". $_POST['birthYear'],
                "mobile_number" => $_POST['mobile_number'],
                "created" => $user_data["updated_at"],
                "bb_id" => 2,
                "Status" => "Active"
            );
            
               $res1 = $this->et_model->get_et_subscriber($user_data["email"]);
                if ($res1) {
                    $data = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $res1[0]['SubscriberID']);
                    $response = $exact_target->add_email_list($_POST['pref'], $data);
                    if ($response[0]->StatusCode == "OK") {
                        $this->et_model->add_etsubscriber_rel($_POST['pref'], $res1[0]['SubscriberID']);
                    }
                } else {
                    $subkey = time();
                    $subs[] = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $subkey, "Attributes" => array(array("Name" => "First Name", "Value" => $_POST['firstname']), array("Name" => "Last Name", "Value" => $_POST['lastname'])));
                    $response = $exact_target->add_email_list($_POST['pref'], $subs);
//                    var_dump($response);die;
                    if ($response[0]->StatusCode == "OK") {
                        $data = array("FirstName" => $_POST['firstname'], "LastName" => $_POST['lastname'], "DOB" => $_POST['birthDay'] . "/". $_POST['birthMonth'] ."/". $_POST['birthYear'], "SubscriberID" => $subkey, "EmailAddress" => $_POST['email'], "Status" => "Active", "CreatedDate" => date("Y-m-d h:m:s", time()));
                        $this->et_model->add_etsubscriber($data);
                        $this->et_model->add_etsubscriber_rel($_POST['pref'], $subkey);
                    }
                    else{
                        $this->session->set_flashdata('msg', "Please enter a valid email address");
                        redirect('login/bepoz_sign_up');
                        die;
                    }
                }
            
            $res = $this->bb_model->insert_bb_customer($bb_customer);
            if ($res) {
//                $this->et_model->insert_mastersubscriber(array("email"=>$_POST["email"],"firstname"=>$_POST["firstname"],"lastname"=>$_POST["lastname"],"DOB" => $_POST['birthDay'] . " . $_POST['birthMonth'] . " . $_POST['birthYear'],"status"=>1,"CreatedDate" => $user_data["updated_at"]),$user_data["email"]);
                $this->bb_model->insert_bb_customer_rel($_POST['pref'], $user_data["email"], $user_data["id"]);
                // add subscriber in ET...... if exist then upadate status to "Active"
             
            }
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $signin = array('email' => $_POST['email'], 'password' => $_POST['password'], 'ip_address' => $ip);
//        $black_boxx->signin($signin);
        redirect('login/thank_you');
    }


 public function createbpoz() {
//        var_dump($_POST);
//        die;
        $exact_target = new Exact_target();

        if (isset($_POST['pref'])) {
            array_push($_POST['pref'], '352396');
        } else {
            $_POST['pref'] = array('352396');
        }

        $res = $this->bp_model->get_where('bp_customer', array("email" => $_POST['email']));
        if ($res) {

            $this->session->set_flashdata('msg', "Email has already been taken");
            redirect('login/bepoz_sign_up');
            //update subscriber if exist in BB..
//            $data = array("firstname" => $_POST['firstname'], "lastname" => $_POST['lastname'], "dob" => $_POST['birthDay'] . " . $_POST['birthMonth'] . " . $_POST['birthYear'], "mobile_number" => $_POST['mobile_number']);
//            $update_info = $this->bb_model->update_bb_customer($_POST['email'], $data);
//            //*********************************
//            if ($update_info) {
//                $signin = array('email' => $_POST['email'],);
//                $black_boxx->signin($signin);
////                redirect('login/thank_you');
//            }
//            $data = array("firstname" => $_POST['firstname'], "lastname" => $_POST['lastname'], "dob" => $_POST['birthDay'] . " . $_POST['birthMonth'] . " . $_POST['birthYear'], "mobile_number" => $_POST['mobile_number']);
//            $update_info = $this->bp_model->update_bp_customer($_POST['email'], $data);
//            //*********************************
//            if ($update_info) {
//                redirect('login/thank_you');
//            }
        } else {
            // add customer in BP .....
            $data = array("first_name" => $_POST['firstname'], "last_name" => $_POST['lastname'], "date_of_birth" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'], "email" => $_POST['email'], "phone_number" => "", "mobile_number" => $_POST['mobile_number']);
            $bp_uid = time();
//            $response = $black_boxx->add_user($data);
            //********************** 
//            $user_data = json_decode($response, TRUE);
//            var_dump($user_data);
            $bp_user_created = date('Y:m:d h:m:s', time());
            $bp_customer = array(
                "BP_UID" => $bp_uid,
                "firstname" => $_POST['firstname'],
                "lastname" => $_POST['lastname'],
                "email" => $_POST["email"],
                "dob" => $_POST['birthDay'] . "/". $_POST['birthMonth'] . "/" . $_POST['birthYear'],
                "mobile_number" => $_POST['mobile_number'],
                "created" => $bp_user_created,
                "Status" => "Active"
            );
            
            
             // add subscriber in ET...... if exist then upadate status to "Active"
                $res1 = $this->et_model->get_et_subscriber($_POST["email"]);
                if ($res1) {
                    $data = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $res1[0]['SubscriberID']);
                    $response = $exact_target->add_email_list($_POST['pref'], $data);
                    if ($response[0]->StatusCode == "OK") {
                        $this->et_model->add_etsubscriber_rel($_POST['pref'], $res1[0]['SubscriberID']);
                    }
                } else {
//                    $subkey = time();
                    $subs[] = array("EmailAddress" => $_POST['email'], "SubscriberKey" => $bp_uid, "Attributes" => array(array("Name" => "First Name", "Value" => $_POST['firstname']), array("Name" => "Last Name", "Value" => $_POST['lastname']), array("Name" => "Date of Birth", "Value" => $_POST['birthDay'] . "/". $_POST['birthMonth'] . "/" . $_POST['birthYear'])));
                    $response = $exact_target->add_email_list($_POST['pref'], $subs);
//                    var_dump($response);die;
                    if ($response[0]->StatusCode == "OK") {
                        $data = array("FirstName" => $_POST['firstname'], "LastName" => $_POST['lastname'], "DOB" => $_POST['birthDay'] . "/". $_POST['birthMonth'] . "/". $_POST['birthYear'], "SubscriberID" => $bp_uid, "EmailAddress" => $_POST['email'], "Status" => "1", "CreatedDate" => $bp_user_created);
                        $this->et_model->add_etsubscriber($data);
                        $this->et_model->add_etsubscriber_rel($_POST['pref'], $bp_uid);
                        $this->new_csv_BepozUpload($bp_customer, $_POST['pref']);
                    }
                    else{
                        $this->session->set_flashdata('msg', "Please enter a valid email address");
                        redirect('login/bepoz_sign_up');
                        die;
                    }
                }
            
            $res = $this->bp_model->insert_bp_customer($bp_customer);
            if ($res) {
//                $this->et_model->insert_mastersubscriber(array("email"=>$_POST["email"],"firstname"=>$_POST["firstname"],"lastname"=>$_POST["lastname"],"DOB" => $_POST['birthDay'] . " . $_POST['birthMonth'] . " . $_POST['birthYear'],"status"=>1,"CreatedDate" => $user_data["updated_at"]),$user_data["email"]);
                $this->bp_model->insert_bp_customer_rel($_POST['pref'], $_POST["email"], $bp_uid);
               
            }
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $signin = array('email' => $_POST['email'], 'password' => $_POST['password'], 'ip_address' => $ip);
//        $black_boxx->signin($signin);
        redirect('login/bepoz_thank');
    }

    private function createCSV() {
        $csv_data = $this->mdb_model->get_mdbSubscriber();

        $list = array();
        $i = 1;
        $list[0] = array("AccountID", "AccNumber", "CardNumber", "AccountGroupID", "AccountGroupName", "Title", "FirstName", "LastName", "Status", "OtherName_1", "OtherName_2", "Street_1", "Street_2", "Street_3", "City", "State", "Country", "PCode", "PhoneHome", "PhoneWork", "Fax", "Mobile", "Email1st", "Email2nd", "PostalStreet_1", "PostalStreet_2", "PostalStreet_3", "PostalCity", "PostalState", "PostalCountry", "PostalPCode", "Comment", "DateJoined", "DateNextRenewal", "DateLastRenewal", "DateExpiry", "MembershipID", "RenewalID", "DateBirth", "Gender", "DoNotPost", "DoNotEmail", "DoNotSMS", "DoNotPhone", "ExportCode_1", "ExportCode_2", "CreditLimit", "DiscountLimit", "StopCredit", "CashOnly", "PointsEarnOK", "PointsRedeemOK", "PointsPercent", "UseCALinkPnts", "AccountType", "AllowedVenueID", "AllowedOperatorID", "PriceNumber", "PricingMode", "PricingSortType", "PricingPercent", "DiscNumber", "UseGroupSettings", "StatemtComment", "OrderNumReqd", "CustomFlag_1", "CustomFlag_2", "CustomFlag_3", "CustomFlag_4", "CustomFlag_5", "CustomFlag_6", "CustomFlag_7", "CustomFlag_8", "CustomFlag_9", "CustomFlag_10", "CustomNum_1", "CustomNum_2", "CustomNum_3", "CustomNum_4", "CustomNum_5", "CustomDate_1", "CustomDate_2", "CustomDate_3", "CustomDate_4", "CustomDate_5", "CustomText_1", "CustomText_2", "CustomText_3", "CustomText_4", "CustomText_5", "CustomText_6", "CustomText_7", "CustomText_8", "CustomText_9", "CustomText_10", "CustomText_11", "CustomText_12", "CustomText_13", "CustomText_14", "CustomText_15", "CustomText_16", "CustomText_17", "CustomText_18", "CustomText_19", "CustomText_20", "Account Balance", "GrossTurnover", "NettTurnover", "PointsEarned", "PointsRedeemed", "Joining Fees Paid", "Renewals Paid", "Count of Visits", "DateLastTrans");
        foreach ($csv_data as $record) {
            $list[$i] = array("", "", "", "", "", "", $record["firstname"], $record["lastname"], $record["status"], "", "", "", "", "", "", "", "", "", "", "", "", "", $record["email"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $record["DOB"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $record["CreatedDate"], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
            $i++;
        }

        $new_rec = "";
        //print_r($list); die();


        $file = fopen("assets/generated/contacts.csv", "w") or die("could not open/create file");

        foreach ($list as $line) {
            fputcsv($file, $line);
        }

        fclose($file);


        // connect and login to FTP server
        $ftp_server = "intellexio.com";
        $ftp_username = "ci-dev@intellexio.com";
        $ftp_password = "q0w9e8";

        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        echo "CONNECTED TO FTP SERVER ....... <br><br>";
        $login = ftp_login($ftp_conn, "ci-dev@intellexio.com", "q0w9e8");
        echo "Authorized TO FTP SERVER ....... <br><br>";

        // open file for reading
        $file = "assets/generated/contacts.csv";
        $fp = fopen($file, "r") or die("Could not open '" . $file . "'");
        echo "File Accessed ....... <br><br>";

        // upload file
        if (!ftp_nb_fput($ftp_conn, "contacts.csv", $fp, FTP_ASCII) or die("Could not upload file")) {
            die("Error uploading $file.");
        }

        // close this connection and file handler
        ftp_close($ftp_conn);
        fclose($fp);
    }

    public function getImportCsv() {

        $fieldseparator = ",";
        $lineseparator = "\n";

        $request = curl_init('http://mcwilliams.dev-iis.com/api.php');

// send a file
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt(
                $request, CURLOPT_POSTFIELDS, array(
            'action' => 'Import'
        ));

// output the response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);

// close the session
        curl_close($request);

        $data = json_decode($response);

//        var_dump($data);die;

        $csvcontent = $data->csv;


        $lines = 0;
        $queries = "";
        $linearray = array();

        foreach (explode($lineseparator, $csvcontent) as $line) {
            $lines++;
            $line = trim($line, " \t");
            $line = str_replace("\r", "", $line);

            /*             * **********************************
              /* This line escapes the special character.
              /* Remove it if entries are already escaped in the csv file
              /*********************************** */
            $line = str_replace("'", "\'", $line);
            /*             * ********************************** */

            $linearray = explode($fieldseparator, $line);
//            var_dump($linearray);
            if(isset($linearray[67])){
            if($lines)
            {
            $exact_target = new Exact_target();

//            if (isset($_POST['pref'])) {
//                array_push($_POST['pref'], '352396');
//            } else {
//                $_POST['pref'] = array('352396');
//            }
            
            $pref = array('352396');
            
            if ($linearray[67] != 'n' || $linearray[67] != 'N') {
                $pref[] = '351486';
            } 
            if ($linearray[68] != 'n' || $linearray[68] != 'N') {
                $pref[] = "351488";
            } 
            if ($linearray[69] != 'n' || $linearray[69] != 'N') {
                $pref[] = "351487";
            }
            if ($linearray[66] != 'n' || $linearray[66] != 'N') {
                $pref[] = "351484";
            }
            
            $res = $this->bp_model->get_where('bp_customer', array("email" => $linearray[22]));
            if ($res) {

            } else {
                // add customer in BP .....
                $data = array("first_name" => $linearray[6], "last_name" => $linearray[7], "date_of_birth" => '', "email" => $linearray[22], "phone_number" => "", "mobile_number" => $linearray[21]);
                $bp_uid = time();
//            $response = $black_boxx->add_user($data);
                //********************** 
//            $user_data = json_decode($response, TRUE);
//            var_dump($user_data);
                $bp_user_created = date('Y:m:d h:m:s', time());
                $bp_customer = array(
                    "BP_UID" => $bp_uid,
                    "firstname" => $linearray[6],
                    "lastname" => $linearray[7],
                    "email" => $linearray[22],
                    "dob" => '',
                    "mobile_number" => $linearray[21],
                    "created" => $bp_user_created,
                    "Status" => "Active"
                );
                $res = $this->bp_model->insert_bp_customer($bp_customer);
                if ($res) {
//                $this->et_model->insert_mastersubscriber(array("email"=>$_POST["email"],"firstname"=>$_POST["firstname"],"lastname"=>$_POST["lastname"],"DOB" => $_POST['birthDay'] . "/" . $_POST['birthMonth'] . "/" . $_POST['birthYear'],"status"=>1,"CreatedDate" => $user_data["updated_at"]),$user_data["email"]);
                    $this->bp_model->insert_bp_customer_rel($pref, $linearray[22], $bp_uid);
                    // add subscriber in ET...... if exist then upadate status to "Active"
                    $res1 = $this->et_model->get_et_subscriber($linearray[22]);
                    if ($res1) {
                        $data = array("EmailAddress" => $linearray[22], "SubscriberKey" => $res1[0]['SubscriberID']);
                        $response = $exact_target->add_email_list($pref, $data);
                        if ($response[0]->StatusCode == "OK") {
                            $this->et_model->add_etsubscriber_rel($pref, $res1[0]['SubscriberID']);
                        }
                    } else {
//                    $subkey = time();
                        $subs[] = array("EmailAddress" => $linearray[22], "SubscriberKey" => $bp_uid, "Attributes" => array(array("Name" => "First Name", "Value" => $linearray[6]), array("Name" => "Last Name", "Value" => $linearray[7]), array("Name" => "Date of Birth", "Value" => '')));
                        $response = $exact_target->add_email_list($pref, $subs);
//                    var_dump($response);die;
                        if ($response[0]->StatusCode == "OK") {
                            $data = array("FirstName" => $linearray[6], "LastName" => $linearray[7], "DOB" => '', "SubscriberID" => $bp_uid, "EmailAddress" => $linearray[22], "Status" => "1", "CreatedDate" => $linearray[80]);
                            $this->et_model->add_etsubscriber($data);
                            $this->et_model->add_etsubscriber_rel($pref, $bp_uid);
//                            $this->new_csv_BepozUpload($bp_customer, $pref);
                        }
                    }
                }
            }
        }
        }
        
                        }
    }

}
