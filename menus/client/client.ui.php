<?php
function get_vignette_client_rdv($clientID, $clientName,$date, $time, $presta,$stateLevel=-100, $state="invalide"){
    ?>
        <div class="vignet_consultant_future_apointement">
            <img class="avatar" src="<?= get_avatar_url($clientID)?>" alt="" ><br/>
            <?= $clientName?><br/>
            <?= $date?>&nbsp;<?= $time?><br/>
            <?= $presta?><br/>
            <div class="<?php
                if($stateLevel<0)echo 'novalid-state';
                else echo "valid-state"
            ?>"><?=$state?></div>
        </div>
        </div>
    <?php
}

?>