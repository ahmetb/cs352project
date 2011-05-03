<script type='text/javascript'>
function add_check(){
	if (!$('#add_duration').val()){
		$('#add_duration').focus();
		return false;
	}
	return true;
}

function edit_check(){
	if (!$('#edit_duration').val()){
		$('#edit_duration').focus();
		return false;
	}
	return true;
}


function edit(id, dep, dest, dur){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_departure').val(dep);	
		$('#edit_destination').val(dest);	
		$('#edit_duration').val(dur);	
		$('#edit_departure').focus();		
	});
}
</script>

<h2>Manage Routes</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>ID</td>
		<td width='40%'>Route</td>
		<td width='10%'>Duration</td>		
		<td width='40%'>Duration</td>
	</tr>	
<?php 
foreach($results as $result){?>
	<tr>
		<td width='10%'><?=$result['id']?></td>
		<td width='40%'><?=$result['route_name']?></td>
		<td width='10%'><?=$result['duration']?>&quot;</td>
		<td width='40%'>
			<a href='javascript://'
			onclick="edit('<?=$result['id']?>',
			'<?=$result['departure']?>',
			'<?=$result['destination']?>',
			'<?=$result['duration']?>'
			)">[modify]</a>
			<a href='?action=delete&id=<?=$result['id']?>'>[remove]</a>
		</td>
	</tr>
<?php }?>
</table>

<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<input type='hidden' name='id' id='edit_id' value=''/>
		<fieldset>
			<legend>Edit Route</legend>

			<div class='line'>
				<div class='label'>Departure</div>
				<div class='field'>
					<select name='departure' id='edit_departure'>
						<?php foreach($airports as $airport){?>
							<option value='<?=$airport['id']?>'><?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Destination</div>
				<div class='field'>
					<select name='destination' id='edit_destination'>
						<?php foreach($airports as $airport){?>
							<option value='<?=$airport['id']?>'><?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Duration (min.)</div>
				<div class='field'>
					<input type='text' name='duration' id='edit_duration' value=''/>
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
			<legend>New Route</legend>
			
			<div class='line'>
				<div class='label'>Departure</div>
				<div class='field'>
					<select name='departure' id='add_departure'>
						<?php foreach($airports as $airport){?>
							<option value='<?=$airport['id']?>'><?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Destination</div>
				<div class='field'>
					<select name='destination' id='add_destination'>
						<?php foreach($airports as $airport){?>
							<option value='<?=$airport['id']?>'><?=$airport['name']?> (<?=$airport['code']?>)</option>
						<?}?>
					</select>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Duration (min.)</div>
				<div class='field'>
					<input type='text' name='duration' id='add_duration' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>&nbsp;</div>
				<div class='field'><input type='submit' value='Create &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>