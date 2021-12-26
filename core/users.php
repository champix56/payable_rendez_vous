<?php
function get_consultants($andAdmin = true)
{
    $all_users = get_users();
    $specific_users = array();

    foreach ($all_users as $user) {
        $isAdmin = false;
        if (in_array("administrator", $user->data->roles)) {
            $isAdmin = true;
        }
        //avec admin ou sans admin et user pas admin et contient manage_rendez_vous
        if (($andAdmin || (!$andAdmin && !$isAdmin)) && $user->has_cap('manage_rendez_vous')) {
                $specific_users[] = $user;
        }
    }
    return $specific_users;
}
