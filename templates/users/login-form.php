<form role="form">
  <div class="form-group">
    <label for="jpb_user_login"><?php e_('Username', 'jp-blank') ?></label>
    <input type="text" class="form-control" name="user_login" id="jpb_user_login" placeholder="<?php e_('Username', 'jp-blank') ?>">
  </div>
  <div class="form-group">
    <label for="jpb_user_password"><?php _e('Password', 'jp-blank') ?></label>
    <input type="password" class="form-control" name="user_password" id="jpb_user_password" placeholder="<?php _e('Password', 'jp-blank') ?>">
  </div>
  <div class="checkbox">
    <label for="jpb_remember">
      <input type="checkbox" name="remember" id="jpb_remember"> <?php _e('Remember Me', 'jp-blank') ?>
    </label>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>