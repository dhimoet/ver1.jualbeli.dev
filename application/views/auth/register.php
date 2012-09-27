<form method="post" action="/auth/register" name="registration_form">
	<div>
		<label>username: </label>
		<input type="text" name="username" value="<?=Input::get('username')?>" />
		<span><?=(!empty($username))?$username[0]:''?></span>
	</div>
	<div>
		<label>email: </label>
		<input type="text" name="email" value="<?=Input::get('email')?>" />
		<span><?=(!empty($email))?$email[0]:''?></span>
	</div>
	<div>
		<label>password: </label>
		<input type="password" name="password" value="<?=Input::get('password')?>" />
		<span><?=(!empty($password))?$password[0]:''?></span>
	</div>
	<div>
		<label>confirm password: </label>
		<input type="password" name="password_confirmation" value="<?=Input::get('password_confirmation')?>" />
		<span><?=(!empty($password_confirmation))?$password_confirmation[0]:''?></span>
	</div>
	<div>
		<input type="submit" value="Submit" />
	</div>
</form>
