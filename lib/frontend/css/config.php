<?php
	$stack_active				= $script->get_parent()->get_setting('stack_active');

	// maybe stack
	$properties					= array();
	$stack = array_map(function ($val) {
		return $val ? 'block' : 'flex';
	}, $stack_active->get_data());

	$properties['display']	= $stack_active->prepare_css_property_responsive($stack,'','');

	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns' : '.sv100_sv_content_wrapper article .wp-block-columns',
		array_merge(
			$properties,
			$script->get_parent()->get_setting('padding')->get_css_data('padding'),
			$script->get_parent()->get_setting('margin')->get_css_data(),
			$script->get_parent()->get_setting('border')->get_css_data()
		)
	);


	// maybe stack -> remove margin left when stacked
	$properties					= array();
	$stack = array_map(function ($val) {
		return $val ? '30px auto 0px auto !important' : '0px 0px 0px 32px !important';
	}, $stack_active->get_data());

	$properties['margin']	= $stack_active->prepare_css_property_responsive($stack,'','');

	echo $stack_active->build_css(
		is_admin() ? '.edit-post-visual-editor.editor-styles-wrapper .wp-block-columns .wp-block-column:not(:first-child)' : '.sv100_sv_content_wrapper article .wp-block-columns .wp-block-column:not(:first-child)',
		$properties
	);


	// maybe stack -> add max width text when stacked
	$properties					= array();

	$stack_max_width = array_map(function ($val) {
		return $val ? 'var( --sv100_sv_common-max-width-text ) !important' : 'inherit !important';
	}, $stack_active->get_data());

	$properties['max-width']	= $stack_active->prepare_css_property_responsive($stack_max_width,'','');

	echo $stack_active->build_css(
		is_admin() ? '.edit-post-visual-editor.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper article .wp-block-columns .wp-block-column',
		$properties
	);