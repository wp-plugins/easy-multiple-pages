<?php
/*
Plugin Name: Easy Multiple Pages
Plugin URI: http://www.blog18.ro
Description: This plugins adds an button in the post editor that allows you to easily split post by pages and also adds link to pages in the post automaticly.
Version: 0.3
Author: Filip Pacurar
Author URI: http://www.filipac.net
Contributer: Alex Jishi
Contributer URI: http://jishi.ru
*/
/*  
Copyright 2009  Alexander Jishi Agapov  (email : alex@jishi.ru)
Copyright 2009  Filip Pacurar  (email : filip.pacurar@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
$singleonly = 0;

add_filter('the_content', 'b18_nextpage_show', 1);

function b18_nextpage_show($content) {
	global $wpdb, $post;
/* Former code by Filip	
if($singleonly){
	if (is_single())
		return $content.wp_link_pages(array("before" => "<p>Pagini:", "echo" => 0));
		}elseif(!$singleonly){
		return $content.wp_link_pages(array("before" => "<p>Pagini:", "echo" => 0));
		}
	else
*/
if ( !is_single() && !is_page() ) return $content; //."<P>it is NOT single<P>";
else {
	$return_content = $content; //."<P>it is single<P>";
	$return_content .= link_pages('<p>', '</p>', 'number', '', '', __('Page').' %');
	}
return $return_content;
}



function easy_multi_pages_addbuttons() {
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
	// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_easy_multi_pages_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_easy_multi_pages_button', 5);
	}
}

// used to insert button in wordpress 2.5x editor
function register_easy_multi_pages_button($buttons) {
	array_push($buttons, "separator", "easy_multi_pages");
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_easy_multi_pages_tinymce_plugin($plugin_array) {
	$plugin_array['easy_multi_pages'] = get_option('siteurl').'/wp-content/plugins/easy-multiple-pages/editor_plugin.js';	
	return $plugin_array;
}

function easy_multi_pages_change_tinymce_version($version) {
	return $version+=1;
}

// Modify the version when tinyMCE plugins are changed.
add_filter('tiny_mce_version', 'easy_multi_pages_change_tinymce_version');
// init process for button control
add_action('init', 'easy_multi_pages_addbuttons');
?>