<style>
/* ---- grid ---- */

/* clear fix */
.grid:after {
  content: '';
  
  clear: both;
}
 /* ---- .grid-item ---- */

.grid-item {
  width: 11%;
  margin-left :10px;
	float:left;
clear:0;
  position:relative !important;  
  
}

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
					
				</div>
			</nav>
			<div class="container-fluid">
				<h1 class="text-h3">
					Select Reviews Category based on Your selection
				</h1>

				<div class="grid">
					<?php 
$i=0;
					$classCss = array(
							0=>'bg-pink-400 ',
							1=>'bg-purple-300',
							2=>'bg-green-400',
							3=>'bg-deep-orange-400',
							4=>'bg-yellow-400 '
					);
					foreach ($clist as $key=>$value){$i++;
$hideiMage=true;?>
					<div class="panel panel-default grid-item " style="position:relative !important;"
						id="<?php echo $value['category_id'];?>">
<div class="ribbon-mark ribbon-danger absolute middle">
									<span class="ribbon"> <span class="text"><?php echo $i; ?>											 </span>
									</span>
								</div>
						<div class="cover overlay hover cover-image-full"
							style="height: 190px;">
							<?php if(strlen($value['subcat_image']) > 0 ){ 
$hideiMage = false;?>
							<img src="<?php echo $value['subcat_image'];?>" alt="music"
								style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;">
							<?php }?>
							<div
								class="overlay overlay-full overlay-full <?php echo  !$hideiMage ? 'overlay-bg-black' : $classCss[rand(0,4)];?>"
								style="height: 209px;">
								
								
							</div>
						</div>

						<div class="panel-body" style="min-height:60px;max-height:60px;">
							<h4 class="margin-none">
								<a href="detail/index"><?php echo $value['category_name'];?>
								</a>
							</h4>
							
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
				

			</div>
			<div class="row well" style="margin-bottom:10px;">
				<div class="col-md-6 col-sm-12 col-md-offset-6">
					<button class="btn btn-primary pull-left">Save Selection</button>
				<div>
			</div>
		
		</div>
		<!-- /st-content-inner -->
	</div>
	<!-- /st-content -->
</div>

</div>
<script src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

// external js: masonry.pkgd.js, imagesloaded.pkgd.js

// init Isotope
//var grid = document.querySelector('.grid');

//var msnry = new Masonry( grid, {
  //itemSelector: '.grid-item',
  //columnWidth: '.grid-sizer',
 // percentPosition: true
//});

 //msnry.layout();



$( function() {
    $( ".grid" ).sortable({
	cursor:"move",
	dropOnEmpty:false,
items:">div",
tolerance: "pointer",
zIndex:9999,
scroll: false,
sortstart:function(event,ui){
	alert($(this).data().sortable.currentItem);
}
    });
   
  } );

</script>
