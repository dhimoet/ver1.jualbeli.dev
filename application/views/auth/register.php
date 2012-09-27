<form method="post" action="/auth/register" name="registration_form">
	<div>
		<label>display name: </label>
		<input type="text" name="user[name]" />
	</div>
	<div>
		<label>username: </label>
		<input type="text" name="user[username]" />
	</div>
	<div>
		<label>password: </label>
		<input type="text" name="user[password]" />
	</div>
	<div>
		<label>confirm password: </label>
		<input type="text" name="user[confirm_password]" />
	</div>
	<div>
		<label>email: </label>
		<input type="text" name="user[email]" />
	</div>
	<div>
		<input type="submit"  />
	</div>
</form>