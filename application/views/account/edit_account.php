<form method="post" action="/account/edit_account" name="account_edit_form">
	<div>
		<label>username: </label>
		<input type="text" name="username" value="<?=$user->username?>" />
		<span><?=(!empty($username))?$username[0]:''?></span>
	</div>
	<div>
		<label>email: </label>
		<input type="text" name="email" value="<?=$user->email?>" />
		<span><?=(!empty($email))?$email[0]:''?></span>
	</div>
	<div>
		<input type="submit" value="Submit" />
	</div>
</form>
