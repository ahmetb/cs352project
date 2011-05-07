<script type='text/javascript'>
function add_check(){
	if (!$('#add_name').val()){
		$('#add_name').focus();
		return false;
	}
	if (!$('#add_code').val()){
		$('#add_code').focus();
		return false;
	}
	return true;
}

function edit_check(){
	if (!$('#edit_name').val()){
		$('#edit_name').focus();
		return false;
	}
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
<?php if (!count($results)){?>
	<tr><td width="100%" colspan='5'>No results found.</td></tr>
<?php }?>
</table>

<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<input type='hidden' name='id' id='edit_id' value=''/>
		<fieldset>
			<legend>Edit Airport</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='edit_name' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Code</div>
				<div class='field'>
					<input type='text' name='code' id='edit_code' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Cities</div>
				<div class='field'>
					<select name='city' id='edit_city'>
						<?php foreach($cities as $city){?>
							<option value='<?=$city['id']?>'><?=$city['name']?></option>
						<?}?>
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
			<legend>New Airport</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='add_name' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Code</div>
				<div class='field'>
					<input type='text' name='code' id='add_code' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Cities</div>
				<div class='field'>
					<select name='city' id='add_city'>
						<?php foreach($cities as $city){?>
							<option value='<?=$city['id']?>'><?=$city['name']?></option>
						<?}?>
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