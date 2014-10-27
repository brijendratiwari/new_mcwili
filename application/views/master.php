<script src="<?php echo base_url();?>assets/js/exacttarget.js"></script>
  <div class="content">

    <div class="container">

              <div class="portlet">

        <h4 class="portlet-title">
          <u>Total Subscribers - MDB</u>
        </h4>

        <div class="portlet-body">

          <div class="row">

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total Subscribers</p>
                <h3 class="row-stat-value"><?php echo count($Subscriber); ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if(count($Subscriber) !=0 ){ echo number_format(((count($Subscriber)-$FilterSubscriber['year'])*100)/count($Subscriber),2); }else{ echo '0';} ?>% from previous year</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Subscribers Last Month</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterSubscriber['month'] !=0 ){ echo number_format((( $FilterSubscriber['month'] - $FilterSubscriber['previous_month'])*100)/$FilterSubscriber['month'],2); } else{ echo '0';} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterSubscriber['last_thirty'] !=0 ) { echo number_format((($FilterSubscriber['last_thirty']-$FilterSubscriber['previous_thirty'])*100)/$FilterSubscriber['last_thirty'],2); } else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($FilterSubscriber['last_seven'] !=0 ) { echo number_format(((count($Subscriber)-$FilterSubscriber['last_seven'])*100)/count($Subscriber),2); } else{ echo '0';} ?>%                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
      
            <div class="portlet">

        <h4 class="portlet-title">
          <u>Total UnSubscribers - MDB</u>
        </h4>

        <div class="portlet-body">

          <div class="row">

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total UnSubscribed</p>
                <h3 class="row-stat-value"><?php echo count($UnSubscriber); ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if(count($UnSubscriber) !=0){ echo number_format(((count($UnSubscriber)-$FilterUnSubscriber['year'])*100)/count($UnSubscriber),2);} else{ echo '0';} ?>% from previous year</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">UnSubscribed Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $FilterUnSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterUnSubscriber['last_thirty'] !=0) { echo number_format((($FilterUnSubscriber['last_thirty']-$FilterUnSubscriber['previous_thirty'])*100)/$FilterUnSubscriber['last_thirty'],2); }else{ echo '0';} ?> from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 4 Hours</p>
                <h3 class="row-stat-value"><?php echo $FilterUnSubscriber['hours']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterUnSubscriber['hours'] !=0) { echo number_format((($FilterUnSubscriber['hours']-$FilterUnSubscriber['previous_hours'])*100)/$FilterUnSubscriber['hours'],2);} else{ echo "0";} ?>% from previous 4 hours</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

            <div class="col-sm-6 col-md-3">
                    <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $FilterUnSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($FilterUnSubscriber['last_seven'] !=0 ) { echo number_format(((count($UnSubscriber)-$FilterUnSubscriber['last_seven'])*100)/count($UnSubscriber),2); } else{ echo '0';} ?>%                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
        
        <div class="row">

          <div class="col-md-4 col-sm-5">

            <div class="portlet">

              <h4 class="portlet-title">
                <u>Subscriber Lists - MDB</u>
              </h4>

              <div class="portlet-body Subscriber_list">                
               
                  <table id="SubscriberList" class="table keyvalue-table">
                  <tbody>
                    <?php
                        if($list != NULL)
                        {
                            foreach ($list as $list_val)
                            {
                    ?>
                    <tr>
                      <td class="kv-key" data-listname="<?php echo $list_val['ListName'] ; ?>"><i class="fa fa-envelope-o kv-icon kv-icon-default"></i><?php echo $list_val['ListName'] ; ?></td>
                      <td class="kv-value" data-listcount="<?php echo $list_val['total']; ?>"><?php echo $list_val['total']; ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </tbody>
                </table>

              </div> <!-- /.portlet-body -->

            </div> <!-- /.portlet -->
            
          </div> <!-- /.col -->

<!--        </div>  /.row 

            

        <div class="row">-->


            <div class="col-md-3">

              <div class="portlet">

                <h4 class="portlet-title">
                  <u>Email Stats</u>
                </h4>

                <div class="portlet-body">
                  
                  <div class="progress-stat">
                      
                    <div class="progress-stat-label">
                     Opened Rate 
                    </div>
                    
                    <div class="progress-stat-value">
                      0%
                    </div>
                    
                    <div class="progress progress-striped progress-sm active">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only">77.74% Visit Rate</span>
                      </div>
                    </div> <!-- /.progress -->
                    
                  </div> <!-- /.progress-stat -->

                  <div class="progress-stat">
                      
                    <div class="progress-stat-label">
                      Click Through Rate
                    </div>
                    <div class="progress-stat-value">
                      0%
                    </div>
                    
                    <div class="progress progress-striped progress-sm active">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        <span class="sr-only">33% Mobile Visitors</span>
                      </div>
                    </div> <!-- /.progress -->
                    
                  </div> <!-- /.progress-stat -->

                  <div class="progress-stat">
                      
                    <div class="progress-stat-label">
                      Bounce Rate
                    </div>
                    
                    <div class="progress-stat-value">
                      0%
                    </div>
                    
                    <div class="progress progress-striped progress-sm active">
                      <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only">2.7% Bounce Rate</span>
                      </div>
                    </div> <!-- /.progress -->
                    
                  </div> <!-- /.progress-stat -->

                </div> <!-- /.portlet-body -->

              </div> <!-- /.portlet -->

          </div> <!-- /.col -->

          <div class="col-md-5">
         <div class="portlet">

                <h4 class="portlet-title">
                  <u>Recent Activity</u>
                </h4>

                <div class="portlet-body">

  <div class="well">
            
            <ul class="icons-list text-md">
                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SubscribedCount']; }else{ echo '0';} ?> subscribers <?php if(!empty($getLastSystemSyncsub)){echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo "0";}?></li>
              <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['UnSubscribedCount']; } else{ echo '0';}  ?> Unsubscribers <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '0';}?></li>
               <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '0';}?></li>

            </ul>
          </div> <!-- /.well -->
                </div> <!-- /.portlet-body -->

              </div>
            
          </div> <!-- /.col -->

        </div> <!-- /.row -->
<div class="portlet">

        <h3 class="portlet-title">
          <u>Subscribers List -MDB</u>
        </h3>

        <div class="portlet-body">

          <table id="table-exact-target" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 8%">UID</th>
                <th style="width: 20%">First Name</th>
                <th style="width: 20%">Last Name</th>
                <th style="width: 30%">Email</th>
                <!--<th style="width: 10%">Created At</th>-->
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </thead>
            <tbody>
                <?php if($Subscriber != NULL)

                    foreach ($Subscriber as $key => $value) {
                        ?>
                <tr>
                            <td style="width: 8%"><?php echo $value['id']?></td>
                            <td style="width: 20%"><?php echo $value['firstname']?></td>
                            <td style="width: 20%"><?php echo $value['lastname']?></td>
                            <td style="width: 30%"><?php echo $value['email']?></td>
                            <!--<td style="width: 10%"><?php // echo $value['CreatedDate']?></td>-->
                            <td style="width: 15%"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '00:00';}?></td>
                            <td style="width: 10%"><?php echo 'Active'?></td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            <tfoot>
              <tr>
                <th style="width: 8%">UID</th>
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
               
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </tfoot>
          </table>

        </div> 
     <!--/.portlet-body--> 

      </div>
        
        <div class="portlet">

        <h3 class="portlet-title">
          <u>UnSubscribers List -MDB</u>
        </h3>

        <div class="portlet-body">

          <table id="unSubscriber" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 8%">UID</th>
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <!--<th style="width: 10%">UnSubscribed At</th>-->
                <th style="width: 15%">System Sync</th>
                <th style="width: 5%">Status</th>
              </tr>
            </thead>
                        <tbody>
                <?php if($UnSubscriber != NULL)

                    foreach ($UnSubscriber as $key => $value) {
                        ?>
                <tr>
                            <td style="width: 8%"><?php echo $value['id']?></td>
                            <td style="width: 15%"><?php echo $value['firstname']?></td>
                            <td style="width: 15%"><?php echo $value['lastname']?></td>
                            <td style="width: 20%"><?php echo $value['email']?></td>
                            <!--<td style="width: 10%"><?php echo $value['unsubscribed_date']?></td>-->
                            <td style="width: 15%"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '00:00';}?></td>
                            <td style="width: 10%">Unsubscribed</td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            <tfoot>
              <tr>
                 <th style="width: 8%">UID</th>
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body 

      </div>
        
    </div> <!-- /.container -->

  </div> <!-- .content -->
  </div>
  </div>