<script src="<?php echo base_url();?>assets/js/exacttarget.js"></script>
  <div class="content">

    <div class="container">

              <div class="portlet">

        <div class="portlet-title">
          <u><h4>Total Customers in Bepoz to Date = <?php if($Subscriber !=0 ){ echo $Subscriber; }else{ echo "0";} ?></h4></u>
           <span class="label label-success row-stat-badge">+
                    <?php if($Subscriber !=0 ){ echo number_format((($Subscriber-$FilterSubscriber['year'])*100)/$Subscriber); }else{ echo '0';} ?>% from previous year</span>
        </div>
     
        <div class="portlet-body">

          <div class="row">

           <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterSubscriber['month'] !=0 ) { echo number_format((($FilterSubscriber['month']-$FilterSubscriber['previous_month'])*100)/$FilterSubscriber['month']); } else{ echo '0';} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->             
                  
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($FilterSubscriber['last_thirty'] !=0 ){ echo number_format((( $FilterSubscriber['last_thirty'] - $FilterSubscriber['previous_thirty'])*100)/$FilterSubscriber['last_thirty'] ); } else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

           <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($FilterSubscriber['previous_seven'] !=0 ) { echo number_format((($FilterSubscriber['last_seven'])*100)/$FilterSubscriber['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $FilterSubscriber['today']; ?></h3>
                <span class="label label-success row-stat-badge">
              <?php echo $FilterSubscriber['yesterday']; ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
      
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>McWilliams Cellar Door to Date = <?php echo $mcSubscriber['total']; ?></h4></u>
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
                    <?php if($mcSubscriber['month'] !=0) { echo number_format((($mcSubscriber['month'])*100)/$mcSubscriber['last_thirty']);} else{ echo "0";} ?>% from previous month</span>
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
              <?php echo $mcSubscriber['today'];?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
       <div class="portlet">

        <div class="portlet-title">
          <u><h4>Mount Pleaser Cellar Door to Date = <?php echo $mount['total']; ?></h4></u>
            <span class="label label-success row-stat-badge">+
                    <?php if($mount['total'] !=0){ echo number_format((($mount['total']-$mount['year'])*100)/$mount['total']);} else{ echo '0';} ?>% from previous year</span>

        </div>

      <div class="portlet-body">

          <div class="row">

<!--            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total Customers</p>
                <h3 class="row-stat-value"><?php echo $mount['total']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($mount['total'] !=0){ echo number_format((($mount['total']-$mount['year'])*100)/$mount['total']);} else{ echo '0';} ?>% from previous year</span>
              </div>  /.row-stat 
            </div>  /.col -->

     <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $mount['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($mount['month'] !=0) { echo number_format((($mount['month']-$mount['previous_month'])*100)/$mount['month']);} else{ echo "0";} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->            
                    
                    
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $mount['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($mount['last_thirty'] !=0) { echo number_format((($mount['last_thirty']-$mount['previous_thirty'])*100)/$mount['last_thirty']); }else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

         <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $mount['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($mount['previous_seven'] !=0 ) { echo number_format((($mount['last_seven'])*100)/$mount['previous_seven']); } else{ echo '0';} ?>%from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col --> 
            
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $mount['today']; ?></h3>
                <span class="label label-success row-stat-badge">
    <?php echo $mount['yesterday']; ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
      
      
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>Brands Laira Cellar Door to Date = <?php echo $brandsSubscriber['total']; ?></h4></u>
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
                    <?php if($brandsSubscriber['total'] !=0){ echo number_format(($brandsSubscriber['total']-$brandsSubscriber['year'])*100)/$brandsSubscriber['total'];} else{ echo '0';} ?>% from previous year</span>
              </div>  /.row-stat 
            </div>  /.col -->

        
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $brandsSubscriber['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($brandsSubscriber['month'] !=0) { echo number_format((($brandsSubscriber['month']-$brandsSubscriber['previous_month'])*100)/$brandsSubscriber['month']);} else{ echo "0";} ?>% from previous month</span>
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
    <?php  echo $brandsSubscriber['yesterday'];?> Yesterday                    
</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
            <div class="portlet">

        <div class="portlet-title">
          <u><h4>Evans And Tate Cellar Door to Date = <?php echo $Evans['total']; ?></h4></u>
         <span class="label label-success row-stat-badge">+
                    <?php if($Evans['total'] !=0){ echo number_format((($Evans['total']-$Evans['year'])*100)/$Evans['total']);} else{ echo '0';} ?>% from previous year</span>

        </div>

        <div class="portlet-body">

          <div class="row">

<!--            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Total Customers</p>
                <h3 class="row-stat-value"><?php echo $Evans['total']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($Evans['total'] !=0){ echo number_format((($Evans['total']-$Evans['year'])*100)/$Evans['total'],2);} else{ echo '0';} ?>% from previous year</span>
              </div>  /.row-stat 
            </div>  /.col -->

          
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last Month</p>
                <h3 class="row-stat-value"><?php echo $Evans['month']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($Evans['month'] !=0) { echo number_format((($Evans['month']-$Evans['previous_month'])*100)/$Evans['month']);} else{ echo "0";} ?>% from previous month</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
          
                    
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Last 30 Days</p>
                <h3 class="row-stat-value"><?php echo $Evans['last_thirty']; ?></h3>
                <span class="label label-success row-stat-badge">+
                    <?php if($Evans['last_thirty'] !=0) { echo number_format((($Evans['last_thirty']-$Evans['previous_thirty'])*100)/$Evans['last_thirty']); }else{ echo '0';} ?>% from previous 30 days</span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->

         <div class="col-sm-6 col-md-3">
             <div class="row-stat">
                <p class="row-stat-label">Last 7 days</p>
                <h3 class="row-stat-value"><?php echo $Evans['last_seven']; ?></h3>
                <span class="label label-success row-stat-badge">+
              <?php if($Evans['previous_seven'] !=0 ) { echo number_format((($Evans['last_seven'])*100)/$Evans['previous_seven']); } else{ echo '0';} ?>% from previous 7 days                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->   
            
            
            <div class="col-sm-6 col-md-3">
              <div class="row-stat">
                <p class="row-stat-label">Today</p>
                <h3 class="row-stat-value"><?php echo $Evans['today']; ?></h3>
                <span class="label label-success row-stat-badge">
    <?php echo $Evans['today']; ?> Yesterday                    
                </span>
              </div> <!-- /.row-stat -->
            </div> <!-- /.col -->
            
          </div> <!-- /.row -->

        </div> <!-- /.portlet-body -->

      </div> <!-- /.portlet -->
                 
        
<!--        <div class="row">

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

              </div>  /.portlet-body 

            </div>  /.portlet 
            
          </div>  /.col 

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
                    </div>  /.progress 
                    
                  </div>  /.progress-stat 

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
                    </div>  /.progress 
                    
                  </div>  /.progress-stat 

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
                    </div>  /.progress 
                    
                  </div>  /.progress-stat 

                </div>  /.portlet-body 

              </div>  /.portlet 

          </div>  /.col 

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
          </div>  /.well 
                </div>  /.portlet-body 

              </div>
            
          </div>  /.col 
            <div class="portlet">

              <h4 class="portlet-title">
                <u>Monthly Subscriptions</u>
              </h4>
                
              <div class="portlet-body">

                <div id="line-chart" class="chart-holder-300"></div>
              </div>  /.portlet-body           

            </div>  /.portlet 

            
            

        </div>  /.row -->


<div class="portlet">

        <h3 class="portlet-title">
          <u>Customer List</u>
        </h3>

        <div class="portlet-body">

          <table id="table-bepoz" class="table table-striped table-bordered">
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
        
<!--        <div class="portlet">

        <h3 class="portlet-title">
          <u>UnSubscribers List -BB</u>
        </h3>

        <div class="portlet-body">

          <table id="unSubscriber" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width: 8%">UID</th>
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
                            <td style="width: 8%"><?php echo $value['id']?></td>
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
                 <th style="width: 8%">UID</th>
                <th style="width: 15%">First Name</th>
                <th style="width: 15%">Last Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Created At</th>
                <th style="width: 15%">System Sync</th>
                <th style="width: 10%">Status</th>
              </tr>
            </tfoot>
          </table>

        </div>  /.portlet-body 

      </div>-->
        
    </div> <!-- /.container -->

  </div> <!-- .content -->