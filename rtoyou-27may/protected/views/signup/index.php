<?php
    $this->_activeMenu = 'signup/index';
?>
<style>
#content {
   position: relative;
   background: url("templates/default/images/photodune-186709-residential-street-m.jpg") repeat scroll 0 0;
}
 
#color-overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: black;
   opacity: 0.6;
}
ul.wiz-progress li{color:#fff;}
#content h1{color:#fff;}
</style>
<div class="st-pusher login">
            <!-- sidebar effects INSIDE of st-pusher: -->
            <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
            <!-- this is the wrapper for the content -->
             <div class="st-content" id="content">
		<div id="color-overlay"></div>
                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner">
                    <div class="container-fluid">
                        
                        <div class="page-section">
                            <div class="row">
                                <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
					<div class="jumbotron text-center bg-transparent margin-none">
                            <h1>SignUp</h1>
                        </div>
                                    <div class="wizard-container wizard-1" id="wizard-demo-1">
                                    <form id="registration" action="signup/insert" data-toggle="wizard" class="max-width-400  h-center" method="post" >
                                        <div data-scrollable-h>
                                            <ul class="wiz-progress">
                                                <li class="active">Account Setup</li>
                                                <li>Personal Details</li>
                                            </ul>
                                        </div>
                                        <?php 
 echo $actionMessage; 
 ?>
                                        
                                        
                                            <fieldset  id="active">
                                                <div class="page-section-heading">
                                                    <h2 class="text-h3 margin-v-0">Create your account</h2>
                                                    <h3 class="text-h4 margin-v-10 text-grey-400">First Step to Dive in ... </h3>
                                                </div>
                                                <!--
                                                <div class="alert alert-info">
						                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">�</span><span class="sr-only">Close</span>
						                            </button>
						                              Invalid User or Password 
						                        </div> -->
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-email">Email:</label>
                                                    <input class="form-control" type="text" id="email" placeholder="Email" name="emailid" value="<?php echo $emailid;?>"/>
                                                    
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-password">Password:</label>
                                                    <input class="form-control" type="password" id="password1" placeholder="Password" name="password" />
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-password2">Confirm Password:</label>
                                                    <input class="form-control" type="password" id="password2" placeholder="Confirm Password" name="cpassword" />
                                                </div>
                                                <button type="button" class="btn btn-primary" id="btn1">Next</button>
						<button type="button" class="wiz-next" style="display:none;"></button>
                                            </fieldset>
                                            <!--<fieldset class="step" >
                                                <div class="page-section-heading">
                                                    <h2 class="text-h3 margin-v-0">Social Profiles</h2>
                                                    <h3 class="text-h4 margin-v-10 text-grey-400">Your presence on social networks</h3>
                                                </div>
                                                <!--  
                                                <div class="alert alert-danger">
						                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">�</span><span class="sr-only">Close</span>
						                            </button>
						                            Invalid User or Password
						                        </div>

                                                <div class="form-group form-control-default">
                                                    <label for="wiz-twitter">Twitter:</label>
                                                    <input class="form-control" type="text" id="wiz-twitter" placeholder="Twitter" name="twitter" />
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-facebook">Facebook:</label>
                                                    <input class="form-control" type="text" id="wiz-facebook" placeholder="Facebook" name="facebook" />
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-gplus">Google Plus:</label>
                                                    <input class="form-control" type="text" id="wiz-gplus" placeholder="Google Plus" name="google" />
                                                </div>
                                                <button type="button" class="wiz-prev btn btn-default">Previous</button>
                                                <button type="button" class="wiz-next btn btn-primary">Next</button>
                                            </fieldset> -->
                                            <fieldset>
                                                <div class="page-section-heading">
                                                    <h2 class="text-h3 margin-v-0">Personal Details</h2>
                                                    <h3 class="text-h4 margin-v-10 text-grey-400">Your personal details are safe with us</h3>
                                                </div>
                                                <!--  
                                                <div class="alert alert-success">
						                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">�</span><span class="sr-only">Close</span>
						                            </button>
						                            You have successfully joined. <br/>Please verify email to enjoy full features.
						                        </div>
						                        -->
                                                <div class="form-group form-control-default">
                                                    <label for="Name">Name:</label>
                                                    <input class="form-control" type="text" id="wiz-fname" placeholder="Name" name="name" maxlength="60"  value="<?php echo $name;?>"/>
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-lname">Gender:</label>
                                                     <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" value="Male" name="gender">
                                                <label for="inlineRadio1">Male</label>
                                            </div>
                                                <div class="radio radio-female radio-inline">
                                                <input type="radio" id="inlineRadio2" value="Female" name="gender" >
                                                <label for="inlineRadio2">Female</label>
                                            </div> 
                                              
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-phone">Birthday(optional):</label><span>(age min 13)</span>
                                                    <input class="form-control datepicker" type="text" id="bday" placeholder="Birthday" name="bday"  readonly/>
							
                                                </div>
                                               
                                               <button type="button" class="wiz-prev btn btn-default">Previous</button>
                                                
                                                <button type="button" class="btn btn-primary join-now" value='submit' name="register">Join Now</button>
						<input type="hidden" value='submit' name="register"/>
                                            </fieldset>
                                            <input type="hidden" name="<?php echo CHttpRequest::init()->getCsrfTokenKey();?>" value="<?php echo CHttpRequest::init()->getCsrfTokenValue();?>" />
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /st-content-inner -->
            </div>
            <!-- /st-content -->
        </div>
        
        
      <!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
         <script type="text/javascript">

         $(document).ready(function(){
        	    $("#btn1").click(function(event){
        	    	var x =$("#email").attr("class");
        	    	
        	    	x = x.replace(/\s/g,'');
        	    	
        	    	if(x!="form-controlLV_valid_field"){
            	    	
        	    		event.preventDefault();
        	    	}
        	    	
        	    });
        	});
        	
</script>

-->
<script>

</script>
