
<form method='POST' action='<?=$_PHP_SELF?>'>
	<fieldset>
		<legend>New customer registration</legend>
		<div class='line'>
			<div class='label'>Name</div>
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
			<div class='label'>Phone Number</div>
			<div class='field'>
				<input type='text' name='phone' id='phone'/>
			</div>
		</div>

		<div class='line'>
			<div class='label'>&nbsp;</div>
			<div class='field'><input type='submit' value='Proceed &raquo;'/></div>			
		</div>
	</fieldset>
</form>
