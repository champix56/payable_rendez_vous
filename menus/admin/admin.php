<?php
function rdv_menu_admin_base_page(){
    ?><h1>Administration</h1><?php

}
function rdv_menu_admin_prestations(){
    ?><h1>Configuration prestations</h1><?php

}
function rdv_menu_admin_histo(){
    ?><h1>Configuration historiques</h1><?php

}
function rdv_menu_admin_paiments(){
    ?><h1>Configuration paiements</h1><?php
}
    function rdv_register_menu_admin(){
        global $PLUGIN_SLUG;
        $USERS_PLUGIN_SLUG=$PLUGIN_SLUG."_ADMIN";
        add_menu_page('Espace Admin','Espace Admin','administrator',$USERS_PLUGIN_SLUG,'rdv_menu_admin_base_page','dashicons-superhero',30);
        add_submenu_page( $USERS_PLUGIN_SLUG, 'Paiements','Paiments', 'administrator', $USERS_PLUGIN_SLUG."_PAY", 'rdv_menu_admin_paiments' );
        add_submenu_page( $USERS_PLUGIN_SLUG, 'Préstations','Prestations', 'administrator', $USERS_PLUGIN_SLUG."_PRESTA", 'rdv_menu_admin_prestations' );
        add_submenu_page( $USERS_PLUGIN_SLUG, 'Historique','Historique', 'administrator', $USERS_PLUGIN_SLUG."_HISTO", 'rdv_menu_admin_histo' );
    }
    add_action('admin_menu', 'rdv_register_menu_admin');
?>