<script type='text/javascript'>
function add_check(){
	if (!$('#add_number').val()){$('#add_number').focus(); return false;}
	if (!$('#add_fare').val()){$('#add_fare').focus(); return false;}
	if (!$('#add_route').val()){$('#add_route').focus(); return false;}
	if (!$('#add_plane').val()){$('#add_plane').focus(); return false;}


	return true;
}

function edit_check(){
	if (!$('#edit_number').val()){$('#edit_number').focus(); return false;}
	if (!$('#edit_fare').val()){$('#edit_fare').focus(); return false;}
	if (!$('#edit_route').val()){$('#edit_route').focus(); return false;}
	if (!$('#edit_plane').val()){$('#edit_plane').focus(); return false;}

	return true;
}


function edit(id, name, code, city){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_name').val(name);	
		$('#edit_code').val(code);	
		$('#edit_city').val(city);
		$('#edit_name').focus();		
	});
}
</script>

<h2>Manage Airports</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>ID</td>
		<td width='10%'>Code</td>
		<td width='30%'>Name</td>
		<td width='20%'>City</td>
		<td width='30%'>Operation</td>		
	</tr>	
<?php 
foreach($results as $result){?>
	<tr>
		<td width='10%'><?=$result['id']?></td>
		<td width='10%'><?=$result['code']?></td>
		<td width='30%'><?=$result['name']?></td>
		<td width='20%'><?=$result['city']?></td>
		<td width='50%'>
			<a href='javascript://'
			onclick="edit('<?=$result['id']?>',
			'<?=$result['name']?>',
			'<?=$result['code']?>',
			'<?=$result['city_id']?>'
			)">[modify]</a>
			<a href='?action=delete&id=<?=$result['id']?>'>[remove]</a>
		</td>
	</tr>
<?php }?>
</table>


<div id='create'>
	<form method='post' action='?action=new' onsubmit='return add_check();'>
		<fieldset>
			<legend>New Flight</legend>
			<div class='line'>
				<div class='label'>Flight Number</div>
				<div class='field'>
					<input type='text' name='number' id='add_number' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Route</div>
				<div class='field'>
					<select name='route' id='add_route'>
						<?php foreach($routes as $route){?>
							<option value='<?=$route['id']?>'><?=$route['route_name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Airplane</div>
				<div class='field'>
					<select name='plane' id='add_plane'>
						<?php foreach($planes as $plane){?>
							<option value='<?=$plane['id']?>'><?=$plane['name']?> (<?=$plane['model']?> <?=$plane['capacity']?>)</option>
						<?php }?>
					</select>
				</div>
			</div>

			<div class='line'>
				<div class='label'>Flight Date </div>
				<div class='field'>
					<select name='month' id='add_month'>
					<?php for($i=1;$i<=12;$i++){
						echo "<option ";
						if(intval(date("m")==$i)) echo "selected='selected' ";
						echo "value='$i'>".date("M", mktime(0,0,0,$i))."</option>\n";}?>
					</select> / 
					<select name='day' id='add_day'>
					<?php for($i=1;$i<=31;$i++){
						echo "<option ";
						if(intval(date("d"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select> /
					<select name='year' id='add_year'>
					<?php for($i=intval(date("Y"));$i>1990;$i--){
						echo "<option ";
						if(intval(date("Y"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>
					
					<select name='hour' id='add_hour'>
					<?php for($i=0;$i<24;$i++){
						echo "<option ";
						if(intval(date("H"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>:
					
					<select name='minute' id='add_minute'>
					<?php for($i=0;$i<60;$i++){
						echo "<option ";
						if(intval(date("i"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Fare ($)</div>
				<div class='field'>
					<input type='text' name='fare' id='add_fare' value=''/>
				</div>
			</div>
		
			<div class='line'>
				<div class='label'>Captain Pilot</div>
				<div class='field'>
					<select name='cpt' id='add_cpt'>
						<?php foreach($pilots as $pilot){?>
							<option value='<?=$pilot['id']?>'><?=$pilot['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Asst. Pilot</div>
				<div class='field'>
					<select name='asst' id='add_asst'>
						<?php foreach($pilots as $pilot){?>
							<option value='<?=$pilot['id']?>'><?=$pilot['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>	
			
			
			<div class='line'>
				<div class='label'>Hostess</div>
				<div class='field'>
					<select name='host' id='add_host'>
						<?php foreach($hostess as $h){?>
							<option value='<?=$h['id']?>'><?=$h['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>&nbsp;</div>
				<div class='field'><input type='submit' value='Create &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>