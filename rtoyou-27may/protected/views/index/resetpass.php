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
							<form action="index/resetpass" class="max-width-400 h-center"
								method="POST" id="resetpass_form" name="resetpass_form">

								<div class="panel panel-default">
									<div class="panel-heading">Reset Password</div>
									<div class="panel-body">
										<div class="form-group form-control-default">
											<label for="new-password">New Password</label> <input
												class="form-control" type="password" id="new"
												placeholder="New Password" name="newpassword" required/>

										</div>
										<div class="form-group form-control-default">
											<label for="new-password">Confirm Password</label> <input
												class="form-control" type="password" id="new"
												placeholder="Confirm Password" name="confirm" required />
										</div>
										<div class="form-group pull-right">
											<input type="hidden" name="change"/>
											<button type="button" class="btn btn-primary" name="change"  onclick="javascript:submitResetPassForm();">Reset</button>
											<a href="index/index" class="btn btn-primary">cancel</a>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /st-content-inner -->
	</div>
	<!-- /st-content -->
</div>
