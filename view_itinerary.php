<fieldset>
	<legend>Travel itinerary</legend>
	<p>Please print out this sheet as travel pass.</p>
	<div class='line'>
		<div class='label'>Customer</div>
		<div class='field'>
			<?=$customer_name?>
		</div>
	</div>
	<div class='line'>
		<div class='label'>Seat</div>
		<div class='field'>
			<?=$seat?>
		</div>
	</div>
	<div class='line'>
		<div class='label'>Flight</div>
		<div class='field'>
			<?=$flight_route?>
		</div>
	</div>
	<div class='line'>
		<div class='label'>Departure Date</div>
		<div class='field'>
			<?=date("M d Y, H:ia",strtotime($flight_date))?>
		</div>
	</div>
	
	<div class='line'>
		<div class='label'>Luggage</div>
		<div class='field'>
			<?php foreach($lugs as $l){
				echo "$l kg.<br />";
			}
			if(count($lugs)<1){
				echo 'No luggage checked in.';
			}?>
		</div>
	</div>
			
	<div class='line'>
		<div class='label'><input type='button' value='&laquo; Check-in screen' onclick='window.location="index.php"'/></div>
		<div class='field'><input type='button' value='Print ticket &raquo;'/></div>			
	</div>
</fieldset>