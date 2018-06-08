<?php

class MCDT_HelloWorld extends ET_Builder_Module {

	public $slug       = 'mcdt_hello_world';
	public $vb_support = 'on';
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

	public function get_main_tabs() {
		$tabs = array(
			'general'    => esc_html__( 'Content', 'et_builder' ),
			'advanced'   => esc_html__( 'Design', 'et_builder' ),
			'custom_css' => esc_html__( 'Advanced', 'et_builder' ),
			'custom_tab' => esc_html__( 'Custom tab', 'mcdt-mc-divi-tutorial' ),
		);
		return $tabs;
	}

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
		$this->name = esc_html__( 'Hello World', 'mcdt-mc-divi-tutorial' );
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
			// custom
			'custom_tab'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Titre', 'mcdt-mc-divi-tutorial' ),
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
				'tab_slug'		  => 'custom_tab', // notre onglet custom
			),
			'content' => array(
				'label'           => esc_html__( 'Content', 'mcdt-mc-divi-tutorial' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'mcdt-mc-divi-tutorial' ),
				'toggle_slug'     => 'main_content',
				'tab_slug'		  => 'general',
			),
		);
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

new MCDT_HelloWorld;
