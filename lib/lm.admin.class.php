<?php
class LugMap_Admin {
    var $lm_prefix = 'lugmap';
    var $table;
    var $path;
    var $db;
    var $plugin_basename;
    
    function LugMap_Admin() {}
    
    /**
     * Constructor
     */
    function __construct() {
        global $wpdb, $lm_path;
        $this->path = $lm_path;
        $this->plugin_basename = plugin_basename( $lm_path.'/lug-map.php' );
        $this->db = $wpdb;
        $this->table = $this->db->prefix.$this->lm_prefix;
        register_activation_hook(__FILE__,array(&$this, 'install'));
        add_action('admin_menu', array(&$this, 'load_pages'));
        add_filter('wp_footer', array(&$this, 'add_marker'));
    }
    
    /**
    * Admin cpanel loads
    */
   function load_pages() {
        if ( current_user_can ( 'manage_options' ) ) {
            add_options_page(__("Lug Map","lug-map"), __("Lug Map","lug-map"), 3, "lug-map", array(&$this, "menu"));
            add_filter("plugin_action_links_{$this->plugin_basename}", array(&$this, 'settings_link'), 10, 2);
        }
    }
   
    /**
     * Admin actions
     */
    function menu() {        
        if(!empty($_POST['lugmap_api_key'])) {
           update_option('lugmap_api_key', attribute_escape($_POST['lugmap_api_key']));
            $flash = __("Options saved.",'lug-map');
        }
        
        if(!empty($_POST['lugmap_coord'])) {
           update_option('lugmap_coord', attribute_escape($_POST['lugmap_coord']));
            $flash = __("Options saved.",'lug-map');
        }
        
        
        if(isset($_GET['delete_lugmap_marker'])) {
            $lugmap_marker_id = attribute_escape($_GET['delete_lugmap_marker']);
            $this->db->query("DELETE FROM $this->table WHERE id = $lugmap_marker_id");
            $flash = sprintf(__('Marker %1$s deleted.','lug-map'),"$lugmap_marker_id");
        }
        
        if($_POST['lugmap_clean'] == 'true')
                $this->clean();
        
        $markers = $this->db->get_results("SELECT * FROM ".$this->table);
        $lugmap_api_key = get_option('lugmap_api_key');
        $lugmap_coord = get_option('lugmap_coord');
        
        //Load the view
        ob_start();
        include($this->path.'/lib/views/admin.php');
        echo ob_get_clean();
    }

    /**
     * Clean lugmap table 
     */
    function clean() {
        $this->db->query("DROP TABLE ".$this->table);
        $this->install();
    }
    
    /**
     * Creating database tables and the rest of needed stuff
     */
    function install() {
        $structure = "CREATE TABLE ".$this->table." (
            id          INT(9) NOT NULL AUTO_INCREMENT,
            name        VARCHAR(80) NOT NULL,
            cord        VARCHAR(40) NOT NULL,
            email       VARCHAR(40) NOT NULL,
            web         VARCHAR(1000) NOT NULL,
            dsc         VARCHAR(2000) NOT NULL,
            point       VARCHAR(20) NOT NULL,
            UNIQUE      KEY id (id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
        $this->db->query($structure);
        
        // Populate table
        $this->db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $this->db->query("
                         INSERT INTO ".$this->table." (name, cord, email, web, dsc, point)
                         VALUES(
                         'Grupul pentru software liber',
                         'Adi Roiban',
                         'adiroiban@gmail.com',
                         'http://softwareliber.ro/',
                         'Grupul pentru software liber s-a conturat la începutul anului 2005 in jurul unor studenți din cadrul Universității Tehnice din Cluj-Napoca. Ținta grupului a fost promovarea software-lui liber în rândurile studenților și profesorilor din facultate și continuarea activitații începute de Igor Știrbu la sfarșitul anului 2004.',
                         '46.776306,23.60429')");
        
        add_option('lugmap_coord','45.943161,24.96676');
        add_option('lugmap_api_key', __('Please add your Google Maps key'));
    }
    
    /**
     * Add new marker to db
     */
    function add_marker($content){
        if ( !empty( $_POST['lm_name'] ) && !empty( $_POST['lm_email'] ) && !empty( $_POST['lm_point'] ) && !empty( $_POST['lm_org'] ) ) {
            $d['lm_name']	= $this->db->escape($_POST['lm_name']);
            $d['lm_org']	= $this->db->escape($_POST['lm_org']);
            $d['lm_email']	= $this->db->escape($_POST['lm_email']);
            $d['lm_web']	= $this->db->escape(apply_filters("the_title",$_POST['lm_web']));
            $d['lm_dsc']	= $this->db->escape(apply_filters("comment_status_pre ",$_POST['lm_dsc']));
            $d['lm_point']	= $this->db->escape(strtok($_POST['lm_point'],"()"));
        }
        
        if(is_array($d)) {
            $this->db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            $this->db->query("
                             INSERT INTO ".$this->table."(name, cord, email, web, dsc, point)
                             VALUES(
                             '".$d['lm_name']."',
                             '".$d['lm_org']."',
                             '".$d['lm_email']."',
                             '".$d['lm_web']."',
                             '".$d['lm_dsc']."',
                             '".$d['lm_point']."')");
        }
        return $content;
    }
    
    /**
     * Generate widget content
     */
    function widget_content() {
        $this->db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
        $markers = $this->db->get_results("SELECT `name`,`web` FROM `".$this->table."` ORDER BY `name`");
        //Load the view
        ob_start();
        include($this->path.'/lib/views/widget.php');
        return ob_get_clean();
    }
    
    /**
     * Helper for plugin links
     */
    function settings_link($links) {
        $settings_link = '<a href="' . admin_url("options-general.php?page=lug-map") . '">'.__('Settings', 'ug-map').'</a>';
        array_unshift ( $links, $settings_link ); 
        return $links;
    }
}
?>