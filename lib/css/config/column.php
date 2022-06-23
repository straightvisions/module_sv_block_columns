<?php
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.wp-block-columns .wp-block-column',
		array_merge(
			$module->get_setting('single_padding')->get_css_data('padding'),
			$module->get_setting('single_border')->get_css_data()
		)
	);
	
	// get stack active settings val
	$stack_active				= $module->get_setting('stack_active');
	$spacing                    = $module->get_setting('spacing')->get_data();
	$properties					= array();
	
	// margin bottom ---------------------------------------------------------------------------------------------------
	$stack_max_width = array_map(function ($val) {
		return $val ? 'var( --wp--custom--sv-wide-size )' : '100%';
	}, $stack_active->get_data());
	
	$properties['max-width']	= $stack_active->prepare_css_property_responsive($stack_max_width,'','');
	
	$stack_margin_bottom = array_map(function ($val) use ($spacing) {
		return $val ? $spacing.'px' : '0';
	}, $stack_active->get_data());
	
	$properties['margin-bottom']	= $stack_active->prepare_css_property_responsive($stack_margin_bottom,'','');
	
	// optimization
	$properties['margin-bottom']['mobile'] =  (int)$properties['margin-bottom']['mobile'] == 0 ? $properties['margin-bottom']['mobile'] : ($spacing / 2).'px';
	$properties['margin-bottom']['mobile_landscape'] =  (int)$properties['margin-bottom']['mobile'] == 0 ? $properties['margin-bottom']['mobile'] : ($spacing / 2).'px';

	echo $stack_active->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns > .wp-block-column' : '.wp-block-columns > .wp-block-column',
		$properties
	);

	// margin left -----------------------------------------------------------------------------------------------------
	$properties					= array();

	$stack = array_map(function ($val) use ($spacing) {
		return boolval($val) ? '0' : $spacing.'px';
	}, $stack_active->get_data());
	
	$properties['margin-left']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	// optimization
	$properties['margin-left']['mobile'] = (int)$properties['margin-left']['mobile'] == 0 ? $properties['margin-left']['mobile'] : ($spacing / 2).'px';
	$properties['margin-left']['mobile_landscape'] = (int)$properties['margin-left']['mobile_landscape'] == 0 ? $properties['margin-left']['mobile_landscape'] : ($spacing / 2).'px';

	// -----------------------------------------------------------------------------------------------------------------
	echo $stack_active->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns > .wp-block-column:not(:first-child)' : '.wp-block-columns > .wp-block-column:not(:first-child)',
		$properties
	);