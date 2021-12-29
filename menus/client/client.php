<?php
include_once($PLUGIN_DIR."core/users.php");
function rdv_menu_client_histo(){
    ?><h1>Mon historique</h1><?php
}
function rdv_menu_client_take_apointment(){
    global $PLUGIN_DIR;
    global $PLUGIN_BASE_URL;
    wp_enqueue_script( "calendar-lib",$PLUGIN_BASE_URL."/js/libs/fullcalendar-5.10.1/lib/main.js", array(), '5.10.1');
    wp_enqueue_style( "calendar-lib",$PLUGIN_BASE_URL."/js/libs/fullcalendar-5.10.1/lib/main.css"  );
    wp_enqueue_script( "calendar",$PLUGIN_BASE_URL."/js/calendar.js", ['calendar-lib'], '5.10.1');
    wp_enqueue_script( "client",$PLUGIN_BASE_URL."/js/client.js", ['common-wp-api-js']);

    ?><h1>Prendre rendez vous</h1><?php 
    include($PLUGIN_DIR."menus/client/take_apointment/take_apointment.php");

}
function rdv_menu_client_base_page(){
    ?><h1>Espace client</h1><?php
}
function rdv_register_menu_client(){
    global $PLUGIN_SLUG;
    $USERS_PLUGIN_SLUG=$PLUGIN_SLUG."_CLIENT";
    add_menu_page('Espace Client','Espace Client','client',$USERS_PLUGIN_SLUG,'rdv_menu_client_base_page','dashicons-admin-site-alt2',30);
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Prendre Rendez-Vous','Prendre Rendez-Vous', 'client', $USERS_PLUGIN_SLUG."_TAKE_APOINTMENT", 'rdv_menu_client_take_apointment' );
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Historique','Historique', 'client', $USERS_PLUGIN_SLUG."_HISTO", 'rdv_menu_client_histo' );
}
add_action('admin_menu', 'rdv_register_menu_client');
?>