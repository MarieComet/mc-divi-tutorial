<?php

class MCDT_CompareTabItem extends ET_Builder_Module {

	public $slug       = 'mcdt_compare_tab_item';
	public $vb_support = 'on';
	public $type = 'child';
	public $debug_module = true;
					
	public function remove_from_local_storage() {
		global $debug_module; 
		echo "<script>localStorage.removeItem('et_pb_templates_".esc_attr($this->slug)."');</script>";
	}

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Marie Comet',
		'author_uri' => 'https://mariecomet.fr',
	);

	/*
	* Paramètres généraux du module
	*/
	public function init() {

		// à retirer en prod
		$debug_module = true;

		if (is_admin()) {
			// Clear module from cache if necessary
			if ($debug_module) { 
				add_action('admin_head', array( $this, 'remove_from_local_storage' ) );
			}
		}
		// à retirer en prod

		// Nom du module
		$this->name = esc_html__( 'Tab item', 'mcdt-mc-divi-tutorial' );
		// Icone
		$this->icon_path =  plugin_dir_path( __FILE__ ) . 'sun.svg';
		// Classe CSS principale
		$this->main_css_element = '%%order_class%%';

		// définir les sections et les sous sections (toggles) par onglet
		$this->settings_modal_toggles  = array(
			// Natif
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Texte', 'mcdt-mc-divi-tutorial' ),
				),
			),
		);

	}

	/*
	* Définir les champs du module
	*/
	public function get_fields() {
		return array(
			'title' => array(
				'label'           => esc_html__( 'Titre', 'mcdt-mc-divi-tutorial' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear as title.', 'mcdt-mc-divi-tutorial' ),
				'toggle_slug'     => 'main_content',
				'tab_slug'		  => 'general', // notre onglet custom
			),
			'content' => array(
				'label'           => esc_html__( 'Content', 'mcdt-mc-divi-tutorial' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'mcdt-mc-divi-tutorial' ),
				'toggle_slug'     => 'main_content',
				'tab_slug'		  => 'general',
				// permet de récupérer la valeur de l'option 'show_option' du parent
				'show_if'   => array( 'parentModule:show_option' => 'on')
			),
		);
	}

	/*
	* Affichage du contenu
	*/
	public function render( $attrs, $content = null, $render_slug ) {

		// récupérer notre variable globale (parent)
		global $compare_tab_show_option;

		$title = $this->props['title'];
		$content = $this->props['content'];

		if ( '' !== $title ) {
			$title = sprintf( '<h1>%1$s</h1>', $title );
		}

		if ( 'off' !== $compare_tab_show_option ) {
			$content = sprintf( '<p class="content">%1$s</p>', $content );
		} else {
			$content = '';
		}

		$output = sprintf(
			'%1$s
			%2$s',
			$title,
			$content
		);

		return $output;
	}
}

new MCDT_CompareTabItem;
