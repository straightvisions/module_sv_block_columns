<?php
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$script->get_parent()->get_setting('single_padding')->get_css_data('padding'),
			$script->get_parent()->get_setting('single_margin')->get_css_data(),
			$script->get_parent()->get_setting('single_border')->get_css_data()
		)
	);