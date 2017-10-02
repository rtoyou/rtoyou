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
</style>
<div class="st-pusher">
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
                                    <div class="wizard-container wizard-1" id="wizard-demo-1">
                                        
                                       
                                        <form action="password/changepwd" name="changePasswordForm" id="changePasswordForm" data-toggle="wizard" class="max-width-400 h-center" method="POST" >
                                            <fieldset class="step">
                                                <div class="page-section-heading">
                                                    <h2 class="text-h3 margin-v-0">Change Your Password</h2>
                                                    
                                                </div>
                                                 <?php echo $actionMessage; ?>
                                               
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-email">Old Password:</label>
                                                    <input class="form-control" type="password" id="oldpassword" placeholder="Old Password" name="oldpassword" />
                                                    
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-password">New Password:</label>
                                                    <input class="form-control" type="password" id="password1" placeholder="Password" name="password" />
                                                </div>
                                                <div class="form-group form-control-default">
                                                    <label for="wiz-password2">Confirm Password:</label>
                                                    <input class="form-control" type="password" id="password2" placeholder="Confirm Password" name="cpassword"/>
                                                </div>
                                                
                                                 <input type="hidden"  value='submit' name="change"/>
                                                 <button type="button" class="btn btn-primary change-password" >Submit</button>
                                                 <button type="button" class="btn btn-default" onclick="window.location.href='home'">Cancel</button>
                                            </fieldset>
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
        
