<?php
    
    include_once($PLUGIN_DIR."menus/client/client.php");
    include_once($PLUGIN_DIR."menus/consultant/consultant.php");
    include_once($PLUGIN_DIR."menus/admin/admin.php");
    add_action('admin_enqueue_scripts', 'enqueue_consultant_menu_script');
?>