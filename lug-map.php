<?php
/*
Plugin Name: Lug Map
Plugin URI: http://softwareliber.ro/harta/
Description: Create a map with lug locations, powered by Google Maps. 
Version: 1.6
Author: Stas Sușcov
Author URI: http://stas.nerd.ro/
Text Domain: lug-map
*/
?>
<?php
/*  Copyright 2008  Stas Sușcov <stas@nerd.ro>

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
?>
<?php

define(LM_VERSION, 1.6);

/**
 * i18n
 */
function lm_textdomain() {
    load_plugin_textdomain('lug-map', false, dirname( plugin_basename( __FILE__ ) ).'/i18n');
}
add_action('init', 'lm_textdomain');

/**
 * Load our libs
 */
$lm_path = dirname( __FILE__ );
require_once($lm_path.'/lib/lm.admin.class.php');
require_once($lm_path.'/lib/lm.user.class.php');
require_once($lm_path.'/lib/lm.widget.class.php');

/**
 * Load our all
 */
$lm_admin = new LugMap_Admin();
$lm_user = new LugMap_User();
$lm_widget_content = $lm_user->widget_content();
$lm_widget = new LugMap_Widget();

/**
 * Get GeoRSS
 */
if(isset($_GET['georss']))
    die($lm_user->georss());
?>