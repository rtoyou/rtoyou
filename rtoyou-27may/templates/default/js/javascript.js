(function($) {

	$.fn.scrollPagination = function(options) {
		
		var settings = { 
			detailid : 47,
			nop     : 1, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			error   : 'No More Reviews!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : true, // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
			url : 'review/getreviews',
			type : 'review',
			reviewid : 0
		}
		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}
		
		// For each so that we keep chainability.
		return this.each(function() {		
			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var offset = $settings.offset;
			var busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = 'Scroll for more or click here';
			else $initmessage = 'Click for more';
			
			// Append custom messages and extra UI
			$this.append('<div class="content"></div><div class="loading-bar">'+$initmessage+'</div>');
			
			function getData(url,type) {
				// Post data to ajax.php
				$.post(url, {
				    action        : 'scrollpagination',
				    number        : $settings.nop,
				    offset        : offset,
				    detailid	  :    $settings.detailid,
				    reviewid      : $settings.reviewid
				}, function(data) {
					$this.find('.loading-bar').html($initmessage);
					if(data.data.length == 0 ) {
						$this.find('.loading-bar').html($settings.error);	
					}
					else {
						if($settings.type == 'photopage'){
							$(document).trigger('onAfterGetPhotos',[data]);
						} else if($settings.type == 'review'){
							offset = offset+$settings.nop; 
							var _reviews = data.data;
							var _reviewTpl = $("#reviewTpl").html();
							Mustache.parse(_reviewTpl);   // optional, speeds up future uses
							$.each(_reviews,function (k,v) {
								var rendered = Mustache.render(_reviewTpl, v);
								$this.find('.content').append(rendered);

							});
							busy = false;
							if(data.data.length < $settings.nop) {
								$this.find('.loading-bar').html($settings.error);
								$this.find('.loading-bar').data('more',0);
							}
						}
					}	
						
				});
					
			}	
			
			getData(settings.url); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					if($(window).scrollTop() + $(window).height() > $this.height() && !busy) {
						
						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're loading posts
						$this.find('.loading-bar').html('Loading Reviews');
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData($settings.url);
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$this.find('.loading-bar').click(function() {
				if($(this).data('more') != 0){
					if(busy == false) {
						busy = true;
						getData($settings.url);
					}
				}
			
			});
			
		});
	}

})(jQuery);
