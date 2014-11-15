<script src="<?php echo base_url();?>assets/js/exacttarget.js"></script>
  <div class="content">

    <div class="container">

              <div class="portlet">

        <div class="portlet-title">
          <u><h4>Total Customers in BB to Date = <?php if($Customer !=0 ) {echo $Customer;} else{ echo "0";} ?></h4></u>
        <span class="label label-success row-stat-badge">+
                    <?php if($Customer !=0 ){ echo number_format((($Customer-$FilterCustomer['year'])*100)/$Customer); }else{ echo '0';} ?>% from previous year</span>

        </div>

        <div class="portlet-body">

          <div class="row">
  
         <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $FilterCustomer['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterCustomer['month'] !=0 ){ echo number_format((( $FilterCustomer['month'] - $FilterCustomer['previous_month'])*100)/$FilterCustomer['month']); } else{ echo '0';} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->         
                    
                    
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $FilterCustomer['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterCustomer['last_thirty'] !=0 ){ echo number_format((( $FilterCustomer['last_thirty'] - $FilterCustomer['previous_month'])*100)/$FilterCustomer['last_thirty']); } else{ echo '0';} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

          <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $FilterCustomer['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($FilterCustomer['previous_seven'] !=0 ) { echo number_format((($FilterCustomer['last_seven'])*100)/$FilterCustomer['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

          <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $FilterCustomer['today']; ?></h3>
                <span class="label label-success row-stat-badge">
              <?php echo $FilterCustomer['yesterday'];  ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
      
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>McWilliams Online Store to Date = <?php echo $mcSubscriber['total']; ?></h4></u>
          <span class="label label-success row-stat-badge">+
                    <?php if($mcSubscriber['total'] !=0){ echo number_format((($mcSubscriber['total']-$mcSubscriber['year'])*100)/$mcSubscriber['total']);} else{ echo '0';} ?>% from previous year</span>

        </div>

        <div class="portlet-body">
          <div class="row">

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $mcSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($mcSubscriber['month'] !=0) { echo number_format((($mcSubscriber['month'] - $mcSubscriber['previous_month'])*100)/$mcSubscriber['month']);} else{ echo "0";} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
                    
          <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $mcSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($mcSubscriber['last_thirty'] !=0) { echo number_format((($mcSubscriber['last_thirty']-$mcSubscriber['previous_thirty'])*100)/$mcSubscriber['last_thirty']); }else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

          <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $mcSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($mcSubscriber['previous_seven'] !=0 ) { echo number_format((($mcSubscriber['last_seven'])*100)/$mcSubscriber['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
            
            <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $mcSubscriber['today']; ?></h3>
                <span class="label label-success row-stat-badge">
              <?php echo $mcSubscriber['yesterday'];  ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
 
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>Entertainment Book to Date = <?php echo $brandsSubscriber['total']; ?></h4></u>
           <span class="label label-success row-stat-badge">+
                    <?php if($brandsSubscriber['total'] !=0){ echo number_format((($brandsSubscriber['total']-$brandsSubscriber['year'])*100)/$brandsSubscriber['total']);} else{ echo '0';} ?>% from previous year</span>

        </div>

        <div class="portlet-body">

          <div class="row">

<!--            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total Customers</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['total']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($brandsSubscriber['total'] !=0){ echo number_format((($brandsSubscriber['total']-$brandsSubscriber['year'])*100)/$brandsSubscriber['total']);} else{ echo '0';} ?>% from previous year</span>
              </div>  /.row-stat 
            </div>  /.col -->

                   <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($brandsSubscriber['month'] !=0) { echo number_format((($brandsSubscriber['month'] - $brandsSubscriber['previous_month'])*100)/$brandsSubscriber['month']);} else{ echo "0";} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->         
                    
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($brandsSubscriber['last_thirty'] !=0) { echo number_format((($brandsSubscriber['last_thirty']-$brandsSubscriber['previous_thirty'])*100)/$brandsSubscriber['last_thirty']); }else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

         <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($brandsSubscriber['previous_seven'] !=0 ) { echo number_format((($brandsSubscriber['last_seven'])*100)/$brandsSubscriber['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
            <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['today']; ?></h3>
                <span class="label label-success row-stat-badge">
              <?php echo $brandsSubscriber['yesterday'];  ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
          
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>Family and Friends to Date = <?php echo $celldoorSubscriber['total']; ?></h4></u>
          <span class="label label-success row-stat-badge">+
                    <?php if($celldoorSubscriber['total'] !=0){ echo number_format((($celldoorSubscriber['total']-$celldoorSubscriber['year'])*100)/$celldoorSubscriber['total']);} else{ echo '0';} ?>% from previous year</span>

        </div>

        <div class="portlet-body">

          <div class="row">

<!--            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total Customers</p>
                <h3 class="row-stat-value"><?php echo $celldoorSubscriber['total']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($celldoorSubscriber['total'] !=0){ echo number_format((($celldoorSubscriber['total']-$celldoorSubscriber['year'])*100)/$celldoorSubscriber['total']);} else{ echo '0';} ?>% from previous year</span>
              </div>  /.row-stat 
            </div>  /.col -->

            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $celldoorSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($celldoorSubscriber['month'] !=0) { echo number_format((($celldoorSubscriber['month']-$celldoorSubscriber['previous_month'])*100)/$celldoorSubscriber['month']);} else{ echo "0";} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

    
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $celldoorSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($celldoorSubscriber['last_thirty'] !=0) { echo number_format((($celldoorSubscriber['last_thirty']-$celldoorSubscriber['previous_thirty'])*100)/$celldoorSubscriber['last_thirty']); }else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
         <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $celldoorSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($celldoorSubscriber['previous_seven'] !=0 ) { echo number_format((($celldoorSubscriber['last_seven'])*100)/$celldoorSubscriber['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $celldoorSubscriber['today']; ?></h3>
                <span class="label label-success row-stat-badge">
    <?php echo $celldoorSubscriber['yesterday'] ?> Yesterday                    
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
                <u>Customers Lists</u>
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
                <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SubscribedCount']; }else{ echo '0';} ?> subscribers <?php if(!empty($getLastSystemSyncsub)){echo date_format(date_create($getLastSystemSyncsub[0]['SyncTime']),"d-m-Y G:i"); } else{ echo "00:00";}?></li>
              <li><i class="icon-li fa fa-exchange text-success"></i>Sync <?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['UnSubscribedCount']; } else{ echo '0';}  ?> Unsubscribers <?php if(!empty($getLastSystemSyncsub)){ echo date_format(date_create($getLastSystemSyncsub[0]['SyncTime']),"d-m-Y G:i"); } else{ echo '00:00';}?></li>
               <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful <?php if(!empty($getLastSystemSyncsub)){ echo date_format(date_create($getLastSystemSyncsub[0]['SyncTime']),"d-m-Y G:i"); } else{ echo '0';}?></li>

            </ul>
          </div> <!-- /.well -->
                </div> <!-- /.portlet-body -->

              </div>
            
          </div> <!-- /.col -->
<!--            <div class="portlet">

              <h4 class="portlet-title">
                <u>Monthly Subscriptions</u>
              </h4>
                
              <div class="portlet-body">

                <div id="line-chart" class="chart-holder-300"></div>
              </div>  /.portlet-body           

            </div>  /.portlet -->

            
            

        </div> <!-- /.row -->


<div class="portlet">

        <h3 class="portlet-title">
          <u>Subscribers List -BB</u>
        </h3>

        <div class="portlet-body">

          <table id="black-boxx" class="table table-striped table-bordered">
            <thead>
              <tr>
                <!--<th style="width: 8%">UID</th>-->
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Created At</th>
                <th style="width: 15%">System Sync</th>
                <th style="width: 5%">Status</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <tr>
                <!--<th style="width: 8%">UID</th>-->
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Created At</th>
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body -->

      </div>
        
        <div class="portlet">

        <h3 class="portlet-title">
          <u>UnSubscribers List -BB</u>
        </h3>

        <div class="portlet-body">

          <table id="unSubscriber" class="table table-striped table-bordered">
            <thead>
              <tr>
                <!--<th style="width: 8%">UID</th>-->
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">UnSubscribed At</th>
                <th style="width: 15%">System Sync</th>
                <th style="width: 5%">Status</th>
              </tr>
            </thead>
                        <tbody>
                <?php if($UnSubscriber != NULL)

                    foreach ($UnSubscriber as $key => $value) {
                        ?>
                <tr>
                            <!--<td style="width: 8%"><?php echo $value['id']?></td>-->
                            <td style="width: 15%"><?php echo $value['firstname']?></td>
                            <td style="width: 15%"><?php echo $value['lastname']?></td>
                            <td style="width: 20%"><?php echo $value['email']?></td>
                            <td style="width: 10%"><?php echo $value['unsubscribed_date']?></td>
                            <td style="width: 15%"><?php if(!empty($getLastSystemSyncsub)){ echo $getLastSystemSyncsub[0]['SyncTime']; } else{ echo '00:00';}?></td>
                            <td style="width: 10%">Unsubscribed</td>
                </tr>
                <?php
                    }
                    ?>
            </tbody>
            <tfoot>
              <tr>
                 <!--<th style="width: 8%">UID</th>-->
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Created At</th>
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </tfoot>
          </table>

        </div> <!-- /.portlet-body -->

      </div>
        
    </div> <!-- /.container -->

  </div> <!-- .content -->