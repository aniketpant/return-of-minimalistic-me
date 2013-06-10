<?php
/**
 * The Return of Minimalistic Me Theme Options
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since The Return of Minimalistic Me 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 *
 * @since The Return of Minimalistic Me 1.0
 *
 */
function retmin_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'retmin-theme-options', get_stylesheet_directory_uri() . '/inc/theme-options.css', false, '2011-04-28' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'retmin_admin_enqueue_scripts' );

/**
 * Register the form setting for our retmin_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, retmin_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are complete, properly
 * formatted, and safe.
 *
 * We also use this function to add our theme option if it doesn't already exist.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_theme_options_init() {

	// If we have no options in the database, let's add them now.
	if ( false === retmin_get_theme_options() )
		add_option( 'retmin_theme_options', retmin_get_default_theme_options() );

	register_setting(
		'retmin_options',       // Options group, see settings_fields() call in retmin_theme_options_render_page()
		'retmin_theme_options', // Database option, see retmin_get_theme_options()
		'retmin_theme_options_validate' // The sanitization callback, see retmin_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see retmin_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'about me',  // Unique identifier for the field for this section
		__( 'About Me', 'retmin' ), // Setting field label
		'retmin_settings_field_about_me', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see retmin_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'retmin_theme_options_init' );

/**
 * Change the capability required to save the 'retmin_options' options group.
 *
 * @see retmin_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see retmin_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * By default, the options groups for all registered settings require the manage_options capability.
 * This filter is required to change our theme options page to edit_theme_options instead.
 * By default, only administrators have either of these capabilities, but the desire here is
 * to allow for finer-grained control for roles and users.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function retmin_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_retmin_options', 'retmin_option_page_capability' );

/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'retmin' ),   // Name of page
		__( 'Theme Options', 'retmin' ),   // Label in menu
		'edit_theme_options',                    // Capability required
		'theme_options',                         // Menu slug, used to uniquely identify the page
		'retmin_theme_options_render_page' // Function that renders the options page
	);

	if ( ! $theme_page )
		return;

	add_action( "load-$theme_page", 'retmin_theme_options_help' );
}
add_action( 'admin_menu', 'retmin_theme_options_add_page' );

function retmin_theme_options_help() {

	$help = '<p>' . __( 'Some themes provide customization options that are grouped together on a Theme Options screen. If you change themes, options may change or disappear, as they are theme-specific. Your current theme, The Return of Minimalistic Me, provides the following Theme Options:', 'retmin' ) . '</p>' .
			'<ol>' .
				'<li>' . __( '<strong>About Me Text</strong>: This text will display on the main page.', 'retmin' ) . '</li>' .
			'</ol>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'retmin' ) . '</p>';

	$sidebar = '<p><strong>' . __( 'For more information:', 'retmin' ) . '</strong></p>' .
		'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Theme_Options_Screen" target="_blank">Documentation on Theme Options</a>', 'retmin' ) . '</p>' .
		'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>', 'retmin' ) . '</p>';

	$screen = get_current_screen();

	if ( method_exists( $screen, 'add_help_tab' ) ) {
		// WordPress 3.3
		$screen->add_help_tab( array(
			'title' => __( 'Overview', 'retmin' ),
			'id' => 'theme-options-help',
			'content' => $help,
			)
		);

		$screen->set_help_sidebar( $sidebar );
	} else {
		// WordPress 3.2
		add_contextual_help( $screen, $help . $sidebar );
	}
}

/**
 * Returns the default options for The Return of Minimalistic Me.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_get_default_theme_options() {
	$default_theme_options = array(
		'about_me' => ''
	);

	return apply_filters( 'retmin_default_theme_options', $default_theme_options );
}

/**
 * Returns the options array for The Return of Minimalistic Me.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_get_theme_options() {
	return get_option( 'retmin_theme_options', retmin_get_default_theme_options() );
}

/**
 * Returns the About Me for The Return of Minimalistic Me.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_get_about_me() {
	$options = retmin_get_theme_options();
	$about_me = $options['about_me'];

	return $about_me;
}

/**
 * Renders the About Me setting field.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_settings_field_about_me() {
	$options = retmin_get_theme_options();

	?>
	<div class="about-me">
            <textarea name="retmin_theme_options[about_me]"><?php echo esc_attr( $options['about_me'] ); ?></textarea>
	</div>
	<?php
}

/**
 * Returns the options array for The Return of Minimalistic Me.
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'retmin' ), wp_get_theme('return-of-minimalistic-me') ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'retmin_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @see retmin_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since The Return of Minimalistic Me 1.0
 */
function retmin_theme_options_validate( $input ) {
	$output = $defaults = retmin_get_default_theme_options();

        $output['about_me'] = $input['about_me'];

	return apply_filters( 'retmin_theme_options_validate', $output, $input, $defaults );
}