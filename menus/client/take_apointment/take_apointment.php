<?php 
$users = get_consultants();
    //print_r($users);?>
    <div class="rdv_custom_menu">

   
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
</div>