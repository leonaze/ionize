<?php

/**
 * Modal window for Editing an user
 *
 */

if ( ! empty($user['id_user']))
	$action = 'update';
else
	$action = 'save';

?>

<form name="userForm<?= $user['id_user'] ?>" id="userForm<?= $user['id_user'] ?>" action="<?= admin_url() ?>users/<?= $action ?>">

	<!-- Hidden fields -->
	<input id="user_PK" name="user_PK" type="hidden" value="<?= $user['id_user'] ?>" />
	<input id="join_date" name="join_date" type="hidden" value="<?= $user['join_date'] ?>" />
	<input id="salt" name="salt" type="hidden" value="<?= $user['salt'] ?>" />
	
	<!-- Username -->
	<dl class="small">
		<dt>
			<label for="username"><?=lang('ionize_label_username')?></label>
		</dt>
		<dd>
			<input id="username" name="username" class="inputtext" type="text" value="<?= $user['username'] ?>" />
		</dd>
	</dl>

	<!-- Screen Name -->
	<dl class="small">
		<dt>
			<label for="screen_name"><?=lang('ionize_label_screen_name')?></label>
		</dt>
		<dd>
			<input id="screen_name" name="screen_name" class="inputtext" type="text" value="<?= $user['screen_name'] ?>" />
		</dd>
	</dl>

	<!-- Email -->
	<dl class="small">
		<dt>
			<label for="email" ><?=lang('ionize_label_email')?></label>
		</dt>
		<dd>
			<input id="email" name="email" class="inputtext" type="text" value="<?= $user['email'] ?>" />
		</dd>
	</dl>

	<!-- Group -->
	<dl class="small">
		<dt>
			<label for="email"><?=lang('ionize_label_group')?></label>
		</dt>
		<dd>
			<select name="id_group" class="select">
				<?php foreach($groups as $group) :?>

					<option value="<?= $group['id_group'] ?>" <?php if($user['group']['id_group'] == $group['id_group']) :?> selected="selected" <?php endif ;?> ><?= $group['group_name'] ?></option>
				
				<?php endforeach ;?>
			</select>
		</dd>
	</dl>
	

	<!-- New password -->
	<h3><?=lang('ionize_title_change_password')?></h3>


	<!-- Password -->
	<dl class="small">
		<dt>
			<label for="password"><?=lang('ionize_label_password')?></label>
		</dt>
		<dd>
			<input id="password" name="password" class="inputtext i120" type="password" value="" />
		</dd>
	</dl>

	<!-- Password confirm -->
	<dl class="small">
		<dt>
			<label for="password2"><?=lang('ionize_label_password2')?></label>
		</dt>
		<dd>
			<input id="password2" name="password2" class="inputtext i120" type="password" value="" />
		</dd>
	</dl>

	
	<!-- Meta data -->
	<h3><?=lang('ionize_title_user_meta')?></h3>

	<?php foreach($meta_data as $key => $field) :?>

		<dl class="small">
			<dt>
				<label for="<?= $key ?>"><?= $key ?></label>
			</dt>
			<dd>
				<?php
					echo form_build_field($field);
				?>
			</dd>
		</dl>

	<?php endforeach ;?>
	
</form>

<div class="buttons">
	<button id="bSaveuser<?= $user['id_user'] ?>" type="button" class="button yes right mr40"><?= lang('ionize_button_save_close') ?></button>
	<button id="bCanceluser<?= $user['id_user'] ?>"  type="button" class="button no right"><?= lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">


	/**
	 * TinyEditors
	 * Must be called after tabs init.
	 *
	 */
	/*
	 *  TODO : Create a tinyMCE init which launch the non translated editors
	 * 	ION.initTinyEditors('.tab_article', '#articleTabContent .tinyTextarea');
	 * 	Purpose : Init tinyMCE from user's meta potential fields
	 *
	 */

	ION.initDatepicker('<?php echo Settings::get('date_format') ;?>');

	ION.initLabelHelpLinks('#userForm<?= $user['id_user'] ?>');


</script>

