<?php
include_once $PLUGIN_DIR . "constant.php";
// error_log("_____".$PLUGIN_DB_PREFIX."_____\n");
function rdv_install_db()
{
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    global $wpdb;
    global $PLUGIN_DB_PREFIX;
    // error_log("_-_-_-_-_-_\n");
    // error_log(print_r($GLOBALS,true));
    // error_log("_-_-_-_-_-_\n");
    error_log("Create database :");
    error_log("\ton prefix :{$PLUGIN_DB_PREFIX}\n");
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}consultants(
        ID BIGINT(20) REFERENCES {$wpdb->prefix}users(ID),
        biography VARCHAR(1024),
        PRIMARY KEY (ID)
    ) {$charset_collate};";
    //error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}consultants ->CREATED");
/****/
    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}prestation_type(
	    ID int PRIMARY KEY AUTO_INCREMENT,
        short_name varchar(10),
        display_name varchar(34),
        description varchar (512),
        montant DECIMAL,
        temps_nominal int
    ) {$charset_collate};";
    //error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}prestation_type ->CREATED");
    /****/
    $sql = "CREATE TABLE  {$PLUGIN_DB_PREFIX}apointment_state(
        ID INT PRIMARY KEY AUTO_INCREMENT,
        short_name VARCHAR(10),
        display_name VARCHAR(32),
        valid_level INT UNIQUE
    );{$charset_collate};";
    //error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}apointment_state ->CREATED");
    
/****/
    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}take_apointment(
        consultationID BIGINT(20) UNIQUE AUTO_INCREMENT,
        consultantID BIGINT(20) REFERENCES {$wpdb->prefix}users(ID),
        clientID BIGINT(20) REFERENCES {$wpdb->prefix}users(ID),
        stateID INT DEFAULT '-999' REFERENCES {$PLUGIN_DB_PREFIX}apointment_state(ID),
        date DATE ,
        time TIME,
        questions VARCHAR(2048) NOT NULL,
        validation_date TIMESTAMP DEFAULT now(),
        prestation_type_ID int REFERENCES {$PLUGIN_DB_PREFIX}prestation_type(ID),
        PRIMARY KEY (consultantID,clientID, date, time)
    ) {$charset_collate};";
    //error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}take_apointment ->CREATED");
/****/
    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}consultant_availabilities(
    consultantID BIGINT(20) REFERENCES {$wpdb->prefix}users(ID) ,
    day_of_week SMALLINT,
    time_start TIME,
    time_end TIME,
    PRIMARY KEY(consultantID,day_of_week,time_start,time_end)
) {$charset_collate};";
//error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}consultant_availabilities ->CREATED");
/****/
    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}consultant_unavailabilities(
    consultantID BIGINT(20) REFERENCES {$wpdb->prefix}users(ID),
    start DATETIME,
    end DATETIME,
    PRIMARY KEY(consultantID,start,end)
) {$charset_collate};";
//error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}consultant_unavailabilities ->CREATED");
/****/
    $sql = "CREATE TABLE {$PLUGIN_DB_PREFIX}rendezvous_follows(
    questionID BIGINT(20) AUTO_INCREMENT,
    consultationID BIGINT(20) REFERENCES {$PLUGIN_DB_PREFIX}take_apointment(consultationID),
    question varchar(128),
    answer varchar(2048),
    PRIMARY KEY(questionID,consultationID)
) {$charset_collate};";
//error_log($sql);
    dbDelta($sql);
    error_log("\ttable {$PLUGIN_DB_PREFIX}rendezvous_follows ->CREATED");

}
function rdv_uninstall_db()
{
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    global $wpdb;
    global $PLUGIN_DB_PREFIX;
    $sql="DROP TABLE `{$PLUGIN_DB_PREFIX}consultants`, `{$PLUGIN_DB_PREFIX}consultant_availabilities`, `{$PLUGIN_DB_PREFIX}consultant_unavailabilities`, `{$PLUGIN_DB_PREFIX}prestation_type`, `{$PLUGIN_DB_PREFIX}rendezvous_follows`, `{$PLUGIN_DB_PREFIX}take_apointment`;";
    dbDelta($sql);
   
}
