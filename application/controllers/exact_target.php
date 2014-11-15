<?php
require 'application/libraries/ET_Client.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exact_target extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function getList($arr = FALSE) {

        $myclient = new ET_Client(false);
        $list = new ET_List();
        $list->authStub = $myclient;
        $response = $list->get();

        $arr = array();
        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $value) {

                $key = count($arr);

                $arr[$key]['ListID'] = $value->ID;
                $arr[$key]['CustomerKey'] = $value->CustomerKey;
                $arr[$key]['ListName'] = $value->ListName;
                $arr[$key]['Category'] = $value->Category;
                $arr[$key]['Type'] = $value->Type;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
                $arr[$key]['ModifiedDate'] = $value->ModifiedDate;
                $arr[$key]['ListClassification'] = $value->ListClassification;
                $arr[$key]['Description'] = $value->Description;
                $arr[$key]['CleintID'] = $value->Client->ID;
            }
        }

        return $arr;
    }

    public function getSubscribersbylist($arr = FALSE, $time = 1, $next = FALSE) {
        // Retrieve all Subscribers on the List
        set_time_limit(0);
        $myclient = new ET_Client(false);
        $getList = new ET_List_Subscriber();
        $getList->authStub = $myclient;

        if ($next != FALSE)
            $getList->filter = array('Property' => 'ObjectID', 'SimpleOperator' => 'greaterThan', 'Value' => $next);

        if ($arr == FALSE) {
            $arr = array();
            $arr1 = array();
        } else {
            $arr1 = $arr;
        }
        $response = $getList->get();

        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $value) {

                $arr1[count($arr1)]['ObjectID'] = $value->ObjectID;
                $arr[$value->ObjectID]['ObjectID'] = $value->ObjectID;
                $arr[$value->ObjectID]['main_id'] = $value->ID;
                $arr[$value->ObjectID]['ListID'] = $value->ListID;
                $arr[$value->ObjectID]['SubscriberID'] = $value->SubscriberKey;
                $arr[$value->ObjectID]['Status'] = $value->Status;
                $arr[$value->ObjectID]['CreatedDate'] = $value->CreatedDate;
            }
        }

        if (count($arr1) == 2500 * $time) {
            return $this->getSubscribersbylist($arr, $time + 1, $arr1[count($arr1) - 1]['ObjectID']);
        } else {
            return $arr;
        }
    }

    public function get_unSubscribe_list($list_id = FALSE) {

        $myclient = new ET_Client(false);
        $retSub = new ET_Subscriber();
        $arr = array();
        $retSub->authStub = $myclient;
        $retSub->filter = array('Property' => 'Status', 'SimpleOperator' => 'equals', 'Value' => 'Unsubscribed');
        if($list_id)
            $retSub->filter = array('Property' => 'ListID', 'SimpleOperator' => 'equals', 'Value' => $list_id);
        
        $getResult = $retSub->get();
//        echo '<pre>';
//        print_r($getResult);
//        echo '</pre>';
//        die;
        return $getResult->results;
    }

    public function get_Subscriber_detail($arr = FALSE, $time = 1, $next = FALSE) {
        set_time_limit(0);
        $myclient = new ET_Client(false);


        $retSub = new ET_Subscriber();
        $retSub->authStub = $myclient;
        $retSub->filter = array('Property' => 'Status', 'SimpleOperator' => 'equals', 'Value' => 'Active');

        if ($next != FALSE)
            $retSub->filter = array('Property' => 'ID', 'SimpleOperator' => 'greaterThan', 'Value' => $next);

        if ($arr == FALSE)
            $arr = array();

        $response = $retSub->get();



        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $value) {
                $key = count($arr);
                $arr[$key]['main_id'] = $value->ID;
                $arr[$key]['EmailAddress'] = $value->EmailAddress;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
                $arr[$key]['SubscriberID'] = $value->SubscriberKey;
                $arr[$key]['Status'] = $value->Status;

                if (is_array($value->Attributes)) {
                    foreach ($value->Attributes as $val) {

                        if ($val->Name == 'Date of Birth') {
                            $arr[$key]['DOB'] = $val->Value;
                        }
                        if ($val->Name == 'First Name') {
                            $arr[$key]['FirstName'] = $val->Value;
                        }
                        if ($val->Name == 'Last Name') {
                            $arr[$key]['LastName'] = $val->Value;
                        }
                        if ($val->Name == 'Full Name') {
                            $arr[$key]['FullName'] = $val->Value;
                        }
                    }
                }
            }
        }


        if (count($arr) == 2500 * $time) {
            return $this->get_Subscriber_detail($arr, $time + 1, $arr[count($arr) - 1]['main_id']);
        } else {
            return $arr;
        }
    }

    public function updateemail() {

        $myclient = new ET_Client(false);
        $patchEmail = new ET_Email();
        $patchEmail->authStub = $myclient;
        $patchEmail->props = array("CustomerKey" => $NameOfTestEmail, "Name" => $NameOfTestEmail, "Subject" => "Created with the SDK!!! Now with more !!!!", "HTMLBody" => "<b>Some HTML Content Goes here. NOW WITH NEW CONTENT</b>");
        $patchResult = $patchEmail->patch();
        print_r('Patch Status: ' . ($patchResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $patchResult->code . "\n";
        print 'Message: ' . $patchResult->message . "\n";
        print 'Results Length: ' . count($patchResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($patchResult->results);
        print "\n---------------\n";
// Retrieve Updated Email
        print "Retrieve Updated Email \n";
        $getEmail = new ET_Email();
        $getEmail->authStub = $myclient;
        $getEmail->filter = array('Property' => 'CustomerKey', 'SimpleOperator' => 'equals', 'Value' => $NameOfTestEmail);
        $getEmail->props = array("ID", "PartnerKey", "CreatedDate", "ModifiedDate", "Client.ID", "Name", "Folder", "CategoryID", "HTMLBody", "TextBody", "Subject", "IsActive", "IsHTMLPaste", "ClonedFromID", "Status", "EmailType", "CharacterSet", "HasDynamicSubjectLine", "ContentCheckStatus", "Client.PartnerClientKey", "ContentAreas", "CustomerKey");
        $getResponse = $getEmail->get();
        print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $getResponse->code . "\n";
        print 'Message: ' . $getResponse->message . "\n";
        print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
        print 'Results Length: ' . count($getResponse->results) . "\n";
        print 'Results: ' . "\n";
        print_r($getResponse->results);
        print "\n---------------\n";
    }

    public function create_list($listname, $desc = 'This list was created with the PHPSDK', $type = 'Private') {
        $myclient = new ET_Client(false);
        $postContent = new ET_List();
        $postContent->authStub = $myclient;
        $postContent->props = array("ListName" => $listname, "Description" => $desc, "Type" => $type);
        $postResponse = $postContent->post();
        if ($postResponse->status) {
            echo $postResponse->results[0]->NewID;
        } else {
            echo 'failed to create list';
        }
    }

    public function delete_list($list_id) {
        // Delete List

        $deleteList = new ET_List();
        $deleteList->authStub = $myclient;
        $deleteList->props = array("ID" => $list_id);
        $deleteResponse = $deleteList->delete();

        print_r($deleteResponse->results);
    }

    public function add_email_list($list_id = FALSE, $data = FALSE) {
        try {
            $myclient = new ET_Client(false);
            $newListID = $list_id;
            // Adding Multiple Subscribers To a List in Bulk
            $response = $myclient->AddSubscribersToLists($data, $list_id);
            
            return $response->results;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function add() {
        $myclient = new ET_Client(false);
// NOTE: These examples only work in accounts where the SubscriberKey functionality is not enabled
// SubscriberKey will need to be included in the props if that feature is enabled
        $SubscriberTestEmail = "test@mail.com";
// Create Subscriber
        print "Create Subscriber \n";
        $subCreate = new ET_Subscriber();
        $subCreate->authStub = $myclient;
        $subCreate->props = array("EmailAddress" => $SubscriberTestEmail);
        $postResult = $subCreate->post();
        print_r('Post Status: ' . ($postResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $postResult->code . "\n";
        print 'Message: ' . $postResult->message . "\n";
        print 'Results Length: ' . count($postResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($postResult->results);
        print "\n---------------\n";
    }

    public function et_mdb_update() {
        $this->et_model->update_mdb();
    }

    public function unsubscribe_email($email, $subkey) {

        $myclient = new ET_Client(false);
        $subPatch = new ET_Subscriber();
        $subPatch->authStub = $myclient;
        $subPatch->props = array("EmailAddress" => $email, "SubscriberKey" => $subkey, "Status" => "Unsubscribed");
        $patchResult = $subPatch->patch();
    }

    public function get_bounce() {
        $myclient = new ET_Client(false);
// Modify the date below to reduce the number of results returned from the request
// Setting this too far in the past could result in a very large response size
        $retrieveDate = "2011-01-15T13:00:00.000";
// Retrieve Filtered BounceEvent with GetMoreResults

        $getBounceEvent = new ET_BounceEvent();
        $getBounceEvent->authStub = $myclient;
        $getBounceEvent->props = array("SendID", "SubscriberKey", "EventDate", "Client.ID", "EventType", "BatchID", "TriggeredSendDefinitionObjectID", "PartnerKey");
        $getBounceEvent->filter = array('Property' => 'EventDate', 'SimpleOperator' => 'greaterThan', 'DateValue' => $retrieveDate);
        $getBounceEvent->getSinceLastBatch = false;
        $getResponse = $getBounceEvent->get();
        echo '<pre>';
        print_r($getResponse->results);
        echo '</pre>';

        print "\n---------------\n";
        while ($getResponse->moreResults) {
            print "Continue Retrieve All BounceEvent with GetMoreResults \n";
            $getResponse = $getBounceEvent->GetMoreResults();
            echo '<pre>';
            print 'Results Length: ' . count($getResponse->results) . "\n";
            echo '</pre>';
        }
    }

    public function get_click() {

        try {
            $myclient = new ET_Client(false);
// Modify the date below to reduce the number of results returned from the request
// Setting this too far in the past could result in a very large response size
            $retrieveDate = "2012-01-15T13:00:00.000";
// Retrieve Filtered ClickEvent with GetMoreResults
            print "Retrieve Filtered ClickEvent with GetMoreResults \n";
            $getClickEvent = new ET_ClickEvent();
            $getClickEvent->authStub = $myclient;
            $getClickEvent->props = array("SendID", "SubscriberKey", "EventDate", "Client.ID", "EventType", "BatchID", "TriggeredSendDefinitionObjectID", "PartnerKey");
            $getClickEvent->filter = array('Property' => 'EventDate', 'SimpleOperator' => 'greaterThan', 'DateValue' => $retrieveDate);
            $getClickEvent->getSinceLastBatch = false;
            $getResponse = $getClickEvent->get();
            print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
            print 'Code: ' . $getResponse->code . "\n";
            print 'Message: ' . $getResponse->message . "\n";
            print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
            print 'Results Length: ' . count($getResponse->results) . "\n";
            print "\n---------------\n";
            while ($getResponse->moreResults) {
                print "Continue Retrieve All ClickEvent with GetMoreResults \n";
                $getResponse = $getClickEvent->GetMoreResults();
                print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
                print 'Code: ' . $getResponse->code . "\n";
                print 'Message: ' . $getResponse->message . "\n";
                print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
                print 'Results Length: ' . count($getResponse->results) . "\n";
                print "\n---------------\n";
            }
// The following request could potentially bring back large amounts of data if run against a production account
            /*
              // Retrieve All ClickEvent with GetMoreResults
              print "Retrieve All ClickEvent with GetMoreResults \n";
              $getClickEvent = new ET_ClickEvent();
              $getClickEvent->authStub = $myclient;
              $getClickEvent->props = array("SendID","SubscriberKey","EventDate","Client.ID","EventType","BatchID","TriggeredSendDefinitionObjectID","PartnerKey");
              $getResponse = $getClickEvent->get();
              print_r('Get Status: '.($getResponse->status ? 'true' : 'false')."\n");
              print 'Code: '.$getResponse->code."\n";
              print 'Message: '.$getResponse->message."\n";
              print_r('More Results: '.($getResponse->moreResults ? 'true' : 'false')."\n");
              print 'Results Length: '. count($getResponse->results)."\n";
              print "\n---------------\n";
              while ($getResponse->moreResults) {
              print "Continue Retrieve All ClickEvent with GetMoreResults \n";
              $getResponse = $getClickEvent->GetMoreResults();
              print_r('Get Status: '.($getResponse->status ? 'true' : 'false')."\n");
              print 'Code: '.$getResponse->code."\n";
              print 'Message: '.$getResponse->message."\n";
              print_r('More Results: '.($getResponse->moreResults ? 'true' : 'false')."\n");
              print 'Results Length: '. count($getResponse->results)."\n";
              print "\n---------------\n";
              }
             */
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function get_Category() {
        $myclient = new ET_Client(false);
        $getFolder = new ET_Folder();
        $getFolder->authStub = $myclient;
        $getFolder->filter = array('Property' => 'ContentType', 'SimpleOperator' => 'equals', 'Value' => 'list');
        $getFolder->props = array("ID", "Client.ID", "ParentFolder.ID", "ParentFolder.CustomerKey", "ParentFolder.ObjectID", "ParentFolder.Name", "ParentFolder.Description", "ParentFolder.ContentType", "ParentFolder.IsActive", "ParentFolder.IsEditable", "ParentFolder.AllowChildren", "Name", "Description", "ContentType", "IsActive", "IsEditable", "AllowChildren", "CreatedDate", "ModifiedDate", "Client.ModifiedBy", "ObjectID", "CustomerKey", "Client.EnterpriseID", "Client.CreatedBy");
        $getResponse = $getFolder->get();
//        print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
//        print 'Code: ' . $getResponse->code . "\n";
//        print 'Message: ' . $getResponse->message . "\n";
//        print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
//        print 'Results Length: ' . count($getResponse->results) . "\n";
//        print "\n---------------\n";
//        while ($getResponse->moreResults) {
//            print "Continue Retrieve All Folder with GetMoreResults \n";
//            $getResponse = $getFolder->GetMoreResults();
//            print_r('Get Status: ' . ($getResponse->status ? 'true' : 'false') . "\n");
//            print 'Code: ' . $getResponse->code . "\n";
//            print 'Message: ' . $getResponse->message . "\n";
//            print_r('More Results: ' . ($getResponse->moreResults ? 'true' : 'false') . "\n");
//            print 'Results Length: ' . count($getResponse->results) . "\n";
//            print "\n---------------\n";
//        }



        $arr = array();
        foreach ($getResponse->results as $key => $val) {
            $arr[$key]['Category_ID'] = $val->ID;
            $arr[$key]['Name'] = $val->Name;
            $arr[$key]['IsActive'] = $val->IsActive;
            $arr[$key]['CreatedDate'] = $val->CreatedDate;
            $arr[$key]['CustomerKey'] = $val->CustomerKey;
            $arr[$key]['Date'] = date("Y-m-d H:i:s", time());
        }

//        echo '<pre>';
//        print_r($arr);
//        echo '</pre>';
        $this->et_model->blank_tab('et_category');
        $this->et_model->insert_tab('et_category', $arr);

        $data = $this->et_model->getListNew();
//        var_dump($data);
        return $arr;
    }

    public function unSubscriberfromlist($SubscriberTestEmail) {

        $subPatch = new ET_Subscriber();
        $subPatch->authStub = $myclient;
        $subPatch->props = array("EmailAddress" => $SubscriberTestEmail, "Status" => "Unsubscribed");
        $patchResult = $subPatch->patch();
        print_r('Patch Status: ' . ($patchResult->status ? 'true' : 'false') . "\n");
        print 'Code: ' . $patchResult->code . "\n";
        print 'Message: ' . $patchResult->message . "\n";
        print 'Results Length: ' . count($patchResult->results) . "\n";
        print 'Results: ' . "\n";
        print_r($patchResult->results);
        print "\n---------------\n";
    }

    public function test() {
//        $myclient = new ET_Client();
//        $bounceevent = new ET_BounceEvent();
//        $bounceevent->authStub = $myclient;         
//        $response = $bounceevent->get();
//        echo '<pre>';
//        print_r($response);   
//        
//        
//        $myclient = new ET_Client();
//        $clickevent = new ET_ClickEvent();
//        $clickevent->authStub = $myclient;
//        $response = $clickevent->get();
//        print_r($response);
//        
//        $myclient = new ET_Client();
//        $openevent = new ET_OpenEvent();
//        $openevent->authStub = $myclient;           
//        $response = $openevent->get();
//        print_r($response);   
//        echo '</pre>';

        $myclient = new ET_Client(false);
        $list = new ET_List();
        $list->authStub = $myclient;
        $list->filter = array('Property' => 'CustomerKey', 'SimpleOperator' => 'equals', 'Value' => 'BP_LIST_EXT');
        $response = $list->get();

//        $arr = array();
//        if (count($response->results) && is_array($response->results)) {
//            foreach ($response->results as $value) {
//
//                $key = count($arr);
//
//                $arr[$key]['ListID'] = $value->ID;
//                $arr[$key]['CustomerKey'] = $value->CustomerKey;
//                $arr[$key]['ListName'] = $value->ListName;
//                $arr[$key]['Category'] = $value->Category;
//                $arr[$key]['Type'] = $value->Type;
//                $arr[$key]['CreatedDate'] = $value->CreatedDate;
//                $arr[$key]['ModifiedDate'] = $value->ModifiedDate;
//                $arr[$key]['ListClassification'] = $value->ListClassification;
//                $arr[$key]['Description'] = $value->Description;
//                $arr[$key]['CleintID'] = $value->Client->ID;
//            }
//        }
//
//        return $arr;
//         $myclient = new ET_Client(false);
//        $postContent = new ET_List();
//        $postContent->authStub = $myclient;
//        $postContent->props = array("ListName" => "Bepoz List", "Description" => "Bepoz List", "Type" => 'Private',"CustomerKey"=>"BP_LIST_EXT");
//        $postResponse = $postContent->post();
//        if ($postResponse->status) {
//            echo $postResponse->results[0]->NewID;
//        } else {
//            echo 'failed to create list';
//        }
//        
        echo '<pre>';
        print_r($response);
        echo '</pre>';
    }

        public function getBepozSubscribersbylist($arr = FALSE, $time = 1, $next = FALSE) {
        // Retrieve all Subscribers on the List
        set_time_limit(0);
        $myclient = new ET_Client(false);
        $getList = new ET_List_Subscriber();
        $getList->authStub = $myclient;
        $getList->filter = array('Property' => 'ListID', 'SimpleOperator' => 'equals', 'Value' => '352396');
        if ($next != FALSE)
            $getList->filter = array('Property' => 'ObjectID', 'SimpleOperator' => 'greaterThan', 'Value' => $next);

        if ($arr == FALSE) {
            $arr = array();
            $arr1 = array();
        } else {
            $arr1 = $arr;
        }
        $response = $getList->get();

        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $value) {

                $arr1[count($arr1)]['ObjectID'] = $value->ObjectID;
                $arr[$value->ObjectID]['ObjectID'] = $value->ObjectID;
                $arr[$value->ObjectID]['main_id'] = $value->ID;
                $arr[$value->ObjectID]['ListID'] = $value->ListID;
                $arr[$value->ObjectID]['SubscriberID'] = $value->SubscriberKey;
                $arr[$value->ObjectID]['Status'] = $value->Status;
                $arr[$value->ObjectID]['CreatedDate'] = $value->CreatedDate;
            }
        }

        if (count($arr1) == 2500 * $time) {
            return $this->getBepozSubscribersbylist($arr, $time + 1, $arr1[count($arr1) - 1]['ObjectID']);
        } else {
            return $arr;
        }
    }
    
        public function get_Subscriber_detail_bepoz($arr = FALSE, $time = 1, $next = FALSE) {
        set_time_limit(0);
        $myclient = new ET_Client(false);


        $retSub = new ET_Subscriber();
        $retSub->authStub = $myclient;
        $retSub->filter = array('Property' => 'Status', 'SimpleOperator' => 'equals', 'Value' => 'Active');

        if ($next != FALSE)
            $retSub->filter = array('Property' => 'ID', 'SimpleOperator' => 'greaterThan', 'Value' => $next);

        if ($arr == FALSE)
            $arr = array();

        $response = $retSub->get();

        $last_id = "";

        if (count($response->results) && is_array($response->results)) {
            foreach ($response->results as $value) {
                $key = $value->SubscriberKey;
                $arr[$key]['main_id'] = $value->ID;
                $arr[$key]['EmailAddress'] = $value->EmailAddress;
                $arr[$key]['CreatedDate'] = $value->CreatedDate;
                $arr[$key]['SubscriberID'] = $value->SubscriberKey;
                $arr[$key]['Status'] = $value->Status;
                $last_id = $value->SubscriberKey;
                if (is_array($value->Attributes)) {
                    foreach ($value->Attributes as $val) {

                        if ($val->Name == 'Date of Birth') {
                            $arr[$key]['DOB'] = $val->Value;
                        }
                        if ($val->Name == 'First Name') {
                            $arr[$key]['FirstName'] = $val->Value;
                        }
                        if ($val->Name == 'Last Name') {
                            $arr[$key]['LastName'] = $val->Value;
                        }
                        if ($val->Name == 'Full Name') {
                            $arr[$key]['FullName'] = $val->Value;
                        }
                        if ($val->Name == 'Mobile') {
                            $arr[$key]['Mobile'] = $val->Value;
                        }
                    }
                }
            }
        }


        if (count($arr) == 2500 * $time) {
            return $this->get_Subscriber_detail_bepoz($arr, $time + 1, $arr[$last_id]['main_id']);
        } else {
            return $arr;
        }
    }
    
    public function syncBepoz() {
         
        $listrealtion = $this->getBepozSubscribersbylist();
        
        $allscrb = $this->get_Subscriber_detail_bepoz();
        
        $sub_list = array();
        
        foreach ($listrealtion as $value) {
            $sub_list[] = $allscrb[$value['SubscriberID']];
        }
        return array('relation' => $listrealtion,'list'=>$sub_list);
        
    }

    public function get_SpecificUnSubscribe_list(){
//        require('ET_Client.php');
    $myclient = new ET_Client();
    $unsubevent = new ET_UnsubEvent();
    $unsubevent->authStub = $myclient;
//    $unsubevent->props = array('SendID', 'EventDate','SubscriberKey','BatchID');
//    echo date('Y-m-dT13 G:i:s ',mktime(0,0,0,10,3,1975));
//    $unsubevent->filter = array('Property' => 'EventDate','SimpleOperator' => 'lessThan','Value' =>date('Y-m-d G:i:s ',time()));
    $unsubevent->filter = array('Property' => 'EventDate','SimpleOperator' => 'greaterThan','Value' =>date('Y-m-d G:i:s ',mktime(0,0,0,10,3,1975)));
//    $unsubevent->filter = array('Property' => 'SubscriberKey','SimpleOperator' => 'equals','Value' => '');
    $response = $unsubevent->get();
    
    return $response;
    }
}

/* End of file exact_target.php */
/* Location: ./application/controllers/exact_target.php */