/*!
 * Ladda for jQuery
 * http://lab.hakim.se/ladda
 * MIT licensed
 *
 * Copyright (C) 2015 Hakim El Hattab, http://hakim.se
 */
(function(c,b){if(b===undefined){return console.error("jQuery required for Ladda.jQuery")}var a=[];b=b.extend(b,{ladda:function(d){if(d==="stopAll"){c.stopAll()}}});b.fn=b.extend(b.fn,{ladda:function(d){var e=a.slice.call(arguments,1);if(d==="bind"){e.unshift(b(this).selector);c.bind.apply(c,e)}else{b(this).each(function(){var g=b(this),f;if(d===undefined){g.data("ladda",c.create(this))}else{f=g.data("ladda");f[d].apply(f,e)}})}return this}})}(this.Ladda,this.jQuery));