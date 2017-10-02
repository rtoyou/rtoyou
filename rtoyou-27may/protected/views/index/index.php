<style>
.media-user-profile {
	width: 45px !important;
}

.alert-minimalist {
	background-color: rgb(241, 242, 240);
	border-color: rgba(149, 149, 149, 0.3);
	border-radius: 3px;
	color: rgb(149, 149, 149);
	padding: 10px;
}

.alert-minimalist>[data-notify="icon"] {
	height: 50px;
	margin-right: 12px;
}

.alert-minimalist>[data-notify="title"] {
	color: rgb(51, 51, 51);
	display: block;
	font-weight: bold;
	margin-bottom: 5px;
}

.alert-minimalist>[data-notify="message"] {
	font-size: 80%;
}

.owl-mixed .owl-controls .owl-prev {
	background: #fff;
	color: black;
}

.owl-mixed .owl-controls .owl-prev:hover {
	background: #ec407a;
	color: #fff;
}

.owl-mixed .owl-controls .owl-next {
	background: #fff;
	color: black;
}

.owl-mixed .owl-controls .owl-next:hover {
	background: #ec407a;
	color: #fff;
}
.height-415-lg { height :415px !important}
	.review {text-align: justify}
	.media-user-profile {width: 60px!important;height: 60px!important;}
</style>
<script>
	var reviewOFDay = '<?php echo json_encode($reviewOfDay[0]);?>';
</script>
<aside
	class="sidebar sidebar-chat right sidebar-size-2 sidebar-offset-0 chat-skin-white sidebar-skin-white sidebar-visible-desktop"
	id=sidebar-property data-scrollable>
	<div class="split-vertical">
		<div data-scrollable="" tabindex="3"
			style="overflow-y: hidden; outline: none;">
			<h4 class="category">Review of Day</h4>
			<div class="sidebar-block">
				<p>
					<a
						href="javascript:void(0);" class="sidebar-link user-profile-link"><strong><?php echo $reviewOfDay[0]['user_name'];?></strong> </a> says on  <i class="fa fa-fw fa-hotel text-pink-500"></i> <a href="<?php echo $reviewOfDay[0]['catSeo']."/".$reviewOfDay[0]['category_seo']; ?>"><?php echo $reviewOfDay[0]['subcat_name'];?> </a> <br/>
						<?php echo SiteUtil::getFilteredComment($reviewOfDay[0]['comment'],140);?>
				</p>
				<a class="btn btn-xs btn-pink-500" href="<?php echo $reviewOfDay[0]['catSeo']."/".$reviewOfDay[0]['category_seo']; ?>?rid=<?php echo $reviewOfDay[0]['review_id'];?>">View</a>
			</div>
			<h4 class="category">New Subcategory</h4>
			<div
				class="sidebar-block list-group list-group-menu list-group-striped">
				<?php foreach ($newsubcat as $skey=>$sval) { ?>
				<div class="list-group-item">
					<div class="media">
						<div class="media-left">
							<a href="<?php echo $sval['url'];?>"> <img
								src="<?php echo SiteUtil::getNoImage();?>" width="35" alt="cover"
								class="media-object"  >
							</a>
						</div>
						<div class="media-body">
							<h4 class="text-h5 media-heading margin-v-1-2">
								<a href="<?php echo $sval['url'];?>"><?php echo $sval['subcat_name'];?></a>
							</h4>
							<p class="text-grey-500">Reviews (<?php echo $sval['comments'];?>)</p>
						</div>
					</div>
				</div>
				<?php }?>
				
			</div>
			<h4 class="category">What users says</h4>
			<div class="sidebar-block">
				<p><?php echo htmlspecialchars($userSays);?></p>
				<a class="btn btn-primary" href="companies-and-organization/rtoyou"><i
					class="fa fa-fw fa-search"></i> View All</a>
			</div>
			<h4 class="category">We on twitter</h4>
			<div class="sidebar-block" id="twitter">
				<p>End of scrollable content</p>
			</div>
		</div>
	</div>
</aside>
<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->

<div class="st-pusher">
	<div class="st-content">
		<div class="st-content-inner" id="content">
			<div class="container-fluid">
				<h1>Top Ranking's This week</h1>
				<div class="row">
					<div class="col-lg-8 col-md-7">
						<div class="tabbable tabs-vertical tabs-right-lg">
							<ul class="nav nav-tabs">
								<?php $added =  false;
								foreach ($topDetails['topOne'] as $category) {
									 ?>
									<li class="<?php echo !$added ? 'active' : '';?>"><a href="#<?php echo $category[0]['catSeo'];?>" data-toggle="tab"><i
												class="fa fa-fw <?php echo $category[0]['cat_icon'];?>"></i> Top <?php echo $category[0]['category_name'];?></a>
									</li>
								<?php $added=true; }?>
							</ul>
							<div class="tab-content">
							<?php $tabActive =  false;
							foreach ($topDetails['topOne'] as $topHeader) {?>
									<div id="<?php echo $topHeader[0]['catSeo'];?>" class="tab-pane <?php echo !$tabActive ? 'active' : '';?>">
										<div class="cover overlay height-415-lg cover-image-full">
											<div class="overlay overlay-bg-black">
												<h3 class="text-h3 margin-top-none">
													<a href="<?php echo SiteUtil::getSubCategoryUrl($topHeader[0]);?>" title="<?php echo $topHeader[0]['subcat_name'];?>" style="color: #fff;text-decoration: none;"><?php echo $topHeader[0]['subcat_name'];?></a> <span class="text-h5"> <?php echo SiteUtil::getStarHTML(floor($topHeader[0]['avg']),'text-primary');?>
													</span>
												</h3>
												<p class="review"><?php echo SiteUtil::getFilteredComment($topHeader[0]['review']['comment'],159);?></p>
											</div>
											<img
												src="<?php echo SiteUtil::getCategoryImageHome($topHeader[0]['catSeo']);?>"
												alt="<?php echo $topHeader[0]['subcat_name'];?>" onerror="this.src='<?php echo SiteUtil::getNoImage();?>'"/>
										</div>
									</div>

							<?php $tabActive = true; }?>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">What's Recent</h4>
							</div>
							<ul class="list-group">
							<?php foreach ($newestComments as $nckey=>$ncval) {$stars='';?>
								<li class="list-group-item"  style="padding:14px 15px;">
									<div class="media">
										<div class="media-left">
											<a href="<?php echo $ncval['url'];?>"> <img
												src="<?php echo SiteUtil::getSubcategoryImage($ncval['subcat_image']);?>"
												alt="<?php echo $ncval['subcat_name'];?>" class="media-object" width="45" onerror="this.src='<?php echo SiteUtil::getNoImage();?>'" title="<?php echo $ncval['subcat_name'];?>"/>
											</a>
										</div>
										<div class="media-body">
											<div class="pull-right visible-lg">
												<a class="btn btn-green-500 btn-circle btn-stroke btn-sm"
													href="<?php echo $ncval['url'];?>" title="View <?php echo $ncval['subcat_name'];?>"><i class="fa fa-eye"></i> </a>
											</div>
											<h4 class="media-heading margin-v-4">
												<a href="<?php echo $ncval['url'];?>"><?php echo $ncval['subcat_name'];?></a>
												
												<Span class="stars" style="font-size:8px;" title="<?php echo  $ncval['rating'] == 1 ? $ncval['rating'].' star' : $ncval['rating'].' stars';?>"><?php echo SiteUtil::getStarHTML(floor($ncval['rating']));?></Span>
											</h4>

											<p class="text-grey-500 margin-none"><?php echo SiteUtil::getFilteredComment($ncval['review'],70);?></p>
										</div>
									</div>
								</li>
								<?php }?>

							</ul>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Top Reviewer's</h4>
					</div>
					<div class="owl-mixed" style="margin-bottom:10px;">
						<?php $position=1;
						foreach ($topReviewers as $keyReviewers=>$valueReviewers) { ?>
						<div class="item">
							<div class="media media-clearfix-xs-min  ribbon-wrapper">
								<div class="ribbon-mark ribbon-primary absolute left">
									<span class="ribbon"> <span class="text"><?php echo $position;?>
											<i class="fa fa-star"></i> </span>
									</span>
								</div>
								<div class="media-left">

									<img src="<?php echo SiteUtil::getUserProfileImage($valueReviewers['image']); ?>"
										alt="<?php echo $valueReviewers['name'];?>" class="media-object" onerror="this.src='<?php echo SiteUtil::getNoImage();?>'"/>

								</div>
								<div class="media-body">
									<h4 class="media-heading">
										<a href="javascript:void(0);" style="cursor:default;"><?php echo $valueReviewers['name'];?> </a>
									</h4>
									<p class="meta">
										<span><i class="fa fa-calendar-o fa-fw"></i> <?php echo TimeUtil::convert($valueReviewers['fromdate']);?>
										</span>
										<?php if($valueReviewers['location']) { ?>
										<span><i class="fa fa-map-marker fa-fw"></i> <?php echo $valueReviewers['location'];?>
										</span>
										<?php }?>
										<span><i class="fa fa-pencil fa-fw"></i> <?php echo $valueReviewers['total'];?> Reviews
										</span>
									</p>
									<p class="meta">
										<span>Recently Reviewed on <a
											href="<?php echo $valueReviewers['url'];?>"><?php echo $valueReviewers['subcat_name'];?>
										</a>
										</span>
									</p>
									<p>
										<?php echo $valueReviewers['review'];?>
									</p>
								</div>
							</div>
						</div>
						<?php $position++;
} ?>

					</div>
				</div>
				<?php foreach ($topDetails['topFive'] as $panelData) {
					if(empty($panelData[0]['category_name'])) continue;
					?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">Our Top 5 <?php echo $panelData[0]['category_name'];?></h4>
						</div>
						<div class="panel-body">
							<div class="row gridalicious" data-toggle="gridalicious"
								 data-width=300>
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
								$topHotels = $panelData;
								foreach ($topHotels as $key=>$value){
									$hideiMage=true;?>
									<div class="panel panel-default"
										 style="margin-bottom: 15px; zoom: 1; opacity: 1;">
										<div class="cover overlay hover cover-image-full"
											 style="height: 209px;">
											<?php //if(strlen($value['subcat_image']) > 0 ){
											if(false ){
												$hideiMage = false;?>
												<img src="<?php echo $value['subcat_image'];?>" height="209"
													 alt="music"
													 style="height: 209px; display: block; margin-left: auto; margin-right: auto;" onerror="this.src='<?php echo SiteUtil::getNoImage();?>'">
											<?php }?>
											<div
												class="overlay overlay-full overlay-full <?php echo  !$hideiMage ? 'overlay-bg-black' : $classCss[rand(0,4)];?>"
												style="height: 209px;">
												<div class="v-top">
													<?php echo SiteUtil::getStarHTML(floor($value['avg']));?>
												</div>
												<div class="v-center">
													<h4 class="text-h4" style="font-size: 12px;">
														<?php echo $value['subcat_name'];?>
													</h4>
													<a href="javascript:void(0);" class="fav" data-expand="right"
													   data-spinner-color="blue" title="Favourite"
													   data-subcategory="<?php echo $value['subcat_id'];?>"> <i
															class="fa fa-heart fa-2x text-pink"></i>
													</a>
												</div>
												<div class="v-bottom">
											<span class="text-white"><i class="fa fa-heart text-pink"></i>
												Favourite (<span class="fav_counter<?php echo $value['subcat_id'];?>"><?php echo $value['favorite'];?></span>)</span>
												</div>
											</div>
										</div>

										<div class="panel-body"  style="min-height: 180px;">
											<h4 class="margin-none" style="min-height: 60px;">
												<a href="<?php echo $value['url'];?>"><?php echo $value['subcat_name'];?> </a>
											</h4>
											<span class="text-grey-500"><?php echo $value['comments'];?>
												Reviews</span>

											<div class="media" style="min-height: 90px;">
												<div class="media-left">
													<img src="<?php echo SiteUtil::getUserProfileImage($value['review']['user_image']);?>"
														 alt="<?php echo $value['review']['user_name'];?>" title="Recently reviewed by <?php echo $value['review']['user_name'];?>" class="media-user-profile img-circle" height="60" style="width: 60px!important;" onerror="this.src='<?php echo SiteUtil::getNoImage();?>'">
												</div>
												<div class="media-body">
													<p class="review"><?php echo SiteUtil::getFilteredComment($value['review']['comment'],100);?></p>
												</div>
											</div>
										</div>
									</div>
								<?php }?>
							</div>
							<div class="pull-right">
								<a class="btn btn-xs btn-pink-500" href="<?php echo $value['catSeo'];?>">more</a>

							</div>

						</div>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
/*
	window.onload = function setDataSource() {
		if (!!window.EventSource) {
			var source = new EventSource("event/listen");

			source.addEventListener('time',function(e){
				var time = e.data;
				console.log(time);
			},false);	

			source.addEventListener('notify',function(e){
				var time = JSON.parse(e.data);
				var starhtml='';
				for(var i=1;i<=parseInt(time[0].rating);i++){
					starhtml+='<span class="fa fa-fw fa-star text-yellow"></span>';
				}
				for(var k=parseInt(time[0].rating);k<=5;k++){
					starhtml+='<span class="fa fa-fw fa-star text-white"></span>';
				}
				$.notify({
					icon: 'http://localhost/RtoyouImages/profile/'+time[0].user_image,
					title: time[0].user_name+' reviewed on '+time[0].subcat_name,
					message: time[0].comment,
				},{
					type: 'minimalist',
					delay: 5000,
					icon_type: 'image',
					template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
						'<img data-notify="icon" class="img-circle pull-left">' +
						'<span data-notify="title">{1}</span>' +
						'<span data-notify="message">'+starhtml+'<br/>{2}</span>' +
					'</div>',
					placement : {
						from : 'bottom',
						align : 'left',
					}
				});
			},false);
			
			source.addEventListener("open", function(e) {
				console.log("open"+JSON.stringify(e));
			}, false);

			source.addEventListener("error", function(e) {
				console.log("ERROR"+JSON.stringify(e));
				if (e.readyState == EventSource.CLOSED) {
					
				}
			}, false);
		} else {
			document.getElementById("notSupported").style.display = "block";
		}
	}

	function updatePrice(data) {
		alert(data);
		var ar = data.split(":");
		var ticket = ar[0];
		var price = ar[1];
		var el = document.getElementById("t_" + ticket);
		var oldPrice = el.innerHTML;
		el.innerHTML = price;
		if (parseFloat(oldPrice) < parseFloat(price)) {
			el.style.backgroundColor = "lightgreen";
		} else {
			el.style.backgroundColor = "tomato";
		}
		window.setTimeout(function clearBackground() {0
			el.style.backgroundColor = "white";
		}, 500);
	}

	function logMessage(obj) {
		var el = document.getElementById("log");
		if (typeof obj === "string") {
			el.innerHTML += obj + "<br>";
		} else {
			el.innerHTML += obj.lastEventId + " - " + obj.data + "<br>";
		}
		el.scrollTop += 20;
	}
*/
</script>
