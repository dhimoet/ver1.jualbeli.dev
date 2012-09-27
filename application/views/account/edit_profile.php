<form method="post" action="/account/edit_profile" name="profile_edit_form">
	<div>
		<label>display name: </label>
		<input type="text" name="display_name" value="<?=$meta->display_name?>" />
		<span><?=(!empty($display_name))?$display_name[0]:''?></span>
	</div>
	<div>
		<label>profile picture: </label>
		<input type="text" name="picture" value="" />
		<span></span>
	</div>
	<div>
		<label>gender: </label>
		<input type="text" name="gender" value="" />
		<span></span>
	</div>
	<div>
		<input type="submit" value="Submit" />
	</div>
</form>
