<script type='text/javascript'>
function check(){
	if (!$('#name').val()){
		$('#name').focus();
		return false;
	}
	if (!$('#ccn').val()){
		$('#ccn').focus();
		return false;
	}
	if (!$('#cvc').val()){
		$('#cvc').focus();
		return false;
	}
	return true;
}
</script>
<form method='POST' action='checkout.php' onsubmit='return check();'>
<input type='hidden' name='flight_id' id='flight_id' value='<?=$result['id']?>'/>
<fieldset>
<legend>Book and Buy the ticket</legend>
<div class='line'>
	<div class='label'>Flight number</div>
	<div class='field'><?=$result['flight_number']?>
	</div>
</div>

<div class='line'>
	<div class='label'>From</div>
	<div class='field'><?=$result['departure']?> (<?=$result['dcode']?>)
	</div>
</div>


<div class='line'>
	<div class='label'>To</div>
	<div class='field'><?=$result['arrival']?> (<?=$result['acode']?>)
	</div>
</div>

<div class='line'>
	<div class='label'>Departure Time</div>
	<div class='field'><?=date("M d, Y H:ia", strtotime($result['departure_date']))?>
	</div>
</div>

<div class='line'>
	<div class='label'>Travel Time</div>
	<div class='field'><?=$result['duration']?> minutes
	</div>
</div>

<div class='line'>
	<div class='label'>Landing Time</div>
	<div class='field'><?=date("M d, Y H:ia",strtotime($result['departure_date'])+60*intval($result['duration']))?> 
	</div>
</div>

<div class='line'>
	<div class='label'>Fare</div>
	<div class='field'>$<?=number_format($result['fare'])?> <small>(incl. VAT)</small>
	</div>
</div>

<div class='line'>
	<div class='label'>Plane</div>
	<div class='field'><?=$result['plane_name']?> (<?=$result['plane_model']?>) Capacity:<?=$result['plane_capacity']?>
	</div>
</div>

<div class='line'>
	<div class='label'>Available Seats</div>
	<div class='field'>
		<select id='seat' name='seat'>
			<?php for($i=1; $i<=intval($result['plane_capacity']); $i++){
				if (array_search($i, $seats)===FALSE){?>
				<option value='<?=$i?>'><?=$i?></option>
			<?}}?>
		</select>
	</div>
</div>
</fieldset>


<fieldset>
<legend>Credit Card Holder's Information</legend>
	<div class='line'>
		<div class='label'>Name on the card</div>
		<div class='field'>
			<input type='text' name='name' id='name'/>
		</div>
	</div>
	<div class='line'>
		<div class='label'>Credit card number</div>
		<div class='field'>
			<input type='text' name='ccn' id='ccn'/>
		</div>
	</div>
	<div class='line'>
		<div class='label'>Security Number (CVC)</div>
		<div class='field'>
			<input type='text' name='cvc' id='cvc' size=10/>
		</div>
	</div>

	<div class='line'>
		<div class='label'>Charge</div>
		<div class='field'>$<?=number_format($result['fare'])?>
		<input type='hidden' name='amount' id='amount' value='<?=$result['fare']?>'/>
		</div>
	</div>
	<div class='line'>
		<div class='label'>&nbsp;</div>
		<div class='field'><input type='submit' value='Checkout &raquo;'/></div>			
	</div>
</fieldset>
<form>