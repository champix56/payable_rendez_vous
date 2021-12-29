<?php
    function add_consultant_availability($dayOfWeek,$start,$end)
    {
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $me=wp_get_current_user();
        $sql="INSERT INTO {$PLUGIN_DB_PREFIX}consultant_availabilities (`consultantID`, `day_of_week`, `time_start`, `time_end`) VALUES ({$me->data->ID}, {$dayOfWeek}, '{$start}', '{$end}');";
 
        return $wpdb->query($sql);
        }
    function list_consultant_availability(){
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $me=wp_get_current_user();
        $sql="SELECT * FROM {$PLUGIN_DB_PREFIX}consultant_availabilities WHERE consultantID={$me->data->ID}";
        return $wpdb->get_results($sql);
    }
    function add_consultant_unavailability($start,$end)
    { 
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $me=wp_get_current_user();
        $sql="INSERT INTO `{$PLUGIN_DB_PREFIX}consultant_unavailabilities` (`consultantID`, `start`, `end`) VALUES ('{$me->data->ID}', '{$start}', '{$end}');";
       
        return $wpdb->query($sql);

    }
    function list_consultant_unavailability(){
        global $wpdb;
        global $PLUGIN_DB_PREFIX;
        $me=wp_get_current_user();
        $sql="SELECT * FROM {$PLUGIN_DB_PREFIX}consultant_unavailabilities WHERE consultantID={$me->data->ID}";
        return $wpdb->get_results($sql);
    }
?>