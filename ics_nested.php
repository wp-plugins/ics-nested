<?php
/*
Plugin Name: Nested image caption shortcode
Plugin URI: 
Description: Allows caption shortcode to have shortcodes
Version: 1.0
Author: tychay
Author URI: http://terrychay.com/
License: GPL v2.0 or newer
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function ics_nested_filter( $html, $attr, $content ) {
    $atts = shortcode_atts( array(
        'id'      => '',
        'align'   => 'alignnone',
        'width'   => '',
        'caption' => '',
        'class'   => '',
    ), $attr, 'caption' );
 
    $atts['width'] = (int) $atts['width'];
    if ( empty( $atts['caption'] ) ) {
    	return do_shortcode( $content );
    }
    // patch the fact that the original prunes out caption
    if ( $atts['width'] < 1 ) {
        return do_shortcode( $content . ' ' . $atts['caption'] );
        // not perfect because we lost everything before $content and also the
        // trim removed stuff.
    }

    if ( ! empty( $atts['id'] ) )
        $atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
 
    $class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );
 
    if ( current_theme_supports( 'html5', 'caption' ) ) {
        return '<figure ' . $atts['id'] . 'style="width: ' . (int) $atts['width'] . 'px;" class="' . esc_attr( $class ) . '">'
        . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . do_shortcode( $atts['caption'] ) . '</figcaption></figure>';
    }
 
    $caption_width = 10 + $atts['width'];
 
    /**
     * Filter the width of an image's caption.
     *
     * By default, the caption is 10 pixels greater than the width of the image,
     * to prevent post content from running up against a floated image.
     *
     * @since 3.7.0
     *
     * @see img_caption_shortcode()
     *
     * @param int    $caption_width Width of the caption in pixels. To remove this inline style,
     *                              return zero.
     * @param array  $atts          Attributes of the caption shortcode.
     * @param string $content       The image element, possibly wrapped in a hyperlink.
     */
    $caption_width = apply_filters( 'img_caption_shortcode_width', $caption_width, $atts, $content );
 
    $style = '';
    if ( $caption_width )
        $style = 'style="width: ' . (int) $caption_width . 'px" ';
 
    return '<div ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
    . do_shortcode( $content ) . '<p class="wp-caption-text">' . do_shortcode( $atts['caption'] ) . '</p></div>';
}

// run a little earlier so other processors can do their thang.
add_filter( 'img_caption_shortcode', 'ics_nested_filter', 5, 3 );