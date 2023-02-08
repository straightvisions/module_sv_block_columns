<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('Columns', 'sv100'); ?></h2>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'stack_active' )->form();
				echo $module->get_setting( 'spacing' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'margin' )->form();
				echo $module->get_setting( 'padding' )->form();
			?>
		</div>
	</div>
<?php } ?>