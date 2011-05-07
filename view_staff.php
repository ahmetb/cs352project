<script type='text/javascript'>
function add_check(){
	if (!$('#add_name').val()){$('#add_name').focus(); return false;}
	if (!$('#add_salary').val()){$('#add_salary').focus(); return false;}
	if (($('#add_type').val()=='EXEC' || $('#add_type').val()=='SALES') && !$('#add_password').val()){
		$('#add_password').focus(); return false;
	}
	return true;
}

function edit_check(){
	if (!$('#edit_name').val()){$('#edit_name').focus(); return false;}
	if (!$('#edit_salary').val()){$('#edit_salary').focus(); return false;}
	return true;
}


function edit(id, name, salary, year,month,day,type){
	$('#edit').slideDown(function(){
		$('#edit_id').val(id);
		$('#edit_name').val(name);
		$('#edit_salary').val(salary);
		$('#edit_year').val(parseInt(year));
		$('#edit_month').val(parseInt(month));
		$('#edit_day').val(parseInt(day));
		$('#edit_type').val(type);
		$('#edit_name').focus();
	});
}
</script>

<h2>Manage Staff</h2>
<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

<table class='data'>
	<tr class='legend'>
		<td width='10%'>ID</td>
		<td width='20%'>Name</td>
		<td width='20%'>Salary</td>
		<td width='20%'>Joined on</td>
		<td width='15%'>Type</td>		
		<td width='15%'>Operations</td>		
	</tr>	
<?php 
foreach($results as $result){?>
	<tr>
		<td width='10%'><?=$result['id']?></td>
		<td width='20%'><?=$result['name']?></td>
		<td width='20%'>$<?=number_format($result['salary'])?></td>
		<td width='20%'><?=date("M d, Y", strtotime($result['date_joined']))?></td>
		<td width='15%'><?=$result['type']?></td>
		<td width='15%'>
			<a href='javascript://'
			onclick="edit('<?=$result['id']?>',
			'<?=$result['name']?>',
			'<?=$result['salary']?>',
			'<?=date("Y", strtotime($result['date_joined']))?>',
			'<?=date("m", strtotime($result['date_joined']))?>',
			'<?=date("d", strtotime($result['date_joined']))?>',
			'<?=$result['type']?>'
			);">[edit]</a> <a href='?action=delete&id=<?=$result['id']?>&type=<?=$result['type']?>'>[fire]</a>
		</td>
	</tr>
<?php }?>
<?php if (!count($results)){?>
	<tr><td width="100%" colspan='6'>No staff found. Create some.</td></tr>
<?php }?>
</table>

<div id='edit' style="display: none">
	<form method='post' action='?action=edit'  onsubmit='return edit_check();'>
		<input type='hidden' name='id' id='edit_id' value=''/>
		<input type='hidden' name='type' id='edit_type' value=''/>
		<fieldset>
			<legend>Edit Employee</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='edit_name' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Monthly Salary $</div>
				<div class='field'>
					<input type='text' name='salary' id='edit_salary' value=''/>
				</div>
			</div>

			<div class='line'>
				<div class='label'>Password <small>(ground staff)</small></div>
				<div class='field'>
					<input type='password' name='password' id='edit_password' value=''/>
				</div>
			</div>					
			
			<div class='line'>
				<div class='label'>Joined on </div>
				<div class='field'>
					<select name='month' id='edit_month'>
					<?php for($i=1;$i<=12;$i++){
						echo "<option value='$i'>".date("M", mktime(0,0,0,$i))."</option>\n";}?>
					</select> / 
					<select name='day' id='edit_day'>
					<?php for($i=1;$i<=31;$i++){
						echo "<option  value='$i'>$i</option>\n";}?>
					</select> /
					<select name='year' id='edit_year'>
					<?php for($i=intval(date("Y"));$i>1990;$i--){
						echo "<option value='$i'>$i</option>\n";}?>
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
			<legend>New Employee</legend>
			<div class='line'>
				<div class='label'>Name</div>
				<div class='field'>
					<input type='text' name='name' id='add_name' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Monthly Salary $</div>
				<div class='field'>
					<input type='text' name='salary' id='add_salary' value=''/>
				</div>
			</div>
			
			<div class='line'>
				<div class='label'>Type</div>
				<div class='field'>
					<select name='type' id='add_type'>
							<option value='SALES'>Sales</option>
							<option value='EXEC'>Executive</option>
							<option value='PILOT'>Pilot</option>														
							<option value='HOSTESS'>Hostess</option>							
					</select>
				</div>
			</div>	
			
			<div class='line'>
				<div class='label'>Password <small>(ground staff)</small></div>
				<div class='field'>
					<input type='password' name='password' id='add_password' value=''/>
				</div>
			</div>					
			
			<div class='line'>
				<div class='label'>Joined on </div>
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
				</div>
			</div>			

			<div class='line'>
				<div class='label'>&nbsp;</div>
				<div class='field'><input type='submit' value='Create &raquo;'/></div>			
			</div>
		</fieldset>
	</form>
</div>