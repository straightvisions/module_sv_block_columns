<?php
	echo $_s->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns .wp-block-column',
		array_merge(
			$module->get_setting('single_padding')->get_css_data('padding'),
			$module->get_setting('single_border')->get_css_data()
		)
	);
	
	// get stack active settings val
	$stack_active				= $module->get_setting('stack_active');
	$spacing                    = 40;
	$properties					= array();
	
	// margin bottom ---------------------------------------------------------------------------------------------------
	$stack_max_width = array_map(function ($val) {
		return $val ? 'var( --sv100_sv_common-max-width-alignwide )' : '100%';
	}, $stack_active->get_data());
	
	$properties['max-width']	= $stack_active->prepare_css_property_responsive($stack_max_width,'','');
	
	$stack_margin_bottom = array_map(function ($val) use ($spacing) {
		return $val ? $spacing.'px' : '0';
	}, $stack_active->get_data());
	
	$properties['margin-bottom']	= $stack_active->prepare_css_property_responsive($stack_margin_bottom,'','');
	
	// optimization
	$properties['margin-bottom']['mobile'] =  (int)$properties['margin-bottom']['mobile'] == 0 ? $properties['margin-bottom']['mobile'] : ($spacing / 2).'px';
	$properties['margin-bottom']['mobile_landscape'] =  (int)$properties['margin-bottom']['mobile'] == 0 ? $properties['margin-bottom']['mobile'] : ($spacing / 2).'px';
	
	// margin left -----------------------------------------------------------------------------------------------------

	$stack = array_map(function ($val) use ($spacing) {
		return boolval($val) ? '0' : $spacing.'px';
	}, $stack_active->get_data());
	
	$properties['margin-left']	= $stack_active->prepare_css_property_responsive($stack,'','');
	
	// optimization
	$properties['margin-left']['mobile'] = (int)$properties['margin-left']['mobile'] == 0 ? $properties['margin-left']['mobile'] : ($spacing / 2).'px';
	$properties['margin-left']['mobile_landscape'] = (int)$properties['margin-left']['mobile_landscape'] == 0 ? $properties['margin-left']['mobile_landscape'] : ($spacing / 2).'px';

	// -----------------------------------------------------------------------------------------------------------------
	echo $stack_active->build_css(
		is_admin() ? '.editor-styles-wrapper .wp-block-columns > .wp-block-column' : '.sv100_sv_content_wrapper .wp-block-columns > .wp-block-column',
		$properties
	);

	// SV Columns Manager Stack Support: No Margin left when stacked in block settings
	/*
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
	}*/