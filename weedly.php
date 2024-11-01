<?php

/**
 * Plugin Name: Weedly
 * Plugin URI:  https://weedly.green/
 * Description: This plugin uses iframes to display regional Weedly content directly on your own WordPress website with easy to use shortcodes, and currently supports the following Weedly websites:
 * Version:     1.0
 * Author:      Meristem
 * Author URI:  https://www.meristemcreative.com/
 * Text Domain: weedly
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

global $post;

add_action('wp_enqueue_scripts', 'weedly_enq_styles');

function weedly_enq_styles()
{

    wp_enqueue_script('weedly-events-js', plugins_url('/assets/script.js', __FILE__) , array() , '1.0');
    wp_enqueue_script('weedly-iframeResizer-js', plugins_url('/assets/iframeResizer.min.js', __FILE__) , array() , '4.1.1');

}

function weedly_iframe_func($atts)
{

    $get_attr = shortcode_atts(array(

        'type' => 'events',
		
        'display' => 'tiles',

        'region' => '',

    ) , $atts);

	if($get_attr['type'] == 'events'){
		
    if ($get_attr['region'] == 'phoenix')
    {

        if ($get_attr['display'] == 'tiles')
        {

            $html = '<iframe id="wiframe" frameborder="0" scrolling="no" style="overflow:hidden" height="100%" width="100%" src="https://phoenix.weedly.green/community-events-tiles/"></iframe>';

        }

        elseif ($get_attr['display'] == 'list')
        {

            $html = '<iframe id="wiframe" frameborder="0" scrolling="no" style="overflow:hidden" height="100%" width="100%" src="https://phoenix.weedly.green/community-events-list/"></iframe>';

        }

        else
        {

            $html = '';

        }
    }
    else
    {
        $html = 'Please select region';
    }
	
	}
	else{
        $html = 'Please select Type';
		
	}

    return $html;

}

add_shortcode('weedly', 'weedly_iframe_func');