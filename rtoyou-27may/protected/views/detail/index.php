<?php include BASE_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'review.php';?>
<style>
.cover-p {
	position: relative;
}

.cover-p.overlay .overlay {
	position: absolute;
	transition: all .5s;
	-webkit-transition: all .5s;
	bottom: 0;
	left: 0;
	right: 0;
	z-index: 3;
	padding: 20px;
	display: table;
	width: 100%;
	vertical-align: middle;
}
#review-images ul
			{
			}
				#review-images li
				{
					display: inline-block;
					margin: 0.625em; /* 10 */
				}
					#review-images img
					{
						width: 8.75em; /* 140 */
						height: 8.75em; /* 140 */
						border-color: #eee;
						border: 0.625em solid rgba( 255, 255, 255, .5 ); /* 10 */

						-webkit-box-shadow: 0 0 0.313em rgba( 0, 0, 0, .05 ); /* 5 */
						box-shadow: 0 0 0.313em rgba( 0, 0, 0, .05 ); /* 5 */

						-webkit-transition: -webkit-box-shadow .3s ease, border-color .3s ease;
						transition: box-shadow .3s ease, border-color .3s ease;
					}
						#review-images img:hover,
						#review-images img:focus
						{
							border-color: #fff;

							-webkit-box-shadow: 0 0 0.938em rgba( 0, 0, 0, .25 ); /* 15 */
							box-shadow: 0 0 0.938em rgba( 0, 0, 0, .25 ); /* 15 */
						}
/* IMAGE LIGHTBOX SELECTOR */
#imagelightbox {
	cursor: pointer;
	position: fixed;
	z-index: 10000;
	-ms-touch-action: none;
	touch-action: none;
	-webkit-box-shadow: 0 0 3.125em rgba(0, 0, 0, .75); /* 50 */
	box-shadow: 0 0 3.125em rgba(0, 0, 0, .75); /* 50 */
}

/* ACTIVITY INDICATION */
#imagelightbox-loading,#imagelightbox-loading div {
	border-radius: 50%;
}

#imagelightbox-loading {
	width: 2.5em; /* 40 */
	height: 2.5em; /* 40 */
	background-color: #444;
	background-color: rgba(0, 0, 0, .5);
	position: fixed;
	z-index: 10003;
	top: 50%;
	left: 50%;
	padding: 0.625em; /* 10 */
	margin: -1.25em 0 0 -1.25em; /* 20 */
	-webkit-box-shadow: 0 0 2.5em rgba(0, 0, 0, .75); /* 40 */
	box-shadow: 0 0 2.5em rgba(0, 0, 0, .75); /* 40 */
}

#imagelightbox-loading div {
	width: 1.25em; /* 20 */
	height: 1.25em; /* 20 */
	background-color: #fff;
	-webkit-animation: imagelightbox-loading .5s ease infinite;
	animation: imagelightbox-loading .5s ease infinite;
}

@
-webkit-keyframes imagelightbox-loading {from { opacity:.5;
	-webkit-transform: scale(.75);
}

50%
{
opacity
:

1;
-webkit-transform
:

scale
(

1
);
}
to {
	opacity: .5;
	-webkit-transform: scale(.75);
}

}
@
keyframes imagelightbox-loading {from { opacity:.5;
	transform: scale(.75);
}

50%
{
opacity
:

1;
transform
:

scale
(

1
);
}
to {
	opacity: .5;
	transform: scale(.75);
}

}

/* OVERLAY */
#imagelightbox-overlay {
	background-color: #fff;
	background-color: rgba(255, 255, 255, .9);
	position: fixed;
	z-index: 9998;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
}

/* "CLOSE" BUTTON */
#imagelightbox-close {
	width: 2.5em; /* 40 */
	height: 2.5em; /* 40 */
	text-align: left;
	background-color: #666;
	border-radius: 50%;
	position: fixed;
	z-index: 10002;
	top: 2.5em; /* 40 */
	right: 2.5em; /* 40 */
	-webkit-transition: color .3s ease;
	transition: color .3s ease;
}

#imagelightbox-close:hover,#imagelightbox-close:focus {
	background-color: #111;
}

#imagelightbox-close:before,#imagelightbox-close:after {
	width: 2px;
	background-color: #fff;
	content: '';
	position: absolute;
	top: 20%;
	bottom: 20%;
	left: 50%;
	margin-left: -1px;
}

#imagelightbox-close:before {
	-webkit-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	transform: rotate(45deg);
}

#imagelightbox-close:after {
	-webkit-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	transform: rotate(-45deg);
}

/* CAPTION */
#imagelightbox-caption {
	text-align: center;
	color: #fff;
	background-color: #666;
	position: fixed;
	z-index: 10001;
	left: 0;
	right: 0;
	bottom: 0;
	padding: 0.625em; /* 10 */
}

/* NAVIGATION */
#imagelightbox-nav {
	background-color: #444;
	background-color: rgba(0, 0, 0, .5);
	border-radius: 20px;
	position: fixed;
	z-index: 10001;
	left: 50%;
	bottom: 3.75em; /* 60 */
	padding: 0.313em; /* 5 */
	-webkit-transform: translateX(-50%);
	-ms-transform: translateX(-50%);
	transform: translateX(-50%);
}

#imagelightbox-nav button {
	width: 1em; /* 20 */
	height: 1em; /* 20 */
	background-color: transparent;
	border: 1px solid #fff;
	border-radius: 50%;
	display: inline-block;
	margin: 0 0.313em; /* 5 */
}

#imagelightbox-nav button.active {
	background-color: #fff;
}

/* ARROWS */
.imagelightbox-arrow {
	width: 3.75em; /* 60 */
	height: 7.5em; /* 120 */
	background-color: #444;
	background-color: rgba(0, 0, 0, .5);
	vertical-align: middle;
	display: none;
	position: fixed;
	z-index: 10001;
	top: 50%;
	margin-top: -3.75em; /* 60 */
}

.imagelightbox-arrow:hover,.imagelightbox-arrow:focus {
	background-color: #666;
	background-color: rgba(0, 0, 0, .75);
}

.imagelightbox-arrow:active {
	background-color: #111;
}

.imagelightbox-arrow-left {
	left: 2.5em; /* 40 */
}

.imagelightbox-arrow-right {
	right: 2.5em; /* 40 */
}

.imagelightbox-arrow:before {
	width: 0;
	height: 0;
	border: 1em solid transparent;
	content: '';
	display: inline-block;
	margin-bottom: -0.125em; /* 2 */
}

.imagelightbox-arrow-left:before {
	border-left: none;
	border-right-color: #fff;
	margin-left: -0.313em; /* 5 */
}

.imagelightbox-arrow-right:before {
	border-right: none;
	border-left-color: #fff;
	margin-right: -0.313em; /* 5 */
}

#imagelightbox-loading,#imagelightbox-overlay,#imagelightbox-close,#imagelightbox-caption,#imagelightbox-nav,.imagelightbox-arrow
	{
	-webkit-animation: fade-in .25s linear;
	animation: fade-in .25s linear;
}

@
-webkit-keyframes fade-in {from { opacity:0;

}

to {
	opacity: 1;
}

}
@
keyframes fade-in {from { opacity:0;

}

to {
	opacity: 1;
}

}
@media only screen and (max-width: 41.250em) /* 660 */ {
	#container {
		width: 100%;
	}
	#imagelightbox-close {
		top: 1.25em; /* 20 */
		right: 1.25em; /* 20 */
	}
	#imagelightbox-nav {
		bottom: 1.25em; /* 20 */
	}
	.imagelightbox-arrow {
		width: 2.5em; /* 40 */
		height: 3.75em; /* 60 */
		margin-top: -2.75em; /* 30 */
	}
	.imagelightbox-arrow-left {
		left: 1.25em; /* 20 */
	}
	.imagelightbox-arrow-right {
		right: 1.25em; /* 20 */
	}
}

@media only screen and (max-width: 20em) /* 320 */ {
	.imagelightbox-arrow-left {
		left: 0;
	}
	.imagelightbox-arrow-right {
		right: 0;
	}
}

.loading-bar {
	padding: 10px 20px;
	display: block;
	text-align: center;
	box-shadow: inset 0px -45px 30px -40px rgba(0, 0, 0, 0.05);
	border-radius: 5px;
	margin: 20px 0;
	font-size: 2em;
	font-family: "museo-sans", sans-serif;
	border: 1px solid #ddd;
	margin-right: 1px;
	font-weight: bold;
	cursor: pointer;
	position: relative;
}

.loading-bar:hover {
	box-shadow: inset 0px 45px 30px -40px rgba(0, 0, 0, 0.05);
}

.cover-p.overlay .overlay.overlay-bg-black {
	background: linear-gradient(to right, rgba(0, 0, 0, .7),
		rgba(0, 0, 0, .2) );
	color:#fff;
}
</style>
<link
	href="css/module-charts.min.css" rel="stylesheet" />
<aside
	class="sidebar right hidden-xs sidebar-size-xs-1 sidebar-size-lg-25pc sidebar-size-30pc sidebar-offset-0 sidebar-skin-white sidebar-visible-desktop"
	id=sidebar-property data-scrollable>
	<div class="split-vertical">
		<?php if($contactInfoAvailable) { ?>
			<div class="sidebar-block equal-padding text-center">
				<h3>Contact Information</h3>
				<?php if($categoryInfo['subcat_url']) { ?>
				<p>
					<a href="<?php echo $categoryInfo['subcat_url'];?>" target="_blank" class="h5">Visit The Site</a>
				</p>
				<?php } ?>

				<?php if($categoryInfo['subcat_author']) { ?>
				<p>
					<h5 class="text-info"><?php echo $categoryInfo['subcat_author'];?></h5>
				</p>
				<?php } ?>

				<?php if($categoryInfo['subcat_contact']) { ?>
				<a href="tel::// <?php echo $categoryInfo['subcat_contact'];?>" class="btn btn-primary">Contact :- <?php echo $categoryInfo['subcat_contact'];?></a>
				<?php } ?>
			</div>
		<?php } ?>
		<!--<div class="panel panel-default">
			<div class="panel-heading">
				<h6>How frequently reviewers are looking it ?</h6>
			</div>
			<div class="panel-body">
				<div id="line-chart" data-toggle="morris-chart-line"
					class="height-250"
					style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-heading">How much fluctuations in rating in last
					five months?</h6>
			</div>
			<div class="panel-body">
				<div id="chart-pie" data-toggle="flot-chart-pie" class="height-250"
					class="flotchart-holder" style="padding: 0px; position: relative;"></div>
			</div>
		</div> -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-heading">How much Rating it have ?</h6>
			</div>
			<div class="panel-body">
				<div id="chart-bar" data-toggle="morris-chart-bar"
					class="morris-chart-holder height-200"
					style="padding: 0px; position: relative;text-align:center;"  data-subcat="<?php echo $categoryInfo['subcat_id'];?>">
					<img src="templates/default/images/rtoyou-loading.gif" class="loading-chart"/>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-heading">Reviews Trends</h6>
			</div>
			<div class="panel-body">
				<div id="line-holder" data-toggle="morris-chart-line"
					class="flotchart-holder height-200"  
					style="padding: 0px; position: relative;"  data-subcat="<?php echo $categoryInfo['subcat_id'];?>">
					<img src="templates/default/images/rtoyou-loading.gif" class="loading-chart-line"/>	
				</div>
			</div>
		</div>
	</div>
</aside>

<div
	class="st-pusher">
	<!-- sidebar effects INSIDE of st-pusher: -->
	<!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
	<!-- this is the wrapper for the content -->
	<div class="st-content">
		<!-- extra div for emulating position:fixed of the menu -->
		<input type="hidden" id="subcat_id" value="<?php echo $categoryInfo['subcat_id'];?>">
		<input type="hidden" id="cmt_id" value="<?php echo $definedCommentId;?>">
		<div id="blueimp-gallery-dialog" data-show="fade" data-hide="fade">
			<!-- The Gallery widget  -->
			<div
				class="blueimp-gallery blueimp-gallery-carousel blueimp-gallery-controls">
				<div class="slides"></div>
				<a class="prev">‹</a> <a class="next">›</a> <a class="play-pause"></a>
			</div>
		</div>
		<div class="st-content-inner padding-top-none" id="content">
			<div id="header-subcat" class="cover-p overlay overflow-hidden margin-bottom-none" style="max-height: 364px;">
				<div class="am-container" id="am-container">

					<?php 

						$collage = explode("||",$categoryInfo['subcat_collage']);
						$total = count($collage);
						
					foreach($collage as $imageUrl) {
					?>
					
					<img src="<?php echo SiteUtil::getReviewImageUrl($imageUrl);?>"/>

					<?php }?>
				</div>

				<div class="overlay overlay-hover overlay-bg-black">
					<div class="v-bottom">
						<div class="jumbotron bg-transparent margin-none" style="padding-top: 10px;">
							<h1 class="text-h1 margin-none"><?php echo $categoryInfo['subcat_name'];?></h1>
							<p class="lead"><?php echo $categoryInfo['subcat_address'];?> <?php echo $categoryInfo['subcat_author'];?></p>
						</div>
					</div>
					<div class="v-bottom">
						<div class="pull-left text-h5">
							<?php echo SiteUtil::getStarHTML(floor($categoryInfo['averageRating']));?>
						</div>
						<div class="pull-right text-h5">
							<a style="text-decoration:none;" href="javascript:void(0);" class="fav" data-expand="left" title="Favourite" data-subcategory="<?php echo $categoryInfo['subcat_id'];?>"><i class="fa fa-fw fa-heart text-pink-500"></i> <span
								class="text-white"> Favourite(<?php echo $categoryInfo['subcat_rtoyou_fav'];?>)</span></a>
						</div>
					</div>
				</div>

			</div>
			<div class="property-meta">
				<div class="tabbable">
					<ul class="nav nav-tabs" tabindex="0"
						style="overflow: hidden; outline: none;">
						<li class="active"><a href="#home" data-toggle="tab"
							aria-expanded="true"><i class="fa fa-fw fa-picture-o"></i> About</a>
						</li>
						<!--<li class=""><a href="#profile" data-toggle="tab"
							aria-expanded="false"><i class="fa fa-fw fa-picture-o"></i>
								Photos</a></li> -->
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="home">
							<?php if($total == 1)  { ?>
								<h4 class="text-h4"><?php echo $categoryInfo['subcat_name'];?></h4>
							<?php } ?>
							<div
								class="expandable expandable-indicator-white expandable-trigger">
								<div class="expandable-content">
									<?php echo $categoryInfo['subcat_desc'];?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile"></div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								Reviews
								<button data-template="post-review-form" data-toggle="tk-modal-demo"
									data-modal-options="grow modal-overlay modal-backdrop-white close-review"
									data-subcategory="<?php echo $categoryInfo['subcat_id'];?>" data-subcategory="<?php echo $categoryInfo['subcat_id'];?>" data-toplist="<?php echo $categoryInfo['category_link_id'];?>" data-contentOptions="{'subcategory':<?php echo $categoryInfo['subcat_id'];?>,'toplist':<?php echo $categoryInfo['category_link_id'];?>}" class="btn btn-info btn-xs pull-right"
									data-target="#a63238ef-fe6b-a3a3-2808-90751b49d71c">
									<i class="fa fa-fw fa-pencil"></i> Write your own
								</button>
							</h4>


						</div>

						<div class="panel-body load-reviews" data-scrollable>
									<?php foreach ($reviews as $review) { ?>

									<?php } ?>
						</div>
					</div>


				</div>
			</div>
			<!-- // END .owl-basic -->
		</div>
	</div>
	<!-- /st-content-inner -->
</div>
<script id="post-review-form" type="text/x-handlebars-template">
                            <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
                                <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
                                    <div class="v-cell">
                                        <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="modal-title">Write a Review</h4>
                                            </div>
                                            <div class="modal-body">
						<span class="review-response"></span>
						<form class="form-horizontal" role="form" action="post/review"
										method="POST" name="post_review" id="post-review">
							<input type="hidden" name="category" value="{{toplist}}" />
							<input type="hidden" name="subcategory" value="{{subcategory}}" />
							<div class="form-group  required">
                                                    <label class="col-sm-2 control-label">Message</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="review" id="review" class="form-control review-text" rows="5" placeholder="Write Your opinion about this to help others ..."></textarea>
                                                    	<span class="text-info">Minimum 10 words and upto 5000 Characters</span>
<span class="text-info"></span>
												<span class="text-info pull-right char-counter">Characters Left : 5000</span>
													</div>
                                                </div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Rate it</label>
						<div class="col-sm-10">
						<div class="radio radio-danger radio-inline">
                                                        <input type="radio" name="rating" id="radio21" value="1" checked="">
                                                        <label for="radio21">Fuzzy</label>
                                                    </div>
						<div class="radio radio-warning radio-inline">
                                                        <input type="radio" name="rating" id="radio22" value="2">
                                                        <label for="radio22">Bad</label>
                                                    </div>
<div class="radio radio-info radio-inline">
                                                        <input type="radio" name="rating" id="radio23" value="3">
                                                        <label for="radio23">Average</label>
                                                    </div>

<div class="radio radio-primary radio-inline">
                                                        <input type="radio" name="rating" id="radio24" value="4">
                                                        <label for="radio24">Good</label>
                                                    </div>

<div class="radio radio-success radio-inline">
                                                        <input type="radio" name="rating" id="radio25" value="5">
                                                        <label for="radio25">Awesome</label>
                                                    </div>
						</div>
						</form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary post-review ladda-button" data-style="expand-left">Post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </script>

<!-- /st-content -->
