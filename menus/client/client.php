<?php
function rdv_menu_client_histo(){
    ?><h1>Mon historique</h1><?php
}
function rdv_menu_client_take_apointment(){
    ?><h1>Prendre rendez vous</h1><?php
}
function rdv_menu_client_base_page(){
    ?><h1>Espace client</h1><?php
}
function rdv_register_menu_client(){
    global $PLUGIN_SLUG;
    $USERS_PLUGIN_SLUG=$PLUGIN_SLUG."_CLIENT";
    add_menu_page('Espace Client','Espace Client','client',$USERS_PLUGIN_SLUG,'rdv_menu_client_base_page','dashicons-welcome-widgets-menus',30);
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Prendre Rendez-Vous','Prendre Rendez-Vous', 'client', $USERS_PLUGIN_SLUG."_TAKE_APOINTMENT", 'rdv_menu_client_take_apointment' );
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Historique','Historique', 'client', $USERS_PLUGIN_SLUG."_HISTO", 'rdv_menu_client_histo' );
}
add_action('admin_menu', 'rdv_register_menu_client');
?>