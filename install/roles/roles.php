<?php
include_once $PLUGIN_DIR . "constant.php";
include_once $PLUGIN_DIR . "core/users.php";
function rdv_install_roles()
{
    global $wp_roles;
    if (!isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }

    error_log("Install roles :");
    error_log("\tCREATE : ");
    //New role bas on subscriber
    $subs = $wp_roles->get_role('subscriber');
    $wp_roles->add_role('consultant', 'Consultant/Consultante', $subs->capabilities);
    error_log("\t-consultant : base on subscriber");

    error_log("ADD CAPABILITIE(S) : ");
    $subs->add_cap('client');
    error_log("\tsubscriber : ADD client ");
    //add special capabilitie for consult space access
    $consult = $wp_roles->get_role('consultant');
    $consult->add_cap('manage_rendez_vous');
    error_log("\tconsultant : ADD manage_rendez_vous ");

    //add special cap for manage consult
    $adm = $wp_roles->get_role('administrator');
    $adm->add_cap('manage_consultants');
    error_log("\tadministrator : ADD manage_consultant");

    $adm->add_cap('manage_rendez_vous');
    error_log("DEBUG : \tadministrator : ADD manage_rendez_vous");
    $adm->add_cap('client');
    error_log("DEBUG : \tadministrator : ADD client");

    
    update_option('users_can_register',1);
    error_log("Allow users regidtration : true");

}

function rdv_uninstall_roles()
{
    global $wp_roles;
    if (!isset($wp_roles)) {
        $wp_roles = new WP_Roles();
    }
    $users=get_consultants(false);
    error_log("transform consultant roles in subscriber role: ");

    foreach($users as $user)
    {
        $user->set_role('subscriber');
    error_log("\t-id:".$user->data->ID.";name:".$user->data->user_name." -> role: suscriber ");

    }
    error_log("remove roles :");
    $wp_roles->remove_role('consultant');
    error_log("\t-consultant : removed");
    error_log("REMOVE CAPABILITIE(S) :");

    $adm = $wp_roles->get_role('subscriber');
    $adm->remove_cap('client');
    error_log("\t-subscriber : remove client capabilitie");

    $adm = $wp_roles->get_role('administrator');
    $adm->remove_cap('manage_consultants');
    $adm->remove_cap('manage_rendez_vous');
    error_log("\tadministrator : remove manage_consultants, manage_rendez_vous capabilities");
    
}
