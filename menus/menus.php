<?php
    
    include_once($PLUGIN_DIR."menus/client/client.php");
    include_once($PLUGIN_DIR."menus/consultant/consultant.php");
    include_once($PLUGIN_DIR."menus/admin/admin.php");
    function enqueue_style(){
        global $PLUGIN_BASE_URL;
        
             //wp_enqueue_script('consultant_menu_script', $PLUGIN_BASE_URL."js/consultMenuScript.js");
            wp_enqueue_style( 'common_menu_css', $PLUGIN_BASE_URL."css/menu/menu.css",array(), 'all' );
    }
    //loading on demand by page ... not globally
    //add_action('admin_enqueue_scripts', 'enqueue_consultant_menu_script');
    add_action('admin_enqueue_scripts', 'enqueue_style');
    
?>