<style>
.file-caption-name { width : 80px !important;}
</style>

<div class="st-pusher">
	<!-- sidebar effects INSIDE of st-pusher: -->
	<!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
	<!-- this is the wrapper for the content -->
	<div class="st-content">
		<!-- extra div for emulating position:fixed of the menu -->
		<div class="st-content-inner padding-top-none" id="content"
			tabindex="2" style="overflow-y: hidden; outline: none;">
			<nav class="navbar navbar-default navbar-static-top"
				style="z-index: 1;">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="toggle pull-right margin-none visible-xs"
							data-toggle="collapse" href="#navbar"><i
							class="fa fa-sliders fa-rotate-90"></i>
						</a>
					</div>
					<!--<div id="navbar" class="navbar-collapse collapse">
						<div class="navbar-right">
							<div class="navbar-text">Sort by:</div>
							<ul class="nav navbar-nav">
								<li class="dropdown"><a href="#" class="dropdown-toggle"
									data-toggle="dropdown"> Date Reviewed <span class="caret"></span>
										<span class="sr-only">(current)</span>
								</a>
									<ul class="dropdown-menu">
										<li class="active"><a href="javascript:filter(0);">Latest</a></li>
										<li><a href="javascript:filter(1);">Most Comments</a></li>
										<li><a href="javascript:filter(4);">Most Loved</a></li>
										<li><a href="javascript:filter(2);">Ratings -High</a></li>
										<li><a href="javascript:filter(3);">Rating - Low</a></li>
									</ul></li>
							</ul>
						</div>
					</div>-->
				</div>
			</nav>
			<div class="container-fluid listing-box">
				<h1 class="text-h3">
					<?php echo $categoryname;?>
				</h1>
				<div class="row gridalicious" data-toggle="gridalicious"
					data-width=200>
					<?php 
					$classCss = array(
							0=>'bg-blue-grey-400',
							1=>'bg-purple-300',
							2=>'bg-green-400',
							3=>'bg-deep-orange-400',
							4=>'bg-cyan-400',
							5=>'bg-pink-400',
							6=>'bg-deep-purple-400',
							7=>'bg-amber-400',
							8=>'bg-google-material-brown-400',
9=>'bg-google-material-pink-400',
10=>'bg-google-material-purple-400',
11=>'bg-google-material-lgblue-400',
12=>'bg-google-material-skyblue-400',
13=>'bg-google-material-green-400',
14=>'bg-google-material-lggreen-400',
15=>'bg-google-material-lgred-400',
16=>'bg-google-material-purple-400'
					);
					foreach ($list as $key=>$value){

$hideiMage=false;?>
					<div class="panel panel-default"
						style="margin-bottom: 15px; zoom: 1; opacity: 1;">
						<div class="cover overlay hover cover-image-full"
							style="height: 209px;">
							<?php if(strlen($value['subcat_image']) > 0 ){ 
$hideiMage = false;?>
							<img src="<?php echo SiteUtil::getSubcategoryImage($value['subcat_image']);?>" alt="<?php echo $value['subcat_image'];?>"
								style="width: 100%; height: 100%; display: block; margin-left: auto; margin-right: auto;" onerror="this.src='templates/default/images/noimage.png'">
							<?php }?>
							<div
								class="overlay overlay-full overlay-full <?php echo  !$hideiMage ? 'overlay-bg-black' : $classCss[rand(0,16)];?>"
								style="height: 209px;">
								<div class="v-top">
									<?php echo SiteUtil::getStarHTML(floor($value['avg'])); ?>
								</div>
								<div class="v-center">
										<h4 class="text-h4" style="font-size:12px;">
										<?php echo $value['subcat_name'];?>
										</h4>
                                            <a href="javascript:void(0);" class="fav" data-expand="right" data-spinner-color="blue" title="Favourite" data-subcategory="<?php echo $value['subcat_id'];?>">
                                               <i class="fa fa-heart fa-2x text-pink"></i>
                                            </a>
                                        </div>
								<div class="v-bottom">
									<span class="text-white"><i class="fa fa-heart text-pink"></i>
										Favourite (<span class="fav_counter<?php echo $value['subcat_id'];?>"><?php echo $value['favorite'];?></span>)</span>
								</div>
							</div>
						</div>

						<div class="panel-body">
							<h4 class="margin-none">
								<a href="<?php echo $value['url'];?>" title="<?php echo $value['subcat_name'];?>"><?php echo $value['subcat_name'];?>
								</a>
							</h4>
							<span class="text-grey-500"><?php echo $value['comments'];?>
								Reviews</span>
							<span class="pull-right" title="Add a Review">
								<a href="javascript:void(0);" data-toggle="modal" data-target="#modal" data-cat="<?php echo $value['category_link_id'];?>" data-subcat="<?php echo $value['subcat_id'];?>"><i class="fa fa-pencil"></i></a>
							</span>
							</div>
					</div>
					<?php }?>

					<!-- 
                        <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 207px;">
                                    <img src="templates/default/images//400/fashion-beauty-portrait-sexy-girl-holiday-makeup.jpg" alt="music" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 207px;">
                                         <div class="v-top">
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star-o text-white"></span>
                                        </div>
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Hotel Clariage</a>
                                    </h4>
                                    <span class="text-grey-500">5000 Reviews</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 207px;">
                                    <img src="templates/default/images//400/fashion-beauty-portrait-sexy-girl-holiday-makeup.jpg" alt="music" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 207px;">
                                       	 <div class="v-top">
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star-o text-white"></span>
                                            <span class="fa fa-fw fa-star-o text-white"></span>
                                        </div>
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">The Voyager</a>
                                    </h4>
                                    <span class="text-grey-500">In Style</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 207px;">
                                    <img src="templates/default/images//400/fashion-beauty-portrait-sexy-girl-holiday-makeup.jpg" alt="music" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 207px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">The Voyager</a>
                                    </h4>
                                    <span class="text-grey-500">In Style</span>
                                </div>
                            </div>
                          <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//400/young-couple-in-love.jpg" alt="music" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-pink-500">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                        <div class="v-bottom">
                                            <a href=""><i class="fa fa-heart text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Dreams</a>
                                    </h4>
                                    <span class="text-grey-500">Shine</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full height-180">
                                    <div class="bg-pink-400 overlay overlay-full text-center">
                                        <div class="v-center">
                                            <h3 class="text-h3">Featured Cover</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Godspeed</a>
                                    </h4>
                                    <span class="text-grey-500">Heavy Metal</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//300/main-playing-guitar.jpg" alt="music" width="100%" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">My Guitar</a>
                                    </h4>
                                    <span class="text-grey-500">Records</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//300/beauty-fashion-portrait.jpg" alt="music" width="100%" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Angels</a>
                                    </h4>
                                    <span class="text-grey-500">Heaven</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//400/autumn-woman-fall.jpg" alt="music" width="100%" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Falling</a>
                                    </h4>
                                    <span class="text-grey-500">Heaven</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//400/singing-woman.jpg" alt="music" width="100%" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Classic</a>
                                    </h4>
                                    <span class="text-grey-500">Heaven</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//400/portrait-of-man-with-guitar.jpg" alt="music" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-bg-black" style="height: 209px;">
                                        <div class="v-top">
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star text-primary"></span>
                                            <span class="fa fa-fw fa-star-o text-white"></span>
                                            <span class="fa fa-fw fa-star-o text-white"></span>
                                        </div>
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-pause"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Things</a>
                                    </h4>
                                    <span class="text-grey-500">Happen</span>
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom: 15px; zoom: 1; opacity: 1;">
                                <div class="cover overlay hover cover-image-full" style="height: 209px;">
                                    <img src="templates/default/images//400/retro-woman.jpg" alt="music" width="100%" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
                                    <div class="overlay overlay-full overlay-hover overlay-bg-black" style="height: 209px;">
                                        <div class="v-center">
                                            <a href="" class="btn btn-lg btn-circle btn-white">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h4 class="margin-none"><a href="">Jazz</a>
                                    </h4>
                                    <span class="text-grey-500">Heaven</span>
                                </div>
                            </div>-->
				</div>
				<?php echo $page;?>

			</div>
		</div>
		<!-- /st-content-inner -->
	</div>
	<!-- /st-content -->
</div>

<div class="modal close-review" id="modal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="v-cell">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Write a Review</h4>
						
				</div>
				<div class="modal-body">
					<span class="review-response"></span>
					<form class="form-horizontal" role="form" action="post/review"
						method="POST" name="post_review" id="post-review">
						<input type="hidden" name="category" value="1"> <input
							type="hidden" name="subcategory" value="12">
						<div class="form-group  required">
							<label class="col-sm-2 control-label">Message</label>
							<div class="col-sm-10">
								<textarea name="review" id="review"
									class="form-control review-text" rows="5"
									placeholder="Write Your opinion about this to help others ..."></textarea>
								<span class="text-info">Maximum 5000 Characters</span> <span
									class="text-info pull-right char-counter">Characters Left : 5000</span>
							</div>
						</div>
						<!--<div class="form-group">
							<button class="btn btn-primary" id="btn-addphotos" type="button"><i class="fa fa-plus"></i> Add Photos </button>
						</div>
						<div class="form-group" class="review-photos">
							<label class="col-sm-2 control-label">Add Photos</label>
							<div class="col-sm-10">
								<input id="input-700" name="images[]" type="file" multiple
									class="file-loading">
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-sm-2 control-label">Rate it</label>
							<div class="col-sm-10">
								<div class="radio radio-danger radio-inline">
									<input type="radio" name="rating" id="radio21" value="1"
										checked=""> <label for="radio21">Fuzzy</label>
								</div>
								<div class="radio radio-warning radio-inline">
									<input type="radio" name="rating" id="radio22" value="2"> <label
										for="radio22">Bad</label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" name="rating" id="radio23" value="3"> <label
										for="radio23">Average</label>
								</div>

								<div class="radio radio-primary radio-inline">
									<input type="radio" name="rating" id="radio24" value="4"> <label
										for="radio24">Good</label>
								</div>

								<div class="radio radio-success radio-inline">
									<input type="radio" name="rating" id="radio25" value="5"> <label
										for="radio25">Awesome</label>
								</div>
							</div>

						</div>
					</form>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="button"
							class="btn btn-primary post-review ladda-button"
							data-style="expand-left">Post</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
