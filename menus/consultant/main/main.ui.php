<?php 
function get_vignette_rdv($clientID, $clientName,$date, $time, $presta){
    ?>
        <div class="vignet_consultant_future_apointement">
            <img class="avatar" src="<?= get_avatar_url($clientID)?>" alt="" ><br/>
            <?= $clientName?><br/>
            <?= $date?>&nbsp;<?= $time?><br/>
            <?= $presta?><br/>
        </div>
    <?php
}
?>