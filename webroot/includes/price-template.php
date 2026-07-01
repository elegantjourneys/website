<?php
	if($tourDetail['tour_type']==2 || $tourDetail['tour_type']==4  || $tourDetail['tour_type']==5  || $tourDetail['tour_type']==7 || $tourDetail['tour_type']==8 || $tourDetail['tour_type']==9 || $tourDetail['tour_type']==11 || $tourDetail['tour_type']==12)
	{
?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Season Start Date<br /></th>
			<th>Season End Date<br /></th>
			<th>STANDARD<img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"></th>
			<th>DELUXE<img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"><img src="<?=WEBROOT?>img/tours/star.png"></th>
			<th>LUXURY (Opulent)</th>
		</tr>
	</thead>
	<tbody>
		<?php
			
			foreach($tourPriceList2 as $tourPrice2)
			{
	    ?>
		<tr>
			<td><?=$tourPrice2['start_date']?></td>
			<td><?=$tourPrice2['end_date']?></td>
			<?php
				$discountInfo = array();
				$discountInfo = array(
										'offer'=>$tourDetail['offer'],
										'profit'=>$tourDetail['profit'],
										'price'=>$tourPrice2['star3'],
										'currencyRate'=>$currencyRate
								);
				
				$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
			?>
			<td>
				<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
				<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
			</td>
			<?php
				$discountInfo = array();
				$discountInfo = array(
										'offer'=>$tourDetail['offer'],
										'profit'=>$tourDetail['profit'],
										'price'=>$tourPrice2['star4'],
										'currencyRate'=>$currencyRate
								);
				
				$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
			?>
			<td>
				<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
				<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
			</td>
			<?php
				
				$discountInfo = array();
				$discountInfo = array(
										'offer'=>$tourDetail['offer'],
										'profit'=>$tourDetail['profit'],
										'price'=>$tourPrice2['star5'],
										'currencyRate'=>$currencyRate
								);
				
				$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
			?>
			<td>
				<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
				<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
			</td>
		</tr>
		<?php
			}
		?>
		        	 						
	</tbody>
</table>
<?php
	}
?>

<?php
	if($tourDetail['tour_type']==3 ||  $tourDetail['tour_type']==6  ||  $tourDetail['tour_type']==10)
	{
?>
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Season Start Date<br /></th>
				<th>Season End Date<br /></th>
				<th>Double/Twin<br />Share</th>
				<th>Solo<br />Traveller</th>
			</tr>
		</thead>
		<tbody>
		<?php
			
			foreach($tourPriceList2 as $tourPrice2)
			{
	    ?>
		<tr>
			<td><?=$tourPrice2['start_date']?></td>
			<td><?=$tourPrice2['end_date']?></td>
			<?php
				$discountInfo = array();
				$discountInfo = array(
										'offer'=>$tourDetail['offer'],
										'profit'=>$tourDetail['profit'],
										'price'=>$tourPrice2['star3'],
										'currencyRate'=>$currencyRate
								);
				
				$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
			?>
			<td>
				<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
				<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
			</td>
			<?php
				$discountInfo = array();
				$discountInfo = array(
										'offer'=>$tourDetail['offer'],
										'profit'=>$tourDetail['profit'],
										'price'=>$tourPrice2['star4'],
										'currencyRate'=>$currencyRate
								);
				
				$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
			?>
			<td>
				<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
				<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
			</td>
			
		</tr>
		<?php
			}
		?>
		        	 						
		</tbody>
	</table>


<?php
	}
?>

<?php
	if($tourDetail['tour_type']==1)
	{
		
?>

		<table class="table table-hover">
		<thead>
			<tr>
				<th>Season Start Date<br /></th>
				<th>
					Double/Twin<br />
					sharing price
				</th>
				<th>
					Single Room<br />
					Supplemen
				</th>
				<th>
					Single Room
					
				</th>
			</tr>
		</thead>

		<tbody>
		<?php
			
			foreach($tourPriceList1 as $tourPrice1)
			{
	    ?>
			<tr>
				<td><?=$tourPrice1['start_date']?></td>
				<?php
					$discountInfo = array();
					$discountInfo = array(
											'offer'=>$tourDetail['offer'],
											'profit'=>$tourDetail['profit'],
											'price'=>$tourPrice1['star3'],
											'currencyRate'=>$currencyRate
									);
					
					$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
				?>
				<td>
					<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
					<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
				</td>
				<?php
					$discountInfo = array();
					$discountInfo = array(
											'offer'=>$tourDetail['offer'],
											'profit'=>$tourDetail['profit'],
											'price'=>$tourPrice1['star4'],
											'currencyRate'=>$currencyRate
									);
					
					$tourPriceInfo =$objTourPrice->getPriceDetail($discountInfo);
				?>
				<td>
					<?=$currencySymbol?><?=$tourPriceInfo['displayPrice']?>  
					<span class="line-over"><?=$currencySymbol?><?=$tourPriceInfo['profitPrice']?></span>
				</td>
				
				<td>
					<?php 
						if($tourPrice1['status']==0)
							  echo "<strong>SOLD OUT</strong>";
						else
							  echo "Available";
					  ?>
				</td>
			</tr>
			<?php
				}
			?>
												
		</tbody>
		</table>
<?php
	}
?>