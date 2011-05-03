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


<form method='POST' action='login.php' onsubmit='return check();'>
	<fieldset>
		<legend>Please log in or register</legend>
		<?php if($success){?><div class='line success'><?=$success?></div><?php }?>
		<?php if($error){?><div class='line error'><?=$error?></div><?php }?>

		<div class='line'>
			<div class='label'>Type</div>
			<div class='field'>
				<select name='type' id='type'>
					<option value='customer'>customer</option>
					<option value='staff'>Staff</option>
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
		
		<div class='line'>
			<div class='label'>&nbsp;</div>
			<div class='field'>
				<a href='signup.php'>New customer?&raquo;</a> -
				<a href='signup_staff.php'>Staff signup&raquo;</a>
			</div>
		</div>
	</fieldset>
</form>
