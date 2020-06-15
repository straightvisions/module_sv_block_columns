<?php
	$stack_active				= $script->get_parent()->get_setting('stack_active');

	// maybe stack
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
		is_admin() ? '.editor-styles-wrapper .wp-block-columns' : '.sv100_sv_content_wrapper article .wp-block-columns',
		array_merge(
			$properties,
			$script->get_parent()->get_setting('padding')->get_css_data('padding'),
			$script->get_parent()->get_setting('margin')->get_css_data(),
			$script->get_parent()->get_setting('border')->get_css_data()
		)
	);
	
	$properties = array();
	$stack = array_map(function ($val) {
		return $val ? '20px' : '0';
	}, $stack_active->get_data());
	
	$properties['margin-top']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns+.wp-block-columns' : '.sv100_sv_content_wrapper article .wp-block-columns+.wp-block-columns',
		array_merge(
			$properties
		)
	);
	
	$properties					= array();
	$stack = array_map(function ($val) {
		return $val ? '20px' : '0';
	}, $stack_active->get_data());
	
	$properties['margin-top']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	$stack = array_map(function ($val) {
		return $val ? '0' : '20px';
	}, $stack_active->get_data());
	
	$properties['margin-left']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns > .wp-block-column:not(:first-child)'
			: '.sv100_sv_content_wrapper article .wp-block-columns > .wp-block-column:not(:first-child)',
		array_merge(
			$properties
		)
	);

	// maybe stack -> add max width text when stacked
	$properties					= array();

	$stack_max_width = array_map(function ($val) {
		return $val ? 'var( --sv100_sv_common-max-width-alignwide )' : '100%';
	}, $stack_active->get_data());

	$properties['max-width']	= $stack_active->prepare_css_property_responsive($stack_max_width,'','');

	echo $stack_active->build_css(
		is_admin() ? '.edit-post-visual-editor.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper article .wp-block-columns .wp-block-column',
		$properties
	);