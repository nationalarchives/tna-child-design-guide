<?php


/*
 *
 * ================================================
 *    Override unneeded functions from parent
 * ================================================
 *
 */

function tnatheme_globals() {
    global $pre_path;
    global $pre_crumbs;
    $headers = apache_request_headers();
    if ( isset($_SERVER['HTTP_X_NGINX_PROXY']) && isset($headers['X_HOST_TYPE']) && $headers['X_HOST_TYPE'] == 'public' ) {
        $pre_crumbs = array(
            'Design guide' => '/design-guide/'
        );
        $pre_path = '/design-guide';
    } elseif (substr($_SERVER['REMOTE_ADDR'], 0, 3) === '10.') {
        $pre_path = '';
        $pre_crumbs = array(
            'Design guide' => '/'
        );
    } else {
        $pre_crumbs = array(
            'Design guide' => '/design-guide/'
        );
        $pre_path = '/design-guide';
    }
}
if ( $_SERVER['SERVER_ADDR'] !== $_SERVER['REMOTE_ADDR'] ) {
    tnatheme_globals(); } else {
    $pre_path = '';
    $pre_crumbs = array(
        'Design guide' => '/'
    );
}
function dequeue_parent_style() {
    wp_dequeue_style('tna-styles');
    wp_deregister_style('tna-styles');
}
add_action( 'wp_enqueue_scripts', 'dequeue_parent_style', 9999 );
add_action( 'wp_head', 'dequeue_parent_style', 9999 );

// Enqueue styles
function tna_child_styles() {
    wp_register_style( 'tna-parent-styles', get_template_directory_uri() . '/css/base-sass.min.css', array(), EDD_VERSION, 'all' );
    wp_register_style( 'tna-child-styles', get_stylesheet_directory_uri() . '/style.css', array(), '0.1', 'all' );
    wp_enqueue_style( 'tna-parent-styles' );
    wp_enqueue_style( 'tna-child-styles' );
}
add_action( 'wp_enqueue_scripts', 'tna_child_styles' );



// functions specific to Design Guide child theme
/**
 * Embed Gists with a URL
 *
 * Usage:
 * Paste a gist link into a blog post or page and it will be embedded eg:
 * https://gist.github.com/username/fde1c809c01b0cfbf8f3cef339e4bd79
 *
 * If a gist has multiple files you can select one using a url in the following format:
 * https://gist.github.com/2926827?file=embed-gist.php
 *
 */

wp_embed_register_handler( 'gist', '/https?:\/\/gist\.github\.com\/([a-z0-9]+)(\?file=.*)?/i', 'bhww_embed_handler_gist' );

function bhww_embed_handler_gist( $matches, $attr, $url, $rawattr ) {

    $embed = sprintf(
        '<script src="https://gist.github.com/%1$s.js%2$s"></script>',
        esc_attr($matches[1]),
        esc_attr($matches[2])
    );

    return apply_filters( 'embed_gist', $embed, $matches, $attr, $url, $rawattr );

}

// Embeds HTML form code into page via shortcode without
function form_meta_boxes() {
        $meta_boxes[] = array (
            'id' => 'embed-form-code',
            'title' => 'Embed HTML form via shortcode',
            'pages' => 'page',
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Paste your HTML here',
                    'desc' => 'Use [form-code] shortcode to embed the form HTML into the page',
                    'id' => 'form_code',
                    'type' => 'textarea',
                    'std' => ''
                )
            )
        );
        // Adds meta box to page
        foreach ( $meta_boxes as $meta_box ) {
            $form_box = new CreateMetaBox( $meta_box );
        }
}
add_action( 'init', 'form_meta_boxes' );

// [form-code]
function embed_form() {
    global $post;
    $code = get_post_meta( $post->ID, 'form_code', true );
    if ($code) {
        return $code;
    }
}
add_shortcode( 'form-code', 'embed_form' );



