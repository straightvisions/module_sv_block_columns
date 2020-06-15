<?php
	namespace sv100;

	/**
	 * @version         4.000
	 * @author			straightvisions GmbH
	 * @package			sv100
	 * @copyright		2019 straightvisions GmbH
	 * @link			https://straightvisions.com
	 * @since			1.000
	 * @license			See license.txt or https://straightvisions.com
	 */

	class sv_block_columns extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Columns', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->load_settings()
				->register_scripts()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_type( 'settings' )
				->set_section_template_path( $this->get_path( 'lib/backend/tpl/settings.php' ) )
				->set_section_order(120)
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_columns {
			$this->get_setting( 'stack_active' )
				->set_title( __( 'Stack Columns', 'sv100' ) )
				->set_description( __( 'You may want to stack Columns on narrow viewports.', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'checkbox' );

			$this->get_setting( 'margin' )
				->set_title( __( 'Margin', 'sv100' ) )
				->set_default_value(array(
					'top'		=> '0',
					'right'		=> 'auto',
					'bottom'	=> '20px',
					'left'		=> 'auto'
				))
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'padding' )
				->set_title( __( 'Padding', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'margin' );

			$this->get_setting( 'border' )
				->set_title( __( 'Border', 'sv100' ) )
				->set_is_responsive(true)
				->load_type( 'border' );

			return $this;
		}

		protected function register_scripts(): sv_block_columns {
			$this->get_script('block')
				->set_path('lib/backend/js/block.js')
				->set_type('js')
				->set_is_gutenberg()
				->set_is_backend()
				->set_deps(array('wp-blocks', 'wp-dom'))
				->set_is_enqueued();

			// Register Styles
			$this->get_script( 'common' )
				->set_is_gutenberg()
				->set_path( 'lib/frontend/css/common.css' );

			$this->get_script( 'config' )
				->set_is_gutenberg()
				->set_path( 'lib/frontend/css/config.php' )
				->set_inline( true );

			add_action('wp', array($this,'enqueue_scripts'));
			add_action('admin_init', array($this,'enqueue_scripts'));

			return $this;
		}
		public function enqueue_scripts(): sv_block_columns {
			if(!$this->has_block_frontend('columns')){
				return $this;
			}

			$this->get_script( 'common' )->set_is_enqueued();
			$this->get_script( 'config' )->set_is_enqueued();

			return $this;
		}
	}