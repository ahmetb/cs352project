<script type='text/javascript'>
function add_check(){
	if (!$('#add_name').val()){	$('#add_name').focus();	return false;}
	if (!$('#add_model').val()){$('#add_model').focus(); return false;}
	if (!$('#add_capacity').val()){$('#add_capacity').focus(); return false;}
	return true;
}

function edit_check(){
	if (!$('#edit_name').val()){$('#edit_name').focus(); return false;}
	if (!$('#edit_model').val()){$('#edit_model').focus(); return false;}
	if (!$('#edit_capacity').val()){$('#edit_capacity').focus(); return false;}
	return true;
}


function edit(id, name,model,capacity){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_name').val(name);	
		$('#edit_model').val(model);	
		$('#edit_capacity').val(capacity);	
		$('#edit_name').focus();		
	});
}
</script>

<h2>Manage Fleet</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>Id</td>
		<td width='30%'>Name</td>
		<td width='20%'>Model</td>
		<td width='15%'>Capacity</td>
		<td width='25%'>Operation</td>		
	</tr>	
<?php foreach($airplanes as $airplane){?>
	<tr>
		<td width='10%'><?=$airplane['id']?></td>
		<td width='30%'><?=$airplane['name']?></td>
		<td width='20%'><?=$airplane['model']?></td>
		<td width='15%'><?=$airplane['capacity']?></td>
		<td width='25%'>
			<a href='javascript://' onclick="edit(
			'<?=$airplane['id']?>',
			'<?=$airplane['name']?>',
			'<?=$airplane['model']?>',
			'<?=$airplane['capacity']?>'
			)">[modify]</a>
			<a href='?action=delete&id=<?=$airplane['id']?>'>[remove]</a>
		</td>
	</tr>
<?php }?>
</table>

<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<input type='hidden' name='id' id='edit_id' value=''/>
		<fieldset>
			<legend>Edit Airplane</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='edit_name' value=''/>
				</div>
			</div>

			<div class='line'>
				<div class='label'>Model</div>
				<div class='field'>
					<input type='text' name='model' id='edit_model' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Capacity</div>
				<div class='field'>
					<input type='text' name='capacity' id='edit_capacity' value=''/>
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
			<legend>New Airplane</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='add_name' value=''/>
				</div>
			</div>

			<div class='line'>
				<div class='label'>Model</div>
				<div class='field'>
					<input type='text' name='model' id='add_model' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Capacity</div>
				<div class='field'>
				<input type='text' name='capacity' id='add_capacity' value=''/>
				</div>
			</div>

			<div class='line'>
				<div class='label'>&nbsp;</div>
				<div class='field'><input type='submit' value='Add &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>