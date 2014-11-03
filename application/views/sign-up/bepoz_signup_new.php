<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <!-- Define Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- Responsive Meta Tag -->
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sky-forms.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sky-forms-red.css">
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="css/sky-forms-ie8.css">
        <![endif]-->

        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>		
        <!--[if lt IE 10]>
                <script src="js/jquery.placeholder.min.js"></script>
        <![endif]-->		
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <script src="js/sky-forms-ie8.js"></script>
        <![endif]-->

        <!-- Facebook sharing information tags -->
        <link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Copse|Pathway+Gothic+One|Roboto+Slab' rel='stylesheet' type='text/css'>
    <custom name="opencounter" type="tracking">
        <style type="text/css">
            @media only screen and (max-width: 900px) {
                td[class=headerBG] {
                    width: 100%!important;
                    background-repeat: no-repeat!important;
                    background-size: 1100px!important;
                    background-position: center center !important;

                }
            }
            @media only screen and (max-width: 640px) {
                body {
                    width:auto!important;
                }
                /* Box Wrap */
                .BoxWrap {
                    width:440px !important;
                }
                /* Show/Hide  */
                .RespoHideMedium {
                    display:none !important;
                }
                .RespoShowMedium {
                    display:block !important;
                }
                .RespoCenterMedium {
                    text-align:center !important;
                }
                .RespoTitle {
                    font-size: 16px !important
                }
                td[class=headerBG] {
                    width: 100%!important;
                    background-repeat: no-repeat!important;
                    background-size: 1100px!important;
                    background-position: center center !important;
                }

                img[class=RespoImage_OneTo50W],img[class=RespoImage_OneTo50]	 	 { width: 440px!important; height: 212px!important; }
                img[class=RespoImage_OneTo50_P_W],img[class=RespoImage_OneTo50_P]	 { width: 400px!important; height: 193px!important; }
                img[class=RespoImage_OneTo75W],img[class=RespoImage_OneTo75] 		 { width: 440px!important; height: 335px!important; }
                img[class=RespoImage_OneTo75x2W],img[class=RespoImage_OneTo75x2] 	 { width: 210px!important; height: 160px!important; }
                img[class=RespoImage_OneToOneW],img[class=RespoImage_OneToOne] 	 { width: 440px!important; height: 440px!important; }
                img[class=RespoImage_70ToOneW],img[class=RespoImage_70ToOne] 	 	 { width: 440px!important; height: 628px!important; }
                img[class=AvatarW],img[class=Avatar] 						   	 	 { width: 50px!important; height: 50px!important; }
                img[class=RespoImage_Bottle_Tall_W],img[class=RespoImage_Bottle_Tall] { width: 300px!important; height: 600px!important; padding-left:17%!important;  }


                /* Phone Mockup */
                img[class=RespoImage_phone600W],img[class=RespoImage_phone600] 	 { width: 440px!important; height: auto!important; }
                img[class=RespoImage_phone186W],img[class=RespoImage_phone186] 	 { width: 136px!important; height: 183px!important; }
                img[class=RespoImage_phone165W],img[class=RespoImage_phone165] 	 { width: 121px!important; height: 183px!important; }
                img[class=RespoImage_phone249W],img[class=RespoImage_phone249] 	 { width: 183px!important; height: 183px!important; }
            }
            @media only screen and (max-width: 479px) {
                body {
                    width:auto!important;
                }
                /* Box Wrap */
                .BoxWrap {
                    width:280px !important;
                }
                /* Hide  */
                .RespoHideSmall {
                    display:none !important;
                }
                .RespoCenterSmall {
                    text-align:center !important;
                }
                .RespoTitle {
                    font-size: 14px !important
                }
                img[class=RespoImage_OneTo50W],img[class=RespoImage_OneTo50]	 	 { width: 280px!important; height: 135px!important; }
                img[class=RespoImage_OneTo50_P_W],img[class=RespoImage_OneTo50_P]	 { width: 240px!important; height: 116px!important; }
                img[class=RespoImage_OneTo75W],img[class=RespoImage_OneTo75] 		 { width: 280px!important; height: 213px!important; }
                img[class=RespoImage_OneTo75x2W],img[class=RespoImage_OneTo75x2] 	 { width: 130px!important; height: 100px!important; }
                img[class=RespoImage_OneToOneW],img[class=RespoImage_OneToOne] 	 { width: 280px!important; height: 280px!important; }
                img[class=RespoImage_70ToOneW],img[class=RespoImage_70ToOne] 		 { width: 280px!important; height: 400px!important; }
                img[class=AvatarW],img[class=Avatar] 						   	 	 { width: 40px!important; height: 40px!important; }
                img[class=RespoImage_Bottle_Tall_W],img[class=RespoImage_Bottle_Tall] { width: 280px!important; height: 560px!important; padding-left:1%!important;}


                /* Phone Mockup */
                img[class=RespoImage_phone600W],img[class=RespoImage_phone600] 	 { width: 280px!important; height: auto!important; }
                img[class=RespoImage_phone186W],img[class=RespoImage_phone186] 	 { width: 87px!important; height: 117px!important; }
                img[class=RespoImage_phone165W],img[class=RespoImage_phone165] 	 { width: 77px!important; height: 117px!important; }
                img[class=RespoImage_phone249W],img[class=RespoImage_phone249] 	 { width: 117px!important; height: 117px!important; }
            }
            .appleLinks a {color:#000000 !important;}
            .appleLinksWhite a {color:#ffffff !important;}
            .appleLinksWhiteNoUnderline a {color: #ffffff !important; text-decoration: none;}
            .appleLinksBlackNoUnderline a {color: #000000 !important; text-decoration: none;}

            .bg-red {
                background-image: none;
            }
        </style>


    </head>
    <body style="width: 100%;background-color: #ffffff;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;text-align: left;">
        <table width="100%" class="BackgroundColor01" bgcolor="#b3123b" cellpadding="0" cellspacing="0" border="0" backgroundcolor01="">
            <tbody>
                <tr>
                    <td style="-webkit-text-size-adjust: none;">
                        <table class="BoxWrap" width="600" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="100%" height="20" vspace="" style="-webkit-text-size-adjust: none;"></td>
                                </tr>
                                <tr>
                                    <td class="Title" style="text-align: center;-webkit-text-size-adjust: none;font-family: 'Roboto Condensed', sans-serif;font-size: 24px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 34px;">
                                        <span>20% OFF YOUR PURCHASE</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="100%" height="20" style="-webkit-text-size-adjust: none;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>


        <!-- Begin Module: Key Visual  -->
        <table width="100%" class="BackgroundColor03" bgcolor="#000000" background="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/bottles_dark_1280x464.jpg" cellpadding="0" cellspacing="0" border="0" backgroundcolor03="" bgimage="">
            <tbody>
                <tr>
                    <td width="100%" valign="top" style="background-image: url(http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/bottles_dark_1280x464.jpg);background-size: 100% auto;background-position: center center;-webkit-text-size-adjust: none;" class="headerBG" bgimage="">

                        <!--[if gte mso 9]>
<v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:976;">
<v:fill type="tile" src="http://image.s6.exacttarget.com/lib/fe9212727767057b7c/m/1/bottles_dark_1280x464.jpg" color="#ffffff" />
<v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
<![endif]-->
                        <div>

                            <table class="BoxWrap" width="600" align="center" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td width="100%" height="40" vspace="" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>

                                    <tr>
                                        <td class="Caption" style="text-align: center;-webkit-text-size-adjust: none;font-family: 'Roboto Condensed', sans-serif;font-size:18px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 34px;" >
                                            <span>Free Membership to McWilliams Online Cellar </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="10" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>
                                    <tr>
                                        <td class="Caption" style="text-align: center;-webkit-text-size-adjust: none;font-family: 'Roboto Condensed', sans-serif;font-size: 48px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 34px;" >
                                            <span>Get 20% Off Right Now</span>
                                        </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td height="10" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>
                                    <tr>
                                        <td class="Caption" style="text-align: center;-webkit-text-size-adjust: none;font-family: 'Roboto Condensed', sans-serif;font-size:20px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 34px;" >
                                            <span>Plus secret deals, members discounts and special offers </span>
                                        </td>
                                    </tr>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td height="20" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>

                                    <tr>

                                        <td class="emphasis-text" style="text-align:center;-webkit-text-size-adjust: none;font-family: Arial, sans-serif;font-size: 14px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 24px;">
                                            <span>Simply fill in your details below and when you make your purchase remember to say your name to receive your 20% discount.</span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td height="30" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>
                             <!--	<tr>
                                            <td width="100%" align="center" style="-webkit-text-size-adjust: none;">
                                                    <table class="EmphasisBackgroundColor btn-style" bgcolor="#b3123b" cellpadding="10" cellspacing="0" style="border-radius: 2px;border: none;moz-border-radius: 5px;" radius="" emphasisbg="">
                                                            <tbody>
                                                                    <tr>
                                                                            <td style="-webkit-text-size-adjust: none;">&nbsp; </td>
                                                                            <td class="emphasis-text" style="text-align: center;color: #ffffff;vertical-align: middle;-webkit-text-size-adjust: none;font-family: Arial, sans-serif;font-size: 14px;font-weight: normal;font-style: normal;text-transform: capitalize;line-height: 24px;">
                                                                                    <span style="color:#ffffff;"><a href="http://www.mcwilliamscellar.com.au/" style="text-align: center;color: #ffffff;-webkit-text-size-adjust: none;text-decoration: none;">Shop Now</a></span>
                                                                            </td>
                                                                            <td style="-webkit-text-size-adjust: none;">&nbsp; </td>
                                                                    </tr>
                                                            </tbody>
                                                    </table>
                                            </td>
                                    </tr>-->
                                    <tr>
                                        <td width="100%" height="20" vspace="" style="-webkit-text-size-adjust: none;"></td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <!--[if gte mso 9]>
                          </v:textbox>
                        </v:rect>
                        <![endif]-->
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End Module: Key Visual  -->
        <div class="bg-red">
            <div class="body body-m">	

                <form id="sky-form" class="sky-form" action="<?php echo base_url(); ?>index.php/login/createbpoz" method="post">
                    <header>New User</header>

                    <fieldset>					
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="customer_firstname_name" required="" maxlength="30" name="firstname"  placeholder="First name">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-user"></i>
                                    <input type="text" id="customer_last_name" required="" maxlength="30" name="lastname"  placeholder="Last name">
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-envelope"></i>
                                    <input  id="customer_email" required="" maxlength="100" name="email" type="email" value="" placeholder="E-mail">
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <i class="icon-append fa fa-phone"></i>
                                    <input type="tel" id="customer_phone_number" required="" maxlength="30" name="mobile_number" placeholder="Phone">
                                </label>
                            </section>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <section class="col col-6 right">


                                <label class="input"><div class="col col-10" style="color: lightgrey;font-weight: bold;padding-top: 8px;font-size: 14px;text-align: right">Date Of Birth</div><i style=" border-left-style: ridge;" class="icon-append fa fa-calendar"></i></label>



                            </section>


                            <section class="col col-2">
                                <label class="input">
                                    <input required="" id="user_date_of_birth_1i" name="birthDay" type="text" placeholder="DD">
                                </label>
                            </section>
                            <div style="color: lightgrey; float: left; font-size: 22px; font-weight: bold; position: relative; width: 0;">/</div>
                            <section class="col col-2">
                                <label class="input">
                                    <input required="" id="user_date_of_birth_2i" name="birthMonth" type="text" placeholder="MM">
                                </label>
                            </section>
                            <div style="color: lightgrey; float: left; font-size: 22px; font-weight: bold; position: relative; width: 0;">/</div>
                            <section class="col col-2">
                                <label class="input">
                                    <input required="" id="customer_date_of_birth_3i" name="birthYear" type="text" placeholder="YYYY">
                                </label>
                            </section>
                        </div>
                    </fieldset>
          
                    <fieldset>
                        <div class="row">
                            <section class="col col-12">
                                <label class="input">
                                    <h3>Join our Mailing Lists</h3>
                                    <p>Be the 'first-to-know' about our exclusive wine offers and news of your favourite wine brands.</p>
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <section class="col col-6">
                                <label class="checkbox"><input type="checkbox" name="subscription" id="subscription"><i></i>Select All Mailing Lists</label>
                            </section>
                        </div>
                        <div class="row">
                            <section class="col col-6">
                                <label class="checkbox">
                                    <input class="checked" id="_subscribed_listslist_id_69" name="pref[]" type="checkbox" <?php if($form == 'Evans'){?> checked <?php } ?> value="351486">
                                    <i></i>Evans &amp; Tate
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="checkbox">
                                    <input class="checked" id="_subscribed_listslist_id_74" name="pref[]" type="checkbox" <?php if($form == 'Mount'){?> checked <?php } ?> value="351488">
                                    <i></i>Mount Pleasant
                                </label>
                            </section>

                            <section class="col col-6">
                                <label class="checkbox">
                                    <input class="checked" id="_subscribed_listslist_id_94" name="pref[]" type="checkbox" <?php if($form == 'McWilliam'){?> checked <?php } ?> value="351487">
                                    <i></i>McWilliam's Wines
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="checkbox">
                                    <input class="checked" id="_subscribed_listslist_id_68" name="pref[]" type="checkbox" <?php if($form == 'Brands'){?> checked <?php } ?> value="351484">
                                    <i></i>Brand's Laira
                                </label>
                            </section>
<!--                                  <section class="col col-6">
                               <label class="checkbox">
                                    <input id="_subscribed_listslist_id_141" name="pref[]" type="checkbox" value="351485">
                                    <i></i>McWilliam's Cellar Door
                                </label>
                            </section>-->
                        </div>
                    </fieldset>



                    <fieldset>
                        <div class="row">

                            <section class="col col-10">
                                <label class="checkbox" for="customer_terms_of_service" >

                                    <input required="" id="customer_terms_of_service" name="agree" type="checkbox" value="1" />
                                    <i class="check"></i>
                                    I agree with the Terms and Condition <abbr title="required">*</abbr>
                                </label>
                            </section>
                            <section class="col col-2">
                                <input type="submit" class="button" value="Continue" > 
                            </section>
                        </div>
                    </fieldset>
                </form>			

            </div>
        </div>
        <!-- Begin Module: Title -->

        <!-- End Module: Title -->
        <table width="100%" class="BackgroundColor01" bgcolor="#b3123b" cellpadding="0" cellspacing="0" border="0" backgroundcolor01="">
            <tbody>
                <tr>
                    <td style="-webkit-text-size-adjust: none;">
                        <table class="BoxWrap" width="600" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td width="100%" height="20" vspace="" style="-webkit-text-size-adjust: none;"></td>
                                </tr>
                                <tr>
                                    <td class="Title" style="text-align: center;-webkit-text-size-adjust: none;font-family: 'Roboto Condensed', sans-serif;font-size: 24px;font-weight: normal;font-style: normal;text-transform: capitalize;color: #ffffff;line-height: 34px;">
                                        <span>20% OFF YOUR PURCHASE</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="100%" height="20" style="-webkit-text-size-adjust: none;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>



    </body>
    <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
                <script type="text/javascript">
                    
                   
                    $("#subscription").change(function() {
                        if(($(this).is(':checked'))){
                            $('.checked').prop('checked', true);
                        }
                        else{
                            $('.checked').prop('checked', false);
                        }
                     });
                    $.validator.addMethod("lessThan",

                            function (value, element, param) {
                              var $min = $(param);
                             
                              return parseInt(value) < 13
                                    
                            }, "Please enter valid month");
                            

            $(function ()
            {
// Validation		
                $("#sky-form").validate(
                        {
                            // Rules for form validation
                 
                            rules:
                                    {
                                        username:
                                                {
                                                    required: true
                                                },
                                        email:
                                                {
                                                    required: true,
                                                    email: true
                                                },
                                        password:
                                                {
                                                    required: true,
                                                    minlength: 8
                                                },
                                        birthMonth:
                                        {
                                                    required: true,
                                                    lessThan : '#birthMonth'
                                                },       
                                        password_confirmation:
                                                {
                                                    required: true,
                                                    minlength: 8,
                                                    equalTo: '#customer_password'
                                                },
                                        firstname:
                                                {
                                                    required: true
                                                },
                                        lastname:
                                                {
                                                    required: true
                                                },
                                        agree:
                                                {
                                                    required: true
                                                }
                                    },
                            // Messages for form validation
                            messages:
                                    {
                                        login:
                                                {
                                                    required: 'Please enter your login'
                                                },
                                        email:
                                                {
                                                    required: 'Please enter your email address',
                                                    email: 'Please enter a VALID email address'
                                                },
                                        password:
                                                {
                                                    required: 'Please enter your password'
                                                },
                                        password_confirmation:
                                                {
                                                    required: 'Please enter your password one more time',
                                                    equalTo: 'Please enter the same password as above'
                                                },
                                        firstname:
                                                {
                                                    required: 'Please select your first name'
                                                },
                                        lastname:
                                                {
                                                    required: 'Please select your last name'
                                                },
                                        agree:
                                                {
                                                    required: 'You must agree with Terms and Conditions'
                                                }
                                    },
                            // Do not change code below
                            errorPlacement: function (error, element)
                            {
                                error.insertAfter(element.parent());
                            }
                        });
            });
        </script>
</html>