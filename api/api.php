<?php
//include(plugin_dir_url(__DIR__)."constant.php");
require_once($PLUGIN_DIR."core/users.php");
function get_api_consultants()
{
    $ret=array();
    $consultants=get_consultants();
    foreach($consultants as $consultant){
        array_push($ret,(object) ['ID' => $consultant->data->ID,"login"=>$consultant->data->user_login,"name"=>$consultant,"avatar"=>get_avatar_url($consultant->data->ID)]);
    }
    return $ret;
}
function get_api_consultant_by_id($datas)
{
    //$ret=array();
    $consultant=get_user_by('ID',$datas['id']);
    $ret=array();
    //print_r()
    if(!$consultant || !array_key_exists('manage_rendez_vous',$consultant->allcaps)){return null;}
     $ret=['ID' => $consultant->data->ID,"login"=>$consultant->data->user_login,"name"=>$consultant,"avatar"=>get_avatar_url($consultant->data->ID)];
     $availabilities=get_api_consultants_availabilities($datas);
     $ret=array_merge($ret,(array)$availabilities);
     //error_log(print_r($ret,true));
    return (object)$ret;
}
function get_api_prestation_by_id($datas){
    global $wpdb;
    global $PLUGIN_DB_PREFIX;
    $sql="SELECT * FROM {$PLUGIN_DB_PREFIX}prestation_type WHERE ID={$datas['id']}";
    return $wpdb->get_results($sql);

}
function get_api_consultants_availabilities($datas)
{
    $availabilities=get_consultants_availabilities($datas['id']);
    $unavailabilities=get_consultants_unavailabilities($datas['id']);
    return (object) ['availabilities' => $availabilities,"unavailabilities"=>$unavailabilities];
}
/**
 * init of rest routes
 */
add_action('rest_api_init', function () {
    //consultants list
    register_rest_route('rdv_plugin/v1', '/consultants', array(
        array(
            'permission_callback' => function ($request) {
                global $PLUGIN_DIR;
                require_once ($PLUGIN_DIR . 'core/users.php');
                return is_user_in_role(wp_get_current_user()->ID,'administrator');
            },
            'methods' => 'GET',
            'callback' => 'get_api_consultants',
        ),
    ));
    //consultants list
    register_rest_route('rdv_plugin/v1', '/consultants/(?P<id>\d+)', array(
        array(
            'permission_callback' => function ($request) {
                global $PLUGIN_DIR;
                require_once ($PLUGIN_DIR . 'core/users.php');
                return is_user_in_role(wp_get_current_user()->ID,'client')|| is_user_in_role(wp_get_current_user()->ID,'consultant')|| is_user_in_role(wp_get_current_user()->ID,'administrator');
            },
            'methods' => 'GET',
            'callback' => 'get_api_consultant_by_id',
        ),
    ));
    //availabilities of a unique consultant
    register_rest_route('rdv_plugin/v1', '/consultants/availabilities/(?P<id>\d+)', array(
        array(
            'permission_callback' => function ($request) {
                global $PLUGIN_DIR;
                error_log(print_r($request,true));//,3,$PLUGIN_DIR."/api/API-error.log");
                //error_log("id :: ".$request->get_param('id'));//,3,$PLUGIN_DIR."/api/API-error.log");
                global $PLUGIN_DIR;
                require_once ($PLUGIN_DIR . 'core/users.php');
                //if it is client or admin or own availabilities asked
                return is_user_in_role(wp_get_current_user()->ID,'client')|| is_user_in_role(wp_get_current_user()->ID,'administrator')||$request->get_param('id')==wp_get_current_user()->ID;
            },
            'methods' => 'GET',
            'callback' => 'get_api_consultants_availabilities',
        ),
    ));
    register_rest_route('rdv_plugin/v1', '/prestations/(?P<id>\d+)', array(
        array(
            'permission_callback' => function ($request) {
                global $PLUGIN_DIR;
                require_once ($PLUGIN_DIR . 'core/users.php');
                return true;//is_user_in_role(wp_get_current_user()->ID,'client');
            },
            'methods' => 'GET',
            'callback' => 'get_api_prestation_by_id',
        ),
    ));
});
?>
