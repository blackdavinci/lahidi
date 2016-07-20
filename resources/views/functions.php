<?php

//===================================================wizedesign==
//  FUNCTIONS
//===============================================================

include(get_template_directory() . '/includes/comment.php');
include(get_template_directory() . '/includes/setup.php');
include(get_template_directory() . '/includes/functions-menu.php');
include(get_template_directory() . '/includes/sidebar.php');
include(get_template_directory() . '/includes/social-counts.php');
include(get_template_directory() . '/includes/post-like.php');
include(get_template_directory() . '/includes/media.php');
include(get_template_directory() . '/includes/plugin-activation.php');

//===================================================wizedesign==
//  ADMIN POSTS
//===============================================================

include(get_template_directory() . '/admin/post.php');
include(get_template_directory() . '/admin/page.php');

//===================================================wizedesign==
//  WIDGETS
//===============================================================

include(get_template_directory() . '/includes/widgets/blog1.php');
include(get_template_directory() . '/includes/widgets/blog2.php');
include(get_template_directory() . '/includes/widgets/blog3.php');
include(get_template_directory() . '/includes/widgets/review.php');
include(get_template_directory() . '/includes/widgets/photo.php');
include(get_template_directory() . '/includes/widgets/video.php');
include(get_template_directory() . '/includes/widgets/social.php');
include(get_template_directory() . '/includes/widgets/like.php');
include(get_template_directory() . '/includes/widgets/youtube.php');
include(get_template_directory() . '/includes/widgets/vimeo.php');
include(get_template_directory() . '/includes/widgets/slider.php');
include(get_template_directory() . '/includes/widgets/flickr.php');
include(get_template_directory() . '/includes/widgets/soundcloud.php');
include(get_template_directory() . '/includes/widgets/advertising.php');
include(get_template_directory() . '/includes/widgets/twitter.php');

//===================================================wizedesign==
//  THEME OPTIONS
//===============================================================

if (!function_exists('of_get_option')) {
	function of_get_option($name, $default = false) {
	
		$optionsframework_settings = get_option('optionsframework');
		$option_name = $optionsframework_settings['id'];
	
		if ( get_option($option_name) ) {
		$options = get_option($option_name);
		}
		
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}

//===================================================wizedesign==
//  ENQUEUE SCRIPT & STYLE
//===============================================================

function sowe_enqueue_script() {
    $responsive = of_get_option('responsive_deactivate', '1');
    $type       = of_get_option('background_type', 'image');
    $menu       = of_get_option('menu_stays', '1');
    wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/backstretch.js', array('jquery'), false, true); //background
    wp_enqueue_script('carouFredSel', get_template_directory_uri() . '/js/carouFredSel.js', array('jquery'), false, true); //feature
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/flexslider.js', array('jquery'), false, true); //slider widget
    wp_enqueue_script('idTabs', get_template_directory_uri() . '/js/idTabs.js', array('jquery'), false, true); //tabs, toogle
	wp_enqueue_script('jRating', get_template_directory_uri() . '/js/jRating.js', array('jquery'), false, true); //review
    wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.js', array('jquery'), false, true); //grid layout
	wp_enqueue_script('revolution', get_template_directory_uri() . '/js/revolution.js', array('jquery'), false, true); //slider
	wp_enqueue_script('royal', get_template_directory_uri() . '/js/royal.js', array('jquery'), false, true); //gallery, video
    wp_enqueue_script('showbizpro', get_template_directory_uri() . '/js/showbizpro.js', array('jquery'), false, true); //news
    wp_enqueue_script('showbizpro-tools', get_template_directory_uri() . '/js/showbizpro-tools.js', array('jquery'), false, true);
	wp_enqueue_script('FWDRL', get_template_directory_uri() . '/js/FWDRL.js', array('jquery'), false, false); //photo, video lightbox
    wp_enqueue_script('sowe-script', get_template_directory_uri() . '/js/script.js', array('jquery'), false, true); //script
	wp_enqueue_script('sowe-JSFWDRL', get_template_directory_uri() . '/js/JSFWDRL.js', array('jquery'), false, true); //JSFWDRL
    if ($type == 'image') {
    wp_enqueue_script('sowe-JSbackstretch', get_template_directory_uri() . '/js/JSbackstretch.js', array('jquery'), false, true); //JSbackstretch
    }
    if ($menu == '1') {
    wp_enqueue_script('menu-top', get_template_directory_uri() . '/js/menu-top.js', array('jquery'), false, false); //menu top
    }
    if (!$responsive == '1') {
	wp_enqueue_script('responsive', get_template_directory_uri() . '/js/responsive.js', array('jquery'), false, true); //responsive
    }
}

function sowe_enqueue_style() {
    $responsive = of_get_option('responsive_deactivate', '1');
    wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('royal', get_template_directory_uri() . '/css/royal.css');
	wp_enqueue_style('hover', get_template_directory_uri() . '/css/hover.css');
	wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');
    wp_enqueue_style('slider', get_template_directory_uri() . '/css/slider.css');
	wp_enqueue_style('global', get_template_directory_uri() . '/css/content/global.css');
    if (!$responsive == '1') {
	wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
    }
}

add_action('wp_enqueue_scripts', 'sowe_enqueue_script');
add_action('wp_enqueue_scripts', 'sowe_enqueue_style');

//===================================================wizedesign==
//  ADMIN SCRIPT & STYLE
//===============================================================

function sowe_admin_script() {
    wp_enqueue_script('ui-js', get_template_directory_uri() . '/admin/post/js/ui.js');
    wp_enqueue_script('setup-js', get_template_directory_uri() . '/admin/post/js/setup.js');
    wp_enqueue_script('datepicker-js', get_stylesheet_directory_uri() . '/admin/post/js/datepicker.js');
    wp_enqueue_script('upload-js', get_stylesheet_directory_uri() . '/admin/post/js/upload.js');
}

function sowe_admin_style() {
    wp_register_style('admin', get_template_directory_uri() . '/admin/post/css/admin.css');
    wp_register_style('datepicker', get_template_directory_uri() . '/admin/post/css/datepicker.css');
    wp_enqueue_style('admin');
    wp_enqueue_style('datepicker');
}

add_action('admin_enqueue_scripts', 'sowe_admin_script');
add_action('admin_enqueue_scripts', 'sowe_admin_style');

//===================================================wizedesign==
//  GOOGLE FONTS
//===============================================================

function sowe_fonts_url() {
    $fonturl = '';
	$fontpri = of_get_option('font_primary');
    
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'sowe' ) ) {
        $fonturl = add_query_arg('family', urlencode('Montserrat|' . $fontpri . ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,400italic,900&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }
    return esc_url_raw($fonturl);
}

function sowe_font_scripts() {
    wp_enqueue_style('wize-fonts', sowe_fonts_url());
}

add_action('wp_enqueue_scripts', 'sowe_font_scripts');

//===================================================wizedesign==
//  CSS SKIN
//===============================================================

function sowe_customizer_css() {
    $url      = get_stylesheet_directory_uri() . '/images/patterns/';
    $font     = of_get_option('font_primary');
    $color    = of_get_option('color_picker');
    $type     = of_get_option('background_type', 'pattern');
    $opacity  = of_get_option('background_opacity');
    $patterns = of_get_option('patterns');
    $custom   = of_get_option('custom_css'); 
 
    echo '  
<style type="text/css">

/* --- font --- */
body, h1, h2, h3, h4, h5, h6, li, p, div  { font-family: "' . $font . '" }

/* --- text color --- */
a, #tmpbl1 a.info-read:hover, #tmpbl3 a.info-read:hover, #tmpbl4 a.info-read:hover, a.sng-aut-user:hover, .logged-in-as a:hover, .comment-author cite a:hover, .comment-meta a:hover, a.comment-edit-link:hover, .tmpbl1-wrap h2 a:hover, .tmpbl3-wrap h2 a:hover, .tmpbl4-wrap h2 a:hover, .footer-col .widget_calendar tbody>tr>td a, .feat-cover:hover h2 a, .footer-col .widget a:hover, .sng-links-prev:hover span a, .sng-links-next:hover span a, #author-info .author-description p.url a { color: ' . $color . ' }

/* --- background color --- */
ul.contactform #submitmail:hover, .info-cat, .snggreat-cat, .sng-cat, .form-submit #submit:hover, .reply a:hover, .widget_calendar tfoot>tr>td#prev a:hover, .widget_calendar tfoot>tr>td#next a:hover, .news-cat, .feat-cat, .pagination a:hover, .sng-pagination a span:hover, .sldbig-cat, .sldleft-cat, .sldtb-cat, .tagcloud a:hover, .highlight, .button-link a, ul.tabs li a, form > p > input, .accordion, .sng-tag a:hover, .sngmedia-cat, .tmprw-cat, .tmpmedia-cat, .rwgreat-cat, .jRatingColor, .videoGallery .rsThumb:hover, .page-title-cat span, .page-cover-cat span, a.sng-aut-url:hover, .footer-col .widget_tag_cloud .tagcloud a:hover, .wd-tmpbl3-cat, .wpcf7-form input.wpcf7-submit:hover { background: ' . $color . ' }

/* --- other --- */  
.widget_search #search-button:hover, .footer-col .widget_search #search-button { background: ' . $color . ' url("' . get_stylesheet_directory_uri() . '/images/searchB.png") }
.rsDefault .rsCloseVideoIcn:hover { background: ' . $color . ' url("' . get_stylesheet_directory_uri() . '/images/close.png") }
.rsDefault .rsFullscreenIcn:hover { background: ' . $color . ' url("' . get_stylesheet_directory_uri() . '/images/extend.png") }
#contback { background: rgba(0, 0, 0, ' . $opacity . ') }
';

    if ($type == 'pattern') {
        echo 'body { background: url("' . $url . '' . $patterns . '.png") }
    ';
    }
    
    echo ' ' . $custom . ' 
</style>

';
}

add_action('wp_head', 'sowe_customizer_css');

//===================================================wizedesign==
//  SEARCH
//===============================================================

function sowe_search_form($form) {
    $form = '
<form role="search" method="get" id="searchform" action="' . esc_url(home_url('/')) . '">
    <div>
		<input id="searchinput" name="s" type="text" placeholder="' . esc_html__('search here...', 'sowe') . '" />
		<input type="submit" class="button1" id="search-button" value="" /> 
    </div>
</form>';
 
    return $form;
}

add_filter('get_search_form', 'sowe_search_form');

function sowe_extra_search_form() {
	echo '	
<div id="search-header">	
	<form id="searchforms" method="get">
		<input id="submit" value="" type="submit">
		<label for="submit" class="submit"></label>
		<a href="javascript: void(0)" class="iconsearh"></a>
		<input type="search" name="s" id="search" placeholder="' . esc_html__('search here...', 'sowe') . '">
	</form>
</div><!-- END#search-header -->';
}

//===================================================wizedesign==
//  TITLE
//===============================================================

function sowe_slug_setup() {
	add_theme_support( 'title-tag' );
}

add_action('after_setup_theme', 'sowe_slug_setup');

//===================================================wizedesign==
//  EXCERPT
//===============================================================

function sowe_excerpt_length($length) {
    return 120;
}

function sowe_excerpt_more($excerpt) {
    return str_replace('...', '...', $excerpt);
}

add_filter('excerpt_length', 'sowe_excerpt_length', 999);
add_filter('wp_trim_excerpt', 'sowe_excerpt_more');

function sowe_excerpt($limit, $source = null) {
    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

//===================================================wizedesign==
//  PAGE NAVIGATION
//===============================================================

function sowe_pagination($pages = '', $range = 4) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo '
	<div id="pagination-posts">';
        echo "<div class=\"pagination\">";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'>&laquo; First</a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; Previous</a>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<span class=\"current\">" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\">Next &rsaquo;</a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'>Last &raquo;</a>";
        echo "</div>\n";
        echo '	
	</div><!-- END#pagination-posts -->';
    }
}

//===================================================wizedesign==
//  TAGCLOUD FONT SIZE
//===============================================================

function sowe_tag($args = array()) {
    $args['smallest'] = 14;
    $args['largest']  = 14;
    $args['unit']     = 'px';
    return $args;
}

add_filter('widget_tag_cloud_args', 'sowe_tag', 90);

//===================================================wizedesign==
//  VIEWS
//===============================================================

function sowe_get_views($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count . '';
}

function sowe_set_views($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//===================================================wizedesign==
//  PREVIOUS AND NEXT LINK
//===============================================================

function sowe_posts_prev($format) {
    $format = str_replace('href=', 'class="prev" href=', $format);
    return $format;
}

function sowe_posts_next($format) {
    $format = str_replace('href=', 'class="next" href=', $format);
    return $format;
}

add_filter('previous_post_link', 'sowe_posts_prev');
add_filter('next_post_link', 'sowe_posts_next');

//===================================================wizedesign==
//  READING TIME
//===============================================================

function sowe_reading_time() { 
    $post    = get_post();
    $words   = str_word_count(strip_tags($post->post_content));
    $minutes = floor($words / 120);
    $seconds = floor($words % 120 / (120 / 60));
     
    if (1 <= $minutes) {
        
        $estimated_time = $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ' read';
    } else {
        $estimated_time = $seconds . ' second' . ($seconds == 1 ? '' : 's') . ' read';
    }
    
    return $estimated_time;
    
}

//===================================================wizedesign==
//  LANGUAGES poEDIT
//===============================================================

function sowe_theme_init() {
    load_theme_textdomain('sowe', get_template_directory() . '/languages');
}
add_action('init', 'sowe_theme_init');

//===================================================wizedesign==
//  NUMBER FORMAT
//===============================================================

function sowe_number($number) {
    $units = array(
        '',
        'K',
        'M',
        'B'
    );
    $power = $number > 0 ? floor(log($number, 1000)) : 0;
    if ($power > 0)
        return @number_format($number / pow(1000, $power), 1, '.', ' ') . ' ' . $units[$power];
    else
        return @number_format($number / pow(1000, $power), 0, '', '');
}

//===================================================wizedesign==
//  REVIEW
//===============================================================

function sowe_review_sng($content) {
    global $post;
    $metadata = get_post_meta($post->ID, 'name', true);
    foreach ((array) $metadata as $meta) {
        $content .= '
		<div class="sngrw-rw">
			<div class="sngrw-rw-title">' . $meta['title'] . '</div>
			<div class="sngrw-rw-rating" data-average="' . $meta['note'] . '"></div>
			<div class="sngrw-rw-score">' . $meta['note'] . '</div>
		</div><!-- END.sngrw-rvw -->';
    }
    return $content;
}

function sowe_review_tmp($content) {
    global $post;
    $metadata = get_post_meta($post->ID, 'name', true);
    foreach ((array) $metadata as $meta) {
        $content .= '
		<div class="tmprw-rw">
			<div class="tmprw-rw-title">' . $meta['title'] . '</div>
			<div class="tmprw-rw-rating" data-average="' . $meta['note'] . '"></div>
			<div class="tmprw-rw-score">' . $meta['note'] . '</div>
		</div><!-- END.tmprw-rvw -->';
    }
    return $content;
}

function sowe_score_note($content) {
    global $post;
    $metadata = get_post_meta($post->ID, 'name', true);
    $total    = 0;
    foreach ((array) $metadata as $meta) {
        $total = $total + $meta['note'];
    }
    return $total;
}

function sowe_score_final($content) {
    global $post;
    $metadata = get_post_meta($post->ID, 'name', true);
    return sowe_score_note($content) / count($metadata);
}

function sowe_score_number($var) {
    if (($var / 1) > 1) {
        $retVal = round($var / 1, 1);
    }
    return $retVal;
}

//----------------------------- WORDPRESS FIX BACKSLASHES ---------------------------------------// 
 

if ( get_magic_quotes_gpc() ) {
$_POST = array_map( ‘stripslashes_deep’, $_POST );
$_GET = array_map( ‘stripslashes_deep’, $_GET );
$_COOKIE = array_map( ‘stripslashes_deep’, $_COOKIE );
$_REQUEST = array_map( ‘stripslashes_deep’, $_REQUEST );
} 
