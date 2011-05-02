
<form method='POST' action='login.php'>
	<fieldset>
		<legend>Please log in</legend>
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
			<div class='field'><input type='submit' value='Proceed'/></div>			
		</div>
		
		<div class='line'>
			<div class='label'>&nbsp;</div>
			<div class='field'>
				<a href='signup.php'>New customer?</a> 		
				<a href='signup_staff.php'>Staff signup</a>
			</div>
		</div>
	</fieldset>
</form>