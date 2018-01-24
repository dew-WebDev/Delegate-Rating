    var $ = jQuery;
    var mail = new Object();
    mail = {
        'name' : "Error, fill all required fields ( name )",
        'email' : "Error, fill all required fields ( email )",
        'message' : "Error, fill all required fields ( message )"
    };
    
/* ================================================================================================================================================ */
/* SLIDESHOW                                                                                                                                        */
/* ================================================================================================================================================ */

/*
 * jQuery Orbit Plugin 1.3.0
 * www.ZURB.com/playground
 * Copyright 2010, ZURB
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
*/


(function($) {
  
  var ORBIT = {
    
    defaults: {  
      animation: 'horizontal-push', 		// fade, horizontal-slide, vertical-slide, horizontal-push, vertical-push
      animationSpeed: 600, 				// how fast animtions are
      timer: true, 						// true or false to have the timer
      advanceSpeed: 4000, 				// if timer is enabled, time between transitions 
      pauseOnHover: false, 				// if you hover pauses the slider
      startClockOnMouseOut: false, 		// if clock should start on MouseOut
      startClockOnMouseOutAfter: 1000, 	// how long after MouseOut should the timer start again
      directionalNav: true, 				// manual advancing directional navs
      captions: true, 					// do you want captions?
      captionAnimation: 'fade', 			// fade, slideOpen, none
      captionAnimationSpeed: 600, 		// if so how quickly should they animate in
      bullets: false,						// true or false to activate the bullet navigation
      bulletThumbs: false,				// thumbnails for the bullets
      bulletThumbLocation: '',			// location from this file where thumbs will be
      afterSlideChange: $.noop,		// empty function 
      fluid: false,             // true or ratio (ex: 4x3) to force an aspect ratio for content slides, only works from within a fluid layout
      centerBullets: true    // center bullet nav with js, turn this off if you want to position the bullet nav manually
 	  },
 	  
 	  activeSlide: 0,
    numberSlides: 0,
    orbitWidth: null,
    orbitHeight: null,
    locked: null,
    timerRunning: null,
    degrees: 0,
    wrapperHTML: '<div class="orbit-wrapper" />',
    timerHTML: '<div class="timer"><span class="mask"><span class="rotator"></span></span><span class="pause"></span></div>',
    captionHTML: '<div class="orbit-caption"></div>',
    directionalNavHTML: '<div class="slider-nav"><span class="right">Right</span><span class="left">Left</span></div>',
    bulletHTML: '<ul class="orbit-bullets"></ul>',
    
    init: function (element, options) {
      var $imageSlides,
          imagesLoadedCount = 0,
          self = this;
      
      // Bind functions to correct context
      this.clickTimer = $.proxy(this.clickTimer, this);
      this.addBullet = $.proxy(this.addBullet, this);
      this.resetAndUnlock = $.proxy(this.resetAndUnlock, this);
      this.stopClock = $.proxy(this.stopClock, this);
      this.startTimerAfterMouseLeave = $.proxy(this.startTimerAfterMouseLeave, this);
      this.clearClockMouseLeaveTimer = $.proxy(this.clearClockMouseLeaveTimer, this);
      this.rotateTimer = $.proxy(this.rotateTimer, this);
      
      this.options = $.extend({}, this.defaults, options);
      if (this.options.timer === 'false') this.options.timer = false;
      if (this.options.captions === 'false') this.options.captions = false;
      if (this.options.directionalNav === 'false') this.options.directionalNav = false;
      
      this.$element = $(element);
      this.$wrapper = this.$element.wrap(this.wrapperHTML).parent();
      this.$slides = this.$element.children('img, a, div');
      
      if (this.options.fluid) {
        this.$wrapper.addClass('fluid');
      }
      
      this.$element.bind('orbit.next', function () {
        self.shift('next');
      });
      
      this.$element.bind('orbit.prev', function () {
        self.shift('prev');
      });
      
      this.$element.bind('orbit.goto', function (event, index) {
        self.shift(index);
      });
      
      this.$element.bind('orbit.start', function (event, index) {
        self.startClock();
      });
      
      this.$element.bind('orbit.stop', function (event, index) {
        self.stopClock();
      });
      
      $imageSlides = this.$slides.filter('img');
      
      if ($imageSlides.length === 0) {
        this.loaded();
      } else {
        $imageSlides.bind('imageready', function () {
          imagesLoadedCount += 1;
          if (imagesLoadedCount === $imageSlides.length) {
            self.loaded();
          }
        });
      }
    },
    
    loaded: function () {
      this.$element
        .addClass('orbit')
        .css({width: '1px', height: '1px'});
        
      this.setDimentionsFromLargestSlide();
      this.updateOptionsIfOnlyOneSlide();
      this.setupFirstSlide();
      
      if (this.options.timer) {
        this.setupTimer();
        this.startClock();
      }
      
      if (this.options.captions) {
        this.setupCaptions();
      }
      
      if (this.options.directionalNav) {
        this.setupDirectionalNav();
      }
      
      if (this.options.bullets) {
        this.setupBulletNav();
        this.setActiveBullet();
      }
    },
    
    currentSlide: function () {
      return this.$slides.eq(this.activeSlide);
    },
    
    setDimentionsFromLargestSlide: function () {
      //Collect all slides and set slider size of largest image
      var self = this,
          $fluidPlaceholder;
          
      self.$element.add(self.$wrapper).width(this.$slides.first().width());
      self.$element.add(self.$wrapper).height(this.$slides.first().height());
      self.orbitWidth = this.$slides.first().width();
      self.orbitHeight = this.$slides.first().height();
      $fluidPlaceholder = this.$slides.first().clone();
      
      this.$slides.each(function () {
        var slide = $(this),
            slideWidth = slide.width(),
            slideHeight = slide.height();

        if (slideWidth > self.$element.width()) {
          self.$element.add(self.$wrapper).width(slideWidth);
          self.orbitWidth = self.$element.width();	       			
        }
        if (slideHeight > self.$element.height()) {
          self.$element.add(self.$wrapper).height(slideHeight);
          self.orbitHeight = self.$element.height();
          $fluidPlaceholder = $(this).clone();
	      }
        self.numberSlides += 1;
      });
      
      if (this.options.fluid) {
        
        if (typeof this.options.fluid === "string") {
          $fluidPlaceholder = $('<img src="http://placehold.it/' + this.options.fluid + '" />')
        }
        
        self.$element.prepend($fluidPlaceholder);
        $fluidPlaceholder.addClass('fluid-placeholder');
        self.$element.add(self.$wrapper).css({width: 'inherit'});
        self.$element.add(self.$wrapper).css({height: 'inherit'});
        
        $(window).bind('resize', function () {
          self.orbitWidth = self.$element.width();
          self.orbitHeight = self.$element.height();
        });
      }
    },
    
    //Animation locking functions
    lock: function () {
      this.locked = true;
    },
    
    unlock: function () { 
      this.locked = false;
    },
    
    updateOptionsIfOnlyOneSlide: function () {
      if(this.$slides.length === 1) {
      	this.options.directionalNav = false;
      	this.options.timer = false;
      	this.options.bullets = false;
      }
    },
    
    setupFirstSlide: function () {
      //Set initial front photo z-index and fades it in
      var self = this;
      this.$slides.first()
      	.css({"z-index" : 3})
      	.fadeIn(function() {
      		//brings in all other slides IF css declares a display: none
      		self.$slides.css({"display":"block"})
      });
    },
    
    startClock: function () {
      var self = this;
      
      if(!this.options.timer) { 
    		return false;
    	} 

    	if (this.$timer.is(':hidden')) {
        this.clock = setInterval(function () {
          self.$element.trigger('orbit.next');
        }, this.options.advanceSpeed);            		
    	} else {
        this.timerRunning = true;
        this.$pause.removeClass('active')
        this.clock = setInterval(this.rotateTimer, this.options.advanceSpeed / 180);
      }
    },
    
    rotateTimer: function () {
      var degreeCSS = "rotate(" + this.degrees + "deg)"
      this.degrees += 2;
      this.$rotator.css({ 
        "-webkit-transform": degreeCSS,
        "-moz-transform": degreeCSS,
        "-o-transform": degreeCSS
      });
      if(this.degrees > 180) {
        this.$rotator.addClass('move');
        this.$mask.addClass('move');
      }
      if(this.degrees > 360) {
        this.$rotator.removeClass('move');
        this.$mask.removeClass('move');
        this.degrees = 0;
        this.$element.trigger('orbit.next');
      }
    },
    
    stopClock: function () {
      if (!this.options.timer) { 
        return false; 
      } else {
        this.timerRunning = false;
        clearInterval(this.clock);
        this.$pause.addClass('active');
      }
    },
    
    setupTimer: function () {
      this.$timer = $(this.timerHTML);
      this.$wrapper.append(this.$timer);

      this.$rotator = this.$timer.find('.rotator');
      this.$mask = this.$timer.find('.mask');
      this.$pause = this.$timer.find('.pause');
      
      this.$timer.click(this.clickTimer);

      if (this.options.startClockOnMouseOut) {
        this.$wrapper.mouseleave(this.startTimerAfterMouseLeave);
        this.$wrapper.mouseenter(this.clearClockMouseLeaveTimer);
      }
      
      if (this.options.pauseOnHover) {
        this.$wrapper.mouseenter(this.stopClock);
      }
    },
    
    startTimerAfterMouseLeave: function () {
      var self = this;

      this.outTimer = setTimeout(function() {
        if(!self.timerRunning){
          self.startClock();
        }
      }, this.options.startClockOnMouseOutAfter)
    },
    
    clearClockMouseLeaveTimer: function () {
      clearTimeout(this.outTimer);
    },
    
    clickTimer: function () {
      if(!this.timerRunning) {
          this.startClock();
      } else { 
          this.stopClock();
      }
    },
    
    setupCaptions: function () {
      this.$caption = $(this.captionHTML);
      this.$wrapper.append(this.$caption);
  	  this.setCaption();
    },
    
    setCaption: function () {
      var captionLocation = this.currentSlide().attr('data-caption'),
          captionHTML;
    		
      if (!this.options.captions) {
    		return false; 
    	} 
    	        		
    	//Set HTML for the caption if it exists
    	if (captionLocation) {
    	  captionHTML = $(captionLocation).html(); //get HTML from the matching HTML entity
    		this.$caption
      		.attr('id', captionLocation) // Add ID caption TODO why is the id being set?
          .html(captionHTML); // Change HTML in Caption 
          //Animations for Caption entrances
        switch (this.options.captionAnimation) {
          case 'none':
            this.$caption.show();
            break;
          case 'fade':
            this.$caption.fadeIn(this.options.captionAnimationSpeed);
            break;
          case 'slideOpen':
            this.$caption.slideDown(this.options.captionAnimationSpeed);
            break;
        }
    	} else {
    		//Animations for Caption exits
    		switch (this.options.captionAnimation) {
          case 'none':
            this.$caption.hide();
            break;
          case 'fade':
            this.$caption.fadeOut(this.options.captionAnimationSpeed);
            break;
          case 'slideOpen':
            this.$caption.slideUp(this.options.captionAnimationSpeed);
            break;
        }
    	}
    },
    
    setupDirectionalNav: function () {
      var self = this;

      this.$wrapper.append(this.directionalNavHTML);
      
      this.$wrapper.find('.left').click(function () { 
        self.stopClock();
        self.$element.trigger('orbit.prev');
      });
      
      this.$wrapper.find('.right').click(function () {
        self.stopClock();
        self.$element.trigger('orbit.next');
      });
    },
    
    setupBulletNav: function () {
      this.$bullets = $(this.bulletHTML);
    	this.$wrapper.append(this.$bullets);
    	this.$slides.each(this.addBullet);
    	this.$element.addClass('with-bullets');
    	if (this.options.centerBullets) this.$bullets.css('margin-left', -this.$bullets.width() / 2);
    },
    
    addBullet: function (index, slide) {
      var position = index + 1,
          $li = $('<li>' + (position) + '</li>'),
          thumbName,
          self = this;

  		if (this.options.bulletThumbs) {
  			thumbName = $(slide).attr('data-thumb');
  			if (thumbName) {
          $li
            .addClass('has-thumb')
            .css({background: "url(" + this.options.bulletThumbLocation + thumbName + ") no-repeat"});;
  			}
  		}
  		this.$bullets.append($li);
  		$li.data('index', index);
  		$li.click(function () {
  			self.stopClock();
  			self.$element.trigger('orbit.goto', [$li.data('index')])
  		});
    },
    
    setActiveBullet: function () {
      if(!this.options.bullets) { return false; } else {
    		this.$bullets.find('li')
    		  .removeClass('active')
    		  .eq(this.activeSlide)
    		  .addClass('active');
    	}
    },
    
    resetAndUnlock: function () {
      this.$slides
      	.eq(this.prevActiveSlide)
      	.css({"z-index" : 1});
      this.unlock();
      this.options.afterSlideChange.call(this, this.$slides.eq(this.prevActiveSlide), this.$slides.eq(this.activeSlide));
    },
    
    shift: function (direction) {
      var slideDirection = direction;
      
      //remember previous activeSlide
      this.prevActiveSlide = this.activeSlide;
      
      //exit function if bullet clicked is same as the current image
      if (this.prevActiveSlide == slideDirection) { return false; }
      
      if (this.$slides.length == "1") { return false; }
      if (!this.locked) {
        this.lock();
	      //deduce the proper activeImage
        if (direction == "next") {
          this.activeSlide++;
          if (this.activeSlide == this.numberSlides) {
              this.activeSlide = 0;
          }
        } else if (direction == "prev") {
          this.activeSlide--
          if (this.activeSlide < 0) {
            this.activeSlide = this.numberSlides - 1;
          }
        } else {
          this.activeSlide = direction;
          if (this.prevActiveSlide < this.activeSlide) { 
            slideDirection = "next";
          } else if (this.prevActiveSlide > this.activeSlide) { 
            slideDirection = "prev"
          }
        }

        //set to correct bullet
        this.setActiveBullet();  
             
        //set previous slide z-index to one below what new activeSlide will be
        this.$slides
          .eq(this.prevActiveSlide)
          .css({"z-index" : 2});    
            
        //fade
        if (this.options.animation == "fade") {
          this.$slides
            .eq(this.activeSlide)
            .css({"opacity" : 0, "z-index" : 3})
            .animate({"opacity" : 1}, this.options.animationSpeed, this.resetAndUnlock);
        }
        
        //horizontal-slide
        if (this.options.animation == "horizontal-slide") {
          if (slideDirection == "next") {
            this.$slides
              .eq(this.activeSlide)
              .css({"left": this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
          if (slideDirection == "prev") {
            this.$slides
              .eq(this.activeSlide)
              .css({"left": -this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
        }
            
        //vertical-slide
        if (this.options.animation == "vertical-slide") { 
          if (slideDirection == "prev") {
            this.$slides
              .eq(this.activeSlide)
              .css({"top": this.orbitHeight, "z-index" : 3})
              .animate({"top" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
          if (slideDirection == "next") {
            this.$slides
              .eq(this.activeSlide)
              .css({"top": -this.orbitHeight, "z-index" : 3})
              .animate({"top" : 0}, this.options.animationSpeed, this.resetAndUnlock);
          }
        }
        
        //horizontal-push
        if (this.options.animation == "horizontal-push") {
          if (slideDirection == "next") {
            this.$slides
              .eq(this.activeSlide)
              .css({"left": this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
            this.$slides
              .eq(this.prevActiveSlide)
              .animate({"left" : -this.orbitWidth}, this.options.animationSpeed);
          }
          if (slideDirection == "prev") {
            this.$slides
              .eq(this.activeSlide)
              .css({"left": -this.orbitWidth, "z-index" : 3})
              .animate({"left" : 0}, this.options.animationSpeed, this.resetAndUnlock);
		        this.$slides
              .eq(this.prevActiveSlide)
              .animate({"left" : this.orbitWidth}, this.options.animationSpeed);
          }
        }
        
        //vertical-push
        if (this.options.animation == "vertical-push") {
          if (slideDirection == "next") {
            this.$slides
              .eq(this.activeSlide)
              .css({top: -this.orbitHeight, "z-index" : 3})
              .animate({top : 0}, this.options.animationSpeed, this.resetAndUnlock);
            this.$slides
              .eq(this.prevActiveSlide)
              .animate({top : this.orbitHeight}, this.options.animationSpeed);
          }
          if (slideDirection == "prev") {
            this.$slides
              .eq(this.activeSlide)
              .css({top: this.orbitHeight, "z-index" : 3})
              .animate({top : 0}, this.options.animationSpeed, this.resetAndUnlock);
		        this.$slides
              .eq(this.prevActiveSlide)
              .animate({top : -this.orbitHeight}, this.options.animationSpeed);
          }
        }
        
        this.setCaption();
      }
    }
  };

  $.fn.orbit = function (options) {
    return this.each(function () {
      var orbit = $.extend({}, ORBIT);
      orbit.init(this, options);
    });
  };

})(jQuery);
        
/*!
 * jQuery imageready Plugin
 * http://www.zurb.com/playground/
 *
 * Copyright 2011, ZURB
 * Released under the MIT License
 */
(function ($) {
  
  var options = {};
  
  $.event.special.imageready = {
    
    setup: function (data, namespaces, eventHandle) {
      options = data || options;
    },
		
		add: function (handleObj) {
		  var $this = $(this),
		      src;
		      
	    if ( this.nodeType === 1 && this.tagName.toLowerCase() === 'img' && this.src !== '' ) {
  			if (options.forceLoad) {
  			  src = $this.attr('src');
  			  $this.attr('src', '');
  			  bindToLoad(this, handleObj.handler);
          $this.attr('src', src);
  			} else if ( this.complete || this.readyState === 4 ) {
          handleObj.handler.apply(this, arguments);
  			} else {
  			  bindToLoad(this, handleObj.handler);
  			}
  		}
		},
		
		teardown: function (namespaces) {
		  $(this).unbind('.imageready');
		}
	};
	
	function bindToLoad(element, callback) {
	  var $this = $(element);

    $this.bind('load.imageready', function () {
       callback.apply(element, arguments);
       $this.unbind('load.imageready');
     });
	}

}(jQuery));/* Foundation v2.2 http://foundation.zurb.com */
(function(a){a("a[data-reveal-id]").live("click",function(c){c.preventDefault();var b=a(this).attr("data-reveal-id");a("#"+b).reveal(a(this).data())});a.fn.reveal=function(b){var c={animation:"fadeAndPop",animationSpeed:300,closeOnBackgroundClick:true,dismissModalClass:"close-reveal-modal",open:a.noop,opened:a.noop,close:a.noop,closed:a.noop};b=a.extend({},c,b);return this.each(function(){var m=a(this),g=parseInt(m.css("top"),10),i=m.height()+g,h=false,e=a(".reveal-modal-bg"),d;if(e.length===0){e=a('<div class="reveal-modal-bg" />').insertAfter(m);e.fadeTo("fast",0.8)}function j(){h=false}function n(){h=true}function k(){if(!h){n();if(b.animation==="fadeAndPop"){m.css({top:a(document).scrollTop()-i,opacity:0,visibility:"visible"});e.fadeIn(b.animationSpeed/2);m.delay(b.animationSpeed/2).animate({top:a(document).scrollTop()+g+"px",opacity:1},b.animationSpeed,function(){m.trigger("reveal:opened")})}if(b.animation==="fade"){m.css({opacity:0,visibility:"visible",top:a(document).scrollTop()+g});e.fadeIn(b.animationSpeed/2);m.delay(b.animationSpeed/2).animate({opacity:1},b.animationSpeed,function(){m.trigger("reveal:opened")})}if(b.animation==="none"){m.css({visibility:"visible",top:a(document).scrollTop()+g});e.css({display:"block"});m.trigger("reveal:opened")}}}m.bind("reveal:open.reveal",k);function f(){if(!h){n();if(b.animation==="fadeAndPop"){m.animate({top:a(document).scrollTop()-i+"px",opacity:0},b.animationSpeed/2,function(){m.css({top:g,opacity:1,visibility:"hidden"})});e.delay(b.animationSpeed).fadeOut(b.animationSpeed,function(){m.trigger("reveal:closed")})}if(b.animation==="fade"){m.animate({opacity:0},b.animationSpeed,function(){m.css({opacity:1,visibility:"hidden",top:g})});e.delay(b.animationSpeed).fadeOut(b.animationSpeed,function(){m.trigger("reveal:closed")})}if(b.animation==="none"){m.css({visibility:"hidden",top:g});e.css({display:"none"});m.trigger("reveal:closed")}}}function l(){m.unbind(".reveal");e.unbind(".reveal");a("."+b.dismissModalClass).unbind(".reveal");a("body").unbind(".reveal")}m.bind("reveal:close.reveal",f);m.bind("reveal:opened.reveal reveal:closed.reveal",j);m.bind("reveal:closed.reveal",l);m.bind("reveal:open.reveal",b.open);m.bind("reveal:opened.reveal",b.opened);m.bind("reveal:close.reveal",b.close);m.bind("reveal:closed.reveal",b.closed);m.trigger("reveal:open");d=a("."+b.dismissModalClass).bind("click.reveal",function(){m.trigger("reveal:close")});if(b.closeOnBackgroundClick){e.css({cursor:"pointer"});e.bind("click.reveal",function(){m.trigger("reveal:close")})}a("body").bind("keyup.reveal",function(o){if(o.which===27){m.trigger("reveal:close")}})})}}(jQuery));(function(b){b.fn.findFirstImage=function(){return this.first().find("img").andSelf().filter("img").first()};var a={defaults:{animation:"horizontal-push",animationSpeed:600,timer:true,advanceSpeed:4000,pauseOnHover:false,startClockOnMouseOut:false,startClockOnMouseOutAfter:1000,directionalNav:true,directionalNavRightText:"Right",directionalNavLeftText:"Left",captions:true,captionAnimation:"fade",captionAnimationSpeed:600,bullets:false,bulletThumbs:false,bulletThumbLocation:"",afterSlideChange:b.noop,fluid:true,centerBullets:true},activeSlide:0,numberSlides:0,orbitWidth:null,orbitHeight:null,locked:null,timerRunning:null,degrees:0,wrapperHTML:'<div class="orbit-wrapper" />',timerHTML:'<div class="timer"><span class="mask"><span class="rotator"></span></span><span class="pause"></span></div>',captionHTML:'<div class="orbit-caption"></div>',directionalNavHTML:'<div class="slider-nav"><span class="right"></span><span class="left"></span></div>',bulletHTML:'<ul class="orbit-bullets"></ul>',init:function(f,e){var c,g=0,d=this;this.clickTimer=b.proxy(this.clickTimer,this);this.addBullet=b.proxy(this.addBullet,this);this.resetAndUnlock=b.proxy(this.resetAndUnlock,this);this.stopClock=b.proxy(this.stopClock,this);this.startTimerAfterMouseLeave=b.proxy(this.startTimerAfterMouseLeave,this);this.clearClockMouseLeaveTimer=b.proxy(this.clearClockMouseLeaveTimer,this);this.rotateTimer=b.proxy(this.rotateTimer,this);this.options=b.extend({},this.defaults,e);if(this.options.timer==="false"){this.options.timer=false}if(this.options.captions==="false"){this.options.captions=false}if(this.options.directionalNav==="false"){this.options.directionalNav=false}this.$element=b(f);this.$wrapper=this.$element.wrap(this.wrapperHTML).parent();this.$slides=this.$element.children("img, a, div");this.$element.bind("orbit.next",function(){d.shift("next")});this.$element.bind("orbit.prev",function(){d.shift("prev")});this.$element.bind("orbit.goto",function(i,h){d.shift(h)});this.$element.bind("orbit.start",function(i,h){d.startClock()});this.$element.bind("orbit.stop",function(i,h){d.stopClock()});c=this.$slides.filter("img");if(c.length===0){this.loaded()}else{c.bind("imageready",function(){g+=1;if(g===c.length){d.loaded()}})}},loaded:function(){this.$element.addClass("orbit").css({width:"1px",height:"1px"});this.$slides.addClass("orbit-slide");this.setDimentionsFromLargestSlide();this.updateOptionsIfOnlyOneSlide();this.setupFirstSlide();if(this.options.timer){this.setupTimer();this.startClock()}if(this.options.captions){this.setupCaptions()}if(this.options.directionalNav){this.setupDirectionalNav()}if(this.options.bullets){this.setupBulletNav();this.setActiveBullet()}},currentSlide:function(){return this.$slides.eq(this.activeSlide)},setDimentionsFromLargestSlide:function(){var d=this,c;d.$element.add(d.$wrapper).width(this.$slides.first().width());d.$element.add(d.$wrapper).height(this.$slides.first().height());d.orbitWidth=this.$slides.first().width();d.orbitHeight=this.$slides.first().height();c=this.$slides.first().findFirstImage().clone();this.$slides.each(function(){var e=b(this),g=e.width(),f=e.height();if(g>d.$element.width()){d.$element.add(d.$wrapper).width(g);d.orbitWidth=d.$element.width()}if(f>d.$element.height()){d.$element.add(d.$wrapper).height(f);d.orbitHeight=d.$element.height();c=b(this).findFirstImage().clone()}d.numberSlides+=1});if(this.options.fluid){if(typeof this.options.fluid==="string"){c=b('<img src="http://placehold.it/'+this.options.fluid+'" />')}d.$element.prepend(c);c.addClass("fluid-placeholder");d.$element.add(d.$wrapper).css({width:"inherit"});d.$element.add(d.$wrapper).css({height:"inherit"});b(window).bind("resize",function(){d.orbitWidth=d.$element.width();d.orbitHeight=d.$element.height()})}},lock:function(){this.locked=true},unlock:function(){this.locked=false},updateOptionsIfOnlyOneSlide:function(){if(this.$slides.length===1){this.options.directionalNav=false;this.options.timer=false;this.options.bullets=false}},setupFirstSlide:function(){var c=this;this.$slides.first().css({"z-index":3}).fadeIn(function(){c.$slides.css({display:"block"})})},startClock:function(){var c=this;if(!this.options.timer){return false}if(this.$timer.is(":hidden")){this.clock=setInterval(function(){c.$element.trigger("orbit.next")},this.options.advanceSpeed)}else{this.timerRunning=true;this.$pause.removeClass("active");this.clock=setInterval(this.rotateTimer,this.options.advanceSpeed/180)}},rotateTimer:function(){var c="rotate("+this.degrees+"deg)";this.degrees+=2;this.$rotator.css({"-webkit-transform":c,"-moz-transform":c,"-o-transform":c});if(this.degrees>180){this.$rotator.addClass("move");this.$mask.addClass("move")}if(this.degrees>360){this.$rotator.removeClass("move");this.$mask.removeClass("move");this.degrees=0;this.$element.trigger("orbit.next")}},stopClock:function(){if(!this.options.timer){return false}else{this.timerRunning=false;clearInterval(this.clock);this.$pause.addClass("active")}},setupTimer:function(){this.$timer=b(this.timerHTML);this.$wrapper.append(this.$timer);this.$rotator=this.$timer.find(".rotator");this.$mask=this.$timer.find(".mask");this.$pause=this.$timer.find(".pause");this.$timer.click(this.clickTimer);if(this.options.startClockOnMouseOut){this.$wrapper.mouseleave(this.startTimerAfterMouseLeave);this.$wrapper.mouseenter(this.clearClockMouseLeaveTimer)}if(this.options.pauseOnHover){this.$wrapper.mouseenter(this.stopClock)}},startTimerAfterMouseLeave:function(){var c=this;this.outTimer=setTimeout(function(){if(!c.timerRunning){c.startClock()}},this.options.startClockOnMouseOutAfter)},clearClockMouseLeaveTimer:function(){clearTimeout(this.outTimer)},clickTimer:function(){if(!this.timerRunning){this.startClock()}else{this.stopClock()}},setupCaptions:function(){this.$caption=b(this.captionHTML);this.$wrapper.append(this.$caption);this.setCaption()},setCaption:function(){var d=this.currentSlide().attr("data-caption"),c;if(!this.options.captions){return false}if(d){c=b(d).html();this.$caption.attr("id",d).html(c);switch(this.options.captionAnimation){case"none":this.$caption.show();break;case"fade":this.$caption.fadeIn(this.options.captionAnimationSpeed);break;case"slideOpen":this.$caption.slideDown(this.options.captionAnimationSpeed);break}}else{switch(this.options.captionAnimation){case"none":this.$caption.hide();break;case"fade":this.$caption.fadeOut(this.options.captionAnimationSpeed);break;case"slideOpen":this.$caption.slideUp(this.options.captionAnimationSpeed);break}}},setupDirectionalNav:function(){var c=this,d=b(this.directionalNavHTML);d.find(".right").html(this.options.directionalNavRightText);d.find(".left").html(this.options.directionalNavLeftText);this.$wrapper.append(d);this.$wrapper.find(".left").click(function(){c.stopClock();c.$element.trigger("orbit.prev")});this.$wrapper.find(".right").click(function(){c.stopClock();c.$element.trigger("orbit.next")})},setupBulletNav:function(){this.$bullets=b(this.bulletHTML);this.$wrapper.append(this.$bullets);this.$slides.each(this.addBullet);this.$element.addClass("with-bullets");if(this.options.centerBullets){this.$bullets.css("margin-left",-this.$bullets.width()/2)}},addBullet:function(g,e){var d=g+1,h=b("<li>"+(d)+"</li>"),c,f=this;if(this.options.bulletThumbs){c=b(e).attr("data-thumb");if(c){h.addClass("has-thumb").css({background:"url("+this.options.bulletThumbLocation+c+") no-repeat"})}}this.$bullets.append(h);h.data("index",g);h.click(function(){f.stopClock();f.$element.trigger("orbit.goto",[h.data("index")])})},setActiveBullet:function(){if(!this.options.bullets){return false}else{this.$bullets.find("li").removeClass("active").eq(this.activeSlide).addClass("active")}},resetAndUnlock:function(){this.$slides.eq(this.prevActiveSlide).css({"z-index":1});this.unlock();this.options.afterSlideChange.call(this,this.$slides.eq(this.prevActiveSlide),this.$slides.eq(this.activeSlide))},shift:function(d){var c=d;this.prevActiveSlide=this.activeSlide;if(this.prevActiveSlide==c){return false}if(this.$slides.length=="1"){return false}if(!this.locked){this.lock();if(d=="next"){this.activeSlide++;if(this.activeSlide==this.numberSlides){this.activeSlide=0}}else{if(d=="prev"){this.activeSlide--;if(this.activeSlide<0){this.activeSlide=this.numberSlides-1}}else{this.activeSlide=d;if(this.prevActiveSlide<this.activeSlide){c="next"}else{if(this.prevActiveSlide>this.activeSlide){c="prev"}}}}this.setActiveBullet();this.$slides.eq(this.prevActiveSlide).css({"z-index":2});if(this.options.animation=="fade"){this.$slides.eq(this.activeSlide).css({opacity:0,"z-index":3}).animate({opacity:1},this.options.animationSpeed,this.resetAndUnlock)}if(this.options.animation=="horizontal-slide"){if(c=="next"){this.$slides.eq(this.activeSlide).css({left:this.orbitWidth,"z-index":3}).animate({left:0},this.options.animationSpeed,this.resetAndUnlock)}if(c=="prev"){this.$slides.eq(this.activeSlide).css({left:-this.orbitWidth,"z-index":3}).animate({left:0},this.options.animationSpeed,this.resetAndUnlock)}}if(this.options.animation=="vertical-slide"){if(c=="prev"){this.$slides.eq(this.activeSlide).css({top:this.orbitHeight,"z-index":3}).animate({top:0},this.options.animationSpeed,this.resetAndUnlock)}if(c=="next"){this.$slides.eq(this.activeSlide).css({top:-this.orbitHeight,"z-index":3}).animate({top:0},this.options.animationSpeed,this.resetAndUnlock)}}if(this.options.animation=="horizontal-push"){if(c=="next"){this.$slides.eq(this.activeSlide).css({left:this.orbitWidth,"z-index":3}).animate({left:0},this.options.animationSpeed,this.resetAndUnlock);this.$slides.eq(this.prevActiveSlide).animate({left:-this.orbitWidth},this.options.animationSpeed)}if(c=="prev"){this.$slides.eq(this.activeSlide).css({left:-this.orbitWidth,"z-index":3}).animate({left:0},this.options.animationSpeed,this.resetAndUnlock);this.$slides.eq(this.prevActiveSlide).animate({left:this.orbitWidth},this.options.animationSpeed)}}if(this.options.animation=="vertical-push"){if(c=="next"){this.$slides.eq(this.activeSlide).css({top:-this.orbitHeight,"z-index":3}).animate({top:0},this.options.animationSpeed,this.resetAndUnlock);this.$slides.eq(this.prevActiveSlide).animate({top:this.orbitHeight},this.options.animationSpeed)}if(c=="prev"){this.$slides.eq(this.activeSlide).css({top:this.orbitHeight,"z-index":3}).animate({top:0},this.options.animationSpeed,this.resetAndUnlock);this.$slides.eq(this.prevActiveSlide).animate({top:-this.orbitHeight},this.options.animationSpeed)}}this.setCaption()}}};b.fn.orbit=function(c){return this.each(function(){var d=b.extend({},a);d.init(this,c)})}})(jQuery);
/*!
 * jQuery imageready Plugin
 * http://www.zurb.com/playground/
 *
 * Copyright 2011, ZURB
 * Released under the MIT License
 */
(function(c){var b={};c.event.special.imageready={setup:function(f,e,d){b=f||b},add:function(d){var e=c(this),f;if(this.nodeType===1&&this.tagName.toLowerCase()==="img"&&this.src!==""){if(b.forceLoad){f=e.attr("src");e.attr("src","");a(this,d.handler);e.attr("src",f)}else{if(this.complete||this.readyState===4){d.handler.apply(this,arguments)}else{a(this,d.handler)}}}},teardown:function(d){c(this).unbind(".imageready")}};function a(d,f){var e=c(d);e.bind("load.imageready",function(){f.apply(d,arguments);e.unbind("load.imageready")})}}(jQuery));jQuery(document).ready(function(c){function b(d){c("form.custom input:"+d).each(function(){var f=c(this).hide(),e=f.next("span.custom."+d);if(e.length===0){e=c('<span class="custom '+d+'"></span>').insertAfter(f)}e.toggleClass("checked",f.is(":checked"));e.toggleClass("disabled",f.is(":disabled"))})}b("checkbox");b("radio");function a(f){var g=c(f),i=g.next("div.custom.dropdown"),d=g.find("option"),e=0,h;if(i.length===0){$customSelectSize="";if(c(f).hasClass("small")){$customSelectSize="small"}else{if(c(f).hasClass("medium")){$customSelectSize="medium"}else{if(c(f).hasClass("large")){$customSelectSize="large"}else{if(c(f).hasClass("expand")){$customSelectSize="expand"}}}}i=c('<div class="custom dropdown '+$customSelectSize+'"><a href="#" class="selector"></a><ul></ul></div>"');d.each(function(){h=c("<li>"+c(this).html()+"</li>");i.find("ul").append(h)});i.prepend('<a href="#" class="current">'+d.first().html()+"</a>");g.after(i);g.hide()}else{i.find("ul").html("");d.each(function(){h=c("<li>"+c(this).html()+"</li>");i.find("ul").append(h)})}i.toggleClass("disabled",g.is(":disabled"));d.each(function(j){if(this.selected){i.find("li").eq(j).addClass("selected");i.find(".current").html(c(this).html())}});i.find("li").each(function(){i.addClass("open");if(c(this).outerWidth()>e){e=c(this).outerWidth()}i.removeClass("open")});if(!i.is(".small, .medium, .large, .expand")){i.css("width",e+18+"px");i.find("ul").css("width",e+16+"px")}}c("form.custom select").each(function(){a(this)})});(function(c){function b(e){var f=0,g=e.next();$options=e.find("option");g.find("ul").html("");$options.each(function(){$li=c("<li>"+c(this).html()+"</li>");g.find("ul").append($li)});$options.each(function(h){if(this.selected){g.find("li").eq(h).addClass("selected");g.find(".current").html(c(this).html())}});g.removeAttr("style").find("ul").removeAttr("style");g.find("li").each(function(){g.addClass("open");if(c(this).outerWidth()>f){f=c(this).outerWidth()}g.removeClass("open")});g.css("width",f+18+"px");g.find("ul").css("width",f+16+"px")}function a(e){var g=e.prev(),f=g[0];if(false==g.is(":disabled")){f.checked=((f.checked)?false:true);e.toggleClass("checked");g.trigger("change")}}function d(e){var g=e.prev(),f=g[0];c('input:radio[name="'+g.attr("name")+'"]').each(function(){c(this).next().removeClass("checked")});f.checked=((f.checked)?false:true);e.toggleClass("checked");g.trigger("change")}c("form.custom span.custom.checkbox").live("click",function(e){e.preventDefault();e.stopPropagation();a(c(this))});c("form.custom span.custom.radio").live("click",function(e){e.preventDefault();e.stopPropagation();d(c(this))});c("form.custom select").live("change",function(e){b(c(this))});c("form.custom label").live("click",function(f){var e=c("#"+c(this).attr("for")),h,g;if(e.length!==0){if(e.attr("type")==="checkbox"){f.preventDefault();h=c(this).find("span.custom.checkbox");a(h)}else{if(e.attr("type")==="radio"){f.preventDefault();g=c(this).find("span.custom.radio");d(g)}}}});c("form.custom div.custom.dropdown a.current, form.custom div.custom.dropdown a.selector").live("click",function(f){var h=c(this),g=h.closest("div.custom.dropdown"),e=g.prev();f.preventDefault();if(false==e.is(":disabled")){g.toggleClass("open");if(g.hasClass("open")){c(document).bind("click.customdropdown",function(i){g.removeClass("open");c(document).unbind(".customdropdown")})}else{c(document).unbind(".customdropdown")}}});c("form.custom div.custom.dropdown li").live("click",function(h){var i=c(this),f=i.closest("div.custom.dropdown"),g=f.prev(),e=0;h.preventDefault();h.stopPropagation();i.closest("ul").find("li").removeClass("selected");i.addClass("selected");f.removeClass("open").find("a.current").html(i.html());i.closest("ul").find("li").each(function(j){if(i[0]==this){e=j}});g[0].selectedIndex=e;g.trigger("change")})})(jQuery);
/*! http://mths.be/placeholder v1.8.7 by @mathias */
(function(o,m,r){var t="placeholder" in m.createElement("input"),q="placeholder" in m.createElement("textarea"),l=r.fn,k;if(t&&q){k=l.placeholder=function(){return this};k.input=k.textarea=true}else{k=l.placeholder=function(){return this.filter((t?"textarea":":input")+"[placeholder]").not(".placeholder").bind("focus.placeholder",s).bind("blur.placeholder",p).trigger("blur.placeholder").end()};k.input=t;k.textarea=q;r(function(){r(m).delegate("form","submit.placeholder",function(){var a=r(".placeholder",this).each(s);setTimeout(function(){a.each(p)},10)})});r(o).bind("unload.placeholder",function(){r(".placeholder").val("")})}function n(b){var c={},a=/^jQuery\d+$/;r.each(b.attributes,function(d,e){if(e.specified&&!a.test(e.name)){c[e.name]=e.value}});return c}function s(){var a=r(this);if(a.val()===a.attr("placeholder")&&a.hasClass("placeholder")){if(a.data("placeholder-password")){a.hide().next().show().focus().attr("id",a.removeAttr("id").data("placeholder-id"))}else{a.val("").removeClass("placeholder")}}}function p(){var d,e=r(this),c=e,a=this.id;if(e.val()===""){if(e.is(":password")){if(!e.data("placeholder-textinput")){try{d=e.clone().attr({type:"text"})}catch(b){d=r("<input>").attr(r.extend(n(this),{type:"text"}))}d.removeAttr("name").data("placeholder-password",true).data("placeholder-id",a).bind("focus.placeholder",s);e.data("placeholder-textinput",d).data("placeholder-id",a).before(d)}e=e.removeAttr("id").hide().prev().attr("id",a).show()}e.addClass("placeholder").val(e.attr("placeholder"))}else{e.removeClass("placeholder")}}}(this,document,jQuery));(function(c){var b={bodyHeight:0,pollInterval:1000};var a={init:function(d){return this.each(function(){var f=c(".has-tip"),e=c(".tooltip"),g=function(j,i){return'<span data-id="'+j+'" class="tooltip">'+i+'<span class="nub"></span></span>'},h=setInterval(a.isDomResized,b.pollInterval);if(e.length<1){f.each(function(k){var n=c(this),o="foundationTooltip"+k,l=n.attr("title"),j=n.attr("class");n.data("id",o);var m=c(g(o,l));m.addClass(j).removeClass("has-tip").appendTo("body");if(Modernizr.touch){m.append('<span class="tap-to-close">tap to close </span>')}a.reposition(n,m,j);m.fadeOut(150)})}c(window).resize(function(){var i=c(".tooltip");i.each(function(){var j=c(this).data();target=f=c(".has-tip"),tip=c(this),classes=tip.attr("class");f.each(function(){(c(this).data().id==j.id)?target=c(this):target=target});a.reposition(target,tip,classes)})});if(Modernizr.touch){c(".tooltip").live("click touchstart touchend",function(i){i.preventDefault();c(this).fadeOut(150)});f.live("click touchstart touchend",function(i){i.preventDefault();c(".tooltip").hide();c("span[data-id="+c(this).data("id")+"].tooltip").fadeIn(150);f.attr("title","")})}else{f.hover(function(){c("span[data-id="+c(this).data("id")+"].tooltip").fadeIn(150);f.attr("title","")},function(){c("span[data-id="+c(this).data("id")+"].tooltip").fadeOut(150)})}})},reposition:function(g,k,e){var d=g.data("width"),l=k.children(".nub"),h=l.outerHeight(),f=l.outerWidth();function j(o,r,p,n,q){o.css({top:r,bottom:n,left:q,right:p})}k.css({top:(g.offset().top+g.outerHeight()+10),left:g.offset().left,width:d});j(l,-h,"auto","auto",10);if(c(window).width()<767){var m=g.parents(".row");k.width(m.outerWidth()-20).css("left",m.offset().left).addClass("tip-override");j(l,-h,"auto","auto",g.offset().left)}else{if(e.indexOf("tip-top")>-1){var i=g.offset().top-k.outerHeight()-h;k.css({top:i,left:g.offset().left,width:d}).removeClass("tip-override");j(l,"auto","auto",-h,"auto")}else{if(e.indexOf("tip-left")>-1){k.css({top:g.offset().top-(g.outerHeight()/2)-(h/2),left:g.offset().left-k.outerWidth()-10,width:d}).removeClass("tip-override");j(l,(k.outerHeight()/2)-(h/2),-h,"auto","auto")}else{if(e.indexOf("tip-right")>-1){k.css({top:g.offset().top-(g.outerHeight()/2)-(h/2),left:g.offset().left+g.outerWidth()+10,width:d}).removeClass("tip-override");j(l,(k.outerHeight()/2)-(h/2),"auto","auto",-h)}}}}},isDomResized:function(){$body=c("body");if(b.bodyHeight!=$body.height()){b.bodyHeight=$body.height();c(window).trigger("resize")}}};c.fn.tooltips=function(d){if(a[d]){return a[d].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof d==="object"||!d){return a.init.apply(this,arguments)}else{c.error("Method "+d+" does not exist on jQuery.tooltips")}}}})(jQuery);
	
		jQuery( '#featured' ).ready( function(){

			/* Orbit slider */
			jQuery('#featured').orbit({
				animation: 'fade',                  	// fade, horizontal-slide, vertical-slide, horizontal-push
				animationSpeed: 2000,                // how fast animtions are
				timer: true,	// true or false to have the timer
				advanceSpeed: 4000, 				 // if timer is enabled, time between transitions 
				pauseOnHover: true, // if you hover pauses the slider
				startClockOnMouseOut: true, 	 	// if clock should start on MouseOut
				startClockOnMouseOutAfter: 1000, 	 // how long after MouseOut should the timer start again
				directionalNav: true, 		 		// manual advancing directional navs
				captions: false, 	 // do you want captions?
				captionAnimation: 'slideOpen', 			 // fade, slideOpen, none
				captionAnimationSpeed: 800, 	 	// if so how quickly should they animate in
				bullets: false,	// true or false to activate the bullet navigation
				bulletThumbs: false,		 		// thumbnails for the bullets
				bulletThumbLocation: '',		 	// location from this file where thumbs will be
				afterSlideChange: function( prev, current ){
					if( jQuery( prev ).find( 'div.row a img' ).length > 0 ){
						jQuery( prev ).find( 'div.row a img' ).css( 'padding' , '0px 0px 0px 20px' );
					}

					if( jQuery( current ).find( 'div.row a img' ).length > 0 ){
						jQuery( current ).find( 'div.row a img' ).animate({
							'padding-left': '0px'
						});
					}
				}, 	// empty function 
				fluid: true
			});

			if( jQuery( '#featured div.content' ).not( '.fluid-placeholder' ).first().find( 'a img' ).length > 0 ){
				jQuery( '#featured div.content' ).not( '.fluid-placeholder' ).first().find( 'a img' ).animate({
					'padding-left': '0px'
				});
			}
		});
    
/* ================================================================================================================================================ */
/* SUPERFISH , SUPERSUBS                                                                                                                 */
/* ================================================================================================================================================ */

/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);	
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
			
		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;
			
			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();
			
			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);
			
		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);

/*
 * Supersubs v0.2b - jQuery plugin
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 *
 * This plugin automatically adjusts submenu widths of suckerfish-style menus to that of
 * their longest list item children. If you use this, please expect bugs and report them
 * to the jQuery Google Group with the word 'Superfish' in the subject line.
 *
 */

;(function($){ // $ will refer to jQuery within this closure

	$.fn.supersubs = function(options){
		var opts = $.extend({}, $.fn.supersubs.defaults, options);
		// return original object to support chaining
		return this.each(function() {
			// cache selections
			var $$ = $(this);
			// support metadata
			var o = $.meta ? $.extend({}, opts, $$.data()) : opts;
			// get the font size of menu.
			// .css('fontSize') returns various results cross-browser, so measure an em dash instead
			var fontsize = $('<li id="menu-fontsize">&#8212;</li>').css({
				'padding' : 0,
				'position' : 'absolute',
				'top' : '-999em',
				'width' : 'auto'
			}).appendTo($$).width(); //clientWidth is faster, but was incorrect here
			// remove em dash
			$('#menu-fontsize').remove();
			// cache all ul elements
			$ULs = $$.find('ul');
			// loop through each ul in menu
			$ULs.each(function(i) {	
				// cache this ul
				var $ul = $ULs.eq(i);
				// get all (li) children of this ul
				var $LIs = $ul.children();
				// get all anchor grand-children
				var $As = $LIs.children('a');
				// force content to one line and save current float property
				var liFloat = $LIs.css('white-space','nowrap').css('float');
				// remove width restrictions and floats so elements remain vertically stacked
				var emWidth = $ul.add($LIs).add($As).css({
					'float' : 'none',
					'width'	: 'auto'
				})
				// this ul will now be shrink-wrapped to longest li due to position:absolute
				// so save its width as ems. Clientwidth is 2 times faster than .width() - thanks Dan Switzer
				.end().end()[0].clientWidth / fontsize;
				// add more width to ensure lines don't turn over at certain sizes in various browsers
				emWidth += o.extraWidth;
				// restrict to at least minWidth and at most maxWidth
				if (emWidth > o.maxWidth)		{ emWidth = o.maxWidth; }
				else if (emWidth < o.minWidth)	{ emWidth = o.minWidth; }
				emWidth += 'em';
				// set ul to width in ems
				$ul.css('width',emWidth);
				// restore li floats to avoid IE bugs
				// set li width to full width of this ul
				// revert white-space to normal
				$LIs.css({
					'float' : liFloat,
					'width' : '100%',
					'white-space' : 'normal'
				})
				// update offset position of descendant ul to reflect new width of parent
				.each(function(){
					var $childUl = $('>ul',this);
					var offsetDirection = $childUl.css('left')!==undefined ? 'left' : 'right';
					$childUl.css(offsetDirection,emWidth);
				});
			});
			
		});
	};
	// expose defaults
	$.fn.supersubs.defaults = {
		minWidth		: 9,		// requires em unit.
		maxWidth		: 25,		// requires em unit.
		extraWidth		: 0			// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
	};
	
})(jQuery); // plugin code ends
 

    
/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

/**
 * Create a cookie with the given name and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String name The name of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given name.
 *
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 *
 * @param String name The name of the cookie.
 * @return The value of the cookie.
 * @type String
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};/*
	Mosaic - Sliding Boxes and Captions jQuery Plugin
	Version 1.0.1
	www.buildinternet.com/project/mosaic
	
	By Sam Dunn / One Mighty Roar (www.onemightyroar.com)
	Released under MIT License / GPL License
*/

(function(a){if(!a.omr){a.omr=new Object()}a.omr.mosaic=function(c,b){var d=this;d.$el=a(c);d.el=c;d.$el.data("omr.mosaic",d);d.init=function(){d.options=a.extend({},a.omr.mosaic.defaultOptions,b);d.load_box()};d.load_box=function(){if(d.options.preload){a(d.options.backdrop,d.el).hide();a(d.options.overlay,d.el).hide();a(window).load(function(){if(d.options.options.animation=="fade"&&a(d.options.overlay,d.el).css("opacity")==0){a(d.options.overlay,d.el).css("filter","alpha(opacity=0)")}a(d.options.overlay,d.el).fadeIn(200,function(){a(d.options.backdrop,d.el).fadeIn(200)});d.allow_hover()})}else{a(d.options.backdrop,d.el).show();a(d.options.overlay,d.el).show();d.allow_hover()}};d.allow_hover=function(){switch(d.options.animation){case"fade":a(d.el).hover(function(){a(d.options.overlay,d.el).stop().fadeTo(d.options.speed,d.options.opacity)},function(){a(d.options.overlay,d.el).stop().fadeTo(d.options.speed,0)});break;case"slide":startX=a(d.options.overlay,d.el).css(d.options.anchor_x)!="auto"?a(d.options.overlay,d.el).css(d.options.anchor_x):"0px";startY=a(d.options.overlay,d.el).css(d.options.anchor_y)!="auto"?a(d.options.overlay,d.el).css(d.options.anchor_y):"0px";var f={};f[d.options.anchor_x]=d.options.hover_x;f[d.options.anchor_y]=d.options.hover_y;var e={};e[d.options.anchor_x]=startX;e[d.options.anchor_y]=startY;a(d.el).hover(function(){a(d.options.overlay,d.el).stop().animate(f,d.options.speed)},function(){a(d.options.overlay,d.el).stop().animate(e,d.options.speed)});break}};d.init()};a.omr.mosaic.defaultOptions={animation:"fade",speed:150,opacity:1,preload:0,anchor_x:"left",anchor_y:"bottom",hover_x:"0px",hover_y:"0px",overlay:".mosaic-overlay",backdrop:".mosaic-backdrop"};a.fn.mosaic=function(b){return this.each(function(){(new a.omr.mosaic(this,b))})}})(jQuery); 

/* ================================================================================================================================================ */
/* SHOPPING CART                                                                                                                                     */
/* ================================================================================================================================================ */
    


jQuery(document).ready(function( ){
	
	jQuery('.confirm_payment').click(function() {
		jQuery('#ajax-indicator').show();
		jQuery.post( ajaxurl ,
						{
							"action" : 'confirm_payment' 
						} ,
						function( data ){ 
						json = eval("(" + data + ")");
						if(json['error_msg'] && json['error_msg'] != ''){
							jQuery('.response_msg').html('<div class="alert-box error">'+json['error_msg']+'<a href="javascript:void(0);" class="close" onclick="javascript:jQuery( this ).parents( \'div.alert-box\' ).fadeOut();"><sup>x</sup></a></div>');
							jQuery('#ajax-indicator').hide();
						}else{
							/*save all data about transaction*/
							save_transaction(json);
						}
					});
	});
	
	jQuery('.addtocart_btn').click(function() { 
		postId = jQuery(this).data('id');  
		AddToCart(1,postId,'add_item');
	});
});

function save_transaction(response_data){
	jQuery('.confirm_payment').hide();
	jQuery('#shopping_cart_details').hide();
	
	jQuery.post( ajaxurl ,
		{
			"action" : 'save_transaction',
			"response_data" : response_data	
		} ,
		function( data ){ 
			
			json = eval("(" + data + ")");
			if(json['success_msg'] && json['success_msg'] != ''){
				jQuery('.response_msg').html(json['transaction_details']);
				//jQuery('.response_msg').html(json['success_msg']);
			}
			jQuery('#ajax-indicator').hide();
	});
}

function AddToCart(qty,post_id,cart_action){
	jQuery('#ajax-indicator').show();
	jQuery.post( ajaxurl ,
            {
                "action" : 'add_to_cart' ,
                //"item_id" : item_id,
                "qty" : qty,
                "post_id" : post_id,
                "cart_action" : cart_action	
            } ,
            function( data ){ 
            	json = eval("(" + data + ")");
        		if(json['error_msg'] && json['error_msg'] != ''){
        			alert(json['error_msg']);
					jQuery('#ajax-indicator').hide();
        		}else{
					if(cart_action == 'update_cart'){
						get_shopping_cart_details();
					}else{
						/*redirect to shopping cart page*/
						jQuery.post( ajaxurl ,
								{
									"action" : 'redirect_shopping_cart' 
								} ,
								function( data ){ 
									
								jQuery('#ajax-indicator').hide();
								window.location = data;								
						});
						
						/*jQuery.post( ajaxurl ,
								{
									"action" : 'get_cart_total' 
								} ,
								function( data ){ 
									jQuery('#shopping-cart').html(data);
									jQuery('#ajax-indicator').hide();
									
						});*/
					}	
        		}
            		
            	
                
    });
}

/*this fnction is triggered when user changes the qty value from the input, on ht e shopping cart page*/
function update_shopping_cart( obj, post_id){
	jQuery('#ajax-indicator').show();
	if(obj.val() == ''){
		
		obj.val('1');
	}
	
	AddToCart(obj.val(),post_id,'update_cart');
	//we want to run get_shopping_cart_details() function after AddToCart()     
	window.setTimeout("get_shopping_cart_details();", 1); 
}

function get_shopping_cart_details(){
	var btn = jQuery('#agreeck').html();
	jQuery('#ajax-indicator').show();
	jQuery.post( ajaxurl ,
            {
                "action" : 'get_cart_details_updated' 
            } ,
            function( data ){ 
				
				json = eval("(" + data + ")");
        		if(json['payment_amount'] == 0){
					jQuery('#paypal_btn').hide();
				}
            	
				jQuery('#shopping_cart_details').html(json['content'] + "<div id='agreeck'>" + btn + "</div>");
				jQuery('#ajax-indicator').hide();
                
    });
	
}

function remove_cart_item(item_id,confirm_msg){
	if(confirm(confirm_msg)) {
		jQuery('#ajax-indicator').show();
		jQuery.post( ajaxurl ,
	            {
	                "action" : 'remove_cart_item' ,
	                "item_id" : item_id,
					"is_ajax" : true		
	            } ,
	            function( ){ 
	            	get_shopping_cart_details();
	                
	    });
	}	
}

function registerFree(qty,post_id){
	/*alert(1);
	jQuery('.confirm_payment').hide();
	jQuery('#shopping_cart_details').hide();*/
	jQuery('#ajax-indicator').show();
	
	jQuery.post( ajaxurl ,
		{
			"action" : 'save_free_transaction',
			"qty" : qty,
			"post_id" : post_id	
		} ,
		function( data ){ 
			
			json = eval("(" + data + ")");
			if(json['success_msg'] && json['success_msg'] != ''){
				if(json['redirect_link'] && json['redirect_link'] != ''){
					document.location = json['redirect_link']; /*redirect to my payments page*/
				}else{
				
					jQuery('.response_msg').html(json['transaction_details']);
				}
				
				
			}else if(json['error_msg'] && json['error_msg'] != ''){
				jQuery('.response_msg').html(json['error_msg']);
			}
			
			jQuery('#ajax-indicator').hide();
	});
}    

/* ================================================================================================================================================ */
/* PRETTY PHOTO                                                                                                                                     */
/* ================================================================================================================================================ */
    
/* ------------------------------------------------------------------------
	Class: prettyPhoto
	Use: Lightbox clone for jQuery
	Author: Stephane Caron (http://www.no-margin-for-errors.com)
	Version: 3.1.2
------------------------------------------------------------------------- */

(function($){$.prettyPhoto={version:'3.1.2'};$.fn.prettyPhoto=function(pp_settings){pp_settings=jQuery.extend({animation_speed:'fast',slideshow:5000,autoplay_slideshow:false,opacity:0.80,show_title:true,allow_resize:true,default_width:500,default_height:344,counter_separator_label:'/',theme:'pp_default',horizontal_padding:20,hideflash:false,wmode:'opaque',autoplay:true,modal:false,deeplinking:true,overlay_gallery:true,keyboard_shortcuts:true,changepicturecallback:function(){},callback:function(){},ie6_fallback:true,markup:'<div class="pp_pic_holder"><div class="ppt">&nbsp;</div><div class="pp_top"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div><div class="pp_content_container"><div class="pp_left"><div class="pp_right"><div class="pp_content"><div class="pp_loaderIcon"></div><div class="pp_fade"><a href="#" class="pp_expand" title="Expand the image">Expand</a><div class="pp_hoverContainer"><a class="pp_next" href="#">next</a><a class="pp_previous" href="#">previous</a></div><div id="pp_full_res"></div><div class="pp_details"><div class="pp_nav"><a href="#" class="pp_arrow_previous">Previous</a><p class="currentTextHolder">0/0</p><a href="#" class="pp_arrow_next">Next</a></div><p class="pp_description"></p>{pp_social}<a class="pp_close" href="#">Close</a></div></div></div></div></div></div><div class="pp_bottom"><div class="pp_left"></div><div class="pp_middle"></div><div class="pp_right"></div></div></div><div class="pp_overlay"></div>',gallery_markup:'<div class="pp_gallery"><a href="#" class="pp_arrow_previous">Previous</a><div><ul>{gallery}</ul></div><a href="#" class="pp_arrow_next">Next</a></div>',image_markup:'<img id="fullResImage" src="{path}" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',inline_markup:'<div class="pp_inline">{content}</div>',custom_markup:'',social_tools:'<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href='+location.href+'&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>'},pp_settings);var matchedObjects=this,percentBased=false,pp_dimensions,pp_open,pp_contentHeight,pp_contentWidth,pp_containerHeight,pp_containerWidth,windowHeight=$(window).height(),windowWidth=$(window).width(),pp_slideshow;doresize=true,scroll_pos=_get_scroll();$(window).unbind('resize.prettyphoto').bind('resize.prettyphoto',function(){_center_overlay();_resize_overlay();});if(pp_settings.keyboard_shortcuts){$(document).unbind('keydown.prettyphoto').bind('keydown.prettyphoto',function(e){if(typeof $pp_pic_holder!='undefined'){if($pp_pic_holder.is(':visible')){switch(e.keyCode){case 37:$.prettyPhoto.changePage('previous');e.preventDefault();break;case 39:$.prettyPhoto.changePage('next');e.preventDefault();break;case 27:if(!settings.modal)
$.prettyPhoto.close();e.preventDefault();break;};};};});};$.prettyPhoto.initialize=function(){settings=pp_settings;if(settings.theme=='pp_default')settings.horizontal_padding=16;if(settings.ie6_fallback&&$.browser.msie&&parseInt($.browser.version)==6)settings.theme="light_square";theRel=$(this).attr('rel');galleryRegExp=/\[(?:.*)\]/;isSet=(galleryRegExp.exec(theRel))?true:false;pp_images=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return $(n).attr('href');}):$.makeArray($(this).attr('href'));pp_titles=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).find('img').attr('alt'))?$(n).find('img').attr('alt'):"";}):$.makeArray($(this).find('img').attr('alt'));pp_descriptions=(isSet)?jQuery.map(matchedObjects,function(n,i){if($(n).attr('rel').indexOf(theRel)!=-1)return($(n).attr('title'))?$(n).attr('title'):"";}):$.makeArray($(this).attr('title'));set_position=jQuery.inArray($(this).attr('href'),pp_images);rel_index=(isSet)?set_position:$("a[rel^='"+theRel+"']").index($(this));_build_overlay(this);if(settings.allow_resize)
$(window).bind('scroll.prettyphoto',function(){_center_overlay();});$.prettyPhoto.open();return false;}
$.prettyPhoto.open=function(event){if(typeof settings=="undefined"){settings=pp_settings;if($.browser.msie&&$.browser.version==6)settings.theme="light_square";pp_images=$.makeArray(arguments[0]);pp_titles=(arguments[1])?$.makeArray(arguments[1]):$.makeArray("");pp_descriptions=(arguments[2])?$.makeArray(arguments[2]):$.makeArray("");isSet=(pp_images.length>1)?true:false;set_position=0;_build_overlay(event.target);}
if($.browser.msie&&$.browser.version==6)$('select').css('visibility','hidden');if(settings.hideflash)$('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','hidden');_checkPosition($(pp_images).size());$('.pp_loaderIcon').show();if($ppt.is(':hidden'))$ppt.css('opacity',0).show();$pp_overlay.show().fadeTo(settings.animation_speed,settings.opacity);$pp_pic_holder.find('.currentTextHolder').text((set_position+1)+settings.counter_separator_label+$(pp_images).size());if(pp_descriptions[set_position]!=""){$pp_pic_holder.find('.pp_description').show().html(unescape(pp_descriptions[set_position]));}else{$pp_pic_holder.find('.pp_description').hide();}
movie_width=(parseFloat(getParam('width',pp_images[set_position])))?getParam('width',pp_images[set_position]):settings.default_width.toString();movie_height=(parseFloat(getParam('height',pp_images[set_position])))?getParam('height',pp_images[set_position]):settings.default_height.toString();percentBased=false;if(movie_height.indexOf('%')!=-1){movie_height=parseFloat(($(window).height()*parseFloat(movie_height)/100)-150);percentBased=true;}
if(movie_width.indexOf('%')!=-1){movie_width=parseFloat(($(window).width()*parseFloat(movie_width)/100)-150);percentBased=true;}
$pp_pic_holder.fadeIn(function(){(settings.show_title&&pp_titles[set_position]!=""&&typeof pp_titles[set_position]!="undefined")?$ppt.html(unescape(pp_titles[set_position])):$ppt.html('&nbsp;');imgPreloader="";skipInjection=false;switch(_getFileType(pp_images[set_position])){case'image':imgPreloader=new Image();nextImage=new Image();if(isSet&&set_position<$(pp_images).size()-1)nextImage.src=pp_images[set_position+1];prevImage=new Image();if(isSet&&pp_images[set_position-1])prevImage.src=pp_images[set_position-1];$pp_pic_holder.find('#pp_full_res')[0].innerHTML=settings.image_markup.replace(/{path}/g,pp_images[set_position]);imgPreloader.onload=function(){pp_dimensions=_fitToViewport(imgPreloader.width,imgPreloader.height);_showContent();};imgPreloader.onerror=function(){alert('Image cannot be loaded. Make sure the path is correct and image exist.');$.prettyPhoto.close();};imgPreloader.src=pp_images[set_position];break;case'youtube':pp_dimensions=_fitToViewport(movie_width,movie_height);movie='http://www.youtube.com/embed/'+getParam('v',pp_images[set_position]);(getParam('rel',pp_images[set_position]))?movie+="?rel="+getParam('rel',pp_images[set_position]):movie+="?rel=1";if(settings.autoplay)movie+="&autoplay=1";toInject=settings.iframe_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case'vimeo':pp_dimensions=_fitToViewport(movie_width,movie_height);movie_id=pp_images[set_position];var regExp=/http:\/\/(www\.)?vimeo.com\/(\d+)/;var match=movie_id.match(regExp);movie='http://player.vimeo.com/video/'+match[2]+'?title=0&amp;byline=0&amp;portrait=0';if(settings.autoplay)movie+="&autoplay=1;";vimeo_width=pp_dimensions['width']+'/embed/?moog_width='+pp_dimensions['width'];toInject=settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,pp_dimensions['height']).replace(/{path}/g,movie);break;case'quicktime':pp_dimensions=_fitToViewport(movie_width,movie_height);pp_dimensions['height']+=15;pp_dimensions['contentHeight']+=15;pp_dimensions['containerHeight']+=15;toInject=settings.quicktime_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,pp_images[set_position]).replace(/{autoplay}/g,settings.autoplay);break;case'flash':pp_dimensions=_fitToViewport(movie_width,movie_height);flash_vars=pp_images[set_position];flash_vars=flash_vars.substring(pp_images[set_position].indexOf('flashvars')+10,pp_images[set_position].length);filename=pp_images[set_position];filename=filename.substring(0,filename.indexOf('?'));toInject=settings.flash_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+'?'+flash_vars);break;case'iframe':pp_dimensions=_fitToViewport(movie_width,movie_height);frame_url=pp_images[set_position];frame_url=frame_url.substr(0,frame_url.indexOf('iframe')-1);toInject=settings.iframe_markup.replace(/{width}/g,pp_dimensions['width']).replace(/{height}/g,pp_dimensions['height']).replace(/{path}/g,frame_url);break;case'ajax':doresize=false;pp_dimensions=_fitToViewport(movie_width,movie_height);doresize=true;skipInjection=true;$.get(pp_images[set_position],function(responseHTML){toInject=settings.inline_markup.replace(/{content}/g,responseHTML);$pp_pic_holder.find('#pp_full_res')[0].innerHTML=toInject;_showContent();});break;case'custom':pp_dimensions=_fitToViewport(movie_width,movie_height);toInject=settings.custom_markup;break;case'inline':myClone=$(pp_images[set_position]).clone().append('<br clear="all" />').css({'width':settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline"></div></div>').appendTo($('body')).show();doresize=false;pp_dimensions=_fitToViewport($(myClone).width(),$(myClone).height());doresize=true;$(myClone).remove();toInject=settings.inline_markup.replace(/{content}/g,$(pp_images[set_position]).html());break;};if(!imgPreloader&&!skipInjection){$pp_pic_holder.find('#pp_full_res')[0].innerHTML=toInject;_showContent();};});return false;};$.prettyPhoto.changePage=function(direction){currentGalleryPage=0;if(direction=='previous'){set_position--;if(set_position<0)set_position=$(pp_images).size()-1;}else if(direction=='next'){set_position++;if(set_position>$(pp_images).size()-1)set_position=0;}else{set_position=direction;};rel_index=set_position;if(!doresize)doresize=true;$('.pp_contract').removeClass('pp_contract').addClass('pp_expand');_hideContent(function(){$.prettyPhoto.open();});};$.prettyPhoto.changeGalleryPage=function(direction){if(direction=='next'){currentGalleryPage++;if(currentGalleryPage>totalPage)currentGalleryPage=0;}else if(direction=='previous'){currentGalleryPage--;if(currentGalleryPage<0)currentGalleryPage=totalPage;}else{currentGalleryPage=direction;};slide_speed=(direction=='next'||direction=='previous')?settings.animation_speed:0;slide_to=currentGalleryPage*(itemsPerPage*itemWidth);$pp_gallery.find('ul').animate({left:-slide_to},slide_speed);};$.prettyPhoto.startSlideshow=function(){if(typeof pp_slideshow=='undefined'){$pp_pic_holder.find('.pp_play').unbind('click').removeClass('pp_play').addClass('pp_pause').click(function(){$.prettyPhoto.stopSlideshow();return false;});pp_slideshow=setInterval($.prettyPhoto.startSlideshow,settings.slideshow);}else{$.prettyPhoto.changePage('next');};}
$.prettyPhoto.stopSlideshow=function(){$pp_pic_holder.find('.pp_pause').unbind('click').removeClass('pp_pause').addClass('pp_play').click(function(){$.prettyPhoto.startSlideshow();return false;});clearInterval(pp_slideshow);pp_slideshow=undefined;}
$.prettyPhoto.close=function(){if($pp_overlay.is(":animated"))return;$.prettyPhoto.stopSlideshow();$pp_pic_holder.stop().find('object,embed').css('visibility','hidden');$('div.pp_pic_holder,div.ppt,.pp_fade').fadeOut(settings.animation_speed,function(){$(this).remove();});$pp_overlay.fadeOut(settings.animation_speed,function(){if($.browser.msie&&$.browser.version==6)$('select').css('visibility','visible');if(settings.hideflash)$('object,embed,iframe[src*=youtube],iframe[src*=vimeo]').css('visibility','visible');$(this).remove();$(window).unbind('scroll.prettyphoto');settings.callback();doresize=true;pp_open=false;delete settings;});};function _showContent(){$('.pp_loaderIcon').hide();projectedTop=scroll_pos['scrollTop']+((windowHeight/2)-(pp_dimensions['containerHeight']/2));if(projectedTop<0)projectedTop=0;$ppt.fadeTo(settings.animation_speed,1);$pp_pic_holder.find('.pp_content').animate({height:pp_dimensions['contentHeight'],width:pp_dimensions['contentWidth']},settings.animation_speed);$pp_pic_holder.animate({'top':projectedTop,'left':(windowWidth/2)-(pp_dimensions['containerWidth']/2),width:pp_dimensions['containerWidth']},settings.animation_speed,function(){$pp_pic_holder.find('.pp_hoverContainer,#fullResImage').height(pp_dimensions['height']).width(pp_dimensions['width']);$pp_pic_holder.find('.pp_fade').fadeIn(settings.animation_speed);if(isSet&&_getFileType(pp_images[set_position])=="image"){$pp_pic_holder.find('.pp_hoverContainer').show();}else{$pp_pic_holder.find('.pp_hoverContainer').hide();}
if(pp_dimensions['resized']){$('a.pp_expand,a.pp_contract').show();}else{$('a.pp_expand').hide();}
if(settings.autoplay_slideshow&&!pp_slideshow&&!pp_open)$.prettyPhoto.startSlideshow();if(settings.deeplinking)
setHashtag();settings.changepicturecallback();pp_open=true;});_insert_gallery();};function _hideContent(callback){$pp_pic_holder.find('#pp_full_res object,#pp_full_res embed').css('visibility','hidden');$pp_pic_holder.find('.pp_fade').fadeOut(settings.animation_speed,function(){$('.pp_loaderIcon').show();callback();});};function _checkPosition(setCount){(setCount>1)?$('.pp_nav').show():$('.pp_nav').hide();};function _fitToViewport(width,height){resized=false;_getDimensions(width,height);imageWidth=width,imageHeight=height;if(((pp_containerWidth>windowWidth)||(pp_containerHeight>windowHeight))&&doresize&&settings.allow_resize&&!percentBased){resized=true,fitting=false;while(!fitting){if((pp_containerWidth>windowWidth)){imageWidth=(windowWidth-200);imageHeight=(height/width)*imageWidth;}else if((pp_containerHeight>windowHeight)){imageHeight=(windowHeight-200);imageWidth=(width/height)*imageHeight;}else{fitting=true;};pp_containerHeight=imageHeight,pp_containerWidth=imageWidth;};_getDimensions(imageWidth,imageHeight);if((pp_containerWidth>windowWidth)||(pp_containerHeight>windowHeight)){_fitToViewport(pp_containerWidth,pp_containerHeight)};};return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(pp_containerHeight),containerWidth:Math.floor(pp_containerWidth)+(settings.horizontal_padding*2),contentHeight:Math.floor(pp_contentHeight),contentWidth:Math.floor(pp_contentWidth),resized:resized};};function _getDimensions(width,height){width=parseFloat(width);height=parseFloat(height);$pp_details=$pp_pic_holder.find('.pp_details');$pp_details.width(width);detailsHeight=parseFloat($pp_details.css('marginTop'))+parseFloat($pp_details.css('marginBottom'));$pp_details=$pp_details.clone().addClass(settings.theme).width(width).appendTo($('body')).css({'position':'absolute','top':-10000});detailsHeight+=$pp_details.height();detailsHeight=(detailsHeight<=34)?36:detailsHeight;if($.browser.msie&&$.browser.version==7)detailsHeight+=8;$pp_details.remove();$pp_title=$pp_pic_holder.find('.ppt');$pp_title.width(width);titleHeight=parseFloat($pp_title.css('marginTop'))+parseFloat($pp_title.css('marginBottom'));$pp_title=$pp_title.clone().appendTo($('body')).css({'position':'absolute','top':-10000});titleHeight+=$pp_title.height();$pp_title.remove();pp_contentHeight=height+detailsHeight;pp_contentWidth=width;pp_containerHeight=pp_contentHeight+titleHeight+$pp_pic_holder.find('.pp_top').height()+$pp_pic_holder.find('.pp_bottom').height();pp_containerWidth=width;}
function _getFileType(itemSrc){if(itemSrc.match(/youtube\.com\/watch/i)){return'youtube';}else if(itemSrc.match(/vimeo\.com/i)){return'vimeo';}else if(itemSrc.match(/\b.mov\b/i)){return'quicktime';}else if(itemSrc.match(/\b.swf\b/i)){return'flash';}else if(itemSrc.match(/\biframe=true\b/i)){return'iframe';}else if(itemSrc.match(/\bajax=true\b/i)){return'ajax';}else if(itemSrc.match(/\bcustom=true\b/i)){return'custom';}else if(itemSrc.substr(0,1)=='#'){return'inline';}else{return'image';};};function _center_overlay(){if(doresize&&typeof $pp_pic_holder!='undefined'){scroll_pos=_get_scroll();contentHeight=$pp_pic_holder.height(),contentwidth=$pp_pic_holder.width();projectedTop=(windowHeight/2)+scroll_pos['scrollTop']-(contentHeight/2);if(projectedTop<0)projectedTop=0;if(contentHeight>windowHeight)
return;$pp_pic_holder.css({'top':projectedTop,'left':(windowWidth/2)+scroll_pos['scrollLeft']-(contentwidth/2)});};};function _get_scroll(){if(self.pageYOffset){return{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset};}else if(document.documentElement&&document.documentElement.scrollTop){return{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft};}else if(document.body){return{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft};};};function _resize_overlay(){windowHeight=$(window).height(),windowWidth=$(window).width();if(typeof $pp_overlay!="undefined")$pp_overlay.height($(document).height()).width(windowWidth);};function _insert_gallery(){if(isSet&&settings.overlay_gallery&&_getFileType(pp_images[set_position])=="image"&&(settings.ie6_fallback&&!($.browser.msie&&parseInt($.browser.version)==6))){itemWidth=52+5;navWidth=(settings.theme=="facebook"||settings.theme=="pp_default")?50:30;itemsPerPage=Math.floor((pp_dimensions['containerWidth']-100-navWidth)/itemWidth);itemsPerPage=(itemsPerPage<pp_images.length)?itemsPerPage:pp_images.length;totalPage=Math.ceil(pp_images.length/itemsPerPage)-1;if(totalPage==0){navWidth=0;$pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').hide();}else{$pp_gallery.find('.pp_arrow_next,.pp_arrow_previous').show();};galleryWidth=itemsPerPage*itemWidth;fullGalleryWidth=pp_images.length*itemWidth;$pp_gallery.css('margin-left',-((galleryWidth/2)+(navWidth/2))).find('div:first').width(galleryWidth+5).find('ul').width(fullGalleryWidth).find('li.selected').removeClass('selected');goToPage=(Math.floor(set_position/itemsPerPage)<totalPage)?Math.floor(set_position/itemsPerPage):totalPage;$.prettyPhoto.changeGalleryPage(goToPage);$pp_gallery_li.filter(':eq('+set_position+')').addClass('selected');}else{$pp_pic_holder.find('.pp_content').unbind('mouseenter mouseleave');}}
function _build_overlay(caller){settings.markup=settings.markup.replace('{pp_social}',(settings.social_tools)?settings.social_tools:'');$('body').append(settings.markup);$pp_pic_holder=$('.pp_pic_holder'),$ppt=$('.ppt'),$pp_overlay=$('div.pp_overlay');if(isSet&&settings.overlay_gallery){currentGalleryPage=0;toInject="";for(var i=0;i<pp_images.length;i++){if(!pp_images[i].match(/\b(jpg|jpeg|png|gif)\b/gi)){classname='default';img_src='';}else{classname='';img_src=pp_images[i];}
toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='50' alt='' /></a></li>";};toInject=settings.gallery_markup.replace(/{gallery}/g,toInject);$pp_pic_holder.find('#pp_full_res').after(toInject);$pp_gallery=$('.pp_pic_holder .pp_gallery'),$pp_gallery_li=$pp_gallery.find('li');$pp_gallery.find('.pp_arrow_next').click(function(){$.prettyPhoto.changeGalleryPage('next');$.prettyPhoto.stopSlideshow();return false;});$pp_gallery.find('.pp_arrow_previous').click(function(){$.prettyPhoto.changeGalleryPage('previous');$.prettyPhoto.stopSlideshow();return false;});$pp_pic_holder.find('.pp_content').hover(function(){$pp_pic_holder.find('.pp_gallery:not(.disabled)').fadeIn();},function(){$pp_pic_holder.find('.pp_gallery:not(.disabled)').fadeOut();});itemWidth=52+5;$pp_gallery_li.each(function(i){$(this).find('a').click(function(){$.prettyPhoto.changePage(i);$.prettyPhoto.stopSlideshow();return false;});});};if(settings.slideshow){$pp_pic_holder.find('.pp_nav').prepend('<a href="#" class="pp_play">Play</a>')
$pp_pic_holder.find('.pp_nav .pp_play').click(function(){$.prettyPhoto.startSlideshow();return false;});}
$pp_pic_holder.attr('class','pp_pic_holder '+settings.theme);$pp_overlay.css({'opacity':0,'height':$(document).height(),'width':$(window).width()}).bind('click',function(){if(!settings.modal)$.prettyPhoto.close();});$('a.pp_close').bind('click',function(){$.prettyPhoto.close();return false;});$('a.pp_expand').bind('click',function(e){if($(this).hasClass('pp_expand')){$(this).removeClass('pp_expand').addClass('pp_contract');doresize=false;}else{$(this).removeClass('pp_contract').addClass('pp_expand');doresize=true;};_hideContent(function(){$.prettyPhoto.open();});return false;});$pp_pic_holder.find('.pp_previous, .pp_nav .pp_arrow_previous').bind('click',function(){$.prettyPhoto.changePage('previous');$.prettyPhoto.stopSlideshow();return false;});$pp_pic_holder.find('.pp_next, .pp_nav .pp_arrow_next').bind('click',function(){$.prettyPhoto.changePage('next');$.prettyPhoto.stopSlideshow();return false;});_center_overlay();};if(!pp_alreadyInitialized&&getHashtag()){pp_alreadyInitialized=true;hashIndex=getHashtag();hashRel=hashIndex;hashIndex=hashIndex.substring(hashIndex.indexOf('/')+1,hashIndex.length-1);hashRel=hashRel.substring(0,hashRel.indexOf('/'));setTimeout(function(){$("a[rel^='"+hashRel+"']:eq("+hashIndex+")").trigger('click');},50);}
return this.unbind('click.prettyphoto').bind('click.prettyphoto',$.prettyPhoto.initialize);};function getHashtag(){url=location.href;hashtag=(url.indexOf('#!')!=-1)?decodeURI(url.substring(url.indexOf('#!')+2,url.length)):false;return hashtag;};function setHashtag(){if(typeof theRel=='undefined')return;location.hash='!'+theRel+'/'+rel_index+'/';};function getParam(name,url){name=name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS="[\\?&]"+name+"=([^&#]*)";var regex=new RegExp(regexS);var results=regex.exec(url);return(results==null)?"":results[1];}})(jQuery);var pp_alreadyInitialized=false;jQuery(document).ready(function(){
    /* show images inserted in gallery */
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            autoplay_slideshow: false,
            theme: 'light_rounded'

    });

    /* show images inserted into post in LightBox */
    jQuery("[class*='wp-image-']").parents('a').prettyPhoto({
            autoplay_slideshow: false,
            theme: 'light_rounded'

    });

    jQuery("a[rel^='keyboardtools']").prettyPhoto({
            autoplay_slideshow: false,
            theme: 'light_rounded',
            social_tools : ''

    });
});
/* ================================================================================================================================================ */
/* JSCROLL PANEL                                                                                                                                    */
/* ================================================================================================================================================ */
function removePost( postID , homeUrl ){
	jQuery(function(){
		jQuery.post( ajaxurl , {
			'action': 'remove_post',
			'post_id': postID
		} , function (data) {
			document.location = homeUrl; 
		});
	});
}

jQuery( window ).load( function(){
	jQuery( '.orbit-wrapper .slider-nav' ).hide();
	jQuery( '.orbit-wrapper' ).hover( function(){
		jQuery( '.orbit-wrapper .slider-nav' ).show();
	});
	jQuery( '.orbit-wrapper' ).mouseleave( function(){
		jQuery( '.orbit-wrapper .slider-nav' ).hide();
	});
});

jQuery(document).ready(function(){
	
	/* digit text field */
	jQuery('input[type="text"].digit').bind( 'keyup' , function(){
		var value = jQuery( this ).val()
		jQuery( this ).val( value.replace( /[^\d|\.|\,]/g , '' ) );
	});
	
	/* Superfish menu */
	jQuery("ul.sf-menu").supersubs({
			minWidth:    12,
			maxWidth:    32,
			extraWidth:  1
		}).superfish({
			delay: 200,
			speed: 250
		});

	/* Deatils div on hover */
	jQuery(".hovermore a").hover(function() {
		var e = this;
		jQuery(e).find("div").stop().animate({ marginTop: "-8px" }, 250, function() {
			jQuery(e).find("div").animate({ marginTop: "-8px" }, 250);
		});
	},function(){
		var e = this;
		jQuery(e).find("div").stop().animate({ marginTop: "0px" }, 250, function() {
			jQuery(e).find("div").animate({ marginTop: "0px" }, 250);
		});
	});
	
	/* Social-media icons annimation */
	jQuery(".social-media li").hover(function() {
		var e = this;
		jQuery(e).find("a").stop().animate({ marginTop: "-8px" }, 250, function() {
			jQuery(e).find("a").animate({ marginTop: "-8px" }, 250);
		});
	},function(){
		var e = this;
		jQuery(e).find("a").stop().animate({ marginTop: "0px" }, 250, function() {
			jQuery(e).find("a").animate({ marginTop: "0px" }, 250);
		});
	});
	
	/*Sponsors images annimation */
	$(".whitey .cosmo-sponsors li").hover(function() {
		var e = this;
		$(e).find("a").stop().animate({ marginTop: "-8px" }, 250, function() {
			$(e).find("a").animate({ marginTop: "-8px" }, 250);
		});
	},function(){
		var e = this;
		$(e).find("a").stop().animate({ marginTop: "0px" }, 250, function() {
			$(e).find("a").animate({ marginTop: "0px" }, 250);
		});
	});

	/* Widget tabber */
    jQuery( 'ul.widget_tabber li a' ).click(function(){
        jQuery(this).parent('li').parent('ul').find('li').removeClass('active');
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').fadeTo( 200 , 0 );
        jQuery(this).parent('li').parent('ul').parent('div').find( 'div.tab_menu_content.tabs-container').hide();
        jQuery( jQuery( this ).attr('href') + '_panel' ).fadeTo( 200 , 1 );
        jQuery( this ).parent('li').addClass('active');
    });

	 /* Initialize tabs */
	(typeof(jQuery.fn.tabs) === 'function') && jQuery(function() { 
		jQuery('.cosmo-tabs').tabs({ fxFade: true, fxSpeed: 'fast' }); 
		jQuery('.tabs-nav li:first-child a').click();
	});
	
	 
	/* Accordion */
	jQuery('.cosmo-acc-container').hide();
	jQuery('.cosmo-acc-trigger:first').addClass('active').next().show();
	jQuery('.cosmo-acc-trigger').click(function(){
		if( jQuery(this).next().is(':hidden') ) {
			jQuery('.cosmo-acc-trigger').removeClass('active').next().slideUp();
			jQuery(this).toggleClass('active').next().slideDown();
		}
		return false;
	});

  	/*toogle*/
  	/*Case when by default the toggle is closed */
	jQuery('.open_title').click(function(){
		if (jQuery(this).find('a').hasClass('show')) {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close'); 
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		} else {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});
  
  	/*Case when by default the toggle is oppened */
	jQuery('.close_title').click(function(){
		if (jQuery(this).find('a').hasClass('hide')) {
			jQuery(this).find('a').removeClass('toggle_close');
			jQuery(this).find('a').addClass('show');     
			jQuery(this).find('.title_open').hide();
			jQuery(this).find('.title_closed').show();
		} else {
			jQuery(this).find('a').removeClass('show');
			jQuery(this).find('a').addClass('toggle_close');
			jQuery(this).find('.title_closed').hide();
			jQuery(this).find('.title_open').show();
		}
		jQuery('.cosmo-toggle-container').slideToggle("slow");
	});

	/* Dynamic twitter widget */
	if (jQuery().slides) {
		jQuery(".dynamic .cosmo_twitter").slides({
			play: 5000,
			effect: 'fade',
			generatePagination: false,
			autoHeight: true
		});
	}

	/* Scroll to top */
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
	});
	jQuery('#toTop').click(function() {
		jQuery('body,html').animate({scrollTop:0},300);
	});	
	
	/* Mosaic fade */
	jQuery('.hovermore, .readmore, .full-screen').mosaic();
	
	/* Determine screen resolution */
	var $body = jQuery('body'),
		wSizes = [1600, 1440, 1280, 1024, 800],
		wSizesClasses = ['w1600', 'w1440', 'w1280', 'w1024', 'w800'];
		
	jQuery(window).bind('resize', function() {
		$body.removeClass(wSizesClasses.join(' '));
		var size = jQuery(this).width();
		for (var i=0; i<wSizes.length; i++) {
			if (size >= wSizes[i]) {
				$body.addClass(wSizesClasses[i]);
				break;
			}
		}
	}).trigger('resize');
	
});

jQuery(function() {

    jQuery( '.demo-tooltip' ).tour();

    jQuery('a.close').click(function() {
        jQuery( jQuery( this ).attr('href') ).slideUp();
        jQuery.cookie( cookies_prefix + "tooltip" , 'closed' , {expires: 365, path: '/'});
        /* jQuery('.delimiter').removeClass('hidden'); */
        return false;
    });
});

function contact( action , form , container ){
    jQuery( document ).ready(function(){

        var name  = jQuery( form ).find("input[name=\"name\"]").val();
        var email = jQuery( form ).find("input[name=\"email\"]").val();
		var contact_email = jQuery( form ).find("input[name=\"contact_email\"]").val();
        var phone  = jQuery( form ).find("input[name=\"phone\"]").val();
        var mssg  = jQuery( form ).find("textarea[name=\"message\"]").val();


        jQuery.post( ajaxurl ,
                {
                    "action" : action ,
                    "name" : name,
                    "email" : email,
					"contact_email" : contact_email, 
                    "phone" : phone,
                    "message" : mssg,
                    "btn_send" : "btn_send"
                } ,
                function( data ){
                    var result = '';
                    var array  = data.split( '","' );
                    if( array.constructor.toString().indexOf("Array") == -1 ){
                        for(var i = 0; i < array.length; i++ ){
                            if( jQuery.trim( array[i] ) == mail.email ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find( "input[name=\"email\"]" ).addClass( 'send-error' );
                            }

                            if( jQuery.trim( array[i] ) == mail.name ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find( "input[name=\"name\"]" ).addClass( 'send-error' );
                            }

                            if( jQuery.trim( array[i] ) == mail.message ){
                                result = result + array[i] + '<br />';
                                jQuery( form ).find( "textarea[name=\"message\"]" ).addClass( 'send-error' );
                            }
                        }
                        if( result.toString().length > 0 ){
                            jQuery( container ).html( result );
                        }else{
                            jQuery( container ).html( data );

                                jQuery('#name').val('');
                                jQuery('#email').val('');
                                jQuery('#comment').val('');
                                jQuery('#contact_name').val('');
                                jQuery('#contact_email').val('');
                                jQuery('#contact_phone').val('');
                                jQuery('#contact_message').val('');
                        }
                    }else{
                        jQuery( container ).html( data );
                    }
        });
    });
}(function(jQuery){
    var defaultOptions = {
        "nextClass" : "next",
        "skipClass" : "skip",
        "closeClass" : "tooltip-close"
    };

    jQuery.fn.tour = function( options ){
        var container = this;
        var index;
        var side;
        var opt = jQuery.extend( {} , defaultOptions , options );
        return this.each(function(){            
            index = 0;
            jQuery( "." + opt.nextClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( container ).each(function( i ){
                    if( index + 1 == parseInt( jQuery( this ).attr('index') ) ){
                        jQuery( this ).fadeTo('slow', 1 );
                        jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index + 1 , {expires: 365, path: '/' } );
                        jQuery( this ).gonext();
                        
                    }else{
                        jQuery( this ).fadeTo('slow', 0 , function(){
                            jQuery( this ).hide();
                        });
                    }
                });
            });

            jQuery( "." + opt.skipClass , this ).click(function(){
                index = parseInt( jQuery( this ).parent().parent().parent().attr('index') );
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                jQuery.cookie(cookies_prefix + '_tour_stap_' + side , index , {expires: 365, path: '/' } );
            });
            jQuery( "." + opt.closeClass , this ).click(function(){
                side  = jQuery( this ).parent().parent().parent().attr('rel');
                jQuery( this ).parent().parent().parent().fadeTo('slow', 0 , function(){
                    jQuery( this ).hide();
                });
                jQuery.cookie(cookies_prefix + '_tour_closed_' + side , 'true' , {expires: 365, path: '/' } );
            });
        });
    }

    jQuery.fn.gonext = function(){
        var h = parseInt((parseInt( jQuery( window ).height() ) - parseInt( jQuery( this ).height()) ) / 2 );
        if( jQuery( this ).offset().top > h ){
            jQuery.scrollTo( jQuery( this ).offset().top - h , 400 );
        }
    }
})(jQuery);    
    /* ================================================================================================================================================ */
    /* GENERAL VARS                                                                                                                                     */
    /* ================================================================================================================================================ */
    
    var ajaxurl = "http://www.patatravelmartdemo.info/wp-admin/admin-ajax.php";
    var cookies_prefix = "PressEvent";  
    var themeurl = "http://www.patatravelmartdemo.info/wp-content/themes/PressEvent";

	/* ================================================================================================================================================ */
    /* LOGIN VARS                                                                                                                                     */
    /* ================================================================================================================================================ */

					var login_url = "http://www.patatravelmartdemo.info/?page_id=6";
	
var user_archives_link;
var close = '<a href="javascript:void(0);" class="close" onclick="javascript:jQuery( this ).parents( \'div.alert-box\' ).fadeOut();"><sup>x</sup></a>';

function redirect(){
	if( document.referrer.indexOf( login_url ) != -1 ){
		document.location = user_archives_link;
	}else{
		var goto = document.referrer;
		if( goto.indexOf( '?' ) != -1 ){
			goto += '&a=b';
		}else{
			goto += '?a=b';
		}
		document.location = goto;
	}
}

jQuery( '#register_form' ).ready( function(){
	jQuery( '#register_form' ).submit( function( event ){
		jQuery.ajax({
			url: ajaxurl,
			data: '&action=cosmo_register&'+jQuery( '#register_form' ).serialize(),
			type: 'POST',
			cache: false,
			success: function (data) {
				if( data.indexOf( 'success' ) != -1 ){
					user_archives_link = login_url;
					jQuery( 'div.alert-box.error' ).hide();
					jQuery( 'div.alert-box.success' ).html( __( 'Registration successful.' ) + close );
					jQuery( 'div.alert-box.success' ).show();
					setTimeout( redirect , 1000 );
				}else{
					jQuery( 'div.alert-box.success' ).hide();
					jQuery( 'div.alert-box.error' ).html( data + close );
					jQuery( 'div.alert-box.error' ).show();
				}
			}
		});
		event.preventDefault();
	});
});
		
jQuery( '#loginform' ).ready( function(){

	jQuery( '#loginform' ).submit( function(event){
		jQuery.ajax({
			url: ajaxurl,
			data: '&action=cosmo_login&'+jQuery( '#loginform' ).serialize(),
			type: 'POST',
			cache: false,
			success: function (data) {
				if( data.indexOf( 'success' ) != -1 ){
					user_archives_link = eval( data );
					jQuery( 'div.alert-box.error' ).hide();
					jQuery( 'div.alert-box.success' ).html( __( 'Login successful' ) + close );
					jQuery( 'div.alert-box.success' ).show();
					setTimeout( redirect , 1000 );
				}else{
					if( data.indexOf( 'Lost your password' ) != -1 )
					{
						jQuery( 'div.alert-box.success' ).hide();
						jQuery( 'div.alert-box.error' ).html( __( 'Incorrect password' ) + close );
						jQuery( 'div.alert-box.error' ).show();
					}else{
						jQuery( 'div.alert-box.success' ).hide();
						jQuery( 'div.alert-box.error' ).html( data + close );
						jQuery( 'div.alert-box.error' ).show();
					}
				}
			}
		});
		event.preventDefault();
	});
});

jQuery( '#lostpasswordform' ).ready( function(){
	jQuery( '#lostpasswordform' ).submit( function( event ){
		jQuery( 'div.alert-box.error' ).hide();
		jQuery( 'div.alert-box.success' ).hide();
		if( !jQuery( '#user_login' ).val() || !jQuery.trim( jQuery( '#user_login' ).val() ).length || jQuery.trim( jQuery( '#user_login' ).val() ).length == 0 ){
			jQuery( 'div.alert-box.error' ).html( __( 'Please enter an email or username' ) + close );
			jQuery( 'div.alert-box.error' ).show();
		}else{
			jQuery( 'div.alert-box.success' ).html( __( 'Please check your email' ) + close );
			jQuery( 'div.alert-box.success' ).show();
		}
	});
});

jQuery( '#cosmo-loginform' ).ready( function(){
	jQuery( '#cosmo-loginform' ).submit( function(event){
		jQuery.ajax({
			url: ajaxurl,
			data: '&action=cosmo_login&'+jQuery( '#cosmo-loginform' ).serialize(),
					type: 'POST',
			  cache: false,
			  success: function (data) {
				  if( data.indexOf( 'success' ) != -1 ){
			user_archives_link = eval( data );
			jQuery( 'div.alert-box.error' ).hide();
			jQuery( 'div.alert-box.success' ).html( __( 'Login successful' ) + close );
			jQuery( 'div.alert-box.success' ).show();
			setTimeout( redirect , 1000 );
				  }else{
					  if( data.indexOf( 'Lost your password' ) != -1 )
			{
				jQuery( 'div.alert-box.success' ).hide();
				jQuery( 'div.alert-box.error' ).html( __( 'Incorrect password' ) + close );
				jQuery( 'div.alert-box.error' ).show();
			}else{
				jQuery( 'div.alert-box.success' ).hide();
				jQuery( 'div.alert-box.error' ).html( data + close );
				jQuery( 'div.alert-box.error' ).show();
			}
				  }
			  }
		});
		event.preventDefault();
	});
});
	/* ================================================================================================================================================ */
    /* UPLOADER                                                                                                                                     */
    /* ================================================================================================================================================ */

var Cosmo_Uploader=
	{
		senders:new Array(),
		process_error:function(receiver,error)
			{
				this.senders[receiver].show_error(error);
			},
		upload_finished:function(receiver,params)
			{
				this.senders[receiver].upload_finished_with_success(params);
			},
		init:function()
		  {
			window.Cosmo_Uploader=this;
		  },
		Basic_Functionality:function(interface_id)
			{
				var object=new Object();
				object.interface_id=interface_id;
				object.attachments=new Array();
				object.thumbnail_ids=new Array();
				object.next_thumbnail_id=0;
				object.files_input_element=document.getElementById(object.interface_id).getElementsByTagName("input")[0];
				Cosmo_Uploader.senders[object.interface_id]=object;
				
				jQuery("#"+object.interface_id).ready(function(){
					jQuery("#"+object.interface_id+" .cui_spinner_container").hide();
				});
				
				jQuery(object.files_input_element).change(function()
				{
					object.show_spinner();
					object.start_upload();
				});
				
				var multiple_files_upload=function()
					{
						var l=this.files_input_element.files.length;
						this.files_processed=0;
						this.files_total=l;
						jQuery("#"+this.interface_id+" .cui_spinner_container p").html(__("Uploading")+" "+l+" "+__("file")+(l==1?'':'s')+". "+__("This may take a while")+".");
						jQuery("#"+this.interface_id+" input[name*=\"method\"]").val("form");
						jQuery("#"+this.interface_id+" input[name*=\"action\"]").val("upload");
						jQuery("#"+this.interface_id+" input[name*=\"sender\"]").val(this.interface_id);
						jQuery("#"+this.interface_id+" form").submit();
						document.getElementById(this.interface_id).getElementsByTagName("form")[0].reset();
					}
				var single_file_upload=function()
					{
						jQuery("#"+this.interface_id+" .cui_spinner_container p").html(__("Uploading... Please wait."));
						jQuery("#"+this.interface_id+" input[name*=\"action\"]").val("upload");
						jQuery("#"+this.interface_id+" input[name*=\"sender\"]").val(this.interface_id);
						jQuery("#"+this.interface_id+" form").submit();
						document.getElementById(this.interface_id).getElementsByTagName("form")[0].reset();
					}
				if(object.files_input_element.files)
					object.start_upload=multiple_files_upload;
				else object.start_upload=single_file_upload;
				
				object.show_spinner=function()
					{
						jQuery( '#ajax-indicator' ).show();
						jQuery("#"+object.interface_id+" .cui_add_button").hide();
					}
				object.hide_spinner=function()
					{
						jQuery("#"+object.interface_id+" .cui_add_button").show();
						jQuery( '#ajax-indicator' ).hide();
					}
				object.show_error=function(error)
					{
						object.hide_spinner();
						jQuery("#"+object.interface_id+" .cui_error_container").append(error+"<br>");
					}
				object.remove=function(id)
					{
						if(!confirm(__("Are you sure?"))) return;
						var attach_id=this.thumbnail_ids[id];
						var thumbnail_id="thumbnail_"+id;
						var idx=jQuery.inArray(attach_id,this.attachments);
						if(idx!=-1)
						  {
							this.attachments.splice(idx,1);
						  }
						idx=jQuery.inArray(id,this.thumbnail_ids);
						if(idx!=-1)
						  {
							this.thumbnail_ids.splice(idx,1);
						  }
					  	var uri=Cosmo_Uploader.template_directory_uri;
						jQuery.ajax({
							url:uri+"/upload-server.php",
							type:"post",
							data:"action=delete&attach_id="+attach_id
						});
						jQuery("#"+this.interface_id+" #"+thumbnail_id).remove();
					}
				object.upload_finished_with_success=function(params)
					{
						this.hide_spinner();
						this.attachments.push(params["attach_id"]);
						var thumbnail_id_to_return=this.next_thumbnail_id;
						var thumbnail_id="thumbnail_"+this.next_thumbnail_id;
						this.thumbnail_ids[this.next_thumbnail_id]=params["attach_id"];
						this.next_thumbnail_id++;
					    var diff=50-params["h"];
						var append="<div class=\"cui_thumbnail\" id=\""+thumbnail_id+"\">";
						append+=params["fn_excerpt"];
						append+="<a href=\"javascript:void(0)\" class=\"feat_ref\" title=\""+params["filename"]+" "+__('Click to set as featured')+".\">"
						append+="<img src=\""+params["url"]+"\" witdh=\""+params['w']+"\" height=\""+params['h']+"\" alt=\""+params["filename"]+". "+__('Click to set as featured')+"\" style=\"margin-top:"+diff+"px\">";
						append+="</a>";
						append+="<br/>";
						append+="<a href=\"javascript:void(0)\" class=\"remove_ref\">"+__('Remove')+"</a>";
						append+="</div>";
						jQuery("#"+this.interface_id+" .cui_thumbnail_container").append(append);
						var jthis=this;
						
						jQuery("#"+this.interface_id+" #"+thumbnail_id+" .remove_ref").click(function()
							{
							  jthis.remove(thumbnail_id_to_return);
							});
						return thumbnail_id_to_return;
					}
				object.serialize=function()
					{
						var querydata="";
						var id;
						for(id=0;id<this.attachments.length;id++)
							{
								querydata+="&attachments[]="+encodeURIComponent(this.attachments[id]);
							}
						 return querydata;
					}
				object.reset=function(){
					jQuery("#"+this.interface_id+" .cui_thumbnail").remove();
					object.attachments=new Array();
					object.thumbnail_ids=new Array();
					object.next_thumbnail_id=0;
				}
				return object;
			},
			
		 Featured_Functionality:function(object)
			  {
				object.inherited_upload_finished_with_success=object.upload_finished_with_success;
				object.upload_finished_with_success=function(params)
					{
						var tid=this.inherited_upload_finished_with_success(params);
						var thumbnail_id="thumbnail_"+tid;
						var jthis=this;
						if(jQuery("#"+this.interface_id+" .cui_thumbnail").length==1)
							{
							  jthis.set_featured(tid);
							}
						jQuery("#"+this.interface_id+" #"+thumbnail_id+" .feat_ref").click(function()
							{
							  jthis.set_featured(tid);
							});
					}
				object.set_featured=function(id)
					{
						this.featured=this.thumbnail_ids[id];
						var thumbnail_id="thumbnail_"+id;
					    jQuery("#"+this.interface_id+" .cui_thumbnail").css("border-color","white");
					    jQuery("#"+this.interface_id+" #"+thumbnail_id).css("border-color","gray");
						
					}
				object.inherited_remove=object.remove;
				object.remove=function(id)
				{
					this.inherited_remove(id);
					if(this.featured==this.thumbnail_ids[id])
						{
						  var i;
						  for(i=0;i<this.attachments.length;i++)
							{
							  if(this.attachments[i])
								{
								  var thumbnail_id=jQuery.inArray(this.attachments[i],this.thumbnail_ids);
								  this.set_featured(thumbnail_id);
								  break;
								}
							}
						}
				}
				object.inherited_serialize=object.serialize;
				object.serialize=function()
				  {
					return this.inherited_serialize()+"&featured="+(this.featured?this.featured:'');
				  }
				object.inherited_reset=object.reset;
				object.reset=function(){
					this.inherited_reset();
					this.featured=false;
				}
				return object;
			  },
		Degenerate_Into_Featured_Image_Uploader:function(object)
		{
		  object.inherited_inherited_upload_finished_with_success=object.upload_finished_with_success;
		  object.upload_finished_with_success=function(params)
			{
			  var i;
			  for(i=0;i<this.thumbnail_ids.length;i++)
			  {
				this.remove(i);
			  }
			  object.inherited_inherited_upload_finished_with_success(params);
			}
		  object.remove=function(id)
		  {
			var attach_id=this.featured;
			var uri=Cosmo_Uploader.template_directory_uri;
			this.attachments=new Array();
			this.thumbnail_ids=new Array();
		  	
			jQuery.ajax({
				url:uri+"/upload-server.php",
				type:"post",
				data:"action=delete&attach_id="+attach_id
			});
			jQuery("#"+this.interface_id+" .cui_thumbnail").remove();
		  }
		},
		Get_Floating_Uploader:function( button_selector , image_selector, hidden_input )
		{
			var j_image_selector=image_selector;
			var j_button_selector = button_selector;
			var j_hidden_input_selector=hidden_input;
			jQuery( button_selector ).mouseenter(function()
				{
					jQuery("#floating_uploader").css("top",jQuery( j_button_selector ).parents( 'form' ).position().top+"px");
					jQuery("#floating_uploader").css("left",jQuery( j_button_selector ).position().left+"px");
					jQuery("#floating_uploader").removeClass("hidden");
					window.floating_uploader.upload_finished_with_success=function(params)
					{
						jQuery(j_image_selector).attr("src",params["url"]);
						jQuery(j_hidden_input_selector).val(params["attach_id"]);
						this.hide_spinner();
					}
				}
			);
		}
	}    
	/* ================================================================================================================================================ */
    /* TABS                                                                                                                                     */
    /* ================================================================================================================================================ */

	
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(5($){$.2c({7:{2q:0}});$.1Z.7=5(f,2){3(x f==\'2D\')2=f;2=$.2c({f:(f&&x f==\'2l\'&&f>0)?--f:0,H:l,o:$.11?21:G,C:G,24:\'C-s-\',1R:l,1K:l,1O:l,1P:l,1D:\'34\',2n:l,2o:l,2e:G,10:l,T:l,X:l,1j:\'7-c\',y:\'7-2E\',U:\'7-H\',R:\'7-d\',14:\'7-1N\',1p:\'7-2G\',26:\'J\'},2||{});$.g.1d=$.g.1d||$.g.I&&x 2H==\'5\';5 1G(){25(0,0)}u 6.Q(5(){4 d=6;4 c=$(\'1e.\'+2.1j,d);c=c.L()&&c||$(\'>1e:t(0)\',d);4 7=$(\'a\',c);3(2.C){4 1J={};7.Q(5(){$(6).1Y(\'<r>\'+$(6).1Y()+\'</r>\');4 p=2.24+(++$.7.2q);4 8=\'#\'+p;1J[8]=6.1C;6.1C=8;$(\'<J p="\'+p+\'" 2I="\'+2.R+\'"></J>\').2i(d)})}4 q=$(\'J.\'+2.R,d);q=q.L()&&q||$(\'>\'+2.26,d);c.z(\'.\'+2.1j)||c.v(2.1j);q.Q(5(){4 $$=$(6);$$.z(\'.\'+2.R)||$$.v(2.R)});4 1B=$(\'9\',c).2J($(\'9.\'+2.y,c)[0]);3(1B>=0){2.f=1B}3(S.8){7.Q(5(i){3(6.8==S.8){2.f=i;3(($.g.I||$.g.2K)&&!2.C){4 j=$(S.8);4 1a=j.V(\'p\');j.V(\'p\',\'\');17(5(){j.V(\'p\',1a)},2M)}1G();u G}})}3($.g.I){1G()}q.1b(\':t(\'+2.f+\')\').1L().1h().2N(\':t(\'+2.f+\')\').v(2.14);3(!2.C){$(\'9\',c).Y(2.y).t(2.f).v(2.y)}3(2.2e){4 1F=5(29){4 1x=$.2O(q.18(),5(W){4 h,1z=$(W);3(29){3($.g.1d){W.N.2P(\'2d\');W.N.n=\'\';W.1i=l}h=1z.A({\'1n-n\':\'\'}).n()}m{h=1z.n()}u h}).2Q(5(a,b){u b-a});3($.g.1d){q.Q(5(){6.1i=1x[0]+\'2f\';6.N.2R(\'2d\',\'6.N.n = 6.1i ? 6.1i : "2S"\')})}m{q.A({\'1n-n\':1x[0]+\'2f\'})}};1F();4 1f=d.2k;4 1H=d.13;4 1E=$(\'#7-2g-2h-L\').18(0)||$(\'<r p="7-2g-2h-L">M</r>\').A({2j:\'2T\',2U:\'2V\',2W:\'2X\'}).2i(D.1u).18(0);4 1l=1E.13;2Y(5(){4 1k=d.2k;4 1I=d.13;4 1m=1E.13;3(1I>1H||1k!=1f||1m!=1l){1F((1k>1f||1m<1l));1f=1k;1H=1I;1l=1m}},1y)}4 P={},K={},1A=2.2n||2.1D,1v=2.2o||2.1D;3(2.1K||2.1R){3(2.1K){P[\'n\']=\'1L\';K[\'n\']=\'1N\'}3(2.1R){P[\'w\']=\'1L\';K[\'w\']=\'1N\'}}m{3(2.1O){P=2.1O}m{P[\'1n-1S\']=0;1A=2.o?1y:1}3(2.1P){K=2.1P}m{K[\'1n-1S\']=0;1v=2.o?1y:1}}4 10=2.10,T=2.T,X=2.X;7.15(\'2p\',5(){4 9=$(6.Z);3(d.12||9.z(\'.\'+2.y)||9.z(\'.\'+2.U)){u G}4 8=6.8;3($.g.I){$(6).E(\'O\');3(2.o){$.11.1t(8);S.8=8.1s(\'#\',\'\')}}m 3($.g.1r){4 1W=$(\'<22 2r="\'+8+\'"><J><2s 2t="1X" 2u="h" /></J></22>\').18(0);1W.1X();$(6).E(\'O\');3(2.o){$.11.1t(8)}}m{3(2.o){S.8=8.1s(\'#\',\'\')}m{$(6).E(\'O\')}}});7.15(\'1o\',5(){4 9=$(6.Z);3($.g.1r){9.1c({w:0},1,5(){9.A({w:\'\'})})}9.v(2.U)});3(2.H&&2.H.1q){1V(4 i=0,k=2.H.1q;i<k;i++){7.t(--2.H[i]).E(\'1o\').1h()}};7.15(\'1U\',5(){4 9=$(6.Z);9.Y(2.U);3($.g.1r){9.1c({w:1},1,5(){9.A({w:\'\'})})}});7.15(\'O\',5(e){4 1g=e.2z;4 F=6,9=$(6.Z),j=$(6.8),B=q.1b(\':2B\');3((x 10==\'5\'&&10(6,j[0],B[0])==G&&1g)||d.12||9.z(\'.\'+2.y)||9.z(\'.\'+2.U)){6.2a();u G}d[\'12\']=21;3(j.L()){3($.g.I&&2.o){4 1a=6.8.1s(\'#\',\'\');j.V(\'p\',\'\');17(5(){j.V(\'p\',1a)},0)}5 1M(){3(2.o&&1g){$.11.1t(F.8)}B.1c(K,1v,5(){$(F.Z).v(2.y).2F().Y(2.y);3(x T==\'5\'){T(F,j[0],B[0])}B.v(2.14).A({2j:\'\',2b:\'\',n:\'\',w:\'\'});j.Y(2.14).1c(P,1A,5(){j.A({2b:\'\',n:\'\',w:\'\'});3($.g.I){B[0].N.1b=\'\';j[0].N.1b=\'\'}3(x X==\'5\'){X(F,j[0],B[0])}d.12=l})})}3(!2.C){1M()}m{4 $$=$(6),r=$(\'r\',6)[0],1T=r.1Q;$$.v(2.1p);r.1Q=\'30&#32;\';17(5(){$(F.8).33(1J[F.8],5(){1M();r.1Q=1T;$$.Y(2.1p)})},0)}}m{2v(\'2w z 2x 2y d.\')}4 27=1w.2A||D.19&&D.19.20||D.1u.20||0;4 28=1w.2C||D.19&&D.19.23||D.1u.23||0;17(5(){1w.25(27,28)},0);6.2a();u 2.o&&!!1g});3(2.C){7.t(2.f).E(\'O\').1h()}3(2.o){$.11.2Z(5(){7.t(2.f).E(\'O\').1h()})}})};4 16=[\'2p\',\'1o\',\'1U\'];1V(4 i=0;i<16.1q;i++){$.1Z[16[i]]=(5(2m){u 5(s){u 6.Q(5(){4 c=$(\'1e.7-c\',6);c=c.L()&&c||$(\'>1e:t(0)\',6);4 a;3(!s||x s==\'2l\'){a=$(\'9>a\',c).t((s&&s>0&&s-1||0))}m 3(x s==\'2L\'){a=$(\'9>a[@1C$="#\'+s+\'"]\',c)}a.E(2m)})}})(16[i])}})(31);',62,191,'||settings|if|var|function|this|tabs|hash|li|||nav|container||initial|browser|||toShow||null|else|height|bookmarkable|id|containers|span|tab|eq|return|addClass|opacity|typeof|selectedClass|is|css|toHide|remote|document|trigger|clicked|false|disabled|msie|div|hideAnim|size||style|click|showAnim|each|containerClass|location|onHide|disabledClass|attr|el|onShow|removeClass|parentNode|onClick|ajaxHistory|locked|offsetHeight|hideClass|bind|tabEvents|setTimeout|get|documentElement|toShowId|filter|animate|msie6|ul|cachedWidth|trueClick|end|minHeight|navClass|currentWidth|cachedFontSize|currentFontSize|min|disableTab|loadingClass|length|safari|replace|update|body|hideSpeed|window|heights|50|jq|showSpeed|hasSelectedClass|href|fxSpeed|watchFontSize|_setAutoHeight|unFocus|cachedHeight|currentHeight|remoteUrls|fxSlide|show|switchTab|hide|fxShow|fxHide|innerHTML|fxFade|width|text|enableTab|for|tempForm|submit|html|fn|scrollLeft|true|form|scrollTop|hashPrefix|scrollTo|tabStruct|scrollX|scrollY|reset|blur|overflow|extend|behaviour|fxAutoHeight|px|watch|font|appendTo|display|offsetWidth|number|tabEvent|fxShowSpeed|fxHideSpeed|triggerTab|remoteCount|action|input|type|value|alert|There|no|such|clientX|pageXOffset|visible|pageYOffset|object|selected|siblings|loading|XMLHttpRequest|class|index|opera|string|500|not|map|removeExpression|sort|setExpression|1px|block|position|absolute|visibility|hidden|setInterval|initialize|Loading|jQuery|8230|load|normal'.split('|'),0,{}));

	/* ================================================================================================================================================ */
    /* MAP							                                                                                                                    */
    /* ================================================================================================================================================ */

    

	/* ================================================================================================================================================ */
    /* TRANSLATIONS                                                                                                                                     */
    /* ================================================================================================================================================ */





function __(msg){
	if(translations[msg]){
		return translations[msg];
	}else{
				return msg;
	}
}

var translations=Array();

translations["Uploading"]="Uploading";
translations["file"]="file";
translations["This may take a while"]="This may take a while";
translations["Click to set as featured"]="Click to set as featured";
translations["Remove"]="Remove";
translations["Are you sure?"]="Are you sure?";
translations["Downloading. Please wait."]="Downloading. Please wait.";
translations["Login successful"]="Login successful";
translations["Please select a parent post"]="Please select a parent post";

	/* ================================================================================================================================================ */
    /* Twitter widget                                                                                                                               */
    /* ================================================================================================================================================ */
/*
* Slides, A Slideshow Plugin for jQuery
* Intructions: http://slidesjs.com
* By: Nathan Searles, http://nathansearles.com
* Version: 1.1.8
* Updated: June 1st, 2011
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
(function(A){A.fn.slides=function(B){B=A.extend({},A.fn.slides.option,B);return this.each(function(){A("."+B.container,A(this)).children().wrapAll('<div class="slides_control"/>');var V=A(this),J=A(".slides_control",V),Z=J.children().size(),Q=J.children().outerWidth(),M=J.children().outerHeight(),D=B.start-1,L=B.effect.indexOf(",")<0?B.effect:B.effect.replace(" ","").split(",")[0],S=B.effect.indexOf(",")<0?L:B.effect.replace(" ","").split(",")[1],O=0,N=0,C=0,P=0,U,H,I,X,W,T,K,F;function E(c,b,a){if(!H&&U){H=true;B.animationStart(P+1);switch(c){case"next":N=P;O=P+1;O=Z===O?0:O;X=Q*2;c=-Q*2;P=O;break;case"prev":N=P;O=P-1;O=O===-1?Z-1:O;X=0;c=0;P=O;break;case"pagination":O=parseInt(a,10);N=A("."+B.paginationClass+" li."+B.currentClass+" a",V).attr("href").match("[^#/]+$");if(O>N){X=Q*2;c=-Q*2;}else{X=0;c=0;}P=O;break;}if(b==="fade"){if(B.crossfade){J.children(":eq("+O+")",V).css({zIndex:10}).fadeIn(B.fadeSpeed,B.fadeEasing,function(){if(B.autoHeight){J.animate({height:J.children(":eq("+O+")",V).outerHeight()},B.autoHeightSpeed,function(){J.children(":eq("+N+")",V).css({display:"none",zIndex:0});J.children(":eq("+O+")",V).css({zIndex:0});B.animationComplete(O+1);H=false;});}else{J.children(":eq("+N+")",V).css({display:"none",zIndex:0});J.children(":eq("+O+")",V).css({zIndex:0});B.animationComplete(O+1);H=false;}});}else{J.children(":eq("+N+")",V).fadeOut(B.fadeSpeed,B.fadeEasing,function(){if(B.autoHeight){J.animate({height:J.children(":eq("+O+")",V).outerHeight()},B.autoHeightSpeed,function(){J.children(":eq("+O+")",V).fadeIn(B.fadeSpeed,B.fadeEasing);});}else{J.children(":eq("+O+")",V).fadeIn(B.fadeSpeed,B.fadeEasing,function(){if(A.browser.msie){A(this).get(0).style.removeAttribute("filter");}});}B.animationComplete(O+1);H=false;});}}else{J.children(":eq("+O+")").css({left:X,display:"block"});if(B.autoHeight){J.animate({left:c,height:J.children(":eq("+O+")").outerHeight()},B.slideSpeed,B.slideEasing,function(){J.css({left:-Q});J.children(":eq("+O+")").css({left:Q,zIndex:5});J.children(":eq("+N+")").css({left:Q,display:"none",zIndex:0});B.animationComplete(O+1);H=false;});}else{J.animate({left:c},B.slideSpeed,B.slideEasing,function(){J.css({left:-Q});J.children(":eq("+O+")").css({left:Q,zIndex:5});J.children(":eq("+N+")").css({left:Q,display:"none",zIndex:0});B.animationComplete(O+1);H=false;});}}if(B.pagination){A("."+B.paginationClass+" li."+B.currentClass,V).removeClass(B.currentClass);A("."+B.paginationClass+" li:eq("+O+")",V).addClass(B.currentClass);}}}function R(){clearInterval(V.data("interval"));}function G(){if(B.pause){clearTimeout(V.data("pause"));clearInterval(V.data("interval"));K=setTimeout(function(){clearTimeout(V.data("pause"));F=setInterval(function(){E("next",L);},B.play);V.data("interval",F);},B.pause);V.data("pause",K);}else{R();}}if(Z<2){return ;}if(D<0){D=0;}if(D>Z){D=Z-1;}if(B.start){P=D;}if(B.randomize){J.randomize();}A("."+B.container,V).css({overflow:"hidden",position:"relative"});J.children().css({position:"absolute",top:0,left:J.children().outerWidth(),zIndex:0,display:"none"});J.css({position:"relative",width:(Q*3),height:M,left:-Q});A("."+B.container,V).css({display:"block"});if(B.autoHeight){J.children().css({height:"auto"});J.animate({height:J.children(":eq("+D+")").outerHeight()},B.autoHeightSpeed);}if(B.preload&&J.find("img:eq("+D+")").length){A("."+B.container,V).css({background:"url("+B.preloadImage+") no-repeat 50% 50%"});var Y=J.find("img:eq("+D+")").attr("src")+"?"+(new Date()).getTime();if(A("img",V).parent().attr("class")!="slides_control"){T=J.children(":eq(0)")[0].tagName.toLowerCase();}else{T=J.find("img:eq("+D+")");}J.find("img:eq("+D+")").attr("src",Y).load(function(){J.find(T+":eq("+D+")").fadeIn(B.fadeSpeed,B.fadeEasing,function(){A(this).css({zIndex:5});A("."+B.container,V).css({background:""});U=true;B.slidesLoaded();});});}else{J.children(":eq("+D+")").fadeIn(B.fadeSpeed,B.fadeEasing,function(){U=true;B.slidesLoaded();});}if(B.bigTarget){J.children().css({cursor:"pointer"});J.children().click(function(){E("next",L);return false;});}if(B.hoverPause&&B.play){J.bind("mouseover",function(){R();});J.bind("mouseleave",function(){G();});}if(B.generateNextPrev){A("."+B.container,V).after('<a href="#" class="'+B.prev+'">Prev</a>');A("."+B.prev,V).after('<a href="#" class="'+B.next+'">Next</a>');}A("."+B.next,V).click(function(a){a.preventDefault();if(B.play){G();}E("next",L);});A("."+B.prev,V).click(function(a){a.preventDefault();if(B.play){G();}E("prev",L);});if(B.generatePagination){if(B.prependPagination){V.prepend("<ul class="+B.paginationClass+"></ul>");}else{V.append("<ul class="+B.paginationClass+"></ul>");}J.children().each(function(){A("."+B.paginationClass,V).append('<li><a href="#'+C+'">'+(C+1)+"</a></li>");C++;});}else{A("."+B.paginationClass+" li a",V).each(function(){A(this).attr("href","#"+C);C++;});}A("."+B.paginationClass+" li:eq("+D+")",V).addClass(B.currentClass);A("."+B.paginationClass+" li a",V).click(function(){if(B.play){G();}I=A(this).attr("href").match("[^#/]+$");if(P!=I){E("pagination",S,I);}return false;});A("a.link",V).click(function(){if(B.play){G();}I=A(this).attr("href").match("[^#/]+$")-1;if(P!=I){E("pagination",S,I);}return false;});if(B.play){F=setInterval(function(){E("next",L);},B.play);V.data("interval",F);}});};A.fn.slides.option={preload:false,preloadImage:"/img/loading.gif",container:"slides_container",generateNextPrev:false,next:"next",prev:"prev",pagination:true,generatePagination:true,prependPagination:false,paginationClass:"pagination",currentClass:"current",fadeSpeed:350,fadeEasing:"",slideSpeed:350,slideEasing:"",start:1,effect:"slide",crossfade:false,randomize:false,play:0,pause:0,hoverPause:false,autoHeight:false,autoHeightSpeed:350,bigTarget:false,animationStart:function(){},animationComplete:function(){},slidesLoaded:function(){}};A.fn.randomize=function(C){function B(){return(Math.round(Math.random())-0.5);}return(A(this).each(function(){var F=A(this);var E=F.children();var D=E.length;if(D>1){E.hide();var G=[];for(i=0;i<D;i++){G[G.length]=i;}G=G.sort(B);A.each(G,function(I,H){var K=E.eq(H);var J=K.clone(true);J.show().appendTo(F);if(C!==undefined){C(K,J);}K.remove();});}}));};})(jQuery);	/* twitter widget */
	if (jQuery().slides) {
		jQuery(".dynamic .cosmo_twitter").slides({
			play: 5000,
			effect: 'fade',
			generatePagination: false,
			autoHeight: true
		});
	}
    
    /* ================================================================================================================================================ */
    /*  JQUERY SETTINGS                                                                                                                                 */
    /* ================================================================================================================================================ */
    
    jQuery(function(){
        
    });
    
    
   

