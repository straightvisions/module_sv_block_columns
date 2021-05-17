<?php
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$module->get_setting('single_padding')->get_css_data('padding'),
			$module->get_setting('single_margin')->get_css_data(),
			$module->get_setting('single_border')->get_css_data()
		)
	);

	$properties					= array();
	
	/*
	$stack_active				= $module->get_setting('stack_active');
	$stack = array_map(function ($val) {
		return boolval($val) ? '0' : 'invalid';
	}, $stack_active->get_data());

	$margin_left_data			= $module->get_setting('single_margin')->get_data();
	foreach($stack as $responsive => $val){
		if($val === 'invalid'){
			$stack[$responsive]		= $margin_left_data[$responsive]['left'];
		}
	}

	$properties['margin-left']	= $stack_active->prepare_css_property_responsive($stack,'','');

	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$properties
		)
	);
	*/