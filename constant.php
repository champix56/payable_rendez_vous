<?php
global $wpdb;
    global $DBG;
    $DBG=true;
    global $PLUGIN_SLUG;
    $PLUGIN_SLUG="PAYABLE_RDV";
    global $PLUGIN_DIR;
    $PLUGIN_DIR=plugin_dir_path(__FILE__);
    global $PLUGIN_BASE_URL;
    $PLUGIN_BASE_URL=plugin_dir_url( __FILE__ );
    global $PLUGIN_ERROR_FILE;
    $PLUGIN_ERROR_FILE=$PLUGIN_DIR."/WPERROR.log";
    global $PLUGIN_DB_PREFIX;
    $PLUGIN_DB_PREFIX=$wpdb->prefix."rdv_";
?>