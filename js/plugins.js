/* ------------------------------------------------------------------------------

OPTIMISED AND JOINED PLUGINS, YO
dbaines.com

Compressed with:
http://www.refresh-sf.com/yui

------------------------------------------------------------------------------ */
/*
 * 	Easy Slider 1.7 - jQuery plugin
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/4004/easy-slider-15-the-easiest-jquery-plugin-for-sliding
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *  Slight modifications by David Baines to enable multiple sliders and keyboard navigation
 * 
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
(function($) {

	$.fn.easySlider = function(options){
	  
		// default configuration properties
		var defaults = {			
			prevId: 		'prevBtn',
			prevText: 		'Previous',
			nextId: 		'nextBtn',	
			nextText: 		'Next',
			controlsShow:	true,
			controlsBefore:	'',
			controlsAfter:	'',	
			controlsFade:	true,
			firstId: 		'firstBtn',
			firstText: 		'First',
			firstShow:		false,
			lastId: 		'lastBtn',	
			lastText: 		'Last',
			lastShow:		false,				
			vertical:		false,
			speed: 			800,
			auto:			false,
			pause:			2000,
			continuous:		false, 
			numeric: 		false,
			numericId: 		'controls',
			
			// dBaines Modifications
			keyboard:		false,
			responsive:		true
		}; 
		
		var options = $.extend(defaults, options);  
		
		// dBaines.com - Start SliderNum
		var sliderNum = 0;
				
		this.each(function() { 
		
			// dBaines.com target
			var thisSlider = $(this);
		
			// dBaines.com - Keyboard Navigation			
			if(options.keyboard) {
				// Keypress Listeners
				function checkKey(e){
					 switch (e.keyCode) {
						case 37:
							e.preventDefault();
							animate("prev",true);
							break;
						case 39:
							e.preventDefault();
							animate("next",true);
							break;
						default:
							}
				}
				
				// Keypress Listener Support
				if ($.browser.mozilla) {
					$(document).keypress(checkKey);
				} else {
					$(document).keydown(checkKey);
				}
			}
		
			// dBaines.com - Iterate Slider Number
			sliderNum = parseInt(sliderNum) + 1;
			
			// dBaines.com - Add Slider Number to Controls ID
			options.numericId = options.numericId + sliderNum;
			
			// dBaines.com change targeted object to a class for Multiple Sliders
			var thisClass = "slider"+sliderNum;
			$(this).addClass(thisClass);
			
			var obj = $("."+thisClass);
			var s = $("li", obj).length;
			var w = $("li", obj).width(); 
			var h = $("li", obj).height(); 
			var clickable = true;
			obj.width(w); 
			obj.height(h); 
			obj.css("overflow","hidden");
			var ts = s-1;
			var t = 0;
			$("ul", obj).css('width',s*w);
			
			if(options.continuous){
				$("ul", obj).prepend($("ul li:last-child", obj).clone().css("margin-left","-"+ w +"px"));
				$("ul", obj).append($("ul li:nth-child(2)", obj).clone());
				$("ul", obj).css('width',(s+1)*w);
			};				
			
			if(!options.vertical) $("li", obj).css('float','left');
								
			if(options.controlsShow){
				var html = options.controlsBefore;				
				if(options.numeric){
					html += '<ol id="'+ options.numericId +'" class="controls"></ol>';
				} else {
					if(options.firstShow) html += '<span id="'+ options.firstId +'"><a href=\"javascript:void(0);\">'+ options.firstText +'</a></span>';
					html += ' <span id="'+ options.prevId +'"><a href=\"javascript:void(0);\">'+ options.prevText +'</a></span>';
					html += ' <span id="'+ options.nextId +'"><a href=\"javascript:void(0);\">'+ options.nextText +'</a></span>';
					if(options.lastShow) html += ' <span id="'+ options.lastId +'"><a href=\"javascript:void(0);\">'+ options.lastText +'</a></span>';				
				};
				
				html += options.controlsAfter;						
				$(obj).after(html);										
			};
			
			if(options.numeric){									
				for(var i=0;i<s;i++){
					$(document.createElement("li"))
						.attr('id',options.numericId + (i+1))
						.html('<a rel='+ i +' href=\"javascript:void(0);\">'+ (i+1) +'</a>')
						.appendTo($("#"+ options.numericId))
						.click(function(){
							// dBaines.com - relocating current-ing here for multi-slider compatability
							$(this).parent("ol").children("li").removeClass("current");
							$(this).addClass("current");
							var $thisButton = $(this).children("a").attr("data-control");
							
							// Normal animate call
							animate($("a",$(this)).attr('rel'),true);
						});
					$("#"+options.numericId).children("li:first").addClass("current");
				};						
			} else {
				$("a","#"+options.nextId).click(function(){		
					animate("next",true);
				});
				$("a","#"+options.prevId).click(function(){		
					animate("prev",true);				
				});	
				$("a","#"+options.firstId).click(function(){		
					animate("first",true);
				});				
				$("a","#"+options.lastId).click(function(){		
					animate("last",true);				
				});				
			};
			
			function setCurrent(i){
				i = parseInt(i)+1;
				//$("li", "#" + options.numericId + sliderNum).removeClass("current");
				//$("li." + options.numericId + sliderNum + i).addClass("current");
			};
			
			function adjust(){
				if(t>ts) t=0;		
				if(t<0) t=ts;	
				if(!options.vertical) {
					$("ul",obj).css("margin-left",(t*w*-1));
				} else {
					$("ul",obj).css("margin-left",(t*h*-1));
				}
				clickable = true;
				if(options.numeric) setCurrent(t);
			};
			
			function animate(dir,clicked){
				if (clickable){
					clickable = false;
					var ot = t;				
					switch(dir){
						case "next":
							t = (ot>=ts) ? (options.continuous ? t+1 : ts) : t+1;						
							break; 
						case "prev":
							t = (t<=0) ? (options.continuous ? t-1 : 0) : t-1;
							break; 
						case "first":
							t = 0;
							break; 
						case "last":
							t = ts;
							break; 
						default:
							t = dir;
							break; 
					};	
					var diff = Math.abs(ot-t);
					var speed = diff*options.speed;						
					if(!options.vertical) {
						p = (t*w*-1);
						$("ul",obj).animate(
							{ marginLeft: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);				
					} else {
						p = (t*h*-1);
						$("ul",obj).animate(
							{ marginTop: p }, 
							{ queue:false, duration:speed, complete:adjust }
						);					
					};
					
					if(!options.continuous && options.controlsFade){					
						if(t==ts){
							$("a","#"+options.nextId).hide();
							$("a","#"+options.lastId).hide();
						} else {
							$("a","#"+options.nextId).show();
							$("a","#"+options.lastId).show();					
						};
						if(t==0){
							$("a","#"+options.prevId).hide();
							$("a","#"+options.firstId).hide();
						} else {
							$("a","#"+options.prevId).show();
							$("a","#"+options.firstId).show();
						};					
					};				
					
					if(clicked) clearTimeout(timeout);
					if(options.auto && dir=="next" && !clicked){;
						timeout = setTimeout(function(){
							animate("next",false);
						},diff*options.speed+options.pause);
					};
			
				};
				
			};
			// init
			var timeout;
			if(options.auto){;
				timeout = setTimeout(function(){
					animate("next",false);
				},options.pause);
			};		
			
			if(options.numeric) setCurrent(0);
		
			if(!options.continuous && options.controlsFade){					
				$("a","#"+options.prevId).hide();
				$("a","#"+options.firstId).hide();				
			};				
			
			// dBaines.com - Reset NumericID
			options.numericId = options.numericId.substr(0,8);
			
			/* dBaines.com - Responsive Resizing */
			if(options.responsive) {
			
				function resizeSlider() {
					thisSlider.find("li").each(function() {
						sliderHeight = $(this).height();
						sliderWidth = $(this).width();
						thisSlider.height(sliderHeight).width(sliderWidth);
					});
				}
				resizeSlider();
				
				// Listen for a window resize
				$(window).bind("resize", resizeSlider);
			}
			
			
		});
	  
	};

})(jQuery);






// ColorBox v1.3.15 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2010 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
(function(B,P){var C={transition:"elastic",speed:300,width:false,initialWidth:"600",innerWidth:false,maxWidth:false,height:false,initialHeight:"450",innerHeight:false,maxHeight:false,scalePhotos:true,scrolling:true,inline:false,html:false,iframe:false,photo:false,href:false,title:false,rel:false,opacity:0.9,preloading:true,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",open:false,returnFocus:true,loop:true,slideshow:false,slideshowAuto:true,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:false,onLoad:false,onComplete:false,onCleanup:false,onClosed:false,overlayClose:true,escKey:true,arrowKey:true,showdate:false},t="colorbox",M="cbox",O=M+"_open",e=M+"_load",N=M+"_complete",q=M+"_cleanup",U=M+"_closed",i=M+"_purge",I=M+"_loaded",r=B.browser.msie&&!B.support.opacity,X=r&&B.browser.version<7,T=M+"_IE6",K,Y,Z,d,z,m,b,J,c,S,F,j,h,l,p,Q,o,L,v,aa,k,g,a,s,A,V,x,R,E=false,D,n=M+"Element";function H(ac,ab){ac=ac?' id="'+M+ac+'"':"";ab=ab?' style="'+ab+'"':"";return B("<div"+ac+ab+"/>")}function G(ab,ac){ac=ac==="x"?S.width():S.height();return(typeof ab==="string")?Math.round((/%/.test(ab)?(ac/100)*parseInt(ab,10):parseInt(ab,10))):ab}function w(ab){return V.photo||/\.(gif|png|jpg|jpeg|bmp)(?:\?([^#]*))?(?:#(\.*))?$/i.test(ab)}function W(ac){for(var ab in ac){if(B.isFunction(ac[ab])&&ab.substring(0,2)!=="on"){ac[ab]=ac[ab].call(s)}}ac.rel=ac.rel||s.rel||"nofollow";ac.href=ac.href||B(s).attr("href");ac.title=ac.title||s.title;ac.date=B(s).attr("data-date");return ac}function y(ab,ac){if(ac){ac.call(s)}B.event.trigger(ab)}function u(){var ac,ae=M+"Slideshow_",af="click."+M,ag,ad,ab;if(V.slideshow&&c[1]){ag=function(){Q.text(V.slideshowStop).unbind(af).bind(N,function(){if(A<c.length-1||V.loop){ac=setTimeout(D.next,V.slideshowSpeed)}}).bind(e,function(){clearTimeout(ac)}).one(af+" "+q,ad);Y.removeClass(ae+"off").addClass(ae+"on");ac=setTimeout(D.next,V.slideshowSpeed)};ad=function(){clearTimeout(ac);Q.text(V.slideshowStart).unbind([N,e,q,af].join(" ")).one(af,ag);Y.removeClass(ae+"on").addClass(ae+"off")};if(V.slideshowAuto){ag()}else{ad()}}}function f(ab){if(!E){s=ab;V=W(B.extend({},B.data(s,t)));c=B(s);A=0;if(V.rel!=="nofollow"){c=B("."+n).filter(function(){var ad=B.data(this,t).rel||this.rel;return(ad===V.rel)});A=c.index(s);if(A===-1){c=c.add(s);A=c.length-1}}if(!x){x=R=true;Y.show();if(V.returnFocus){try{s.blur();B(s).one(U,function(){try{this.focus()}catch(ad){}})}catch(ac){}}K.css({opacity:+V.opacity,cursor:V.overlayClose?"pointer":"auto"}).show();V.w=G(V.initialWidth,"x");V.h=G(V.initialHeight,"y");D.position(0);if(X){S.bind("resize."+T+" scroll."+T,function(){K.css({width:S.width(),height:S.height(),top:S.scrollTop(),left:S.scrollLeft()})}).trigger("scroll."+T)}y(O,V.onOpen);p.add(L).add(o).add(Q).add(l).add($date).hide();v.html(V.close).show()}D.load(true)}}D=B.fn[t]=B[t]=function(ab,ae){var ac=this,ad;if(!ac[0]&&ac.selector){return ac}ab=ab||{};if(ae){ab.onComplete=ae}if(!ac[0]||ac.selector===undefined){ac=B("<a/>");ab.open=true}ac.each(function(){B.data(this,t,B.extend({},B.data(this,t)||C,ab));B(this).addClass(n)});ad=ab.open;if(B.isFunction(ad)){ad=ad.call(ac)}if(ad){f(ac[0])}return ac};D.init=function(){S=B(P);Y=H().attr({id:t,"class":r?M+"IE":""});K=H("Overlay",X?"position:absolute":"").hide();Z=H("Wrapper");d=H("Content").append(F=H("LoadedContent","width:0; height:0; overflow:hidden"),h=H("LoadingOverlay").add(H("LoadingGraphic")),l=H("Title"),$date=H("Date"),p=H("Current"),o=H("Next"),L=H("Previous"),Q=H("Slideshow").bind(O,u),v=H("Close"));Z.append(H().append(H("TopLeft"),z=H("TopCenter"),H("TopRight")),H(false,"clear:left").append(m=H("MiddleLeft"),d,b=H("MiddleRight")),H(false,"clear:left").append(H("BottomLeft"),J=H("BottomCenter"),H("BottomRight"))).children().children().css({"float":"left"});j=H(false,"position:absolute; width:9999px; visibility:hidden; display:none");B("body").prepend(K,Y.append(Z,j));d.children().hover(function(){B(this).addClass("hover")},function(){B(this).removeClass("hover")}).addClass("hover");aa=z.height()+J.height()+d.outerHeight(true)-d.height();k=m.width()+b.width()+d.outerWidth(true)-d.width();g=F.outerHeight(true);a=F.outerWidth(true);Y.css({"padding-bottom":aa,"padding-right":k}).hide();o.click(D.next);L.click(D.prev);v.click(D.close);d.children().removeClass("hover");B("."+n).live("click",function(ab){if(!((ab.button!==0&&typeof ab.button!=="undefined")||ab.ctrlKey||ab.shiftKey||ab.altKey)){ab.preventDefault();f(this)}});K.click(function(){if(V.overlayClose){D.close()}});B(document).bind("keydown",function(ab){if(x&&V.escKey&&ab.keyCode===27){ab.preventDefault();D.close()}if(x&&V.arrowKey&&!R&&c[1]){if(ab.keyCode===37&&(A||V.loop)){ab.preventDefault();L.click()}else{if(ab.keyCode===39&&(A<c.length-1||V.loop)){ab.preventDefault();o.click()}}}})};D.remove=function(){Y.add(K).remove();B("."+n).die("click").removeData(t).removeClass(n)};D.position=function(af,ac){var ae,ad=Math.max(document.documentElement.clientHeight-V.h-g-aa,0)/2+S.scrollTop(),ab=Math.max(S.width()-V.w-a-k,0)/2+S.scrollLeft();ae=(Y.width()===V.w+a&&Y.height()===V.h+g)?0:af;Z[0].style.width=Z[0].style.height="9999px";function ag(ah){z[0].style.width=J[0].style.width=d[0].style.width=ah.style.width;h[0].style.height=h[1].style.height=d[0].style.height=m[0].style.height=b[0].style.height=ah.style.height}Y.dequeue().animate({width:V.w+a,height:V.h+g,top:ad,left:ab},{duration:ae,complete:function(){ag(this);R=false;Z[0].style.width=(V.w+a+k)+"px";Z[0].style.height=(V.h+g+aa)+"px";if(ac){ac()}},step:function(){ag(this)}})};D.resize=function(ab){if(x){ab=ab||{};if(ab.width){V.w=G(ab.width,"x")-a-k}if(ab.innerWidth){V.w=G(ab.innerWidth,"x")}F.css({width:V.w});if(ab.height){V.h=G(ab.height,"y")-g-aa}if(ab.innerHeight){V.h=G(ab.innerHeight,"y")}if(!ab.innerHeight&&!ab.height){var ac=F.wrapInner("<div style='overflow:auto'></div>").children();V.h=ac.height();ac.replaceWith(ac.children())}F.css({height:V.h});D.position(V.transition==="none"?0:V.speed)}};D.prep=function(ae){if(!x){return}var ad,af=V.transition==="none"?0:V.speed;S.unbind("resize."+M);F.remove();F=H("LoadedContent").html(ae);function ab(){V.w=V.w||F.width();V.w=V.mw&&V.mw<V.w?V.mw:V.w;return V.w}function ag(){V.h=V.h||F.height();V.h=V.mh&&V.mh<V.h?V.mh:V.h;return V.h}F.hide().appendTo(j.show()).css({width:ab(),overflow:V.scrolling?"auto":"hidden"}).css({height:ag()}).prependTo(d);j.hide();B("#"+M+"Photo").css({cssFloat:"none",marginLeft:"auto",marginRight:"auto"});if(X){B("select").not(Y.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(q,function(){this.style.visibility="inherit"})}function ac(ak){var am,an,aj,ai,al=c.length,ah=V.loop;D.position(ak,function(){function ao(){if(r){Y[0].style.removeAttribute("filter")}}if(!x){return}if(r){if(ad){F.fadeIn(100)}}F.show();y(I);l.show().html(V.title);if(V.showdate){$date.show().html(V.date)}if(al>1){if(typeof V.current==="string"){p.html(V.current.replace(/\{current\}/,A+1).replace(/\{total\}/,al)).show()}o[(ah||A<al-1)?"show":"hide"]().html(V.next);L[(ah||A)?"show":"hide"]().html(V.previous);am=A?c[A-1]:c[al-1];aj=A<al-1?c[A+1]:c[0];if(V.slideshow){Q.show()}if(V.preloading){ai=B.data(aj,t).href||aj.href;an=B.data(am,t).href||am.href;ai=B.isFunction(ai)?ai.call(aj):ai;an=B.isFunction(an)?an.call(am):an;if(w(ai)){B("<img/>")[0].src=ai}if(w(an)){B("<img/>")[0].src=an}}}h.hide();if(V.transition==="fade"){Y.fadeTo(af,1,function(){ao()})}else{ao()}S.bind("resize."+M,function(){D.position(0)});y(N,V.onComplete)})}if(V.transition==="fade"){Y.fadeTo(af,0,function(){ac(0)})}else{ac(af)}};D.load=function(ae){var ad,ac,af,ab=D.prep;R=true;s=c[A];if(!ae){V=W(B.extend({},B.data(s,t)))}y(i);y(e,V.onLoad);V.h=V.height?G(V.height,"y")-g-aa:V.innerHeight&&G(V.innerHeight,"y");V.w=V.width?G(V.width,"x")-a-k:V.innerWidth&&G(V.innerWidth,"x");V.mw=V.w;V.mh=V.h;if(V.maxWidth){V.mw=G(V.maxWidth,"x")-a-k;V.mw=V.w&&V.w<V.mw?V.w:V.mw}if(V.maxHeight){V.mh=G(V.maxHeight,"y")-g-aa;V.mh=V.h&&V.h<V.mh?V.h:V.mh}ad=V.href;h.show();if(V.inline){H().hide().insertBefore(B(ad)[0]).one(i,function(){B(this).replaceWith(F.children())});ab(B(ad))}else{if(V.iframe){Y.one(I,function(){var ag=B("<iframe frameborder='0' style='width:100%; height:100%; border:0; display:block'/>")[0];ag.name=M+(+new Date());ag.src=V.href;if(!V.scrolling){ag.scrolling="no"}if(r){ag.allowtransparency="true"}B(ag).appendTo(F).one(i,function(){ag.src="//about:blank"})});ab(" ")}else{if(V.html){ab(V.html)}else{if(w(ad)){ac=new Image();ac.onload=function(){var ag;ac.onload=null;ac.id=M+"Photo";B(ac).css({border:"none",display:"block",cssFloat:"left"});if(V.scalePhotos){af=function(){ac.height-=ac.height*ag;ac.width-=ac.width*ag};if(V.mw&&ac.width>V.mw){ag=(ac.width-V.mw)/ac.width;af()}if(V.mh&&ac.height>V.mh){ag=(ac.height-V.mh)/ac.height;af()}}if(V.h){ac.style.marginTop=Math.max(V.h-ac.height,0)/2+"px"}if(c[1]&&(A<c.length-1||V.loop)){B(ac).css({cursor:"pointer"}).click(D.next)}if(r){ac.style.msInterpolationMode="bicubic"}setTimeout(function(){ab(ac)},1)};setTimeout(function(){ac.src=ad},1)}else{if(ad){j.load(ad,function(ah,ag,ai){ab(ag==="error"?"Request unsuccessful: "+ai.statusText:B(this).children())})}}}}}};D.next=function(){if(!R){A=A<c.length-1?A+1:0;D.load()}};D.prev=function(){if(!R){A=A?A-1:c.length-1;D.load()}};D.close=function(){if(x&&!E){E=true;x=false;y(q,V.onCleanup);S.unbind("."+M+" ."+T);K.fadeTo("fast",0);Y.stop().fadeTo("fast",0,function(){y(i);F.remove();Y.add(K).css({opacity:1,cursor:"auto"}).hide();setTimeout(function(){E=false;y(U,V.onClosed)},1)})}};D.element=function(){return B(s)};D.settings=C;B(D.init)}(jQuery,this));


// Google Code Prettify
// http://code.google.com/p/google-code-prettify/
var q=null;window.PR_SHOULD_USE_CONTINUATION=!0;
(function(){function L(a){function m(a){var f=a.charCodeAt(0);if(f!==92)return f;var b=a.charAt(1);return(f=r[b])?f:"0"<=b&&b<="7"?parseInt(a.substring(1),8):b==="u"||b==="x"?parseInt(a.substring(2),16):a.charCodeAt(1)}function e(a){if(a<32)return(a<16?"\\x0":"\\x")+a.toString(16);a=String.fromCharCode(a);if(a==="\\"||a==="-"||a==="["||a==="]")a="\\"+a;return a}function h(a){for(var f=a.substring(1,a.length-1).match(/\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\[0-3][0-7]{0,2}|\\[0-7]{1,2}|\\[\S\s]|[^\\]/g),a=
[],b=[],o=f[0]==="^",c=o?1:0,i=f.length;c<i;++c){var j=f[c];if(/\\[bdsw]/i.test(j))a.push(j);else{var j=m(j),d;c+2<i&&"-"===f[c+1]?(d=m(f[c+2]),c+=2):d=j;b.push([j,d]);d<65||j>122||(d<65||j>90||b.push([Math.max(65,j)|32,Math.min(d,90)|32]),d<97||j>122||b.push([Math.max(97,j)&-33,Math.min(d,122)&-33]))}}b.sort(function(a,f){return a[0]-f[0]||f[1]-a[1]});f=[];j=[NaN,NaN];for(c=0;c<b.length;++c)i=b[c],i[0]<=j[1]+1?j[1]=Math.max(j[1],i[1]):f.push(j=i);b=["["];o&&b.push("^");b.push.apply(b,a);for(c=0;c<
f.length;++c)i=f[c],b.push(e(i[0])),i[1]>i[0]&&(i[1]+1>i[0]&&b.push("-"),b.push(e(i[1])));b.push("]");return b.join("")}function y(a){for(var f=a.source.match(/\[(?:[^\\\]]|\\[\S\s])*]|\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\\d+|\\[^\dux]|\(\?[!:=]|[()^]|[^()[\\^]+/g),b=f.length,d=[],c=0,i=0;c<b;++c){var j=f[c];j==="("?++i:"\\"===j.charAt(0)&&(j=+j.substring(1))&&j<=i&&(d[j]=-1)}for(c=1;c<d.length;++c)-1===d[c]&&(d[c]=++t);for(i=c=0;c<b;++c)j=f[c],j==="("?(++i,d[i]===void 0&&(f[c]="(?:")):"\\"===j.charAt(0)&&
(j=+j.substring(1))&&j<=i&&(f[c]="\\"+d[i]);for(i=c=0;c<b;++c)"^"===f[c]&&"^"!==f[c+1]&&(f[c]="");if(a.ignoreCase&&s)for(c=0;c<b;++c)j=f[c],a=j.charAt(0),j.length>=2&&a==="["?f[c]=h(j):a!=="\\"&&(f[c]=j.replace(/[A-Za-z]/g,function(a){a=a.charCodeAt(0);return"["+String.fromCharCode(a&-33,a|32)+"]"}));return f.join("")}for(var t=0,s=!1,l=!1,p=0,d=a.length;p<d;++p){var g=a[p];if(g.ignoreCase)l=!0;else if(/[a-z]/i.test(g.source.replace(/\\u[\da-f]{4}|\\x[\da-f]{2}|\\[^UXux]/gi,""))){s=!0;l=!1;break}}for(var r=
{b:8,t:9,n:10,v:11,f:12,r:13},n=[],p=0,d=a.length;p<d;++p){g=a[p];if(g.global||g.multiline)throw Error(""+g);n.push("(?:"+y(g)+")")}return RegExp(n.join("|"),l?"gi":"g")}function M(a){function m(a){switch(a.nodeType){case 1:if(e.test(a.className))break;for(var g=a.firstChild;g;g=g.nextSibling)m(g);g=a.nodeName;if("BR"===g||"LI"===g)h[s]="\n",t[s<<1]=y++,t[s++<<1|1]=a;break;case 3:case 4:g=a.nodeValue,g.length&&(g=p?g.replace(/\r\n?/g,"\n"):g.replace(/[\t\n\r ]+/g," "),h[s]=g,t[s<<1]=y,y+=g.length,
t[s++<<1|1]=a)}}var e=/(?:^|\s)nocode(?:\s|$)/,h=[],y=0,t=[],s=0,l;a.currentStyle?l=a.currentStyle.whiteSpace:window.getComputedStyle&&(l=document.defaultView.getComputedStyle(a,q).getPropertyValue("white-space"));var p=l&&"pre"===l.substring(0,3);m(a);return{a:h.join("").replace(/\n$/,""),c:t}}function B(a,m,e,h){m&&(a={a:m,d:a},e(a),h.push.apply(h,a.e))}function x(a,m){function e(a){for(var l=a.d,p=[l,"pln"],d=0,g=a.a.match(y)||[],r={},n=0,z=g.length;n<z;++n){var f=g[n],b=r[f],o=void 0,c;if(typeof b===
"string")c=!1;else{var i=h[f.charAt(0)];if(i)o=f.match(i[1]),b=i[0];else{for(c=0;c<t;++c)if(i=m[c],o=f.match(i[1])){b=i[0];break}o||(b="pln")}if((c=b.length>=5&&"lang-"===b.substring(0,5))&&!(o&&typeof o[1]==="string"))c=!1,b="src";c||(r[f]=b)}i=d;d+=f.length;if(c){c=o[1];var j=f.indexOf(c),k=j+c.length;o[2]&&(k=f.length-o[2].length,j=k-c.length);b=b.substring(5);B(l+i,f.substring(0,j),e,p);B(l+i+j,c,C(b,c),p);B(l+i+k,f.substring(k),e,p)}else p.push(l+i,b)}a.e=p}var h={},y;(function(){for(var e=a.concat(m),
l=[],p={},d=0,g=e.length;d<g;++d){var r=e[d],n=r[3];if(n)for(var k=n.length;--k>=0;)h[n.charAt(k)]=r;r=r[1];n=""+r;p.hasOwnProperty(n)||(l.push(r),p[n]=q)}l.push(/[\S\s]/);y=L(l)})();var t=m.length;return e}function u(a){var m=[],e=[];a.tripleQuotedStrings?m.push(["str",/^(?:'''(?:[^'\\]|\\[\S\s]|''?(?=[^']))*(?:'''|$)|"""(?:[^"\\]|\\[\S\s]|""?(?=[^"]))*(?:"""|$)|'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$))/,q,"'\""]):a.multiLineStrings?m.push(["str",/^(?:'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$)|`(?:[^\\`]|\\[\S\s])*(?:`|$))/,
q,"'\"`"]):m.push(["str",/^(?:'(?:[^\n\r'\\]|\\.)*(?:'|$)|"(?:[^\n\r"\\]|\\.)*(?:"|$))/,q,"\"'"]);a.verbatimStrings&&e.push(["str",/^@"(?:[^"]|"")*(?:"|$)/,q]);var h=a.hashComments;h&&(a.cStyleComments?(h>1?m.push(["com",/^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/,q,"#"]):m.push(["com",/^#(?:(?:define|elif|else|endif|error|ifdef|include|ifndef|line|pragma|undef|warning)\b|[^\n\r]*)/,q,"#"]),e.push(["str",/^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h|[a-z]\w*)>/,q])):m.push(["com",/^#[^\n\r]*/,
q,"#"]));a.cStyleComments&&(e.push(["com",/^\/\/[^\n\r]*/,q]),e.push(["com",/^\/\*[\S\s]*?(?:\*\/|$)/,q]));a.regexLiterals&&e.push(["lang-regex",/^(?:^^\.?|[!+-]|!=|!==|#|%|%=|&|&&|&&=|&=|\(|\*|\*=|\+=|,|-=|->|\/|\/=|:|::|;|<|<<|<<=|<=|=|==|===|>|>=|>>|>>=|>>>|>>>=|[?@[^]|\^=|\^\^|\^\^=|{|\||\|=|\|\||\|\|=|~|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\s*(\/(?=[^*/])(?:[^/[\\]|\\[\S\s]|\[(?:[^\\\]]|\\[\S\s])*(?:]|$))+\/)/]);(h=a.types)&&e.push(["typ",h]);a=(""+a.keywords).replace(/^ | $/g,
"");a.length&&e.push(["kwd",RegExp("^(?:"+a.replace(/[\s,]+/g,"|")+")\\b"),q]);m.push(["pln",/^\s+/,q," \r\n\t\xa0"]);e.push(["lit",/^@[$_a-z][\w$@]*/i,q],["typ",/^(?:[@_]?[A-Z]+[a-z][\w$@]*|\w+_t\b)/,q],["pln",/^[$_a-z][\w$@]*/i,q],["lit",/^(?:0x[\da-f]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+-]?\d+)?)[a-z]*/i,q,"0123456789"],["pln",/^\\[\S\s]?/,q],["pun",/^.[^\s\w"-$'./@\\`]*/,q]);return x(m,e)}function D(a,m){function e(a){switch(a.nodeType){case 1:if(k.test(a.className))break;if("BR"===a.nodeName)h(a),
a.parentNode&&a.parentNode.removeChild(a);else for(a=a.firstChild;a;a=a.nextSibling)e(a);break;case 3:case 4:if(p){var b=a.nodeValue,d=b.match(t);if(d){var c=b.substring(0,d.index);a.nodeValue=c;(b=b.substring(d.index+d[0].length))&&a.parentNode.insertBefore(s.createTextNode(b),a.nextSibling);h(a);c||a.parentNode.removeChild(a)}}}}function h(a){function b(a,d){var e=d?a.cloneNode(!1):a,f=a.parentNode;if(f){var f=b(f,1),g=a.nextSibling;f.appendChild(e);for(var h=g;h;h=g)g=h.nextSibling,f.appendChild(h)}return e}
for(;!a.nextSibling;)if(a=a.parentNode,!a)return;for(var a=b(a.nextSibling,0),e;(e=a.parentNode)&&e.nodeType===1;)a=e;d.push(a)}var k=/(?:^|\s)nocode(?:\s|$)/,t=/\r\n?|\n/,s=a.ownerDocument,l;a.currentStyle?l=a.currentStyle.whiteSpace:window.getComputedStyle&&(l=s.defaultView.getComputedStyle(a,q).getPropertyValue("white-space"));var p=l&&"pre"===l.substring(0,3);for(l=s.createElement("LI");a.firstChild;)l.appendChild(a.firstChild);for(var d=[l],g=0;g<d.length;++g)e(d[g]);m===(m|0)&&d[0].setAttribute("value",
m);var r=s.createElement("OL");r.className="linenums";for(var n=Math.max(0,m-1|0)||0,g=0,z=d.length;g<z;++g)l=d[g],l.className="L"+(g+n)%10,l.firstChild||l.appendChild(s.createTextNode("\xa0")),r.appendChild(l);a.appendChild(r)}function k(a,m){for(var e=m.length;--e>=0;){var h=m[e];A.hasOwnProperty(h)?window.console&&console.warn("cannot override language handler %s",h):A[h]=a}}function C(a,m){if(!a||!A.hasOwnProperty(a))a=/^\s*</.test(m)?"default-markup":"default-code";return A[a]}function E(a){var m=
a.g;try{var e=M(a.h),h=e.a;a.a=h;a.c=e.c;a.d=0;C(m,h)(a);var k=/\bMSIE\b/.test(navigator.userAgent),m=/\n/g,t=a.a,s=t.length,e=0,l=a.c,p=l.length,h=0,d=a.e,g=d.length,a=0;d[g]=s;var r,n;for(n=r=0;n<g;)d[n]!==d[n+2]?(d[r++]=d[n++],d[r++]=d[n++]):n+=2;g=r;for(n=r=0;n<g;){for(var z=d[n],f=d[n+1],b=n+2;b+2<=g&&d[b+1]===f;)b+=2;d[r++]=z;d[r++]=f;n=b}for(d.length=r;h<p;){var o=l[h+2]||s,c=d[a+2]||s,b=Math.min(o,c),i=l[h+1],j;if(i.nodeType!==1&&(j=t.substring(e,b))){k&&(j=j.replace(m,"\r"));i.nodeValue=
j;var u=i.ownerDocument,v=u.createElement("SPAN");v.className=d[a+1];var x=i.parentNode;x.replaceChild(v,i);v.appendChild(i);e<o&&(l[h+1]=i=u.createTextNode(t.substring(b,o)),x.insertBefore(i,v.nextSibling))}e=b;e>=o&&(h+=2);e>=c&&(a+=2)}}catch(w){"console"in window&&console.log(w&&w.stack?w.stack:w)}}var v=["break,continue,do,else,for,if,return,while"],w=[[v,"auto,case,char,const,default,double,enum,extern,float,goto,int,long,register,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"],
"catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"],F=[w,"alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,dynamic_cast,explicit,export,friend,inline,late_check,mutable,namespace,nullptr,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"],G=[w,"abstract,boolean,byte,extends,final,finally,implements,import,instanceof,null,native,package,strictfp,super,synchronized,throws,transient"],
H=[G,"as,base,by,checked,decimal,delegate,descending,dynamic,event,fixed,foreach,from,group,implicit,in,interface,internal,into,is,lock,object,out,override,orderby,params,partial,readonly,ref,sbyte,sealed,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,var"],w=[w,"debugger,eval,export,function,get,null,set,undefined,var,with,Infinity,NaN"],I=[v,"and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"],
J=[v,"alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"],v=[v,"case,done,elif,esac,eval,fi,function,in,local,set,then,until"],K=/^(DIR|FILE|vector|(de|priority_)?queue|list|stack|(const_)?iterator|(multi)?(set|map)|bitset|u?(int|float)\d*)/,N=/\S/,O=u({keywords:[F,H,w,"caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END"+
I,J,v],hashComments:!0,cStyleComments:!0,multiLineStrings:!0,regexLiterals:!0}),A={};k(O,["default-code"]);k(x([],[["pln",/^[^<?]+/],["dec",/^<!\w[^>]*(?:>|$)/],["com",/^<\!--[\S\s]*?(?:--\>|$)/],["lang-",/^<\?([\S\s]+?)(?:\?>|$)/],["lang-",/^<%([\S\s]+?)(?:%>|$)/],["pun",/^(?:<[%?]|[%?]>)/],["lang-",/^<xmp\b[^>]*>([\S\s]+?)<\/xmp\b[^>]*>/i],["lang-js",/^<script\b[^>]*>([\S\s]*?)(<\/script\b[^>]*>)/i],["lang-css",/^<style\b[^>]*>([\S\s]*?)(<\/style\b[^>]*>)/i],["lang-in.tag",/^(<\/?[a-z][^<>]*>)/i]]),
["default-markup","htm","html","mxml","xhtml","xml","xsl"]);k(x([["pln",/^\s+/,q," \t\r\n"],["atv",/^(?:"[^"]*"?|'[^']*'?)/,q,"\"'"]],[["tag",/^^<\/?[a-z](?:[\w-.:]*\w)?|\/?>$/i],["atn",/^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],["lang-uq.val",/^=\s*([^\s"'>]*(?:[^\s"'/>]|\/(?=\s)))/],["pun",/^[/<->]+/],["lang-js",/^on\w+\s*=\s*"([^"]+)"/i],["lang-js",/^on\w+\s*=\s*'([^']+)'/i],["lang-js",/^on\w+\s*=\s*([^\s"'>]+)/i],["lang-css",/^style\s*=\s*"([^"]+)"/i],["lang-css",/^style\s*=\s*'([^']+)'/i],["lang-css",
/^style\s*=\s*([^\s"'>]+)/i]]),["in.tag"]);k(x([],[["atv",/^[\S\s]+/]]),["uq.val"]);k(u({keywords:F,hashComments:!0,cStyleComments:!0,types:K}),["c","cc","cpp","cxx","cyc","m"]);k(u({keywords:"null,true,false"}),["json"]);k(u({keywords:H,hashComments:!0,cStyleComments:!0,verbatimStrings:!0,types:K}),["cs"]);k(u({keywords:G,cStyleComments:!0}),["java"]);k(u({keywords:v,hashComments:!0,multiLineStrings:!0}),["bsh","csh","sh"]);k(u({keywords:I,hashComments:!0,multiLineStrings:!0,tripleQuotedStrings:!0}),
["cv","py"]);k(u({keywords:"caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END",hashComments:!0,multiLineStrings:!0,regexLiterals:!0}),["perl","pl","pm"]);k(u({keywords:J,hashComments:!0,multiLineStrings:!0,regexLiterals:!0}),["rb"]);k(u({keywords:w,cStyleComments:!0,regexLiterals:!0}),["js"]);k(u({keywords:"all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,true,try,unless,until,when,while,yes",
hashComments:3,cStyleComments:!0,multilineStrings:!0,tripleQuotedStrings:!0,regexLiterals:!0}),["coffee"]);k(x([],[["str",/^[\S\s]+/]]),["regex"]);window.prettyPrintOne=function(a,m,e){var h=document.createElement("PRE");h.innerHTML=a;e&&D(h,e);E({g:m,i:e,h:h});return h.innerHTML};window.prettyPrint=function(a){function m(){for(var e=window.PR_SHOULD_USE_CONTINUATION?l.now()+250:Infinity;p<h.length&&l.now()<e;p++){var n=h[p],k=n.className;if(k.indexOf("prettyprint")>=0){var k=k.match(g),f,b;if(b=
!k){b=n;for(var o=void 0,c=b.firstChild;c;c=c.nextSibling)var i=c.nodeType,o=i===1?o?b:c:i===3?N.test(c.nodeValue)?b:o:o;b=(f=o===b?void 0:o)&&"CODE"===f.tagName}b&&(k=f.className.match(g));k&&(k=k[1]);b=!1;for(o=n.parentNode;o;o=o.parentNode)if((o.tagName==="pre"||o.tagName==="code"||o.tagName==="xmp")&&o.className&&o.className.indexOf("prettyprint")>=0){b=!0;break}b||((b=(b=n.className.match(/\blinenums\b(?::(\d+))?/))?b[1]&&b[1].length?+b[1]:!0:!1)&&D(n,b),d={g:k,h:n,i:b},E(d))}}p<h.length?setTimeout(m,
250):a&&a()}for(var e=[document.getElementsByTagName("pre"),document.getElementsByTagName("code"),document.getElementsByTagName("xmp")],h=[],k=0;k<e.length;++k)for(var t=0,s=e[k].length;t<s;++t)h.push(e[k][t]);var e=q,l=Date;l.now||(l={now:function(){return+new Date}});var p=0,d,g=/\blang(?:uage)?-([\w.]+)(?!\S)/;m()};window.PR={createSimpleLexer:x,registerLangHandler:k,sourceDecorator:u,PR_ATTRIB_NAME:"atn",PR_ATTRIB_VALUE:"atv",PR_COMMENT:"com",PR_DECLARATION:"dec",PR_KEYWORD:"kwd",PR_LITERAL:"lit",
PR_NOCODE:"nocode",PR_PLAIN:"pln",PR_PUNCTUATION:"pun",PR_SOURCE:"src",PR_STRING:"str",PR_TAG:"tag",PR_TYPE:"typ"}})();
