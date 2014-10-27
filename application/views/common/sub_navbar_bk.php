 <div class="mainnav">

    <div class="container">

      <a class="mainnav-toggle" data-toggle="collapse" data-target=".mainnav-collapse">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </a>

      <nav class="collapse mainnav-collapse" role="navigation">

        <form class="mainnav-form pull-right" role="search">
          <input type="text" class="form-control input-md mainnav-search-query" placeholder="Search">
          <button class="btn btn-sm mainnav-form-btn"><i class="fa fa-search"></i></button>
        </form>

        <ul class="mainnav-menu" id="sub_navbar">

          <li class="dropdown" data-target="index">
              <a href="<?php echo base_url();?>index.php/home/index">
          	Overview
          	</a>
          </li>


          <li class="dropdown">
            <a href="<?php echo base_url();?>index.php/home/master">
            Master DB
            </a>

          </li>


          <li class="dropdown" data-target="exact_target">

            <a href="<?php echo base_url();?>index.php/home/exact_target">
            Exact Target
            </a>

          </li>
          
            <li class="dropdown">

            <a href="<?php echo base_url();?>index.php/home/black_boxx">
            BlackBoxx
            </a>

           
          </li>
          
          <li class="dropdown" data-target="sync">

            <a href="<?php echo base_url();?>index.php/home/sync">
            Sync 
            <span class="badge badge-success">ok</span> 
            </a>

          </li>
        


          <li class="dropdown ">

            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
            Extras
            <i class="mainnav-caret"></i>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="./page-notifications.html">
                <i class="fa fa-bell"></i> 
                &nbsp;&nbsp;Notifications
                </a>
              </li>			

              <li>
                <a href="./extras-icons.html">
                <i class="fa fa-smile-o"></i> 
                &nbsp;&nbsp;Font Icons
                </a>
              </li> 

              <li class="dropdown-submenu">
                <a tabindex="-1" href="#">
                <i class="fa fa-ban"></i> 
                &nbsp;&nbsp;Error Pages
                </a>
   </li>
                  <li>
                    <a href="./page-404.html">
                    <i class="fa fa-ban"></i> 
                    &nbsp;&nbsp;404 Error
                    </a>
                  </li>

                  <li>
                    <a href="./page-500.html">
                    <i class="fa fa-ban"></i> 
                    &nbsp;&nbsp;500 Error
                    </a>
                  </li>
           

              <li class="dropdown-submenu">

                <a tabindex="-1" href="#">
                <i class="fa fa-lock"></i> 
                &nbsp;&nbsp;Login Pages
                </a>
               </li>
                  <li>
                    <a href="./account-login.html">
                    <i class="fa fa-unlock"></i> 
                    &nbsp;&nbsp;Login
                    </a>
                  </li>

                  <li>
                    <a href="./account-login-social.html">
                    <i class="fa fa-unlock"></i> 
                    &nbsp;&nbsp;Login Social
                    </a>
                  </li>

                  <li>
                    <a href="./account-signup.html">
                    <i class="fa fa-star"></i> 
                    &nbsp;&nbsp;Signup
                    </a>
                    </li>

                  <li>
                    <a href="./account-forgot.html">
                    <i class="fa fa-envelope"></i> 
                    &nbsp;&nbsp;Forgot Password
                    </a>
                  </li>
                  <li>
                <a href="./index.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Analytics Dashboard
                </a>
              </li>

              <li>
                <a href="./dashboard-2.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Sidebar Dashboard
                </a>
              </li>

              <li>
                <a href="./dashboard-3.html">
                <i class="fa fa-dashboard"></i> 
                &nbsp;&nbsp;Reports Dashboard
                </a>
              </li>
                <li>
                <a href="./components-tabs.html">
                <i class="fa fa-bars"></i> 
                &nbsp;&nbsp;Tabs &amp; Accordions
                </a>
              </li>

              <li>
                <a href="./components-popups.html">
                <i class="fa fa-calendar-o"></i> 
                &nbsp;&nbsp;Popups &amp; Alerts
                </a>
              </li>

              <li>
                <a href="./components-validation.html">
                <i class="fa fa-check"></i> 
                &nbsp;&nbsp;Validation
                </a>
              </li>

              <li>
                <a href="./components-datatables.html">
                <i class="fa fa-table"></i> 
                &nbsp;&nbsp;Data Tables
                </a>
              </li>

              <li>
                <a href="./components-gallery.html">
                <i class="fa fa-picture-o"></i> 
                &nbsp;&nbsp;Gallery
                </a>
              </li>

              <li>
                <a href="./components-charts.html">
                <i class="fa fa-bar-chart-o"></i> 
                &nbsp;&nbsp;Charts
                </a>
              </li>
              <li>
                <a href="./page-pricing.html">
                <i class="fa fa-money"></i> 
                &nbsp;&nbsp;Plans & Billing
                </a>
              </li>

              <li>
                <a href="./page-profile.html">
                <i class="fa fa-user"></i> 
                &nbsp;&nbsp;Profile
                </a>
              </li>

              <li>
                <a href="./page-settings.html">
                <i class="fa fa-cogs"></i> 
                &nbsp;&nbsp;Settings
                </a>
              </li>

              <li>
                <a href="./page-faq.html">
                <i class="fa fa-question"></i> 
                &nbsp;&nbsp;FAQ
                </a>
              </li>
              </li> 

            </ul>

          </li>

        </ul>

      </nav>

    </div> <!-- /.container -->

  </div> <!-- /.mainnav -->
  <script>
    $(document).ready(function(){
    $('#sub_navbar a[href="<?php echo base_url('index.php'); ?>/<?php echo uri_string(); ?>"]').parent('li').addClass('open active');
    });
  </script>
      