<?php
class LugMap_User {
    
    var $lm_prefix = 'lugmap';
    var $table;
    var $path;
    function LugMap_User() {}
    
    /**
     * Constructor
     */
    function __construct() {
        global $wpdb, $lm_path;
        $this->db = $wpdb;
        $this->table = $this->db->prefix.$this->lm_prefix;
        $this->path = $lm_path;
        add_action('init', array(&$this, 'header'));
        add_action('wp_head', array(&$this, 'header_js'));
        add_shortcode('LUGMAP', array(&$this, 'content'));
    }
    
    /**
     * Loading meta stuff like js files and etc.
     */
    function header() {
        $lugmap_api_key = get_option('lugmap_api_key');
        wp_enqueue_script('google-maps',
                          "http://maps.google.com/maps?file=api&amp;v=2&amp;key=$lugmap_api_key",
                          null,
                          null,
                          false );
        wp_enqueue_script('jmap',
                          WP_PLUGIN_URL.'/lug-map/js/jquery.jmap.min.js',
                          array('jquery'),
                          'git+8c818fafdd1a5a1d7dfc8b52d403255e3afcbec8',
                          false );
        wp_enqueue_script('lug-map',
                          WP_PLUGIN_URL.'/lug-map/js/lug-map.js',
                          array('jmap'),
                          LM_VERSION,
                          true);
        wp_enqueue_style('lug-map',
                         WP_PLUGIN_URL.'/lug-map/css/lug-map.css',
                         null,
                         LM_VERSION,
                         'screen' );
    }
    
    /**
     * Put some javascript in head
     */
    function header_js() {
    ?>
        <script type="text/javascript">
            var lm_language = '<?=get_locale()?>';
            var lm_mapCenter = [<?=get_option('lugmap_coord')?>];
            var lm_feedUrl = '<?=get_bloginfo('url').'/?georss&amp;'.rand()?>';
            var lm_jsError = '<?=__('Please fill in the following fields', 'lug-map')?>';
        </script>
    <?php
    }
    
    /**
     * Generates a GeoRSS with markers
     */
    function georss() {
        $title = get_bloginfo('name').' / Lug Map GeoRSS';
        $desc = get_bloginfo('description');
        $url = get_bloginfo('url');
        $ms = $this->db->get_results("SELECT point FROM ".$this->table." GROUP BY `point`");
        foreach($ms as $m) {
            $markers[$m->point]['d'] = $this->db->get_results("SELECT * FROM ".$this->table." WHERE `point`='".$m->point."'");
        }
        //Load view
        ob_start();
        include($this->path.'/lib/views/georss.php');
        die(ob_get_clean());
    }
    
    /**
     * Page content
     */
    function content() {
        //Load view
        ob_start();
        include($this->path.'/lib/views/user.php');
        echo ob_get_clean();
    }
    
    /**
     * Widget content
     */
    function widget_content() {
        $markers = $this->db->get_results("SELECT * FROM ".$this->table);
        //Load view
        ob_start();
        include($this->path.'/lib/views/widget.php');
        return ob_get_clean();
    }
}
?>