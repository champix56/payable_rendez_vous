<?php
require_once __DIR__ . "/take_apointment.func.php";
// wp-content/plugins/payable_rendez_vous/menus/client/client.ui.php
require_once $PLUGIN_DIR . "menus/client/client.ui.php";
$consultants = get_consultants();
//INSERT INTO `wp_rdv_take_apointment` (`consultationID`, `consultantID`, `clientID`, `stateID`, `date`, `time`, `questions`, `validation_date`, `prestation_type_ID`) VALUES (NULL, '1', '5', '-999', '2022-01-02', '12:00:00', 'QUestion1\r\nQuestion2\r\nQuestion3', CURRENT_TIMESTAMP, '1');
//$apointments = get_clients_apointments()
?>
<div class="rdv_custom_menu">
    <form>
        <div class="flex center-child" style="justify-content: space-around;">
            <div>
                <label>Selectionner consultant :</label><br />
                <select id="client_take_apointment_select_consultant"><?php
foreach ($consultants as $value) {
    ?><option value="<?php echo $value->ID; ?>"><?php echo $value->data->display_name; ?></option>
                    <?php
}?>
                </select>
                <div class="consultant-viewer">
                    <img src="" alt="">
                    <div class="infos"></div>
                </div>
            </div>
            <div class="take_apointement_datetime">
                <input type="date" name="" id=""><br />
                <input type="time" name="" id="">
                <div id="calendar"></div>
            </div>
            <!-- <div>
                <!- - <label>Selectionnez date : <br /><input type="date" name="" id=""></label>
                <br />- ->

                <label>Selectionnez heure : <br /><input type="time" name="" id=""></label>
            </div> -->
            <div>
                <label for="client_take_apointment_select_prestation_type">Selectionnez une prestation : </label><br />
                <select name="prestation_type_id" id="client_take_apointment_select_prestation_type">
                    <!-- <optgroup label="Horaire">
                        <option value="h">1h/35euros</option>
                        <option value="h">30Min/20euros</option>
                    </optgroup>
                    <optgroup label="questions">
                        <option value="h">3 questions/35euros</option>
                    </optgroup> -->
                    <?php $types = get_prestation_type();
foreach ($types as $presta) {?><option value="<?=$presta->ID?>"><?=$presta->display_name?>/<?=$presta->montant?>&euro;</option><?php }?>
                </select>
                <div class="loading-prestation-container">
                    <img class="loading-prestation-img" src="<?=$PLUGIN_BASE_URL . "img/loading.svg"?>" alt="">
                </div>
                <div class="presta-infos">
                    <div class="flex" style="justify-content: space-between;">
                        <div>
                            <h5>Prix</h5><?=$types[0]->montant?>&euro;
                        </div>
                        <div>
                            <h5>temps nominal</h5><?=$types[0]->temps_nominal?>min
                        </div>
                    </div>
                    <h5>Description</h5><?=$types[0]->description?>
                </div>
                <hr />
                <div class="questions_content">
                    <label for="client_take_apointment_question_content">Saisiez vos questions / domaines</label>
                    <textarea name="apointment_client_ask" id="client_take_apointment_question_content" rows="8"></textarea>
                </div>
            </div>
        </div>
        <hr />
        <div class="flex" style="justify-content: space-around;">
            <button style="padding: 5px 15px; border-radius: 7px; background-color: tomato; color:white; border:none; " type="reset">Annuler</button>
            <button style="padding: 5px 15px; border-radius: 7px; background-color: skyblue; color:white; border:none; " type="submit">Valider</button>
        </div>
    </form>
    <h2>Mes rendez-vous</h2>
    <div class="flex" style="flex-wrap: wrap; justify-content: space-evenly;">
    <?php
$rdvs = get_client_apointments();
foreach ($rdvs as $rdv) {
    get_vignette_client_rdv($rdv->consultantID, $rdv->display_name, $rdv->date, $rdv->time, $rdv->type_display_name);
} ?>
    </div>
    <hr/>
    <?php //var_dump($rdvs);
    ?>
</div>