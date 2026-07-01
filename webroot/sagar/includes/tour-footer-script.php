<!-- jquery library -->
	<script src="<?=WEBROOT?>vendors/jquery/jquery-2.1.4.min.js"></script>
	<!-- external scripts -->
	<script src="<?=WEBROOT?>vendors/bootstrap/javascripts/bootstrap.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jquery-placeholder/jquery.placeholder.min.js"></script>
	<script src="<?=WEBROOT?>vendors/match-height/jquery.matchHeight.js"></script>
	<script src="<?=WEBROOT?>vendors/wow/wow.min.js"></script>
	<script src="<?=WEBROOT?>vendors/stellar/jquery.stellar.min.js"></script>
	<script src="<?=WEBROOT?>vendors/validate/jquery.validate.js"></script>
	<script src="<?=WEBROOT?>vendors/waypoint/waypoints.min.js"></script>
	<script src="<?=WEBROOT?>vendors/counter-up/jquery.counterup.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jQuery-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?=WEBROOT?>vendors/fancybox/jquery.fancybox.js"></script>
	<link media="all" rel="stylesheet" href="<?=WEBROOT?>vendors/fancybox/jquery.fancybox.css">
	<script src="<?=WEBROOT?>vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.js"></script>
	<script src="<?=WEBROOT?>vendors/jcf/js/jcf.select.js"></script>
	<script src="<?=WEBROOT?>js/mailchimp.js"></script>
	<script src="<?=WEBROOT?>vendors/retina/retina.min.js"></script>
	<script src="<?=WEBROOT?>vendors/sticky-kit/sticky-kit.js"></script>
	<script src="<?=WEBROOT?>js/sticky-kit-init.js"></script>
	<script src="<?=WEBROOT?>vendors/bootstrap-datetimepicker-master/dist/js/bootstrap-datepicker.js"></script>
	<!-- custom jquery script -->
	<script src="<?=WEBROOT?>js/jquery.main.js"></script>
	<script src="<?=WEBROOT?>js/jquery.bxslider.js"></script>
	<!---SLIDER-->
	<script>
		$(document).ready(function(){
		  $('.bxslider').bxSlider();


		  /*$(window).click(function (event) {
				var scroll = $(window).scrollTop();
				alert(scroll);
			});*/
		});
	</script>
	<script>
		$(document).ready(function(){
		  $('.bxslidertwo').bxSlider();
		});
	</script>
	<!-- revolution slider plugin -->
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
	<!-- rs5.0 core files -->
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script type="text/javascript" src="<?=WEBROOT?>vendors/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<!-- revolutions slider script -->
	<script src="<?=WEBROOT?>js/revolution.js"></script>
	<!-- fancybox css -->
	
	<script>

		(function($) {
		 "use strict"
		 
		 // Accordion Toggle Items
		   var iconOpen = 'fa fa-minus',
		        iconClose = 'fa fa-plus';

		    $(document).on('show.bs.collapse hide.bs.collapse', '.accordion', function (e) {
		        var $target = $(e.target)
		          $target.siblings('.accordion-heading')
		          .find('em').toggleClass(iconOpen + ' ' + iconClose);
		          if(e.type == 'show')
		              $target.prev('.accordion-heading').find('.accordion-toggle').addClass('active');
		          if(e.type == 'hide')
		              $(this).find('.accordion-toggle').not($target).removeClass('active');
		    });
		    
		})(jQuery);
	</script>
	<script>
		$(document).ready(function() {
	    // Configure/customize these variables.
	    var showChar = 00;  // How many characters are shown by default
	    var ellipsestext = "...";
	    var moretext = "VIEW FULL ITINERY";
	    var lesstext = "HIDE ITINERY";
	    

	    $('.more').each(function() {
	        var content = $(this).html();
	 
	        if(content.length > showChar) {
	 
	            var c = content.substr(0, showChar);
	            var h = content.substr(showChar, content.length - showChar);
	 
	            var html = c + '<span class="moreellipses" id="itineraryText">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + ''+'</span>&nbsp;&nbsp; <a href="" class="morelink">' + moretext + '</a></span>';
	 
	            $(this).html(html);
	        }
	 
	    });
	 
	    $(".morelink").click(function(){
	        if($(this).hasClass("less")) {
	            $(this).removeClass("less");
	            $(this).html(moretext);
	        } else {
	            $(this).addClass("less");
	            $(this).html(lesstext);
	        }
	        $(this).parent().prev().toggle();
	        $(this).prev().toggle();
	        return false;
	    });
	});
	</script>
	  <script src="<?=WEBROOT?>js/readmore.js"></script>

	  <script>
	    $('#info').readmore({
	      moreLink: '<a href="#">Usage, examples, and options</a>',
	      collapsedHeight: 384,
	      afterToggle: function(trigger, element, expanded) {
	        if(! expanded) { // The "Close" link was clicked
	          $('html, body').animate({scrollTop: element.offset().top}, {duration: 100});
	        }
	      }
	    });

	    $('article').readmore({speed: 500});
	  </script>
	<script type="text/javascript">
	$(document).ready(function () {
	    $('.same-pagelinking li a').click(function(e) {
              
	        $('.same-pagelinking li a').removeClass('active');
	        //$('.itinery, .dates-prices, .hotls-s').addClass('padding-top-for-nav');

	        var $this = $(this);
	        if (!$this.hasClass('active')) {
	            $this.addClass('active');
	             $this.removeClass('padding-top-for-nav');
	        }
	        //e.preventDefault();
	    });
	});
	</script>
		<script type="text/javascript">
		$(document).ready(function () {
		    $('#itineryone').click(function(e) {
	              
		       
		        $('.itinery').addClass('padding-top-for-nav');
                $('.dates-prices').removeClass('padding-top-for-nav');
                $('.hotls-s').removeClass('padding-top-for-nav');
    
		    });
		});
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		    $('#hotelsthree').click(function(e) {
	              
		       
		         $('.hotls-s').addClass('padding-top-for-nav');
		        $('.itinery').removeClass('padding-top-for-nav');
                $('.dates-prices').removeClass('padding-top-for-nav');



		    });
		});
		</script>
		<script type="text/javascript">
		$(document).ready(function () {
		    $('#datedtwo').click(function(e) {
	              
		        $('.hotls-s').removeClass('padding-top-for-nav');
		        $('.itinery').removeClass('padding-top-for-nav');
                $('.dates-prices').addClass('padding-top-for-nav');


		    });



			$(".various").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: false,
				width		: '90%',
				height		: '90%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});


		});
		</script>
	<script>
	$(function() {
	    var header = $(".fixed");
	    $(window).scroll(function() {    
	        var scroll = $(window).scrollTop();

	        if (scroll >= 178) {
	            header.addClass('fixed-tab');
	        } else{
	        	 header.removeClass('fixed-tab');
	        }

	    });
	});

</script>