(function(w){

	var commentsActive = false,
		sw = document.documentElement.clientWidth,
		breakpoint = 650; 
	
	// $(document).ready(function() {
	// 	$('body').addClass('comments-ready').append('<div id="comment-link"><a href="#">Annotations: <strong>OFF</strong></a></div>').delegate('#comment-link', 'click', function(){
	// 		toggleComments();
	// 		return false;
	// 	});
		
	// 	commentContainerInit();
		
	// });
	
	function toggleComments() {
		if (!commentsActive) {
			commentsActive = true;
			// post message to child window
			document.getElementById('sg-viewport').contentWindow.postMessage("on","http://"+window.location.host);
			$('#comment-link strong').text('ON');
		} else {
			commentsActive = false;
			document.getElementById('sg-viewport').contentWindow.postMessage("off","http://"+window.location.host);
			$('#comment-link strong').text('OFF');
			slideComment(999);
		}
	};
	
	function commentContainerInit() {
			$('<div id="comment-container"></div>').html('<a href="#" id="close-comments">Close</a><h2 id="comment-title">Annotation Title</h2><div id="comment-text">Here is some comment text</div>').appendTo('body').css('bottom',-$(this).outerHeight());
			
			if(sw<breakpoint) {
				$('#comment-container').hide();
			} else {
				$('#comment-container').show();
			}
			
			$('body').delegate('#close-comments','click',function(e) {
				var commentHeight = $('#comment-container').outerHeight();
				slideComment(commentHeight);
				return false;
			});
	}
	
	function slideComment(pos) {
		$('#comment-container').show();
		if(sw>breakpoint) {
			$('#comment-container').css('bottom',-pos);
		} else {
			var offset = $('#comment-container').offset().top;
			$('html,body').animate({scrollTop: offset}, 500);
		}
	}
		
	
	function updateComment(el,title,msg) {
			var $container = $('#comment-container'),
				$title = $('#comment-title'),
				$text = $('#comment-text');
			$title.text(title);
			$text.html(msg);
			slideComment(0);
	}
	
	// watch the iframe source so that it can be sent back to everyone else.
	// based on the great MDN docs at https://developer.mozilla.org/en-US/docs/Web/API/window.postMessage
	function receiveIframeMessage(event) {

		// does the origin sending the message match the current host? if not dev/null the request
		if (event.origin !== "http://"+window.location.host) {
			return;
		}
		
		updateComment(event.data.el,event.data.title,event.data.comment);

	}
	window.addEventListener("message", receiveIframeMessage, false);
	
})(this);