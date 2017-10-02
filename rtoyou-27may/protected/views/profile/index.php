<div
	class="st-pusher">
	<!-- sidebar effects INSIDE of st-pusher: -->
	<!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
	<!-- this is the wrapper for the content -->
	<div class="st-content">
		<!-- extra div for emulating position:fixed of the menu -->
		<div class="st-content-inner" id="content">
			<div class="container-fluid">
				<div class="media media-grid media-clearfix-xs">
					<div class="media-left">
						<div class="width-250 width-auto-xs">

							<div
								class="panel panel-default widget-user-1 text-center ribbon-wrapper ribbon-corner-wrapper">
								<div class="ribbon-corner left">
									<a href="javascript:void(0);" title="Silver star User">RtoYou</a>
								</div>
								<?php $val = $detail[0] ; ?>
								<div class="avatar">
									<input type="hidden"
										   value="/RtoyouImages/profile/<?php echo $val['user_image'];?>"
										   id="profile_pic" />
									<img
										src='/RtoyouImages/profile/<?php echo $val['user_image'];?>'
										alt="" class="img-circle profile-pic" width="140" height="140"> <br /> <span
										class="btn btn-primary fileinput-button"> <i
											class="fa fa-camera"></i> <span>Browse Photo</span> <!-- The file input field used as target for the file upload widget -->
										<input id="file-3" type="file" name="photoimg">
									</span>

									<h3>
										<?php echo $val['user_name'];?>
									</h3>

								</div>
								<div class="profile-icons margin-none">
									<span>Reviews <a href="javascript:void(0);"><?php echo $totalReviews;?></a>
									</span>

								</div>
								<div class="panel-body">
									<div
										class="expandable expandable-indicator-white expandable-trigger">
										<div class="expandable-content">
											<?php
											$aboutPara = SiteUtil::getAboutContent($val['user_about']);
											echo $aboutPara['text'] ;
											?>

										</div>
									</div>
								</div>
							</div>
							<!-- Contact -->
							<div class="panel panel-default">
								<div class="panel-heading">Contact</div>
								<ul class="icon-list icon-list-block">
									<li><i class="fa fa-envelope fa-fw"></i> <span style="display:inline;"><?php echo $val['user_email'];?>
										</span>
									</li>
									<?php if(!empty($val['facebook_link'])){ ?>
										<li><i class="fa fa-facebook fa-fw"></i> <a
												href="<?php echo $val['facebook_link'];?>" target="_new">/facebook</a>
										</li>
									<?php }?>
									<?php if(!empty($val['twitter_link'])){ ?>
										<li><i class="fa fa-twitter fa-fw"></i> <a href="<?php echo $val['twitter_link'];?>" target="_new">/twitter</a>
										</li>
									<?php }?>
									<?php if(!empty($val['user_google_profile'])){ ?>
										<li><i class="fa fa-google fa-fw"></i> <a href="<?php echo $val['user_google_profile'];?>" target="_new">/google</a>
										</li>
									<?php }?>
									<?php if(!empty($val['user_instagram_profile'])){ ?>
										<li><i class="fa fa-instagram fa-fw"></i> <a href="<?php echo $val['user_instagram_profile'];?>" target="_new">/insta</a>
										</li>
									<?php }?>
								</ul>
							</div>
						</div>
					</div>
					<div class="media-body">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<?php echo $actionMessage; ?>
									<div class="panel-heading panel-heading-gray">

										<i class="fa fa-fw fa-info-circle"></i> About
									</div>
									<div class="panel-body">
										<form class="form-horizontal" role="form"
											  action="profile/update" method="POST" id="update-profile">
											<div class="form-group">

												<label for="inputEmail3" class="col-sm-3 control-label"  style="text-align:left;">Name</label>

												<div class="col-sm-9">
													<input type="text" class="form-control" id="pname"
														   name="pname" placeholder="Write your Name here ..."
														   value='<?php echo  $val['user_name']; ?>' required maxlength="50">
												</div>

											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" style="text-align:left;">Gender</label>
												<div class="col-sm-9">
													<div class="radio radio-info radio-inline">
														<input type="radio" id="inlineRadio1" value="Male"
															   name="gender"
															<?php if(strtolower($val['user_gender'])==="male"){ ?>
																checked <?php } ?>> <label for="inlineRadio1">Male</label>
													</div>
													<div class="radio radio-female radio-inline">
														<input type="radio" id="inlineRadio2" value="Female"
															   name="gender"
															<?php if(strtolower($val['user_gender'])==="female"){ ?>
																checked <?php } ?>> <label for="inlineRadio2">Female</label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label"  style="text-align:left;">Birthday</label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-calendar"></i>
														</span> <input id="bday" type="text"
																	   class="form-control datepicker" name="bday"
																	   value="<?php echo  $val['user_dob'] ? date("d/m/Y", strtotime($val['user_dob'])) : "Select DOB"; ?>"
																	   readonly="readonly" required>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label"  style="text-align:left;">About</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="5" name="about" placeholder="Describe yourself ... " maxlength="360"><?php echo  $val['user_about']; ?></textarea>
<span class="text-danger">Summarize yourself in brief below 360 characters</span>
												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-3 control-label"  style="text-align:left;">Lives in</label>
												<div class="col-sm-9">
													<select class="selectpicker" data-style="btn-white"
															data-live-search="true" data-size="5"
															style="display: none;" name="country">
														<option value="">--Select Location--</option>
														<?php foreach($countries as $country) {  ?>
															<option value="<?php echo $country['nameImage'];?>" <?php echo $country['nameImage'] === $val['user_location'] ? 'selected' : '' ;?>><?php echo $country['nameImage'];?></option>

														<?php }?>

													</select>
												</div>
											</div>

									</div>
								</div>
							</div>

						</div>
						<div class="panel panel-default">
							<div class="panel-heading panel-heading-gray">
								<i class="fa fa-bookmark"></i> Find me on
							</div>
							<div class="panel-body">
								<div class="row">
									<form class="form-horizontal" role="form">
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
											<div class="input-group col-sm-9">
												<span class="input-group-addon"><i class="fa fa-envelope"></i>
												</span> <input type="email" disabled class="form-control"
															   id="inputEmail3" name="email"
															   value="<?php echo $val['user_email'];?>">
											</div>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Facebook</label>
											<div class="input-group col-sm-9">
												<span class="input-group-addon"><i class="fa fa-facebook"></i>
												</span> <input type="text" class="form-control"
															   placeholder="Your Facebook Profile ..." name="facebook" id="facebook"
															   value=<?php echo  $val['facebook_link']; ?>>
											</div>

										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Twitter</label>
											<div class="input-group col-sm-9">
												<span class="input-group-addon"><i class="fa fa-twitter"></i>
												</span> <input type="text" class="form-control"
															   placeholder="Your Twitter Profile..." name="twitter" id="twitter"
															   value="<?php echo  $val['twitter_link']; ?>">
											</div>

										</div>

										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Instagram</label>
											<div class="input-group col-sm-9">
												<span class="input-group-addon"><i class="fa fa-instagram"></i>
												</span> <input type="text" class="form-control"
															   placeholder="Your Instagram Profile..." name="instagram" id="instagram"  value="<?php echo  $val['user_instagram_profile']; ?>">
											</div>

										</div>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-3 control-label">Contact</label>
											<div class="input-group col-sm-9">
												<span class="input-group-addon"><i class="fa fa-phone"></i>
												</span> <input type="text" class="form-control"
															   placeholder="your contact no." name="contact"
															   value="<?php echo  $val['user_contact_number']; ?>" id="contact"> 
											</div>

										</div>

										<div class="form-group margin-none">
											<div class="col-sm-offset-3 col-sm-9">
												<input type="hidden" name="update" value="submit"/>
												<button type="button" class="btn btn-primary update-profile" name="update"
														value="submit">Update</button>
											</div>
										</div>
									</form>
									<?php //} ?>
								</div>
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
<!-- /st-pusher -->



