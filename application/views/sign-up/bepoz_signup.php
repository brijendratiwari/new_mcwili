
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Brand's Laira</title>
        <link rel="stylesheet" href="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/laira-style-new.css" type="text/css" />
        <script src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/jquery.min.js" type="text/javascript"></script>
        <script src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/modernizr.min.js" type="text/javascript"></script>
        <script type="text/javascript">

            function CheckDetails() {

                var day = document.getElementById('txtDay').value;
                var month = document.getElementById('txtMonth').value;
                var year = document.getElementById('txtYear').value;
                var email = document.getElementById('txtEmail').value;
                var password = document.getElementById('txtPassword').value;
                var pattern = /^\w+([\+\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if (email == "" || email.match(pattern) == false) {
                    document.getElementById('emailerror2').style.display = 'block';
                    flag1 = 1;
                }
                else
                {
                    document.getElementById('emailerror2').style.display = 'none';
                    flag1 = 0;
                }
                if (password == "" || password.length < 5) {
                    document.getElementById('passworderror2').style.display = 'block';
                    flag1 = 1;
                }
                else
                {
                    document.getElementById('passworderror2').style.display = 'none';
                    flag1 = 0;
                }

                if (day == "" || month == "" || year == "") {

                    document.getElementById('doberror1').style.display = 'block';
                    flag2 = 1;
                }
                else {
                    document.getElementById('doberror1').style.display = 'none';
                    flag2 = 0;
                    var age = 18;
                    var mydate = new Date();
                    mydate.setFullYear(year, month - 1, day);

                    var currdate = new Date();
                    var setDate = new Date();
                    setDate.setFullYear(mydate.getFullYear() + age, month - 1, day);

                    if ((currdate - setDate) > 0) {
                        document.getElementById('doberror2').style.display = 'none';
                        flag3 = 0;
                    } else {

                        document.getElementById('doberror2').style.display = 'block';
                        flag3 = 1;
                    }
                }

                if (flag1 == 1 || flag2 == 1 || flag3 == 1)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script>
        <style type="text/css">
            .reg-form-submit {
                margin-left: -40px;
            }
            #footer-social-icons {
                background-color: #a98855 !important;
                min-width: 1070 !important;
            }
            #footer-copy-text {
                background-color: #272727 !important;
                min-width: 1070 !important;
            }
            .regs-form {
                width: 520px;
                background-color: #f1f1f1;
                border-radius: 5px;
                margin: 0 auto;
                padding-top: 30px;
                overflow: hidden;
            }
            #brand-img {
                padding-top: 25px !important;
                height: 535px !important;
            }
            p.chck span.chck-container {
                margin: 1px 1px 0 0 !important;
            }
            .reg-form-submit {
                padding: 10px 0 20px 0 !important;
            }
            img {
                max-width: 100%;
            }
            .checkboxes-bg {
                height: auto !important;
            }
            .padtop {
                padding-top: 30px;
            }

            @media only screen and (max-width : 1024px) {
                .container_wrapper {
                    width: 760px !important;
                }
                #header{
                    padding:30px 0 15px 48px !important;
                }
                #brand-img {
                    background: url("http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/Laira_0224_02.jpg") no-repeat;
                    margin: 0 auto;
                    position: relative !important;
                    width: 90% !important;
                    background-size: cover;
                    padding-top: 10px !important;
                    height: 430px !important;
                }
                #footer-social-icons, #footer-copy-text {
                    width: 760px !important;
                }
                #footer-social-icons{
                    padding:10px 0 !important;

                }
                #footer-copy-text {
                    padding-top: 10px !important;
                }
                .regs-form {
                    padding-top: 5px !important;
                }
                .heading {
                    font-size: 18px !important;
                }
                #reg-form-fields {
                    margin-top: 5px !important;
                }
                .padtop {
                    padding-top: 10px !important;
                }
                .social-icon-resize {
                    width: 25px !important;
                    height: 25px !important;
                }
                .input {
                    height: 25px !important;
                }
                .checkboxes-bg {
                    margin-bottom: 10px !important;
                }
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div style="background-color:#ffffff; width:100%;">
                <div class="container_wrapper">
                    <div id="header"> <a href="http://www.brandslaira.com.au/" title="Brand's Laira Wines" target="_blank" style="font-size:26px; color:#343434; text-decoration:none;"><img src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/Laira_0224_01.gif" alt="Brand's Laira Wines" title="Brand's Laira Wines"/></a> </div>
                </div>
            </div>
            <!-- Wrapper ends here -->

            <div id="brand-bg">
                <div id="brand-img">
                    <div class="regs-form">
                        <div id="reg-form-heading">
                            <p><span class="heading">BECOME A MEMBER.</span><br />
                                It's free to join and we will keep you up to date with the latest news, wine offers and events from Brand's Laira.</p>
                        </div>
                        <div id="reg-form-fields">
                            <form name="form" action="<?php echo base_url();?>index.php/login/createbb" method="post" onsubmit="return CheckDetails()" >
                                <div id="reg-form-fields-wrap">
                                    <input type="hidden" name="requiredAge" id="requiredAge" value="18">
                                        <table width="440" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="240" class="padtop"><label for="firstname">
                                                        <input type="text" name="firstname" placeholder="First Name"/>
                                                    </label></td>
                                                <td width="200"><label for="lastname">
                                                        <input type="text" name="lastname" placeholder="Last Name" />
                                                    </label></td>
                                            </tr>
                                            
                                                <tr>
                                                <span id="doberror1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">Please enter Your Date Of Birth.</span> <span id="doberror2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">You need to be above 18</span> </p></td>
<!--                                               <td width="200"><p> Password*<br />
                                                        <label for="password">
                                                            <input type="password" required="" placeholder="Password" id="txtPassword" name="password" style="width:190px !important;"/>
                                                        </label>
                                                        <span id="passworderror2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">Password at least have minimum 5 Character.</span> </p>
                                                </td>    -->
                                            <td width="200"><br />
                                                        <label for="mobile_number">
                                                            <input type="text" required="" placeholder="Mobile Number" id="txtMobile" name="mobile_number" style="width:190px !important;"/>
                                                        </label>
                                                        <span id="emailerror2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">Please enter a Mobile Number.</span> </p>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td width="240" style="padding-top:20px;"><p>Date of birth *<br />
                                                        <label for="date">
                                                            <input type="text" placeholder="DD" id="txtDay" name="birthDay" maxlength="2" class="dd-fix"/>
                                                        </label>
                                                        <span>/</span>
                                                        <label for="month">
                                                            <input type="text" placeholder="MM" id="txtMonth" name="birthMonth" maxlength="2" class="dd-fix"/>
                                                        </label>
                                                        <span>/</span>
                                                        <label for="year">
                                                            <input type="text" placeholder="YYYY" id="txtYear" name="birthYear" maxlength="4" class="y-fix" />
                                                        </label>
                                                        <span id="doberror1" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">Please enter Your Date Of Birth.</span> <span id="doberror2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">You need to be above 18</span> </p></td>
                                                <td width="200"><p> Email Address *<br />
                                                        <label for="email">
                                                            <input type="text" placeholder="Email Address" id="txtEmail" name="email" style="width:190px !important;"/>
                                                        </label>
                                                        <span id="emailerror2" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #ff0000; display:none;">Please enter a valid email address.</span> </p></td>
                                            </tr>
                                        
                                            <tr>
                                                <td colspan="2"><div class="checkboxes-bg m-top">
                                                        <p>I would also like to join:</p>
                                                        <table width="388" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="194" style="padding-top:12px;"><p class="chck">
                                                                        <label>
                                                                            <input type="checkbox" value="351486" name="pref[]" style="width:13px; height:17px;"  />
                                                                            &nbsp;&nbsp;Evans &amp; Tate</label>
                                                                    </p></td>
                                                                <td width="194" align="left" valign="top"><p class="chck" style="clear:left;">
                                                                        <label>
                                                                            <input type="checkbox" value="351484" name="pref[]" style="width:13px; height:17px;" />
                                                                            &nbsp;&nbsp;Brands Laira</label>
                                                                    </p></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="194" align="left" valign="top" style="padding-top:12px;"><p class="chck">
                                                                        <label>
                                                                            <input type="checkbox" value="351487" name="pref[]" style="width:13px;height:17px;" />
                                                                            &nbsp;&nbsp;McWilliam's Wines</label>
                                                                    </p></td>
                                                                <td width="194" align="left" valign="top"><p class="chck">
                                                                        <label>
                                                                            <input value="351488" type="checkbox" name="pref[]" style="width:13px; height:17px;" />
                                                                            &nbsp;&nbsp;Mount Pleasant</label>
                                                                    </p></td>
                                                            </tr>
                                                        </table>
                                                    </div></td>
                                            </tr>
<!--                                            <tr>
                                                <td colspan="2"><div class="checkboxes-bg m-top">
                                                        <p>For online shopping and discounts automatically join :</p>
                                                        <table cellspacing="0" cellpadding="0" border="0" width="388">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="left" width="194" valign="top" style="padding-top:12px;"><p class="chck">
                                                                            <label>
                                                                                <span><span ><input value="351485" type="checkbox" style="width:13px;height:17px;" name="pref[]"><span class="chck"></span></span><span class="chck"></span></span>
                                                                                &nbsp;&nbsp;Online CellarDoor</label>
                                                                        </p></td>

                                                                </tr>
                                                            </tbody></table>
                                                    </div></td>
                                            </tr>-->
                                            <tr><td><?php echo $this->session->flashdata('msg'); ?></td></tr>
                                        </table>
                                        <div class="reg-form-submit">
                                            <div class="reg-form-submit-wrap">
                                                <p>
                                                    <input type="hidden" name="frmSub" value="submitted" />
                                                    <input type="submit" value="Submit" id="sub" class="submit"  />
                                                </p>
                                                <p style="margin-top:8px;">* You must be of legal drinking age in your country to join.</p>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <div id="footer-social-bg">
                    <div id="footer-social-icons">
                        <p>Want to stay in touch more often? Follow us on</p>
                        <p class="mtop"><a href="https://www.facebook.com/BrandsLaira" title="Facebook" class="mright" target="_blank"><img src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/McWilliams_0224_01.png" alt="Facebook" title="Facebook"  class="social-icon-resize" /></a><a href="https://twitter.com/brandslaira" title="Follow us on Twitter" class="mright" target="_blank"><img src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/McWilliams_0224_02.png" title="Twitter" alt="Twitter" class="social-icon-resize" /></a><a href="http://instagram.com/brandslaira" title="Instagram" target="_blank"><img src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/McWilliams_0224_03.png" title="Instagram" alt="Instagram" class="social-icon-resize" /></a></p>
                    </div>
                </div>
                <div id="footer-copy-bg">
                    <div id="footer-copy-text">
                        <p>Full privacy policy can be found at <a href="http://www.brandslaira.com.au/" title="www.brandslaira.com.au" target="_blank">www.brandslaira.com.au</a></p>
                        <p style="margin-top:10px;">&copy; McWilliam's Wines 2014. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/custom-javascript.js" type="text/javascript"></script>
    </body>
</html>