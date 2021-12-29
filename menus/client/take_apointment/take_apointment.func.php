<?php

    function get_prestation_type()
    {
        global $wpdb;
        global $PLUGIN_DB_PREFIX;

        $sql="SELECT * FROM {$PLUGIN_DB_PREFIX}prestation_type ";
        return $wpdb->get_results($sql);
    }
    function get_client_apointments(){
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $sql="SELECT `consultationID`, `consultantID`, `clientID`, `stateID`, `date`, `time`, `questions`, `validation_date`, `prestation_type_ID`,PT.`display_name` as type_display_name , `montant`, `temps_nominal`, AST.`short_name`as state_short_name, AST.`display_name`as state_diplay_name , `valid_level`, `user_nicename`,WU.`display_name` FROM `{$PLUGIN_DB_PREFIX}apointment_state` AST, `{$PLUGIN_DB_PREFIX}prestation_type` PT, `{$PLUGIN_DB_PREFIX}take_apointment` TA, `{$wpdb->prefix}users` WU WHERE WU.ID=consultantID AND PT.ID=prestation_type_ID AND AST.ID=stateID AND clientID=".wp_get_current_user()->ID;
        return $wpdb->get_results($sql);

    }
?>