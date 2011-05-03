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


function edit(id, number,fare, y,m,d,h,i, route,plane,cpt,asst,host){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_number').val(number);	
		$('#edit_fare').val(fare);	
		$('#edit_route').val(route);	
		$('#edit_plane').val(plane);
		$('#edit_year').val((y));
		$('#edit_month').val((m));
		$('#edit_day').val((d));
		$('#edit_hour').val(h);
		$('#edit_minute').val(i);
		$('#edit_cpt').val(cpt);
		$('#edit_asst').val(asst);
		$('#edit_host').val(host);
				
		$('#edit_number').focus();		
	});
}
</script>

<h2>Manage Flights</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>ID</td>
		<td width='10%'>Flight Number</td>
		<td width='20%'>Departure</td>
		<td width='10%'>Fare</td>
		<td width='20%'>Route</td>		
		<td width='10%'>Plane</td>		
		<td width='20%'>Operations</td>		
	</tr>	
<?php 
foreach($flights as $result){?>
	<tr>
		<td width='10%'><?=$result['id']?></td>
		<td width='10%'><?=$result['flight_number']?></td>
		<td width='20%'><?=date("M d,Y H:i a", strtotime($result['departure_date']))?></td>
		<td width='10%'>$<?=number_format($result['fare'])?></td>
		<td width='20%'><?=$result['route_name']?></td>
		<td width='10%'><?=$result['plane_name']?></td>		
		<td width='20%'>
			<a href='javascript://'
			onclick="edit('<?=$result['id']?>',
			'<?=$result['flight_number']?>',
			'<?=$result['fare']?>',
			'<?=date("Y", strtotime($result['departure_date']))?>',
			'<?=intval(date("m", strtotime($result['departure_date'])))?>',
			'<?=intval(date("d", strtotime($result['departure_date'])))?>',
			'<?=intval(date("H", strtotime($result['departure_date'])))?>',		
			'<?=intval(date("i", strtotime($result['departure_date'])))?>',
			'<?=$result['route']?>',
			'<?=$result['plane']?>',
			'<?=$result['cpt']?>',
			'<?=$result['asst']?>',
			'<?=$result['host']?>'
			);">[modify]</a>
			<a href='?action=delete&id=<?=$result['id']?>'>[remove]</a>
		</td>
	</tr>
<?php }?>
</table>



<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<input type='hidden' name='id' id='edit_id' value=''/>
		<fieldset>
			<legend>Modify Flight</legend>
			<div class='line'>
				<div class='label'>Flight Number</div>
				<div class='field'>
					<input type='text' name='number' id='edit_number' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Route</div>
				<div class='field'>
					<select name='route' id='edit_route'>
						<?php foreach($routes as $route){?>
							<option value='<?=$route['id']?>'><?=$route['route_name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Airplane</div>
				<div class='field'>
					<select name='plane' id='edit_plane'>
						<?php foreach($planes as $plane){?>
							<option value='<?=$plane['id']?>'><?=$plane['name']?> (<?=$plane['model']?> <?=$plane['capacity']?>)</option>
						<?php }?>
					</select>
				</div>
			</div>

			<div class='line'>
				<div class='label'>Flight Date </div>
				<div class='field'>
					<select name='month' id='edit_month'>
					<?php for($i=1;$i<=12;$i++){
						echo "<option ";
						if(intval(date("m")==$i)) echo "selected='selected' ";
						echo "value='$i'>".date("M", mktime(0,0,0,$i))."</option>\n";}?>
					</select> / 
					<select name='day' id='edit_day'>
					<?php for($i=1;$i<=31;$i++){
						echo "<option ";
						if(intval(date("d"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select> /
					<select name='year' id='edit_year'>
					<?php for($i=intval(date("Y"));$i<2020;$i++){
						echo "<option ";
						if(intval(date("Y"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>
					
					<select name='hour' id='edit_hour'>
					<?php for($i=0;$i<24;$i++){
						echo "<option ";
						if(intval(date("H"))==$i) echo "selected='selected' ";
						echo "value='$i'>$i</option>\n";}?>
					</select>:
					
					<select name='minute' id='edit_minute'>
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
					<input type='text' name='fare' id='edit_fare' value=''/>
				</div>
			</div>
		
			<div class='line'>
				<div class='label'>Captain Pilot</div>
				<div class='field'>
					<select name='cpt' id='edit_cpt'>
						<?php foreach($pilots as $pilot){?>
							<option value='<?=$pilot['id']?>'><?=$pilot['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Asst. Pilot</div>
				<div class='field'>
					<select name='asst' id='edit_asst'>
						<?php foreach($pilots as $pilot){?>
							<option value='<?=$pilot['id']?>'><?=$pilot['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>	
			
			
			<div class='line'>
				<div class='label'>Hostess</div>
				<div class='field'>
					<select name='host' id='edit_host'>
						<?php foreach($hostess as $h){?>
							<option value='<?=$h['id']?>'><?=$h['name']?></option>
						<?php }?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'><input type='button' id='cancel' onclick="javascript:$('#edit').slideUp()" value='&laquo; Cancel'/></div>
				<div class='field'><input type='submit' value='Update &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>


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
					<?php for($i=intval(date("Y"));$i<2020;$i++){
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