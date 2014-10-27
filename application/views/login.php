<style>

    .footer {
        bottom: 0;
        position: absolute;
        width: 100%;
    }
</style>
<div class="content">
    <div class="container">
        
  <div class="account-wrapper">

    <div class="account-body">

      <h3>McWilliams Wine Group</h3>

      <h5>Please sign in to get access.</h5>

      <form class="form account-form" method="POST" action="<?php echo base_url(); ?>index.php/login"> 

        <div class="form-group">
          <label for="login-username" class="placeholder-hidden">Username</label>
          <input type="email" required="" class="form-control" id="login-username" name="email_address" value="<?php echo set_value('email_address'); ?>" placeholder="Email" tabindex="1">
        </div> <!-- /.form-group -->

        <div class="form-group">
          <label for="login-password" class="placeholder-hidden">Password</label>
          <input type="password" required="" class="form-control" id="login-password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" tabindex="2">
        </div> <!-- /.form-group -->

        <div class="form-group clearfix">
          <div class="pull-left">					
            <label class="checkbox-inline">
            <input type="checkbox" class="" value="" tabindex="3"> <small>Remember me</small>
            </label>
          </div>

          <div class="pull-right">
            <small><a href="#">Forgot Password?</a></small>
          </div>
        </div> <!-- /.form-group -->

        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-lg" tabindex="4">
            Sign in &nbsp; <i class="fa fa-play-circle"></i>
          </button>
        </div> <!-- /.form-group -->
<?php echo validation_errors(); ?>
      </form>


    </div> <!-- /.account-body -->

    <div class="account-footer">
      <p>
      Don't have an account? &nbsp;
      <a href="#" class="">Create an Account!</a>
      </p>
    </div> <!-- /.account-footer -->

  </div> <!-- /.account-wrapper -->


    </div>
</div>
