<?php
function get_consultants($andAdmin = true)
{
    $all_users = get_users();
    $specific_users = array();
    foreach ($all_users as $user) {
        $isAdmin = false;
        if (in_array("administrator", $user->roles)) {
            $isAdmin = true;
        }
        //avec admin ou sans admin et user pas admin et contient manage_rendez_vous
        if (($andAdmin || (!$andAdmin && !$isAdmin)) && $user->has_cap('manage_rendez_vous')) {
                $specific_users[] = $user;
        }
    }
    return $specific_users;
}
function get_consultants_unavailabilities($id)
{
    global $wpdb;
    global $PLUGIN_DB_PREFIX;
    $sql="SELECT * FROM `{$PLUGIN_DB_PREFIX}consultant_unavailabilities` WHERE `consultantID`={$id} ORDER BY `start`";
    return $wpdb->get_results($sql);
    // return $specific_users;
}
function get_consultants_availabilities($id)
{
    global $wpdb;
    global $PLUGIN_DB_PREFIX;
    $sql="SELECT * FROM `{$PLUGIN_DB_PREFIX}consultant_availabilities` WHERE `consultantID`={$id} ORDER BY `day_of_week`, `time_start`";
    return $wpdb->get_results($sql);
    // return $specific_users;
}/**
 * get user roles by ID
 *
 * @param [number] $user_id
 * @return array
 */
function get_user_roles_by_user_id( $user_id ) {
   // echo "id;";
    $user = get_userdata( $user_id );
    return empty( $user ) ? array() : $user->roles;
}
/**
 * check role of user
 *
 * @param [number] $user_id
 * @param [string] $role
 * @return boolean
 */
function is_user_in_role( $user_id, $role  ) {
    //echo "role;";
    return in_array( $role, get_user_roles_by_user_id( $user_id ) );
}
?>