<?php 
function get_vignette_rdv($clientID, $clientName,$date, $time, $presta){
    ?>
        <div class="vignet_consultant_future_apointement" style="text-align: center; min-width: 140px;;">
            <img src="<?= get_avatar_url($clientID)?>" alt="" style="border-radius:50%"><br/>
            <?= $clientName?><br/>
            <?= $date?>&nbsp;<?= $time?><br/>
            <?= $presta?><br/>
        </div>
    <?php
}
?>