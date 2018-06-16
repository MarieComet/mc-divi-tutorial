<?php

class MCDT_CompareTab extends ET_Builder_Module {

	public $slug       = 'mcdt_compare_tab';
	public $vb_support = 'on';
	public $child_slug = 'mcdt_compare_tab_item';
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
		$this->name = esc_html__( 'A Tab', 'mcdt-mc-divi-tutorial' );
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
			'show_option' => array(
				'label'           	=> esc_html__( 'Show option', 'plugin_domain' ),
				'type'            	=> 'yes_no_button',
				'option_category' 	=> 'configuration',
				'options'         	=> array(
					'off'  	=> esc_html__( 'Off', 'plugin_domain' ),
					'on' 	=> esc_html__( 'On', 'plugin_domain' ),
				),
				'toggle_slug'     => 'main_content',
				'tab_slug'		  => 'general',
			),
		);
	}

	function before_render() {

		// définir une variable globale
		global $compare_tab_show_option;
		// définir notre variable sur l'option choisie
		$compare_tab_show_option = $this->props['show_option'];

	}

	/*
	* Affichage du contenu
	*/
	public function render( $attrs, $content = null, $render_slug ) {

		$title = $this->props['title'];
		$content = $this->props['content'];

		if ( '' !== $title ) {
			$title = sprintf( '<h1>%1$s</h1>', $title );
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

new MCDT_CompareTab;
