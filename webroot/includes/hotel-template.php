<h1 id="hotels" class="hotls-s">HOTELS</h1> 
<?php
	foreach($hotelInformation as $key=>$hotels)
	{
		switch($key)
		{
			case 'four_star':
					$hotelTitle='STANDARD HOTELS (4 Star)';
				break;
			case 'five_star':
					$hotelTitle='DELUXE HOTELS (5 Star)';
				break;
			case 'best_available':
					$hotelTitle='LUXURY HOTELS (Best Available)';
				break;
		}

?>
<div class="hotles-main">
	<div class="sub-heading"><?=$hotelTitle?> <img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"> </div>

	<?php
		foreach($hotels as $hotel)
		{
	?>
		<div class="standard-hotles">
			<div class="hotles-l"><img src="<?=WEBROOT?>img/tours/location.png"> <?=$hotel['location']?></div>
			<div class="hotles-r">
			<img src="<?=WEBROOT?>img/tours/place.png">
				<ul>
					<?php
						$hotelList = array();
						$hotelList = explode('|',$hotel['primaryHotelName']);
						foreach($hotelList as $hotelName)
						{
					?>
					<li><?=$hotelName?> </li>
					<?php
						}
					?>
			  </ul>
			</div>
		</div> <div class="clearfix"></div>
	<?php
		}
	?>

</div> 
<hr />
<?php
		}
?>
