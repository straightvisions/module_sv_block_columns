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

	// SV Columns Manager Stack Support: No Margin left when stacked in block settings
	if($this->get_instance('sv_columns_manager')) {
		$states_col = array(
			'mobile'				=> 'svcm-xs-h-col',
			'mobile_landscape'		=> 'svcm-xs-v-col',
			'tablet'				=> 'svcm-sm-h-col',
			'tablet_landscape'		=> 'svcm-sm-v-col',
			'tablet_pro'			=> 'svcm-md-h-col',
			'tablet_pro_landscape'	=> 'svcm-md-v-col',
			'desktop'				=> 'svcm-lg-col',
		);
		$states_row = array(
			'mobile'				=> 'svcm-xs-h-row',
			'mobile_landscape'		=> 'svcm-xs-v-row',
			'tablet'				=> 'svcm-sm-h-row',
			'tablet_landscape'		=> 'svcm-sm-v-row',
			'tablet_pro'			=> 'svcm-md-h-row',
			'tablet_pro_landscape'	=> 'svcm-md-v-row',
			'desktop'				=> 'svcm-lg-row',
		);

		foreach($this->get_breakpoints() as $breakpoint => $min_width){
			$state_col = $states_col[$breakpoint];
			$state_row = $states_row[$breakpoint];

			$selector_col = is_admin() ? '.editor-styles-wrapper .wp-block-straightvisions-sv-columns-manager.'.$state_col.' > .wp-block-columns > .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-straightvisions-sv-columns-manager.'.$state_col.' > .wp-block-columns > .wp-block-column';
			$selector_row = is_admin() ? '.editor-styles-wrapper .wp-block-straightvisions-sv-columns-manager.'.$state_row.' > .wp-block-columns > .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-straightvisions-sv-columns-manager.'.$state_row.' > .wp-block-columns > .wp-block-column';

			echo $_s->wrap_media_queries(array(
				$breakpoint => array(
					$selector_col	=> array('margin-left:0;'),
					$selector_row	=> array('margin-left:'.$properties['margin-left'][$breakpoint].';'),
				)
			));
		}
	}