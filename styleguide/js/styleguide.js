(function(w){
	var sw = document.body.clientWidth,
		sh = document.body.clientHeight,
		bp = window.getComputedStyle(document.body,':after').getPropertyValue('content');
		$sgViewport = $('#sg-viewport'),
		$viewToggle = $('#sg-t-toggle'),
		$sizeToggle = $('#sg-size-toggle'),
		$tClean = $('#sg-t-clean'),
		$tAnnotations = $('#sg-t-annotations'),
		$tCode = $('#sg-t-code'),
		$tSidebar = $('#sg-t-sidebar'),
		$tFull = $('#sg-t-full'),
		$tSize = $('#sg-size'),
		$vp = Object,
		$sgPattern = Object,
		discoID = false,
		discoMode = false;
	
	
	$(w).resize(function(){ //Update dimensions on resize
		sw = document.body.clientWidth;
		sh = document.body.clientHeight;
		bp = window.getComputedStyle(document.body,':after').getPropertyValue('content');
		
		displayWidth();
	});

	$('.sg-nav-toggle').on("click", function(e){
		e.preventDefault();
		$('.sg-nav-container').toggleClass('active');
	});
	
	
	
	//View Trigger
	$viewToggle.on("click", function(e){
		e.preventDefault();
		$(this).parents('ul').toggleClass('active');
	});

	//Size Trigger
	$sizeToggle.on("click", function(e){
		e.preventDefault();
		$(this).parents('ul').toggleClass('active');
	});
	
	//Size View Events
	$('#sg-size-s').on("click", function(e){
		e.preventDefault();
		killDisco();
		sizeiframe(getRandom(320,500));
	});
	
	$('#sg-size-m').on("click", function(e){
		e.preventDefault();
		killDisco();
		sizeiframe(getRandom(500,800));
	});
	
	$('#sg-size-l').on("click", function(e){
		e.preventDefault();
		killDisco();
		sizeiframe(getRandom(800,1200));
	});
	
	$('#sg-size-xl').on("click", function(e){
		e.preventDefault();
		killDisco();
		sizeiframe(getRandom(1200,1920));
	});
	
	$('#sg-size-random').on("click", function(e){
		e.preventDefault();
		killDisco();
		sizeiframe(getRandom(240,sw));
	});
	
	$('#sg-size-disco').on("click", function(e){
		e.preventDefault();
		if (discoMode) {
			killDisco();
		} else {
			discoMode = true;
			discoID = setInterval(disco, 800);
		}
		
	});
	
	$('#sg-size-enter').submit(function(){
		var val = $('#sg-size-num').val();
		sizeiframe(val);
		return false;
	});


	$sgViewport.load(function (){
		var $sgSrc = $sgViewport.attr('src'),
			$vp = $sgViewport.contents(),
			$sgPattern = $vp.find('.sg-pattern');
		
		//Left Navigation Anchors
		$('.sg-nav a').not('.sg-acc-handle').on("click", function(e){
			var $thisHref = $(this).attr('href');
			//e.preventDefault();
		});

		//Clean View Trigger
		$tClean.on("click", function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$sgViewport.contents().hide();
			$vp.find('body').toggleClass('sg-clean');
			$vp.find('#intro, .sg-head, #about-sg').toggle();
			$vp.find('[role=main]').toggleClass('clean');
		});
		
		//Code View Trigger
		$tCode.on("click", function(e){
			var $code = $vp.find('.sg-code');
			e.preventDefault();
			$(this).toggleClass('active');
			
			if($vp.find('.sg-code').length==0) {
				buildCodeView();
			} else {
				$code.toggle();
			}
		});
		
		
		function buildCodeView() {
			$sgPattern.each(function(index) {
				$this = $(this),
				$thisHTML = $this.html().replace(/[<>]/g, function(m) { return {'<':'&lt;','>':'&gt;'}[m]}),
				$thisCode = $( '<code></code>' ).html($thisHTML);
				
				$('<pre class="sg-code" />').html($thisCode).appendTo($this);
			});
			$vp.find('.sg-code').show();
		}
		
		//Pattern Click
		$vp.find('.sg-head a').on("click", function(e){
			e.preventDefault();
			var thisHref = $(this).attr('href');
			window.location = thisHref;
		});
	});
	
	//Resize the viewport
	function sizeiframe(size) {
		$('#sg-viewport').width(size);
		updateSizeReading(size);
	}
	
	//Update Size Reading 
	var $sizePx = $('.sg-size-px');
	var $sizeEms = $('.sg-size-em');
	var $bodySize = parseInt($('body').css('font-size'));
	
	function displayWidth() {
		var vpWidth = $sgViewport.width();
		var emSize = vpWidth/$bodySize;
		$sizePx.text(vpWidth);
		$sizeEms.text(emSize.toFixed(2));
	}
	
	displayWidth();
	
	function updateSizeReading(size) {
		var emSize = size/$bodySize;
		$sizePx.text(Math.floor(size));
		$sizeEms.text(emSize.toFixed(2));
	}
	
	/* Disco Mode */
	function disco() {
		sizeiframe(getRandom(240,sw));
	}
	
	function killDisco() {
		discoMode = false;
		clearInterval(discoID);
		discoID = false;
	}
	
	
	/* Returns a random number between min and max */
	function getRandom (min, max) {
	    return Math.random() * (max - min) + min;
	}
	
	/* Accordion */
	$('.sg-acc-handle').on("click", function(e){
		var $this = $(this),
			$panel = $this.next('.sg-acc-panel');
		e.preventDefault();
		$this.toggleClass('active');
		$panel.toggleClass('active');
	});

	
	$('.sg-control-trigger').on("click", function(e){
			var $this = $(this),
				$thisParent = $this.parents('.sg-control-container');
			e.preventDefault();
			$thisParent.toggleClass('active');
			
		});
	
	
	/*  */
	
	
	/* load iframe */
	function loadIframe(iframeName, url) {
	    var $iframe = $('#' + iframeName);
	    if ( $iframe.length ) {
	        $iframe.attr('src',url);   
	        return false;
	    }
	    return true;
	}
	

})(this);