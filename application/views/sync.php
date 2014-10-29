<div class="content">
<?php // var_dump($UnSubscriber);die; ?>
    <div class="container">

        <div class="portlet">

            <h4 class="portlet-title">
                <u>Master Sync Status&nbsp; <i class="fa fa-exchange "></i> </u>
            </h4>

            <div class="portlet-body">

                <div class="row">

                    <div class="col-sm-6 col-md-4">
                        <h4>Recent Activity</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['SubscribedCount'];} else{ echo '0';}  ?> subscribers <?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['SyncTime'];} else{ echo "00:00";}?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['UnSubscribedCount'];} else{ echo '0';}  ?> Unsubscribers <?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['SyncTime'];} else{ echo "00:00";}?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful <?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['SyncTime']; } else{ echo '00:00';}?></li>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-4">
                        <h4>Error Log</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                <li>
                                    <i class="icon-li fa fa-ban text-danger"></i>
                                    Sync Not Failed </li>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-4">
                        <h4>Master Switch</h4>
                        <div class="portlet">
                            <a class="btn btn-success btn-jumbo btn-block <?php if($autosync == 1) echo 'disabled'; ?>" href="javascript:stratsync(this);" id="syncstrat">AutoSync Active</a>
                            <br>
                            <a class="btn btn-primary btn-small btn-block <?php if($autosync == 0) echo 'disabled'; ?>" href="javascript:stopsync(this);" id="syncstop"><i class="fa fa-exclamation-triangle"></i> Deactivate Sync </a>
                            <br>
                            <div class="col-sm-4 col-md-6">
                            <p class="row-stat-label">Last Sync</p><h3 class="row-stat-value"><?php if(!empty($mdbSyncsub)){ echo date('h:ma', strtotime($mdbSyncsub[0]['SyncTime']));} else{ echo "00:00";}?></h3>
                            </div>
                            <div class="col-sm-4 col-md-6">
                            <p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">85Sec</h3>
                            </div>
                        </div> <!-- /.portlet -->


                    </div> <!-- /.col -->

                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div>

        <div class="portlet">
            <div class="portlet-body">

                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                        <h4>New Subscribers</h4>

                        <div class="well">

                            <ul class="icons-list text-md">
                                    <?php if(!empty($mdbSyncsub) && !empty($Subscriber)){
                                      $res = array_slice($Subscriber,-3,3); ?>
                                 <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[0]['firstname']." ".$res[0]['lastname'].",".$res[0]['email'].",".$mdbSyncsub[0]['SyncTime'];  ?> </li>
                                <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[1]['firstname']." ".$res[1]['lastname'].",".$res[1]['email'].",".$mdbSyncsub[0]['SyncTime'];?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[2]['firstname']." ".$res[2]['lastname'].",".$res[2]['email'].",".$mdbSyncsub[0]['SyncTime'];?></li>
                           <?php    }else{ ?>
                                     <li><i class="icon-li fa fa-exchange text-success"></i>No New Subscriber Found</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i></i>No New Subscriber Found</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i></i>No New Subscriber Found</li>
 
                                <?php } ?>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->
                                    <div class="col-sm-6 col-md-6">
                        <h4>Last UnSubscribers</h4>

                        <div class="well">

              <ul class="icons-list text-md">
                     <?php if(!empty($mdbSyncsub) && !empty($AllUnSubscriber)){
                       $res = array_slice($AllUnSubscriber,-3,3); ?>
                                <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[0]['firstname']." ".$res[0]['lastname'].",".$res[0]['email'].",".$mdbSyncsub[0]['SyncTime'];  ?> </li>
                                <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[1]['firstname']." ".$res[1]['lastname'].",".$res[1]['email'].",".$mdbSyncsub[0]['SyncTime'];?></li>
                                <li><i class="icon-li fa fa-exchange text-success"></i><?php echo $res[2]['firstname']." ".$res[2]['lastname'].",".$res[2]['email'].",".$mdbSyncsub[0]['SyncTime'];?></li>
                           <?php    }else{ ?>
                                <li><i class="icon-li fa fa-exchange text-success"></i>UnSubscriber Not Found</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i></i>UnSubscriber Not Found</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i></i>UnSubscriber Not Found</li>
 
                                <?php } ?>
                            </ul>
                        </div> <!-- /.well -->


                    </div> <!-- /.col -->

                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->
        <div class="portlet">

            <h4 class="portlet-title">
                <u>System Sync Status &nbsp;<i class="fa fa-exchange "></i> </u>
            </h4>

            <div class="portlet-body">

                <div class="row">
                                        <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">MDB</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    0%
                                </div>

                                <div class="progress progress-striped progress-sm active" id="mdb_progessbar">
                                    <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">0% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value" id="mdb_subscribe"><?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['SubscribedCount'];} else{ echo "0";}  ?></h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value" id="mdb_lastsync"><?php if(!empty($mdbSyncsub)){ echo date('h:ma',  strtotime($mdbSyncsub[0]['SyncTime']));}else{ echo "00:00";}?></h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value" id="mdb_unsubscribe"><?php if(!empty($mdbSyncsub)){ echo $mdbSyncsub[0]['UnSubscribedCount'];}else{ echo "0";}?></h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">0sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a id="mdb_stopsync" class="btn btn-primary  disabled" href="javascript:stopallsync(5);">Stop Sync</a>   &nbsp;   <a id="mdb_startsync" class="btn btn-primary" href="javascript:startmdbsync(5);">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">Exact Target</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    
                                </div>

                                <div class="progress progress-striped progress-sm active" id="exact_progessbar">
                                    <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">Subscribed</p><h3 class="row-stat-value" id="et_subscribe"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SubscribedCount'];} else{ echo "0";}  ?></h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value" id="et_lastsync"><?php if(!empty($getLastSystemSyncsub)){ echo date('h:ma',  strtotime($getLastSystemSyncsub[0]['SyncTime']));}else{ echo "00:00";}?></h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribers</p><h3 class="row-stat-value" id="et_unsubscribe"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['UnSubscribedCount'];}else{ echo "0";}?></h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value" id="exact_target_timer">85Sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a id="et_stopsync" class="btn btn-primary disabled" href="javascript:stopallsync(1);">Stop Sync</a>   &nbsp;   <a id="et_startsync" class="btn btn-primary" href="javascript:startsync(1);">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">BlackBoxx</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                   0% 
                                </div>

                             
                                <div class="progress progress-striped progress-sm active" id="bb_progessbar">
                                    <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only"></span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                             <div class="col-sm-12 col-md-6"> <p class="row-stat-label">New Customer</p><h3 class="row-stat-value" id="bb_subscribe"><?php if(!empty($bbSyncsub)){ echo $bbSyncsub[0]['SubscribedCount'];} else{ echo "0";}  ?></h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value" id="bb_lastsync"><?php if(!empty($bbSyncsub)){ echo date('h:ma',  strtotime($bbSyncsub[0]['SyncTime']));}else{ echo "00:00";}?></h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribed</p><h3 class="row-stat-value" id="bb_unsubscribe"><?php if(!empty($bbSyncsub)){ echo $bbSyncsub[0]['UnSubscribedCount'];}else{ echo "0";}?></h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">85sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a id="bb_stopsync" class="btn btn-primary disabled" href="javascript:stopallsync(2);">Stop Sync</a>   &nbsp;   <a id="bb_startsync" class="btn btn-primary" href="javascript:startblackboxxsync(2);">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->
                    <div class="col-sm-6 col-md-3">

                        <div class="row-stat">
                            <h3 class="row-stat-value">BePoz</h3>
                            <hr>

                            <!-- Sync-stat -->
                            <div class="progress-stat hide">

                                <div class="progress-stat-label">
                                    Active Sync
                                </div>

                                <div class="progress-stat-value">
                                    77.7%
                                </div>

                                <div class="progress progress-striped progress-sm active">
                                    <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-success">
                                        <span class="sr-only">77.74% Sync Progress</span>
                                    </div>
                                </div> <!-- /.progress -->

                            </div> <!-- Sync-stat End -->
                            <div class="col-sm-12 col-md-6"> <p class="row-stat-label">New Customer</p><h3 class="row-stat-value">0</h3><hr><p class="row-stat-label">Last Sync</p><h3 class="row-stat-value">00:00</h3></div>
                            <div class="col-sm-12  col-md-6"><p class="row-stat-label">UnSubscribed</p><h3 class="row-stat-value">0</h3><hr><p class="row-stat-label">Next Sync</p><h3 class="row-stat-value">0sec</h3></div> 
                            <h3 class="row-stat-value">&nbsp;</h3><hr><a class="btn btn-primary disabled" href="javascript:;">Stop Sync</a>   &nbsp;   <a class="btn btn-primary disabled" href="javascript:;">Manual Sync</a>
                        </div> <!-- /.row-stat -->

                    </div> <!-- /.col -->





                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div>


              <div class="portlet">

        <h3 class="portlet-title">
          <u>Master Subscribe List </u>
        </h3>

        <div class="portlet-body">
  <?php 
  if(!empty($bbCustomer)){
    foreach($bbCustomer as $bb_customer){
      $bb_emails = explode(",", $bb_customer);
    }
  }
  if(!empty($etSubscriber)){
    foreach($etSubscriber as $et_subscriber){
      $et_emails = explode(",", $et_subscriber);
    }
    }
  if(!empty($mdbSubscriber)){
    foreach($mdbSubscriber as $mdb_Subscriber){
      $mdb_emails = explode(",", $mdb_Subscriber);
    }
    }
  if(!empty($bpSubscriber)){
    foreach($bpSubscriber as $bp_subscriber){
      $bp_emails = explode(",", $bp_subscriber);
    }
    }
  ?>
          <table class="table table-striped table-bordered" id="table-1">
            <thead>
              <tr>
                <!--<th style="width: 30%">ID</th>-->
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                 <th style="width: 12%">MDB</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
              </tr>
            </thead>
                         <tbody>
                <?php if($Subscriber != NULL)
                    foreach ($Subscriber as $key => $value) {
                        ?>
                <tr>
                            <!--<td style="width: 8%"><?php echo $value['id']?></td>-->
                            <td style="width: 15%"><?php echo $value['firstname']?></td>
                            <td style="width: 15%"><?php echo $value['lastname']?></td>
                            <td style="width: 20%"><?php echo $value['email']?></td>
                            <td style="width: 10%"><?php if(!empty($mdbSubscriber)){ if(in_array($value['email'],$mdb_emails) ){ echo "y";}else{ echo "n";} } else{ echo "None";}?></td>
                            <td style="width: 10%"><?php  if(!empty($etSubscriber)){ if(in_array($value['email'],$et_emails) ){ echo "y";}else{ echo "n";} } else{ echo "None";}?></td>
                            <td style="width: 15%"><?php  if(!empty($bbCustomer)){ if(in_array($value['email'],$bb_emails) ){ echo "y";}else{ echo "n";} } else{ echo "None";}?></td>
                            <td style="width: 10%"><?php if(!empty($bpSubscriber)){ if(in_array($value['email'],$bp_emails) ){ echo "y";}else{ echo "n";} } else{ echo 'None';}?></td>
               </tr>
                 <?php
                    }
                    ?> 
            </tbody>
               
            <tfoot>
              <tr>
               <!--<th style="width: 30%">ID</th>-->
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 12%">MDB</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
               
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
              <div class="portlet">

        <h3 class="portlet-title">
          <u>Master Usubscribe List </u>
        </h3>

        <div class="portlet-body">
  <?php // var_dump($AllUnSubscriber); ?>
          <table class="table table-striped table-bordered" id="table-1">
            <thead>
              <tr>
                <!--<th style="width: 30%">ID</th>-->
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                 <th style="width: 12%">MDB</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
              </tr>
            </thead>
                         <tbody>
                <?php if($AllUnSubscriber != NULL)
                    foreach ($AllUnSubscriber as $key => $value) {
                       $store_name =  explode(",", $value['unsubscriber_from']);
                        ?>
                <tr>
                            <!--<td style="width: 8%"><?php echo $value['id']?></td>-->
                            <td style="width: 15%"><?php echo $value['firstname']?></td>
                            <td style="width: 15%"><?php echo $value['lastname']?></td>
                            <td style="width: 20%"><?php echo $value['email']?></td>
                            <td style="width: 10%"><?php  if(in_array("4",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 10%"><?php  if(in_array("1",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 15%"><?php  if(in_array("2",$store_name)){echo "y";}else{echo "n";}?></td>
                            <td style="width: 10%"><?php  if(in_array("3",$store_name)){echo "y";}else{echo "n";}?></td>
                </tr>
                 <?php
                    }
                    ?> 
            </tbody>
               
            <tfoot>
              <tr>
               <!--<th style="width: 30%">ID</th>-->
                <th style="width: 20%">First Name</th>
                <th style="width: 18%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 12%">MDB</th>
                <th style="width: 12%">Exact Target</th>
                <th style="width: 12%">Blackbox</th>
                <th style="width: 12%">Bepoz</th>
               
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->

    </div> <!-- /.container -->

</div> <!-- .content -->
</div> <!-- .content -->
<?php 
//  if(!empty($getLastSystemSyncsub)){ $time=  date("h:m:sa",strtotime($getLastSystemSyncsub[0]['SyncTime']));}
//  if(!empty($getAutoSyncUpdate)){ $next=$getAutoSyncUpdate[0]['time_duration'];
//$endTime = strtotime("+30'".$next."'minutes", strtotime($time));
////echo $next_time = strtotime(date('h:i:s', $time))."<br>";
//$current_time=strtotime(date('h:i:sa',time()));
//$diff = $endTime-$current_time;
//if($diff){
//    $timer_time= date('m', $diff);
//}
//  }
?>
<!--<input type="hidden" name="auto_sync_time" value="<?php   echo $timer_time; ?>" id="auto_sync_time">-->
<script src="<?php echo base_url();?>assets/js/sync.js"></script>