<?php
	namespace sv100;

	class sv_block_columns extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Columns', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->set_css_cache_active()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_template_path()
				->set_section_order(5000)
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 24h-6v-24h6v24zm9-24h-6v24h6v-24zm9 0h-6v24h6v-24z"/></svg>')
				->set_block_handle('wp-block-columns')
				->set_block_name('core/columns')
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_columns {
			$this->get_setting( 'stack_active' )
				->set_title( __( 'Stack Columns', 'sv100' ) )
				->set_description( __( 'You may want to stack Columns on narrow viewports.', 'sv100' ) )
				->set_is_responsive(true)
				->set_default_value(array(
					'mobile'						=> 1,
					'mobile_landscape'				=> 1,
					'tablet'						=> 1,
					'tablet_landscape'				=> 0,
					'tablet_pro'					=> 0,
					'tablet_pro_landscape'			=> 0,
					'desktop'						=> 0
				))
				->load_type( 'checkbox' );

			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_default_value(array(
					'top'		=> '0',
					'right'		=> 'auto',
					'bottom'	=> '0',
					'left'		=> 'auto'
				))
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'spacing' )
				->set_title( __( 'Spacing', 'sv100' ) )
				->set_default_value(40)
				->load_type( 'number' );

			$this->get_setting( 'border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			$this->get_setting( 'single_padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'single_border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			return $this;
		}
		protected function register_scripts(): sv_block_columns {
			parent::register_scripts();

			// Register Styles
			$this->get_script( 'equal_height' )
				->set_is_gutenberg()
				->set_block_style(__('Equal Height', 'sv100'))
				->set_path( 'lib/css/styles/equal_height.css' );

			$this->get_script( 'fit_content' )
			     ->set_is_gutenberg()
			     ->set_block_style(__('Fit Content', 'sv100'))
			     ->set_path( 'lib/css/styles/fit_content.css' );

			return $this;
		}
	}