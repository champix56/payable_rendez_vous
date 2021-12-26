<?php
include_once($PLUGIN_DIR."core/users.php");
function rdv_menu_client_histo(){
    ?><h1>Mon historique</h1><?php
}
function rdv_menu_client_take_apointment(){
    $users = get_consultants();
    //print_r($users);
    
    ?><h1>Prendre rendez vous</h1>
    <form>
    <label>Selectionner consultant :</label><br/>
    <select><?php
    foreach ($users as $value){
        ?><option value="<?php echo $value->ID ;?>"><?php echo $value->data->display_name ;?></option>
      <?php
    }?>
    </select>
    <br/>
    <label>Selectionnez date : <br/><input type="date" name="" id=""></label>
    <br/>

    <label>Selectionnez heure : <br/><input type="time" name="" id=""></label>
    <br/>
<label for="">Selectionnez une prestation : </label><br/>
<select name="" id="">
    <optgroup label="Horaire">
        <option value="h">1h/35euros</option>
        <option value="h">30Min/20euros</option>
    </optgroup>
    <optgroup label="questions">
        <option value="h">3 questions/35euros</option>
    </optgroup>
</select>
<br/><br/><br/>
<div style="display: flex;justify-content: space-around;"></div>
<button style="padding: 5px 15px; border-radius: 7px; background-color: skyblue; color:white; border:none; " type="submit">Valider</button>
<button style="padding: 5px 15px; border-radius: 7px; background-color: tomato; color:white; border:none; "  type="reset">Annuler</button>
</form>
    <?php

}
function rdv_menu_client_base_page(){
    ?><h1>Espace client</h1><?php
}
function rdv_register_menu_client(){
    global $PLUGIN_SLUG;
    $USERS_PLUGIN_SLUG=$PLUGIN_SLUG."_CLIENT";
    add_menu_page('Espace Client','Espace Client','client',$USERS_PLUGIN_SLUG,'rdv_menu_client_base_page','dashicons-welcome-widgets-menus',30);
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Prendre Rendez-Vous','Prendre Rendez-Vous', 'client', $USERS_PLUGIN_SLUG."_TAKE_APOINTMENT", 'rdv_menu_client_take_apointment' );
    add_submenu_page( $USERS_PLUGIN_SLUG, 'Historique','Historique', 'client', $USERS_PLUGIN_SLUG."_HISTO", 'rdv_menu_client_histo' );
}
add_action('admin_menu', 'rdv_register_menu_client');
?>