<?php
$consultants = get_consultants();
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
                        } ?>
                </select>
                <div class="consultant-viewer">
                    <img src="" alt="">
                    <div class="infos"></div>
                </div>
            </div>
            <div>
            <div id="calendar"></div>
        </div>
            <!-- <div>
                <!- - <label>Selectionnez date : <br /><input type="date" name="" id=""></label> 
                <br />- ->
                
                <label>Selectionnez heure : <br /><input type="time" name="" id=""></label>
            </div> -->
            <div>
                <label for="">Selectionnez une prestation : </label><br />
                <select name="" id="">
                    <optgroup label="Horaire">
                        <option value="h">1h/35euros</option>
                        <option value="h">30Min/20euros</option>
                    </optgroup>
                    <optgroup label="questions">
                        <option value="h">3 questions/35euros</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <hr />
     
        <div class="flex" style="justify-content: space-around;">
            <button style="padding: 5px 15px; border-radius: 7px; background-color: tomato; color:white; border:none; " type="reset">Annuler</button>
            <button style="padding: 5px 15px; border-radius: 7px; background-color: skyblue; color:white; border:none; " type="submit">Valider</button>
        </div>
    </form>
    <h2>Mes rendez-vous</h2>

</div>