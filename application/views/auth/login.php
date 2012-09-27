<form method="post" action="/auth/login" name="login_form">
	<div>
		<label>username: </label>
		<input type="text" name="username" value="<?=Input::get('username')?>" />
		<span><?=(!empty($username))?$username[0]:''?></span>
	</div>
	<div>
		<label>password: </label>
		<input type="password" name="password" value="<?=Input::get('password')?>" />
		<span><?=(!empty($password))?$password[0]:''?></span>
	</div>
	<div>
		<input type="submit" value="Login" />
	</div>
</form>
