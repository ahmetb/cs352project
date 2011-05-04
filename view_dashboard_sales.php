

<h2>Sales Operations</h2>
<?php

// Query routes.
$flights = array();
$sql = "SELECT id, flight_number from flight;";

$results_query = mysql_query($sql, $mysql) or die(mysql_error());
while ($row = mysql_fetch_assoc($results_query)) {
	$flights[] = $row;
}
?>
<script type='text/javascript'>
function add(){
	var field = "<div class='line'><div class='label'>&nbsp;</div><div class='field'><input type='text' name='luggage[]'  noremember='noremember'/> kg.</div></div>";
	$('#more').append(field);
}

function check(){
	if (!$('#seat').val()){
		$('#seat').focus();
		return false;
	}
	return true;
}
</script>

<fieldset>
	<legend>Check-in passengers</legend>
	<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

	<form method='post' action='checkin.php' onsubmit='return check()'>
		<div class='line'>
			<div class='label'>Flight Number</div>
			<div class='field'>
				<select id='flight_id' name='flight_id'>
				<?php foreach($flights as $result){?>
					<option
					<?php if($_POST['flight_id']==$result['id']) echo ' selected="selected" ';?>
					 value='<?=$result['id']?>'><?=$result['flight_number']?></option>
				<?php }?>
				</select>
			</div>
		</div>
		<div class='line'>
			<div class='label'>Seat number</div>
			<div class='field'>
				<input type='text' name='seat' id='seat' noremember='noremember' value='<?=$_POST['seat']?>'/>
			</div>
		</div>

		<div class='line'>
			<div class='label'>Luggage</div>
			<div class='field'>
				<input type='text' name='luggage[]' noremember='noremember'/> kg.
			</div>
		</div>
		<div class='line'>
			<div class='label'>&nbsp;</div>
			<div class='field'>
				<input type='text' name='luggage[]' noremember='noremember'/> kg.
			</div>
		</div>

		<div id='more'>
		</div>
		<div class='line'>
			<div class='label'>
				<input type='button' value='+ Add luggage' onclick='add()'/>
			</div>
			<div class='field'>
				<input type='submit' value='Check-in &raquo;'/>
			</div>			
		</div>
	</form>
</fieldset>
	