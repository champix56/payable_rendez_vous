<?php
function rdv_menu_consultant_histo(){
    ?><h1>Mon historique</h1><?php
}
function rdv_menu_consultant_my_apointments(){
    ?><h1>Prendre rendez vous</h1><?php
}
function rdv_menu_consultant_base_page(){
    ?><h1>Espace consultant</h1><?php
}
function rdv_register_menu_consultant(){
    global $PLUGIN_SLUG;
    $CONSULT_PLUGIN_SLUG=$PLUGIN_SLUG."_CONSULT";
    add_menu_page('Espace Consultant','Espace Consultant','manage_rendez_vous',$CONSULT_PLUGIN_SLUG,'rdv_menu_consultant_base_page','dashicons-welcome-widgets-menus',30);
    add_submenu_page( $CONSULT_PLUGIN_SLUG, 'Mes Rendez-Vous','Mes Rendez-Vous', 'manage_rendez_vous', $CONSULT_PLUGIN_SLUG."_MY_APOINTMENTS", 'rdv_menu_consultant_my_apointments' );
    add_submenu_page( $CONSULT_PLUGIN_SLUG, 'Historique','Historique', 'manage_rendez_vous', $CONSULT_PLUGIN_SLUG."_HISTO", 'rdv_menu_consultant_histo' );
}
add_action('admin_menu', 'rdv_register_menu_consultant');
?>