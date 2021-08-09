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
		is_admin() ? '.editor-styles-wrapper .wp-block-columns' : '.sv100_sv_content_wrapper .wp-block-columns',
		array_merge(
			$properties,
			$module->get_setting('padding')->get_css_data('padding'),
			$module->get_setting('margin')->get_css_data(),
			$module->get_setting('border')->get_css_data()
		)
	);
	
	$properties					= array();
	
	$stack_max_width = array_map(function ($val) {
		return $val ? 'var( --sv100_sv_common-max-width-alignwide )' : '100%';
	}, $stack_active->get_data());
	
	$properties['max-width']	= $stack_active->prepare_css_property_responsive($stack_max_width,'','');
	
	$spacing = 40;
	
	$stack_margin_bottom = array_map(function ($val) use ($spacing) {
		return $val ? $spacing.'px' : '0';
	}, $stack_active->get_data());
	
	$properties['margin-bottom']	= $stack_active->prepare_css_property_responsive($stack_margin_bottom,'','');
	// optimization
	$properties['margin-bottom']['mobile'] = ($spacing / 2).'px';
	$properties['margin-bottom']['mobile_landscape'] = ($spacing / 2).'px';

	echo $stack_active->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns > .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns > .wp-block-column',
		$properties
	);