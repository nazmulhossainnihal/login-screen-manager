<?php
function cwlsm_options_page() {

	global $cwlsm_options;

	ob_start(); ?>
	<div class="wrap">
		<h2>Login Screen Manager</h2>
		<?php
			$input = array(
				"logo_url" => array("text"=>"Logo Image URL","class"=>"cwlsm_file","placeholder"=>"Example : %BLOG_URL%/wp-content/logo.png"),
				"fav_icon_url" => array("text"=>"Favicon Url","class"=>"cwlsm_file","placeholder"=>"Example : %BLOG_URL%/wp-content/favicon.png"),
				"hover_title" => array("text"=>"Hover Title","class"=>"cwlsm_file","placeholder"=>"Example : %BLOG_NAME%"),
				"url" => array("text"=>"Url","class"=>"cwlsm_file","placeholder"=>"Example : %BLOG_URL%"),
				"body_bg_color" => array("text"=>"Body Background Color","class"=>"color {hash:true}","default"=>"#F1F1F1","Textdf" => "#000000"),
				"login_form_bg_color" =>  array("text"=>"Login Form Background Color","class"=>"color {hash:true}","default"=>"#FFFFFF","Textdf" => "#000000"),
				"text_input_color" => array("text"=>"Input Text Color","class"=>"color {hash:true}","default"=>"#000000","Textdf" => "#FFFFFF"),
				"input_bg_color" => array("text"=>"Input Background Color","class"=>"color {hash:true}","default"=>"#FFFFFF","Textdf" => "#000000"),
				"label_color" =>  array("text"=>"Label Color","class"=>"color {hash:true}","default"=>"#000000","Textdf" => "#FFFFFF")
			);
		?>
		<form method="post" action="options.php">
			<?php settings_fields('cwlsm_settings_group'); ?>
			<table>
				<?php foreach ($input as $name => $data) : ?>
				<tr>
					<td style="text-align:;"><label class="description" for="cwlsm_settings[<?php echo $name; ?>]"><?php _e($data["text"], 'cwlsm_domain'); ?></label></td>
					<?php if($data["class"]=="color {hash:true}"): ?>
					<td><input class="<?php echo $data["class"]; ?>" id="cwlsm_settings[<?php echo $name; ?>]" size="30" name="cwlsm_settings[<?php echo $name; ?>]" type="text" value="<?php if(empty($cwlsm_options[$name])){echo $data["default"]; }else{ echo $cwlsm_options[$name];} ?>"/>
					<input type="button" value="Restore Default" onclick="cw_df_change_color('<?php echo $name; ?>','<?php echo $data["default"]; ?>','<?php echo $data["Textdf"]; ?>')" />
					<?php else:?>
					<td><input class="<?php echo $data["class"]; ?>" id="cwlsm_settings[<?php echo $name; ?>]" size="45" name="cwlsm_settings[<?php echo $name; ?>]" type="text" value="<?php if(empty($cwlsm_options[$name])){echo ""; }else{ echo $cwlsm_options[$name];} ?>" placeholder="<?php echo $data["placeholder"]; ?>"/>
					<?php endif;?>
					
					</td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td><label class="description" for="cwlsm_settings[css]"><?php _e("Custom Css", 'cwlsm_domain'); ?></label></td>
					<td><textarea id="cwlsm_settings[css]" style="height:250px;width:390px;"  name="cwlsm_settings[css]" type="text"><?php echo $cwlsm_options["css"]; ?></textarea></td>
				</tr>
				<tr><td></td><td>
				<br />
				<iframe src="//www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2Fnazmul.hossain.nihal&amp;width&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;show_faces=false&amp;appId=715408735224516" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
				<br />
				If you find this plugin useful then please rate this plugin <a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/login-screen-manager/" target="_blank">here</a> <br /> and don't forget to visit my website <a style="text-decoration:none;" href="http://www.SuperbCodes.com/" target="_blank">SuperbCodes.com</a>.
				<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FYMPLJ69H9EM6" target="_blank"><img style="width:100px;height:30px;" alt="Donate" src="<?php echo plugin_dir_url( __FILE__ ); ?>images/donate.gif" /></a></p>
				</td></tr>
				<tr>
					<td></td>
					<td class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Options', 'cwlsm_domain'); ?>" />
					&nbsp;&nbsp;&nbsp;
					<a class="button-primary" href="<?php echo get_site_url(); ?>/wp-login.php" target="_blank">View Login Screen</a>
					</td>
				</tr>
			</table>
		</form>
		
	</div>
	<?php
	echo ob_get_clean();
}

function cwlsm_add_options_link() {
	add_options_page('Login Screen Manager', 'Login Screen', 'manage_options', 'cwlsm-options', 'cwlsm_options_page');
}
add_action('admin_menu', 'cwlsm_add_options_link');

function cwlsm_register_settings() {
	register_setting('cwlsm_settings_group', 'cwlsm_settings');
}
add_action('admin_init', 'cwlsm_register_settings');


	function cwlsm_scripts_method() {
		if(is_admin() and isset($_GET['page']) and $_GET['page'] == 'cwlsm-options'){
			wp_enqueue_script('custom_admin_script',  plugins_url('/js/jscolor.js', __FILE__), array('jquery'));
			wp_enqueue_script('restore_deafult',  plugins_url('/js/restore_deafult.js', __FILE__), array('scriptaculous'));
		}
	}    

	add_action('init', 'cwlsm_scripts_method');

?>