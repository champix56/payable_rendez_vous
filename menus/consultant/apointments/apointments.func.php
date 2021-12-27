<?php
    function get_consultant_future_apointments(){
        return get_consultant_apointments(false,true);
    }
    function get_consultant_old_apointments(){
        return get_consultant_apointments(true,false);
    }
    function get_consultant_apointments($pastToo=true,$next=true){
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $me=wp_get_current_user();
        //  FROM `wp_rdv_take_apointment` TA,wp_users WUC, wp_rdv_prestation_type PT WHERE `clientID`=WUC.ID AND `prestation_type_ID`=PT.ID
        $sql="SELECT `consultationID`, `date`, `time`, `validation_date`,clientID, WUC.user_login as client_login, PT.display_name FROM {$PLUGIN_DB_PREFIX}take_apointment TA, {$wpdb->prefix}users WUC, {$PLUGIN_DB_PREFIX}prestation_type PT WHERE `clientID`=WUC.ID AND `prestation_type_ID`=PT.ID AND consultantID={$me->data->ID} ";
        return $wpdb->get_results($sql);
    }
?>