<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('Column', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'single_margin' )->form();
				echo $module->get_setting( 'single_padding' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'single_border' )->form();
			?>
		</div>
	</div>
<?php } ?>