<script type='text/javascript'>
function add_check(){
	if (!$('#add_name').val()){
		$('#add_name').focus();
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


function edit(id, name){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_name').val(name);	
		$('#edit_name').focus();		
	});
}
</script>

<h2>Manage Cities</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>ID</td>
		<td width='50%'>Name</td>
		<td width='50%'>Operation</td>		
	</tr>	
<?php foreach($cities as $city){?>
	<tr>
		<td width='10%'><?=$city['id']?></td>
		<td width='50%'><?=$city['name']?></td>
		<td width='50%'>
			<a href='javascript://' onclick="edit('<?=$city['id']?>','<?=$city['name']?>')">[modify]</a>
			<a href='?action=delete&id=<?=$city['id']?>'>[remove]</a>
		</td>
	</tr>
<?php }?>
</table>

<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<fieldset>
			<legend>Edit City</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='edit_name' value=''/>
					<input type='hidden' name='id' id='edit_id' value=''/>
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
			<legend>New City</legend>

			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='add_name' value='<?=$add_name?>'/>
				</div>
			</div>

			<div class='line'>
				<div class='label'>&nbsp;</div>
				<div class='field'><input type='submit' value='Add &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>