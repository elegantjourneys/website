<?php
	include_once(BASEPATH_CLASS."website-section-class.php");
	$objWebsiteSection = new WebsiteSection();

?>
<!-- <br> -->

<footer id="footer">

			<section class="content-block footer-top-section">
				<div class="container">
					<div class="row footer-pad-bottom">
						<div class="col-lg-3">
							<h3>Golden Triangle Tour</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>north-india/7-day-golden-triangle-tour">7 Day Golden Triangle</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-golden-triangle-tour">8 Day GT + Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/Mystical-India-41">9 Day GT + Jodhpur, Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/5-day-golden-triangle-gt54">5 Day Golden Triangle - EXPRESS</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-3">
							<h3>Luxury Private Offers</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>luxury-tours/7-day-oberoi-golden-triangle-ob-59">7 Day Oberoi Golden Triangle</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/8-day-golden-triangle-with-udaipur-ob-60">8 Day Oberoi GT + Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/8-day-golden-triangle-tour-with-tiger-ob-61">8 Day Oberoi GT + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>luxury-tours/10-day-golden-triange-with-udaipur-ob-62">10 Day Oberoi GT + Tigers & Udaipur</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-3">
							<h3>Rajsthan Tour</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>north-india/13-day-rajsthan-tour-with-tigers-gt-155">13 Day Rajasthan Tour + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/10-day-rajsthan-tiger-rj-156">10 Day Rajasthan + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/11-day-rajsthan-tigers-rj-157">11 Day Rajasthan + Tigers</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/8-day-rajsthan-tour-and-udaipur-rj-172">8 Day Rajasthan Tour + Udaipur</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-3">
							<h3>Other Popular Tours</h3>
							<ul class="">
								<li>
									<a href="<?=WEBROOT?>north-india/12-day-north-india-tour-with-udaipur-nv-47">12 Day North India Tour + Udaipur</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/14-day-north-india-and-kerala-tour-nv-76">14 Day North India Tour + Kerala</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/3-day-varansai-tour-ex-95">3 Day Varanasi Extension</a>
								</li>
								<li>
									<a href="<?=WEBROOT?>north-india/14-day-north-india-and-kerala-tour-nv-76">14 Day North India Tour + Kerala</a>
								</li>
							</ul>
						</div>
						
					</div>	
					<div class="row">
						<div class="col-md-12">
							<h3 class="tags-heading"></h3>
						</div>
					</div>
				</div>
			
			</section>
			<div class="container">
				<!-- newsletter form -->
				<!--<form action="php/subscribe.html" id="signup" method="post" class="newsletter-form">
					<fieldset>
						<div class="input-holder">
							<input type="email" class="form-control" placeholder="Email Address" name="subscriber_email" id="subscriber_email">
							<input type="submit" value="GO">
						</div>
						<span class="info" id="subscribe_message">To receive news, updates and tour packages via email.</span>
					</fieldset>
				</form>-->
				<!-- footer links -->
				<div class="row footer-holder">
					<?=$objWebsiteSection->getWebsiteSectionByCode('footer_link')?>
				</div>


				<?php
					/*

				<!-- social wrap -->
				<ul class="social-wrap">
					<li class="facebook"><a href="https://www.facebook.com/elegantjourneys">
						<span class="icon-facebook"></span>
						<strong class="txt">Like Us</strong>
					</a></li>
					<li class="twitter"><a href="https://twitter.com/elegantjourney">
						<span class="icon-twitter"></span>
						<strong class="txt">Follow On</strong>
					</a></li>
					<li class="google-plus"><a href="https://plus.google.com/+ElegantjourneysCo">
						<span class="icon-google-plus"></span>
						<strong class="txt">+1 On Google</strong>
					</a></li>
					<li class="vimeo"><a href="#">
						<span class="icon-vimeo"></span>
						<strong class="txt">Share At</strong>
					</a></li>
					<li class="pin"><a href="#">
						<span class="icon-pin"></span>
						<strong class="txt">Pin It</strong>
					</a></li>
					<li class="dribble"><a href="#">
						<span class="icon-dribble"></span>
						<strong class="txt">Dribbble</strong>
					</a></li>
				</ul>

					*/
				?>

				<div class="col-lg-12 footer-nav tags-wrap">
					<br><br>
					<h3 class="tags-heading">Popular Tags123</h3>
					<ul>
						<li><a href="" class="tags">India Tours</a></li>
						<li><a href="" class="tags">Rajasthan Tours</a></li>
						<li><a href="" class="tags">Kerala Tours</a></li>
						<li><a href="" class="tags">Rajasthan Tour Packages</a></li>
						<li><a href="" class="tags">Incredible India</a></li>
						<li><a href="" class="tags">Golden Triangle Tours</a></li>
						<li><a href="" class="tags">Golden Triangle Tour from Delhi</a></li>
						<li><a href="" class="tags">Golden Triangle with Varanasi</a></li>
						<li><a href="" class="tags">Holiday Packages India</a></li>
						<li><a href="" class="tags">Luxury Travel India</a></li>
						<li><a href="" class="tags">North India Tour Packages</a></li>
						
					</ul>


				</div>

			</div>
			<div class="footer-bottom">
				<div class="container">
					
					<div class="row">
						<div class="col-lg-6">
								<ul class="payment-option">
								<li>
									<a target="_blank" href="https://www.facebook.com/elegantjourneys/">
										<i data-toggle="tooltip" class="fa fa-facebook fa-2x">
										</i>
									</a>
								</li>
							
								
							
								<li>
									<a target="_blank" href="#">
										<i data-toggle="tooltip" class="fa fa-twitter fa-2x">
										</i>
									</a>
								</li>
							
								<li>
									<a target="_blank" href="https://www.instagram.com/incredibleindia">
										<i data-toggle="tooltip" class="fa fa-instagram fa-2x">
										</i>
									</a>
								</li>
							</ul>
						</div>
						<div class="col-lg-6">
							<ul class="payment-option">
								<li> </li>
							</ul>
						</div>
					</div>



					<div class="row">
						<div class="col-lg-6">
							<!-- copyright -->
							<strong class="copyright"><i class="fa fa-copyright"></i> Copyright <?=date("Y")?> -  Elegant Journeys   <a href="#"> </a></strong>
						</div>
						<div class="col-lg-6">
							<ul class="payment-option">
								<li>
									<img src="<?=WEBROOT?>img/footer/visa.png" alt="visa" height="20" width="33" alt="visa card">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/mastercard.png" height="20" width="33" alt="master card">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/paypal.png" height="20" width="72" alt="paypal">
								</li>
								<li>
									<img src="<?=WEBROOT?>img/footer/maestro.png" height="20" width="33" alt="maestro">
								</li>
								<!--<li>
									<img src="<?=WEBROOT?>img/footer/bank-transfer.png" height="20" width="55" alt="bank transfer">
								</li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<script id='_webengage_script_tag' type='text/javascript'>
			var webengage;!function(w,e,b,n,g){function o(e,t){e[t[t.length-1]]=function(){r.__queue.push([t.join("."),
			arguments])}}var i,s,r=w[b],z=" ",l="init options track screen onReady".split(z),a="feedback survey notification".split(z),c="options render clear abort".split(z),p="Open Close Submit Complete View Click".split(z),u="identify login logout setAttribute".split(z);if(!r||!r.__v){for(w[b]=r={__queue:[],__v:"6.0",user:{}},i=0;i < l.length;i++)o(r,[l[i]]);for(i=0;i < a.length;i++){for(r[a[i]]={},s=0;s < c.length;s++)o(r[a[i]],[a[i],c[s]]);for(s=0;s < p.length;s++)o(r[a[i]],[a[i],"on"+p[s]])}for(i=0;i < u.length;i++)o(r.user,["user",u[i]]);setTimeout(function(){var f=e.createElement("script"),d=e.getElementById("_webengage_script_tag");f.type="text/javascript",f.async=!0,f.src=("https:"==e.location.protocol?"https://ssl.widgets.webengage.com":"http://cdn.widgets.webengage.com")+"/js/webengage-min-v-6.0.js",d.parentNode.insertBefore(f,d)})}}(window,document,"webengage");webengage.init("826181aa");
		</script>


		<!--Start of Zendesk Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="https://v2.zopim.com/?Wu2MB2SErhIq3wwFNtS7Ycszh3a3fJzr";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		</script>
		<!--End of Zendesk Chat Script-->