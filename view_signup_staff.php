<script type='text/javascript'>
function check(){
	if (!$('#username').val()){
		$('#username').focus();
		return false;
	}
	if(!$('#password').val()){
		$('#password').focus();
		return false;
	}
	return true;
}
</script>

<form method='POST' action='<?=$_PHP_SELF?>' onsubmit='return check();'>
	<fieldset>
		<legend>Staff registration</legend>
		<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
		<?php if($error){?><div class='line error'><?=$error?></div><?php }?>
		
		<div class='line'>
			<div class='label'>Type</div>
			<div class='field'>
				<select name='type' id='type'>
					<option value='sales'>Sales</option>
					<option value='exec'>Executive</option>
				</select>
			</div>
		</div>
		
		<div class='line'>
			<div class='label'>Username</div>
			<div class='field'>
				<input type='text' name='username' id='username'/>
			</div>
		</div>
		
		<div class='line'>
			<div class='label'>Password</div>
			<div class='field'>
				<input type='password' name='password' id='password'/>
			</div>
		</div>

		<div class='line'>
			<div class='label'>&nbsp;</div>
			<div class='field'><input type='submit' value='Proceed &raquo;'/></div>			
		</div>
	</fieldset>
</form>
