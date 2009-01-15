<?php
/*
Plugin Name: Pagini Multiple
Plugin URI: http://www.blog18.ro
Description: This plugins adds an button in the post editor that allows you to easily split post by pages and also adds link to pages in the post automaticly.
Version: 0.1
Author: Filip Pacurar
Author URI: http://www.filipac.net
*/
/*  Copyright 2009  Filip Pacurar  (email : filip.pacurar@gmail.com)

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
function b18_nextpage_add() {
	if (strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php')) {
echo <<<b18
	<script type="text/javascript">//<![CDATA[
	var toolbar = document.getElementById("ed_toolbar");
	if (toolbar) {
		var theButton = document.createElement('input');
		theButton.type = 'button';
		theButton.value = 'Pagina urmatoare';
		theButton.onclick = b18_nextpage_handler;
		theButton.className = 'ed_button';
		theButton.title = "Imparte continutul pe mai multe pagini.";
		theButton.id = "ed_paginaurmatoare";
		toolbar.appendChild(theButton);
	}
	var state_my_button = true;

function b18_nextpage_handler() {
	if (state_my_button) {
			b18_nextpage = '<!--nextpage-->';
			edInsertContent(edCanvas, b18_nextpage); 
	}
}
//]]></script>
b18;
	} }
add_filter('admin_footer', 'b18_nextpage_add');
add_filter('the_content', 'b18_nextpage_show',1);
function b18_nextpage_show($content) {
	global $wpdb, $post;
	if (is_single())
		return $content.wp_link_pages(array("before" => "<p>Pagini:", "echo" => 0));
	else
		return $content;
}

?>