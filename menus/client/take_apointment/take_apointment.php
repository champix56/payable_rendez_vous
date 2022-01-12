<?php
require_once __DIR__ . "/take_apointment.func.php";
// wp-content/plugins/payable_rendez_vous/menus/client/client.ui.php
require_once $PLUGIN_DIR . "menus/client/client.ui.php";
require_once $PLUGIN_DIR . "menus/message.ui.php";

$consultants = get_consultants();
show_message_viewer("");
?>
<div class="rdv_custom_menu">
    <form id="client_take_apointment_form" action="" method="POST">
        <div class="flex center-child" id="client_take_apointment_consultant_block" style="justify-content: space-around;">
            <div>
                <label>Selectionner consultant :</label><br />
                <select id="client_take_apointment_select_consultant" name="consultantID">
                    <option value="-1">Selectionnez un consultant</option>
                    <?php
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
            <div class="take_apointement_datetime hide"  id="client_take_apointment_datetime_block" >
                <label for="client_take_apointment_date">Selectionnez une date & heure : </label><br />

                <input type="date" name="date" id="client_take_apointment_date"><br />
                <input type="time" name="time" id="client_take_apointment_time">
                <div id="calendar"></div>
            </div>
            <!-- <div>
                <!- - <label>Selectionnez date : <br /><input type="date" name="" id=""></label>
                <br />- ->

                <label>Selectionnez heure : <br /><input type="time" name="" id=""></label>
            </div> -->
            <div id="client_take_apointment_presta_block"  class="hide">
                <label for="client_take_apointment_select_prestation_type">Selectionnez une prestation : </label><br />
                <select name="prestation_type_id" id="client_take_apointment_select_prestation_type">
                    <!-- <optgroup label="Horaire">
                        <option value="h">1h/35euros</option>
                        <option value="h">30Min/20euros</option>
                    </optgroup>
                    <optgroup label="questions">
                        <option value="h">3 questions/35euros</option>
                    </optgroup> -->
                    <option value="-1">Selectionnez une prestation</option>
                    <?php $types = get_prestation_type();
foreach ($types as $presta) {?><option value="<?=$presta->ID?>"><?=$presta->display_name?>/<?=$presta->montant?>&euro;</option><?php }?>
                </select>
                <div class="loading-prestation-container">
                    <img class="loading-prestation-img" src="<?=$PLUGIN_BASE_URL . "img/loading.svg"?>" alt="">
                </div>
                <div class="presta-infos">
                    <div class="flex" style="justify-content: space-between;">
                    </div>
                </div>
                <hr />
                <div class="questions_content hide">
                    <label for="client_take_apointment_question_content">Saisiez vos questions / domaines</label>
                    <textarea name="questions" id="client_take_apointment_question_content" rows="8"></textarea>
                </div>
            </div>
        </div>
        <hr />
        <div class="flex" style="justify-content: space-around;">
            <button class="btn btn-warning" type="reset">Annuler</button>
            <button class="btn btn-primary" type="submit" disabled>Valider</button>
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