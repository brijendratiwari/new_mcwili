<script src="<?php echo base_url(); ?>assets/js/exacttarget.js"></script>
<div class="content">

    <div class="container">

        <div class="portlet">

            <h4 class="portlet-title">
                <u>Total Subscribers</u>
            </h4>

            <div class="portlet-body">

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Revenue Today</p>
                            <h3 class="row-stat-value">$890.00</h3>
                            <span class="label label-success row-stat-badge">+43%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Revenue This Month</p>
                            <h3 class="row-stat-value">$8290.00</h3>
                            <span class="label label-success row-stat-badge">+17%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Total Users</p>
                            <h3 class="row-stat-value">98,290</h3>
                            <span class="label label-success row-stat-badge">+26%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Currently Active Uses</p>
                            <h3 class="row-stat-value">19</h3>
                            <span class="label label-danger row-stat-badge">+5%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div> <!-- /.portlet -->

        <div class="portlet">

            <h4 class="portlet-title">
                <u>Total UnSubscribers</u>
            </h4>

            <div class="portlet-body">

                <div class="row">

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Revenue Today</p>
                            <h3 class="row-stat-value">$890.00</h3>
                            <span class="label label-success row-stat-badge">+43%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Revenue This Month</p>
                            <h3 class="row-stat-value">$8290.00</h3>
                            <span class="label label-success row-stat-badge">+17%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Total Users</p>
                            <h3 class="row-stat-value">98,290</h3>
                            <span class="label label-success row-stat-badge">+26%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                    <div class="col-sm-6 col-md-3">
                        <div class="row-stat">
                            <p class="row-stat-label">Currently Active Uses</p>
                            <h3 class="row-stat-value">19</h3>
                            <span class="label label-danger row-stat-badge">+5%</span>
                        </div> <!-- /.row-stat -->
                    </div> <!-- /.col -->

                </div> <!-- /.row -->

            </div> <!-- /.portlet-body -->

        </div> <!-- /.portlet -->

        <div class="row">

            <div class="col-md-4 col-sm-5">

                <div class="portlet">

                    <h4 class="portlet-title">
                        <u>Subscriber Lists</u>
                    </h4>

                    <div class="portlet-body Subscriber_list">                

                        <table id="SubscriberList" class="table keyvalue-table">
                            <tbody>
                                <?php
                                if ($list != NULL) {
                                    foreach ($list as $list_val) {
                                        ?>
                                        <tr>
                                            <td class="kv-key" data-listname="<?php echo $list_val['ListName']; ?>"><i class="fa fa-envelope-o kv-icon kv-icon-default"></i><?php echo $list_val['ListName']; ?></td>
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


            <div class="col-md-8 col-sm-7">
                <div class="portlet">

                    <h4 class="portlet-title">
                        <u>Monthly Subscriptions</u>
                    </h4>

                    <div class="portlet-body">

                        <div id="line-chart" class="chart-holder-300"></div>
                    </div> <!-- /.portlet-body -->          

                </div> <!-- /.portlet -->
                <hr>
                <div class="portlet">

                    <div class="portlet-body">              

                        <div class="row">

                            <div class="col-md-2 col-xs-6 text-center">  
                                <div>
                                    <h3><small><i class="fa fa-caret-up text-success"></i></small> &nbsp;10%</h3>
                                    <small class="text-muted">Cellar Door</small>
                                </div>     
                            </div> <!-- /.col --> 

                            <div class="col-md-2 col-xs-8 text-center">      
                                <div>
                                    <h3><small><i class="fa fa-caret-down text-danger "></i></small> &nbsp;4%</h3>
                                    <small class="text-muted">Mount Pleasant</small>
                                </div>   
                            </div> <!-- /.col --> 

                            <div class="col-md-2 col-xs-8 text-center">            
                                <div>
                                    <h3><small><i class="fa fa-minus text-warning"></i></small> &nbsp;0%</h3>
                                    <small class="text-muted">Evans And Tate</small>
                                </div>
                            </div> <!-- /.col --> 

                            <div class="col-md-2 col-xs-8 text-center">        
                                <div>
                                    <h3><small><i class="fa fa-caret-up text-success"></i></small> &nbsp;976%</h3>
                                    <small class="text-muted">Mc Williams</small>
                                </div>  
                            </div> <!-- /.col --> 
                            <div class="col-md-2 col-xs-8 text-center">        
                                <div>
                                    <h3><small><i class="fa fa-caret-up text-success"></i></small> &nbsp;43%</h3>
                                    <small class="text-muted">Brand Laira</small>
                                </div>  
                            </div> <!-- /.col --> 
                            <div class="col-md-2 col-xs-8 text-center">        
                                <div>
                                    <h3><small><i class="fa fa-caret-up text-success"></i></small> &nbsp;32%</h3>
                                    <small class="text-muted">Misc Lists</small>
                                </div>  
                            </div> <!-- /.col --> 

                        </div> <!-- /.row -->
                        <hr>

                    </div> <!-- /.portlet-body -->

                </div>


            </div> <!-- /.col -->

        </div> <!-- /.row -->



        <div class="row">

            <div class="col-md-4">

                <div class="portlet">

                    <h4 class="portlet-title">
                        <u>Subscriber Lists</u>
                    </h4>

                    <div class="portlet-body">

                        <div id="pie-chart" class="chart-holder-250"></div>
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
                                77.7%
                            </div>

                            <div class="progress progress-striped progress-sm active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%">
                                    <span class="sr-only">77.74% Visit Rate</span>
                                </div>
                            </div> <!-- /.progress -->

                        </div> <!-- /.progress-stat -->

                        <div class="progress-stat">

                            <div class="progress-stat-label">
                                Click Through Rate
                            </div>
                            <div class="progress-stat-value">
                                34.2%
                            </div>

                            <div class="progress progress-striped progress-sm active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 34%">
                                    <span class="sr-only">33% Mobile Visitors</span>
                                </div>
                            </div> <!-- /.progress -->

                        </div> <!-- /.progress-stat -->

                        <div class="progress-stat">

                            <div class="progress-stat-label">
                                Bounce Rate
                            </div>

                            <div class="progress-stat-value">
                                2.7%
                            </div>

                            <div class="progress progress-striped progress-sm active">
                                <div class="progress-bar progress-bar-secondary" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" style="width:8%">
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
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync 6 subscribers 12:32:012322</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync 12 subscribers, 4 unsubscribes 12:32:012322</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>New List Created 12:32:012322</li>
                                <li><i class="icon-li fa fa-exchange text-success"></i>Sync Successful 12:32:012322</li>

                            </ul>
                        </div> <!-- /.well -->
                    </div> <!-- /.portlet-body -->

                </div>

            </div> <!-- /.col -->

        </div> <!-- /.row -->
        <div class="portlet">

            <h3 class="portlet-title">
                <u>Subscribers List</u>
            </h3>

            <div class="portlet-body">

                <table id="table-exact-target" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 8%">UID</th>
                            <th style="width: 15%">First Name</th>
                            <th style="width: 15%">Last Name</th>
                            <th style="width: 20%">Email</th>
                            <th style="width: 10%">Created At</th>
                            <th style="width: 15%">System Sync</th>
                            <th style="width: 5%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
if ($Subscriber != NULL)
    foreach ($Subscriber as $key => $value) {
        ?>
                                <tr>
                                    <td style="width: 8%"><?php echo $value['ID'] ?></td>
                                    <td style="width: 15%"><?php echo $value['FirstName'] ?></td>
                                    <td style="width: 15%"><?php echo $value['LastName'] ?></td>
                                    <td style="width: 20%"><?php echo $value['EmailAddress'] ?></td>
                                    <td style="width: 10%"><?php echo $value['CreatedDate'] ?></td>
                                    <td style="width: 15%"><?php echo $value['ID'] ?></td>
                                    <td style="width: 10%"><?php echo $value['Status'] ?></td>
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

            </div> <!-- /.portlet-body -->

        </div>

        <div class="portlet">

            <h3 class="portlet-title">
                <u>UnSubscribers List</u>
            </h3>

            <div class="portlet-body">

                <table id="unSubscriber" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 8%">UID</th>
                            <th style="width: 15%">First Name</th>
                            <th style="width: 15%">Last Name</th>
                            <th style="width: 20%">Email</th>
                            <th style="width: 10%">Created At</th>
                            <th style="width: 15%">System Sync</th>
                            <th style="width: 5%">Status</th>
                        </tr>
                    </thead>

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

            </div> <!-- /.portlet-body -->

        </div>

    </div> <!-- /.container -->

</div> <!-- .content -->