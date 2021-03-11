<?php
	$stack_active				= $module->get_setting('stack_active');
	$stack = array_map(function ($val) {
		return boolval($val) ? '0' : '';
	}, $stack_active->get_data());

	$properties['margin-left']	= $stack_active->prepare_css_property_responsive($stack,'','');

	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$properties
		)
	);

	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$module->get_setting('single_padding')->get_css_data('padding'),
			$module->get_setting('single_margin')->get_css_data(),
			$module->get_setting('single_border')->get_css_data()
		)
	);