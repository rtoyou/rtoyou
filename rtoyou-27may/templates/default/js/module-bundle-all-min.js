/*!
 *  3.6.3
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2015
 */
;
/*!
 *  3.6.3
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2015
 */
(function(a){var c=a("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com']"),b=a("panel");c.each(function(){a(this).data("aspectRatio",this.height/this.width).removeAttr("height").removeAttr("width")});a(".gallery-grid .panel").resize(function(){var d=b.width();c.each(function(){var e=a(this);e.width(d).height(d*e.data("aspectRatio"))})}).resize()})(jQuery);(function(a){a.fn.tkOwlDefault=function(){if(!this.length){return}var b=this;b.owlCarousel({dots:true,items:b.data("items")||4,responsive:{1200:{items:b.data("itemsLg")||4},992:{items:b.data("itemsMg")||3},768:{items:b.data("itemsSm")||3},480:{items:b.data("itemsXs")||2},0:{items:1}},rtl:this.data("rtl"),afterUpdate:function(){a(window).trigger("resize")}})};a(".owl-basic").each(function(){a(this).tkOwlDefault()})})(jQuery);(function(a){a.fn.tkOwlMixed=function(){if(!this.length){return}this.owlCarousel({items:2,nav:true,dots:false,rtl:this.data("rtl"),navText:['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],responsive:{1200:{items:2},0:{items:1}}})};a(".owl-mixed").tkOwlMixed()})(jQuery);(function(a){var b=function(d,c){if(d.namespace&&d.property.name==="items"){c.trigger("to.owl.carousel",[d.item.index,300,true])}};a.fn.tkOwlPreview=function(){if(!this.length){return}var e=a(this.data("sync")),d=this,c=this.data("rtl");if(!e.length){return}this.owlCarousel({items:1,slideSpeed:1000,dots:false,responsiveRefreshRate:200,rtl:c,nav:true,navigationText:['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>']});this.on("change.owl.carousel",function(f){b(f,e)});e.owlCarousel({items:5,responsive:{1200:{items:7},768:{items:6},480:{items:3},0:{items:2}},dots:false,nav:true,responsiveRefreshRate:100,rtl:c,afterInit:function(f){f.find(".owl-item").eq(0).addClass("synced")}});e.on("change.owl.carousel",function(f){b(f,d)});e.find(".owl-item").click(function(g){g.preventDefault();var f=a(this).data("owl-item");d.trigger("to.owl.carousel",[f.index,300,true])})};a(".owl-preview").tkOwlPreview()})(jQuery);(function(a){a.fn.tkSlickDefault=function(){if(!this.length){return}if(typeof a.fn.slick=="undefined"){return}var b=this;b.slick({dots:true,slidesToShow:b.data("items")||3,responsive:[{breakpoint:1200,settings:{slidesToShow:b.data("itemsLg")||4}},{breakpoint:992,settings:{slidesToShow:b.data("itemsMd")||3}},{breakpoint:768,settings:{slidesToShow:b.data("itemsSm")||3}},{breakpoint:480,settings:{slidesToShow:b.data("itemsXs")||2}},{breakpoint:0,settings:{slidesToShow:1}}],rtl:this.data("rtl"),onSetPosition:function(){a(window).trigger("resize")}});a(document).on("sidebar.shown",function(){b.slickSetOption("dots",true,true)})};a(".slick-basic").each(function(){a(this).tkSlickDefault()})})(jQuery);
/*!
 *  3.6.3
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2015
 */
(function(a){a(function(){var b={videoPlay:".video-play",play:".play",pause:".pause",stop:".stop",seekBar:".seek-bar",playBar:".play-bar",mute:".mute",unmute:".unmute",volumeBar:".volume-bar",volumeBarValue:".volume-bar-value",volumeMax:".volume-max",playbackRateBar:".playback-rate-bar",playbackRateBarValue:".playback-rate-bar-value",currentTime:".current-time",duration:".duration",title:".title",fullScreen:".full-screen",restoreScreen:".restore-screen",repeat:".repeat",repeatOff:".repeat-off",gui:".gui",noSolution:".no-solution"},c={playing:"state-playing",seeking:"state-seeking",muted:"state-muted",looped:"state-looped",fullScreen:"state-full-screen",noVolume:"state-no-volume"};a("#jquery_jplayer_audio_1").jPlayer({ready:function(){a(this).jPlayer("setMedia",{title:"Miaow - Bubble",m4a:"http://jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",oga:"http://jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"})},play:function(){a(this).jPlayer("pauseOthers")},timeFormat:{padMin:false},swfPath:"js/jplayer",supplied:"m4a,oga",cssSelectorAncestor:"#audio",useStateClassSkin:true,autoBlur:false,smoothPlayBar:true,remainingDuration:true,keyEnabled:true,keyBindings:{loop:null,muted:null,volumeUp:null,volumeDown:null},wmode:"window",cssSelector:b,stateClass:c});a("#jquery_jplayer_audio_social_cover").jPlayer({ready:function(){a(this).jPlayer("setMedia",{title:"Miaow - Bubble",m4a:"http://jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",oga:"http://jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"})},play:function(){a(this).jPlayer("pauseOthers")},timeFormat:{padMin:false},swfPath:"js/jplayer",supplied:"m4a,oga",cssSelectorAncestor:"#audio_social_cover",useStateClassSkin:true,autoBlur:false,smoothPlayBar:true,remainingDuration:true,keyEnabled:true,keyBindings:{loop:null,muted:null,volumeUp:null,volumeDown:null},wmode:"window",cssSelector:b,stateClass:c});a("#jquery_jplayer_video_1").jPlayer({ready:function(g){var k=a(this).jPlayer("setMedia",{title:"Big Buck Bunny Trailer",m4v:"http://jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v",ogv:"http://jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv",webmv:"http://jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm",poster:"http://jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png"});if(g.jPlayer.status.noFullWindow){var j=a(k.jPlayer("option","wrapper"));j.find(".screen-control").hide();j.find(".bar").css({right:"0"})}var i=function(){var e=k.data("jPlayer").ancestorJq.width(),d=9*e/16;k.jPlayer("option","size",{width:e+"px",height:d+"px"})};var h=a.jPlayer.platform;if(h.ipad||(h.iphone||(h.ipod||g.jPlayer.flash.used))){a(window).on("resize",function(){i()});i()}},timeFormat:{padMin:false},swfPath:"js/jplayer",supplied:"webmv, ogv, m4v",cssSelectorAncestor:"#video",size:{width:"100%",height:"auto",cssClass:"video-responsive"},sizeFull:{cssClass:"video-full"},autohide:{full:false,restored:false},play:function(){a(this).jPlayer("pauseOthers")},pause:function(){},click:function(d){a(this).jPlayer(d.jPlayer.status.paused?"play":"pause")},useStateClassSkin:true,autoBlur:false,smoothPlayBar:!(a.jPlayer.browser.msie&&a.jPlayer.browser.version<9),remainingDuration:true,keyEnabled:true,cssSelector:b,stateClass:c});new jPlayerPlaylist({jPlayer:"#jquery_playlist_1_player",cssSelectorAncestor:"#jquery_playlist_1"},[{title:"Cro Magnon Man",artist:"The Stark Palace",mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",poster:"http://www.jplayer.org/audio/poster/The_Stark_Palace_640x360.png"},{title:"Incredibles Teaser",artist:"Pixar",m4v:"http://www.jplayer.org/video/m4v/Incredibles_Teaser.m4v",ogv:"http://www.jplayer.org/video/ogv/Incredibles_Teaser.ogv",webmv:"http://www.jplayer.org/video/webm/Incredibles_Teaser.webm",poster:"http://www.jplayer.org/video/poster/Incredibles_Teaser_640x272.png"},{title:"Finding Nemo Teaser",artist:"Pixar",m4v:"http://www.jplayer.org/video/m4v/Finding_Nemo_Teaser.m4v",ogv:"http://www.jplayer.org/video/ogv/Finding_Nemo_Teaser.ogv",webmv:"http://www.jplayer.org/video/webm/Finding_Nemo_Teaser.webm",poster:"http://www.jplayer.org/video/poster/Finding_Nemo_Teaser_640x352.png"}],{playlistOptions:{enableRemoveControls:false},swfPath:"js/jplayer",supplied:"webmv, ogv, m4v, oga, mp3",useStateClassSkin:true,autoBlur:false,smoothPlayBar:true,keyEnabled:true,audioFullScreen:true,size:{width:"100%",height:"auto",cssClass:"video-responsive"},sizeFull:{cssClass:"video-full"},cssSelector:b,stateClass:c});new jPlayerPlaylist({jPlayer:"#jquery_playlist_2_player",cssSelectorAncestor:"#jquery_playlist_2"},[{title:"Cro Magnon Man",mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3",oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"},{title:"Your Face",mp3:"http://www.jplayer.org/audio/mp3/TSP-05-Your_face.mp3",oga:"http://www.jplayer.org/audio/ogg/TSP-05-Your_face.ogg"},{title:"Cyber Sonnet",mp3:"http://www.jplayer.org/audio/mp3/TSP-07-Cybersonnet.mp3",oga:"http://www.jplayer.org/audio/ogg/TSP-07-Cybersonnet.ogg"},{title:"Tempered Song",mp3:"http://www.jplayer.org/audio/mp3/Miaow-01-Tempered-song.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-01-Tempered-song.ogg"},{title:"Hidden",mp3:"http://www.jplayer.org/audio/mp3/Miaow-02-Hidden.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-02-Hidden.ogg"},{title:"Lentement",mp3:"http://www.jplayer.org/audio/mp3/Miaow-03-Lentement.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-03-Lentement.ogg"},{title:"Lismore",mp3:"http://www.jplayer.org/audio/mp3/Miaow-04-Lismore.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-04-Lismore.ogg"},{title:"The Separation",mp3:"http://www.jplayer.org/audio/mp3/Miaow-05-The-separation.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-05-The-separation.ogg"},{title:"Beside Me",mp3:"http://www.jplayer.org/audio/mp3/Miaow-06-Beside-me.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-06-Beside-me.ogg"},{title:"Bubble",mp3:"http://www.jplayer.org/audio/mp3/Miaow-07-Bubble.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"},{title:"Stirring of a Fool",mp3:"http://www.jplayer.org/audio/mp3/Miaow-08-Stirring-of-a-fool.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-08-Stirring-of-a-fool.ogg"},{title:"Partir",mp3:"http://www.jplayer.org/audio/mp3/Miaow-09-Partir.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-09-Partir.ogg"},{title:"Thin Ice",mp3:"http://www.jplayer.org/audio/mp3/Miaow-10-Thin-ice.mp3",oga:"http://www.jplayer.org/audio/ogg/Miaow-10-Thin-ice.ogg"}],{playlistOptions:{enableRemoveControls:false},swfPath:"js/jplayer",supplied:"oga, mp3",useStateClassSkin:true,autoBlur:false,smoothPlayBar:true,keyEnabled:true,cssSelector:b,stateClass:c})})})(jQuery);
/*!
 *  3.6.3
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2015
 */
(function(a){a(window).bind("enterBreakpoint480",function(){a(".chat-window-container .panel:not(:last)").remove();a(".chat-window-container .panel").attr("id","chat-0001")});a(window).bind("enterBreakpoint768",function(){if(a(".chat-window-container .panel").length==3){a(".chat-window-container .panel:first").remove();a(".chat-window-container .panel:first").attr("id","chat-0001");a(".chat-window-container .panel:last").attr("id","chat-0002")}})})(jQuery);(function(b){b.expr[":"].containsNoCase=function(f,e,c){var d=c[3];if(!d){return false}return new RegExp(d,"i").test(b(f).text())};function a(d,g){var f=d instanceof jQuery?d.val():b(this).val(),e=typeof g=="undefined"?d.data.opt:g;var c=b(e.targetSelector);c.show();if(f&&f.length>=e.charCount){c.not(":containsNoCase("+f+")").hide()}}b.fn.searchFilter=function(c){var d=b.extend({targetSelector:"",charCount:1},c);return this.each(function(){var e=b(this);e.off("keyup",a);e.on("keyup",null,{opt:d},a)})};b(".chat-filter a").on("click",function(c){c.preventDefault();b(".chat-contacts li").hide();b(".chat-contacts").find(b(this).data("target")).show();b(".chat-filter li").removeClass("active");b(this).parent().addClass("active");b(".chat-search input").searchFilter({targetSelector:".chat-contacts "+b(this).data("target")});a(b(".chat-search input"),{targetSelector:".chat-contacts "+b(this).data("target"),charCount:1})});b(".chat-search input").searchFilter({targetSelector:".chat-contacts li"})})(jQuery);(function(b){var a=b(".chat-window-container");b(".chat-contacts li").on("click",function(){if(b('.chat-window-container [data-user-id="'+b(this).data("userId")+'"]').length){return}if(b(this).attr("class")==="offline"){return}var i=b("#chat-window-template").html();var g=Handlebars.compile(i);var f={user_image:b(this).find("img").attr("src"),user:b(this).find(".contact-name").text()};var e=g(f);var j=b(e);j.attr("data-user-id",b(this).data("userId"));a.find('.panel:not([id^="chat"])').remove();var h=a.find(".panel").length;h++;var d=b(window).width()>768?3:1;if(h>=d){a.find("#chat-000"+d).remove();h=d}j.attr("id","chat-000"+parseInt(h));a.append(j).show();j.show();j.find("> .panel-body").removeClass("display-none");j.find("> input").removeClass("display-none")});function c(){a.find(".panel").each(function(d,e){b(this).attr("id","chat-000"+parseInt(d+1))})}b("body").on("click",".chat-window-container .close",function(){b(this).parent().parent().remove();c();if(b(window).width()<768){b(".chat-window-container").hide()}});b("body").on("click",".chat-window-container .panel-heading",function(d){d.preventDefault();b(this).parent().find("> .panel-body").toggleClass("display-none");b(this).parent().find("> input").toggleClass("display-none")})})(jQuery);
/*!
 *  3.6.3
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2015
 */
(function(a){a(".share textarea").on("keyup",function(){a(".share button")[a(this).val()===""?"hide":"show"]()});if(!a("#scroll-spy").length){return}var b=a("#scroll-spy").offset().top;a("body").scrollspy({target:"#scroll-spy",offset:b})})(jQuery);