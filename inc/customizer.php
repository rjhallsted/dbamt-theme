<?php
/**
 * Dream Big and Make Things Theme 1.0 Theme Customizer
 *
 * @package Dream Big and Make Things Theme 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function dbamt_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Adds textarea support to the theme customizer
	 */
	class Dbamt_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}

	$wp_customize->add_setting( 'homepage_message' );
	$wp_customize->add_control( new Dbamt_Customize_Textarea_Control( $wp_customize, 'homepage_message', array(
	    'label'   => 'Homepage Message',
	    'section' => 'title_tagline',
	    'settings'   => 'homepage_message',
	) ) );
	$wp_customize->get_setting( 'homepage_message' )->transport = 'postMessage';
	 
}
add_action( 'customize_register', 'dbamt_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function dbamt_customize_preview_js() {
	wp_enqueue_script( 'dbamt_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'dbamt_customize_preview_js' );