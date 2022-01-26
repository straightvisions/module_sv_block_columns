<?php
	$stack_active				= $module->get_setting('stack_active');
	
	// column stacking
	$properties					= array();
	
	$stack = array_map(function ($val) {
		return $val ? 'column' : 'row';
	}, $stack_active->get_data());
	
	$properties['flex-direction']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	$stack = array_map(function ($val) {
		return $val ? 'wrap' : 'nowrap';
	}, $stack_active->get_data());
	
	$properties['flex-wrap']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns' : '.wp-block-columns',
		array_merge(
			$properties,
			$module->get_setting('padding')->get_css_data('padding'),
			$module->get_setting('margin')->get_css_data(),
			$module->get_setting('border')->get_css_data()
		)
	);