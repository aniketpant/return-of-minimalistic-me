<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
    - enqueueing scripts & styles
    - theme support functions
    - custom menu output & fallbacks
    - related post function
    - page-navi function
    - removing <p> from around images
    - customizing the post excerpt
    - custom google+ integration
    - adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => __('Sidebar 1', 'bonestheme'),
        'description' => __('The first (primary) sidebar.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    /*
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call
    your new sidebar just use the following code:

    Just change the name to whatever your new
    sidebar's id is, for example:

    register_sidebar(array(
        'id' => 'sidebar2',
        'name' => __('Sidebar 2', 'bonestheme'),
        'description' => __('The second (secondary) sidebar.', 'bonestheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php

    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="clearfix">
            <header class="comment-author vcard">
                <?php
                /*
                    this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
                    echo get_avatar($comment,$size='32',$default='<path_to_url>' );
                */
                ?>
                <!-- custom gravatar call -->
                <?php
                    // create variable
                    $bgauthemail = get_comment_author_email();
                ?>
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
                <!-- end custom gravatar call -->
                <?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
                <?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="alert alert-info">
                    <p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
                </div>
            <?php endif; ?>
            <section class="comment_content clearfix">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

// Custom Functions

add_action( 'after_setup_theme', 'retmin_setup' );

if ( ! function_exists( 'retmin_setup' ) ):

    function retmin_setup() {

	// Load up our theme options page and related code.
	require( get_stylesheet_directory() . '/inc/theme-options.php' );

    }

endif;

/*
 * Disable self trackbacks
 */
function disable_self_ping( &$links ) {
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, get_option( 'home' ) ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'disable_self_ping' );

/*
 * Get latest post
 */
function get_latest_post() {
        $args = array(
        'numberposts' => 1,
        'offset' => 0,
        'category' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish',
        'suppress_filters' => true );
	$recent_posts = wp_get_recent_posts($args);
	foreach( $recent_posts as $recent ){
		echo _e('Read my last post: &ldquo;<a href="' . get_permalink($recent["ID"]) . '" title="Read &ldquo;'.esc_attr($recent["post_title"]).'&rdquo;" >' .   $recent["post_title"].'</a>&rdquo;');
	}
}

/*
 * Add support for shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');

/*
 * Register new post type - Example
 */

register_post_type('example', array(	'label' => 'Examples','description' => 'For adding examples.','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,'has_archive' => true,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'taxonomies' => array('post_tag',),'labels' => array (
  'name' => 'Examples',
  'singular_name' => 'Example',
  'menu_name' => 'My Examples',
  'add_new' => 'Add New',
  'add_new_item' => 'Add New Example',
  'edit' => 'Edit',
  'edit_item' => 'Edit Example',
  'new_item' => 'New Example',
  'view' => 'View Example',
  'view_item' => 'View Example',
  'search_items' => 'Search Examples',
  'not_found' => 'No Examples Found',
  'not_found_in_trash' => 'No Examples found in Trash',
  'parent' => 'Parent Example',
),) );

/*
 * Text based funtions
 */

function about_me_text() {
    return retmin_get_about_me();
}

function info_on_me() {
    echo _e('<ul class="my_info">');
    echo _e('<li><strong><a href="'.site_url().'/blog/">Check out my blog</a></strong></li>');
    echo _e('<li><a href="'.site_url().'/about-me/">Read more about me</a></li>');
    echo _e('<li>The <a href="'.site_url().'/archives/">graveyard of my growing posts</a></li>');
    echo _e('<li>Follow me on twitter <a href="http://twitter.com/aniket_pant/">@aniket_pant</a></li>');
    echo _e('</ul>');
}

function previous_next_post() {
    echo _e('<nav class="post_navigation">');
    if (previous_post_link('<p class="alignleft"><span>Previous Post:</span> %link</p>')) :
    endif;
    if (next_post_link('<p class="alignright"><span>Next Post:</span> %link</p>')) :
    endif;
    echo _e('</nav>');
}

function list_categories() {
    $args = array(
        'orderby'   => 'name',
        'order'     => 'asc'
    );
    $categories = get_categories($args);
    foreach ($categories as $category) {
        echo _e('<li><a href="'.get_category_link( $category->term_id ).'" title="View all posts in '.$category->name.'">'.$category->name.'</a></li>');
    }
}

function twitter_follow() {
    $arr_quotes = array(
        0   => 'After reading all of it, I bet you want to follow me on twitter too!',
        1   => 'I have a feeling that you are going to love my tweets too.',
        2   => 'You are amazing. Click this button and say hi to me!',
        3   => 'Are you thinking of clicking this button?'
    );
    $rand_num = rand(0, count($arr_quotes) - 1);
    echo _e('<a href="https://twitter.com/aniket_pant" class="follow-twitter btn blue" target="_blank"><span>'.$arr_quotes[$rand_num].'</span></a>');
}

/*
 * Shortcodes
 */

function side_note( $attr, $content = null ) {
  return '<p class="sidenote">' . $content . '</p>';
}
add_shortcode('sidenote', 'side_note');

function view_demo( $attr, $link = null ) {
  return '<p class="alignright"><a href="' . $link . '" class="view_demo btn orangeyellow" target="_blank">View Demo</a></p>';
}
add_shortcode('demo', 'view_demo');

function print_hndiscuss( $attr, $link = null ) {
  return '<p class="sidenote">If you liked my post, then it would be great if you <a href="' . $link . '" class="discuss-hn" target="_blank">upvote it on HN</a>.</p>';
}
add_shortcode('hndiscuss', 'print_hndiscuss');

add_shortcode('about_me_info', 'about_me_text');

register_sidebar(array(
 	'id' => 'sidebar_home',
 	'name' => 'Sidebar Home',
    	'description' => 'Sidebar for the home page.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
 ));
register_sidebar(array(
 	'id' => 'sidebar_page',
 	'name' => 'Sidebar Page',
    	'description' => 'Sidebar for pages only.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
 ));
register_sidebar(array(
 	'id' => 'footer_area_1',
 	'name' => 'Footer Area 1',
    	'description' => 'The first (secondary) footer sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
 ));
register_sidebar(array(
 	'id' => 'footer_area_2',
 	'name' => 'Footer Area 2',
    	'description' => 'The second (secondary) footer sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
 ));
register_sidebar(array(
 	'id' => 'footer_area_3',
 	'name' => 'Footer Area 3',
    	'description' => 'The third (secondary) footer sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
 ));

?>