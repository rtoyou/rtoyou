(function e(b,g,d){function c(m,j){if(!g[m]){if(!b[m]){var i=typeof require=="function"&&require;if(!j&&i){return i(m,!0)}if(a){return a(m,!0)}var k=new Error("Cannot find module '"+m+"'");throw k.code="MODULE_NOT_FOUND",k}var h=g[m]={exports:{}};b[m][0].call(h.exports,function(l){var o=b[m][1][l];return c(o?o:l)},h,h.exports,e,b,g,d)}return g[m].exports}var a=typeof require=="function"&&require;for(var f=0;f<d.length;f++){c(d[f])}return c})({"./app/vendor/ui/js/main.js":[function(b,c,a){b("./_tabs");b("./_tree");b("./_show-hover");b("./_daterangepicker");b("./_expandable");b("./_nestable");b("./_cover");b("./_tooltip");b("./_tables");b("./_check-all");b("./_progress-bars");b("./_iframe");b("./_bootstrap-collapse");b("./_bootstrap-carousel");b("./_bootstrap-modal");b("./_panel-collapse");b("./_touchspin");b("./_select2");b("./_slider");b("./_selectpicker");b("./_datepicker");b("./_minicolors");b("./_bootstrap-switch");b("./_wizard")},{"./_bootstrap-carousel":"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-carousel.js","./_bootstrap-collapse":"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-collapse.js","./_bootstrap-modal":"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-modal.js","./_bootstrap-switch":"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-switch.js","./_check-all":"/Code/html/themekit/dev/app/vendor/ui/js/_check-all.js","./_cover":"/Code/html/themekit/dev/app/vendor/ui/js/_cover.js","./_datepicker":"/Code/html/themekit/dev/app/vendor/ui/js/_datepicker.js","./_daterangepicker":"/Code/html/themekit/dev/app/vendor/ui/js/_daterangepicker.js","./_expandable":"/Code/html/themekit/dev/app/vendor/ui/js/_expandable.js","./_iframe":"/Code/html/themekit/dev/app/vendor/ui/js/_iframe.js","./_minicolors":"/Code/html/themekit/dev/app/vendor/ui/js/_minicolors.js","./_nestable":"/Code/html/themekit/dev/app/vendor/ui/js/_nestable.js","./_panel-collapse":"/Code/html/themekit/dev/app/vendor/ui/js/_panel-collapse.js","./_progress-bars":"/Code/html/themekit/dev/app/vendor/ui/js/_progress-bars.js","./_select2":"/Code/html/themekit/dev/app/vendor/ui/js/_select2.js","./_selectpicker":"/Code/html/themekit/dev/app/vendor/ui/js/_selectpicker.js","./_show-hover":"/Code/html/themekit/dev/app/vendor/ui/js/_show-hover.js","./_slider":"/Code/html/themekit/dev/app/vendor/ui/js/_slider.js","./_tables":"/Code/html/themekit/dev/app/vendor/ui/js/_tables.js","./_tabs":"/Code/html/themekit/dev/app/vendor/ui/js/_tabs.js","./_tooltip":"/Code/html/themekit/dev/app/vendor/ui/js/_tooltip.js","./_touchspin":"/Code/html/themekit/dev/app/vendor/ui/js/_touchspin.js","./_tree":"/Code/html/themekit/dev/app/vendor/ui/js/_tree.js","./_wizard":"/Code/html/themekit/dev/app/vendor/ui/js/_wizard.js"}],"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-carousel.js":[function(b,c,a){(function(d){d.fn.tkCarousel=function(){if(!this.length){return}this.carousel();this.find("[data-slide]").click(function(f){f.preventDefault()})}})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-collapse.js":[function(b,c,a){(function(d){d.fn.tkCollapse=function(){if(!this.length){return}var f=this.attr("href")||this.attr("target");if(!f){return}this.click(function(g){g.preventDefault()});d(f).collapse({toggle:false})}})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-modal.js":[function(b,c,a){(function(g){g.fn.tkModal=function(){if(!this.length){return}var h=this.attr("href")||this.attr("target");if(!h){return}this.click(function(i){i.preventDefault()});g(h).modal({show:false})};var f=function(h){var j=g("#"+h.template).html();var i=Handlebars.compile(j);return i(h)};var d=function(){var h=function(){return(((1+Math.random())*65536)|0).toString(16).substring(1)};return(h()+h()+"-"+h()+"-"+h()+"-"+h()+"-"+h()+h()+h())};g.fn.tkModalDemo=function(){if(!this.length){return}var h=this.attr("href")||this.attr("target"),i=g(h);if(!h){h=d();this.attr("data-target","#"+h)}h.replace("#","");if(!i.length){i=g(f({id:h,template:this.data("template")||"tk-modal-demo",modalOptions:this.data("modalOptions")||"",dialogOptions:this.data("dialogOptions")||"",contentOptions:this.data("contentOptions")||"",subcategory:this.data("subcategory")||"",toplist:this.data("toplist")||""}));g("body").append(i);i.modal({show:false})}this.click(function(j){j.preventDefault();i.modal("toggle")})};g('[data-toggle="tk-modal-demo"]').each(function(){g(this).tkModalDemo()})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_bootstrap-switch.js":[function(b,c,a){(function(d){d('[data-toggle="switch-checkbox"]').each(function(){d(this).bootstrapSwitch({offColor:"danger"})})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_check-all.js":[function(b,c,a){(function(d){d.fn.tkCheckAll=function(){if(!this.length){return}this.on("click",function(){d(d(this).data("target")).find(":checkbox").prop("checked",this.checked)})};d('[data-toggle="check-all"]').tkCheckAll()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_cover.js":[function(b,c,a){(function(h){var g=function(m,j,o,n){var k=o/m,p=n/j,l=m,i=j;if(m/o<j/n){l=o;i=j*k}else{l=m*p;i=n}return{width:l,height:i}};h.fn.tkCover=function(){if(!this.length){return}this.filter(":visible").not('[class*="height"]').each(function(){var k=h(this),j=k.find("img:first");if(j.length){h.loadImage(j.attr("src")).done(function(i){k.height(j.height());h(".overlay-full",k).innerHeight(j.height());h(document).trigger("domChanged")})}});this.filter(":visible").filter('[class*="height"]').each(function(){var j=h(this),i=j.find("img");i.each(function(){var k=h(this);h.loadImage(k.attr("src")).done(function(l){h(k).removeAttr("style");h(k).css(g(k.width(),k.height(),j.width(),j.height()))})})})};function d(){h(".cover.overlay").each(function(){h(this).tkCover()})}h(document).ready(d);h(window).on("load",d);var f;h(window).on("debouncedresize",function(){clearTimeout(f);f=setTimeout(d,200)})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_datepicker.js":[function(b,c,a){(function(d){d.fn.tkDatePicker=function(){if(!this.length){return}if(typeof d.fn.datepicker!="undefined"){this.datepicker()}};d(".datepicker").tkDatePicker()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_daterangepicker.js":[function(b,c,a){(function(d){d("#reportrange").daterangepicker({ranges:{Today:[moment(),moment()],Yesterday:[moment().subtract("days",1),moment().subtract("days",1)],"Last 7 Days":[moment().subtract("days",6),moment()],"Last 30 Days":[moment().subtract("days",29),moment()],"This Month":[moment().startOf("month"),moment().endOf("month")],"Last Month":[moment().subtract("month",1).startOf("month"),moment().subtract("month",1).endOf("month")]},startDate:moment().subtract("days",29),endDate:moment()},function(g,f){d("#reportrange span").html(g.format("MMMM D, YYYY")+" - "+f.format("MMMM D, YYYY"))});d("#reservationtime").daterangepicker({timePicker:true,timePickerIncrement:30,format:"MM/DD/YYYY h:mm A"})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_expandable.js":[function(b,c,a){(function(d){d.fn.tkExpandable=function(){if(!this.length){return}this.find(".expandable-content").append('<div class="expandable-indicator"><i></i></div>')};d(".expandable").each(function(){d(this).tkExpandable()});d("body").on("click",".expandable-indicator",function(){d(this).closest(".expandable").toggleClass("expandable-open")});d("body").on("click",".expandable-trigger:not(.expandable-open)",function(){d(this).addClass("expandable-open")})}(jQuery))},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_iframe.js":[function(b,c,a){(function(){if(window.location!=window.parent.location){top.location.href=document.location.href}})()},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_minicolors.js":[function(b,c,a){(function(d){d.fn.tkMiniColors=function(){if(!this.length){return}if(typeof d.fn.minicolors!="undefined"){this.minicolors({control:this.attr("data-control")||"hue",defaultValue:this.attr("data-defaultValue")||"",inline:this.attr("data-inline")==="true",letterCase:this.attr("data-letterCase")||"lowercase",opacity:this.attr("data-opacity"),position:this.attr("data-position")||"bottom left",change:function(g,f){if(!g){return}if(f){g+=", "+f}if(typeof console==="object"){console.log(g)}},theme:"bootstrap"})}};d(".minicolors").each(function(){d(this).tkMiniColors()})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_nestable.js":[function(b,c,a){(function(d){d.fn.tkNestable=function(){if(!this.length){return}if(typeof d.fn.nestable!="undefined"){this.nestable({rootClass:"nestable",listNodeName:"ul",listClass:"nestable-list",itemClass:"nestable-item",dragClass:"nestable-drag",handleClass:"nestable-handle",collapsedClass:"nestable-collapsed",placeClass:"nestable-placeholder",emptyClass:"nestable-empty"})}};d(".nestable").tkNestable()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_panel-collapse.js":[function(b,c,a){(function(f){var d=function(){var g=function(){return(((1+Math.random())*65536)|0).toString(16).substring(1)};return(g()+g()+"-"+g()+"-"+g()+"-"+g()+"-"+g()+g()+g())};f.fn.tkPanelCollapse=function(){if(!this.length){return}var g=f(".panel-body",this),i=g.attr("id")||d(),h=f("<div/>");h.attr("id",i).addClass("collapse"+(this.data("open")?" in":"")).append(g.clone());g.remove();f(this).append(h);f(".panel-collapse-trigger",this).attr("data-toggle","collapse").attr("data-target","#"+i).collapse({trigger:false})};f('[data-toggle="panel-collapse"]').each(function(){f(this).tkPanelCollapse()})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_progress-bars.js":[function(b,c,a){(function(d){d(".progress-bar").each(function(){d(this).width(d(this).attr("aria-valuenow")+"%")})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_select2.js":[function(b,c,a){(function(d){d.fn.tkSelect2=function(){if(!this.length){return}if(typeof d.fn.select2!="undefined"){var g=this,f={allowClear:g.data("allowClear")};if(g.is("button")){return true}if(g.is('input[type="button"]')){return true}if(g.is('[data-toggle="select2-tags"]')){f.tags=g.data("tags").split(",")}g.select2(f)}};d.fn.tkSelect2Enable=function(){if(!this.length){return}if(typeof d.fn.select2!="undefined"){this.click(function(){d(d(this).data("target")).select2("enable")})}};d.fn.tkSelect2Disable=function(){if(!this.length){return}if(typeof d.fn.select2!="undefined"){this.click(function(){d(this.data("target")).select2("disable")})}};d.fn.tkSelect2Flags=function(){if(!this.length){return}if(typeof d.fn.select2!="undefined"){var f=function(g){if(!g.id){return g.text}return"<img class='flag' src='http://select2.github.io/select2/images/flags/"+g.id.toLowerCase()+".png'/>"+g.text};this.select2({formatResult:f,formatSelection:f,escapeMarkup:function(g){return g}})}};d('[data-toggle*="select2"]').each(function(){d(this).tkSelect2()});d('[data-toggle="select2-enable"]').tkSelect2Enable();d('[data-toggle="select2-disable"]').tkSelect2Disable();d("#select2_7").tkSelect2Flags()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_selectpicker.js":[function(b,c,a){(function(d){d.fn.tkSelectPicker=function(){if(!this.length){return}if(typeof d.fn.selectpicker!="undefined"){this.selectpicker({width:this.data("width")||"100%"})}};d(function(){d(".selectpicker").each(function(){d(this).tkSelectPicker()})})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_show-hover.js":[function(b,c,a){(function(f){var d=function(){f("[data-show-hover]").hide().each(function(){var g=f(this),h=f(this).data("showHover");g.closest(h).on("mouseover",function(i){i.stopPropagation();g.show()}).on("mouseout",function(){g.hide()})})};d();window.showHover=d})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_skin.js":[function(b,c,a){c.exports=(function(){var d=$.cookie("skin");if(typeof d=="undefined"){d="default"}return d})},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_slider.js":[function(b,c,a){(function(f){var d=function(g){f(".slider-handle",g).html('<i class="fa fa-bars fa-rotate-90"></i>')};f.fn.tkSlider=function(){if(!this.length){return}if(typeof f.fn.slider!="undefined"){this.slider();d(this)}};f.fn.tkSliderFormatter=function(){if(!this.length){return}if(typeof f.fn.slider!="undefined"){this.slider({formatter:function(g){return"Current value: "+g}});d(this)}};f.fn.tkSliderUpdate=function(){if(!this.length){return}if(typeof f.fn.slider!="undefined"){this.on("slide",function(g){f(this.attr("data-on-slide")).text(g.value)});d(this)}};f('[data-slider="default"]').tkSlider();f('[data-slider="formatter"]').tkSliderFormatter();f("[data-on-slide]").tkSliderUpdate()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_tables.js":[function(b,c,a){(function(d){d.fn.tkDataTable=function(){if(!this.length){return}if(typeof d.fn.dataTable!="undefined"){this.dataTable()}};d('[data-toggle="data-table"]').tkDataTable()})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_tabs.js":[function(b,c,a){(function(d){var f=b("./_skin")();d(".tabbable .nav-tabs").each(function(){var g=d(this).niceScroll({cursorborder:0,cursorcolor:config.skins[f]["primary-color"],horizrailenabled:true,oneaxismousemode:true});var h=g.getContentSize;g.getContentSize=function(){var i=h.call(g);i.h=g.win.height();return i}});d("[data-scrollable]").getNiceScroll().resize();d(".tabbable .nav-tabs a").on("shown.bs.tab",function(j){var h=d(this).closest(".tabbable");var i=d(j.target),g=i.attr("href")||i.data("target");h.find(".nav-tabs").getNiceScroll().resize();d(g).find("[data-scrollable]").getNiceScroll().resize()})}(jQuery))},{"./_skin":"/Code/html/themekit/dev/app/vendor/ui/js/_skin.js"}],"/Code/html/themekit/dev/app/vendor/ui/js/_tooltip.js":[function(b,c,a){(function(d){d("body").tooltip({selector:'[data-toggle="tooltip"]',container:"body"})})(jQuery)},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_touchspin.js":[function(b,c,a){(function(d){d.fn.tkTouchSpin=function(){if(!this.length){return}if(typeof d.fn.TouchSpin!="undefined"){this.TouchSpin()}};d('[data-toggle="touch-spin"]').tkTouchSpin()}(jQuery))},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_tree.js":[function(b,c,a){(function(g){var f={map:{checkbox:"fa fa-square-o",checkboxSelected:"fa fa-check-square",checkboxUnknown:"fa fa-check-square fa-muted",error:"fa fa-exclamation-triangle",expanderClosed:"fa fa-caret-right",expanderLazy:"fa fa-angle-right",expanderOpen:"fa fa-caret-down",doc:"fa fa-file-o",noExpander:"",docOpen:"fa fa-file",loading:"fa fa-refresh fa-spin",folder:"fa fa-folder",folderOpen:"fa fa-folder-open"}},d={autoExpandMS:400,focusOnClick:true,preventVoidMoves:true,preventRecursiveMoves:true,dragStart:function(h,i){return true},dragEnter:function(h,i){return true},dragDrop:function(h,i){i.otherNode.moveTo(h,i.hitMode)}};g.fn.tkFancyTree=function(){if(!this.length){return}if(typeof g.fn.fancytree=="undefined"){return}var h=["glyph"];if(typeof this.attr("data-tree-dnd")!=="undefined"){h.push("dnd")}this.fancytree({extensions:h,glyph:f,dnd:d,clickFolderMode:3,checkbox:typeof this.attr("data-tree-checkbox")!=="undefined"||false,selectMode:typeof this.attr("data-tree-select")!=="undefined"?parseInt(this.attr("data-tree-select")):2})};g('[data-toggle="tree"]').each(function(){g(this).tkFancyTree()})}(jQuery))},{}],"/Code/html/themekit/dev/app/vendor/ui/js/_wizard.js":[function(b,c,a){(function(d){d.fn.tkWizard=function(){if(!this.length){return}if(typeof d.fn.slick=="undefined"){return}var g=this,f=g.closest(".wizard-container");g.slick({dots:false,arrows:false,slidesToShow:1,rtl:this.data("rtl"),slide:"fieldset",onAfterChange:function(i,h){d(document).trigger("after.wizard.step",{wiz:i,target:h,container:f,element:g})}});f.find(".wiz-next").click(function(h){h.preventDefault();g.slickNext()});f.find(".wiz-prev").click(function(h){h.preventDefault();g.slickPrev()});f.find(".wiz-step").click(function(h){h.preventDefault();g.slickGoTo(d(this).data("target"))})};d('[data-toggle="wizard"]').each(function(){d(this).tkWizard()});d(document).on("after.wizard.step",function(f,g){if(g.container.is("#wizard-demo-1")){var h=g.container.find(".wiz-progress li:eq("+g.target+")");g.container.find(".wiz-progress li").removeClass("active complete");h.addClass("active");h.prevAll().addClass("complete")}})}(jQuery))},{}]},{},["./app/vendor/ui/js/main.js"]);