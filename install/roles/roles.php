<?php
include_once $PLUGIN_DIR . "constant.php";
function rdv_install_roles()
{
    global $wp_roles;
    if (!isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }

    error_log("Install roles :\nCREATE : \n");
    //New role bas on subscriber
    $subs = $wp_roles->get_role('subscriber');
    $wp_roles->add_role('consultant', 'Consultant/Consultante', $subs->capabilities);
    error_log("\t-consultant : base on subscriber\n");

    error_log("ADD CAPABILITIE(S) : \n");
    $subs->add_cap('client');
    error_log("\tsubscriber : ADD client \n");
    //add special capabilitie for consult space access
    $consult = $wp_roles->get_role('consultant');
    $consult->add_cap('manage_rendez_vous');
    error_log("\tconsultant : ADD manage_rendez_vous \n");

    //add special cap for manage consult
    $adm = $wp_roles->get_role('administrator');
    $adm->add_cap('manage_consultants');
    error_log("\tadministrator : ADD manage_consultant \n");

    $adm->add_cap('manage_rendez_vous');
    error_log("DEBUG : \tadministrator : ADD manage_rendez_vous \n");
    $adm->add_cap('client');
    error_log("DEBUG : \tadministrator : ADD client \n");

}

function rdv_uninstall_roles()
{
    global $wp_roles;
    if (!isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }
    error_log("remove roles :\Remove : \n");
    $wp_roles->remove_role('consultant');
    error_log("\t-consultant : removed\n");
    error_log("REMOVE CAPABILITIE(S) : \n");

    $adm = $wp_roles->get_role('subscriber');
    $adm->remove_cap('client');
    error_log("\subscriber : remove client capabilitie\n");

    $adm = $wp_roles->get_role('administrator');
    $adm->remove_cap('manage_consultants');
    $adm->remove_cap('manage_rendez_vous');
    error_log("\subscriber : remove manage_consultants, manage_rendez_vous capabilitie\n");

}
