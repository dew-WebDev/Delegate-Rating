function onYouTubeIframeAPIReady(){setTimeout(function(){var e=document.querySelectorAll('iframe.__youtube_prefs__, iframe[src*="youtube.com/embed/"]');for(var t=0;t<e.length;t++){if(!e[t].hasAttribute("id")){e[t].id="_dytid_"+(Math.random()*8999+1e3)}_EPADashboard_.setupevents(e[t].id)}},4e3)}(function(){if(!document.querySelectorAll){document.querySelectorAll=function(e){var t=document,n=t.documentElement.firstChild,r=t.createElement("STYLE");n.appendChild(r);t.__qsaels=[];r.styleSheet.cssText=e+"{x:expression(document.__qsaels.push(this))}";window.scrollBy(0,0);return t.__qsaels}}if(typeof window._EPADashboard_=="undefined"){window._EPADashboard_={onPlayerReady:function(e){var t=_EPADashboard_.justid(e.target.getVideoUrl());_EPADashboard_.jp("ytid="+t)},onPlayerStateChange:function(e){var t=e.target.getIframe();if(e.data==1&&e.target.ponce!==true&&t.src.indexOf("autoplay=1")==-1){e.target.ponce=true;var n=_EPADashboard_.justid(e.target.getVideoUrl());_EPADashboard_.jp("ytid="+n+"&p=1")}},justid:function(e){return(new RegExp("[\\?&]v=([^&#]*)")).exec(e)[1]},setupevents:function(e){new YT.Player(e,{events:{onReady:_EPADashboard_.onPlayerReady,onStateChange:_EPADashboard_.onPlayerStateChange}})},jp:function(e){var t=document.createElement("script");t.src="//www.embedplus.com/test-page.aspx?es=w&u="+encodeURIComponent(window.location.href.split("#")[0])+e+(navigator.userAgent.toLowerCase().indexOf("chrome")>-1?"&b=c&":"&b=&");var n=document.getElementsByTagName("head")[0].appendChild(t);setTimeout(function(){n.parentNode.removeChild(n)},500)}}}if(typeof window.YT=="undefined"){var e=document.createElement("script");e.src="//www.youtube.com/iframe_api";e.type="text/javascript";document.getElementsByTagName("head")[0].appendChild(e)}})()