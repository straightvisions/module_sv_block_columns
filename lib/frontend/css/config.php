<?php
	// ##### SETTINGS #####

	// Fetches all settings and creates new variables with the setting ID as name and setting data as value.
	// This reduces the lines of code for the needed setting values.
	foreach ( $script->get_parent()->get_settings() as $setting ) {
		if ( $setting->get_type() !== false ) {
			${ $setting->get_ID() } = $setting->get_data();
		}
	}

	$properties					= array();

	// Margin
	if($margin) {
		$imploded		= false;
		foreach($margin as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : 0;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : 0;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : 0;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : 0;

			if($top+$right+$bottom+$left!==0) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['margin'] = $setting->prepare_css_property_responsive($imploded, '', '');
		}
	}

	// Padding
	// @todo: same as margin, refactor to avoid doubled code
	if($padding) {
		$imploded		= false;
		foreach($padding as $breakpoint => $val) {
			$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : 0;
			$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : 0;
			$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : 0;
			$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : 0;

			if($top+$right+$bottom+$left!==0) {
				$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
			}
		}
		if($imploded) {
			$properties['padding'] = $setting->prepare_css_property_responsive($imploded, '', '');
		}
	}

	// border
	if($border) {
		if($border['top_width']){
			$val		= $border['top_width'].' '.$border['top_style'].' rgba('.$border['color'].')';
			$properties['border-top'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['right_width']){
			$val		= $border['right_width'].' '.$border['right_style'].' rgba('.$border['color'].')';
			$properties['border-right'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['bottom_width']){
			$val		= $border['bottom_width'].' '.$border['bottom_style'].' rgba('.$border['color'].')';
			$properties['border-bottom'] = $setting->prepare_css_property_responsive($val, '', '');
		}
		if($border['left_width']){
			$val		= $border['left_width'].' '.$border['left_style'].' rgba('.$border['color'].')';
			$properties['border-left'] = $setting->prepare_css_property_responsive($val, '', '');
		}

		if($border['top_left_radius']+$border['top_right_radius']+$border['bottom_right_radius']+$border['bottom_left_radius']!==0) {
			$border_radius = $border['top_left_radius'] . ' ' . $border['top_right_radius'] . ' ' . $border['bottom_right_radius'] . ' ' . $border['bottom_left_radius'];
			$properties['border-radius'] = $setting->prepare_css_property_responsive($border_radius, '', '');
		}
	}

	echo $setting->build_css(
		'.wp-block-columns',
		$properties
	);