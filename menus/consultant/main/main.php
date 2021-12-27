<?php
include($PLUGIN_DIR . "menus/consultant/apointments/apointments.func.php");
include($PLUGIN_DIR . "menus/consultant/main/main.ui.php");
$message = "";
$apointments = get_consultant_future_apointments();
$oldapointments = get_consultant_old_apointments();
if (strlen($message) > 0) {
?><div id="message" class="updated notice is-dismissible">
        <p><?php print_r($apointments) ?><br /><?= $message ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ignorer cette notification.</span></button>
    </div>
<?php }
?>

<h2>Mes rendez vous à venir :</h2>
<div class="rdv_custom_menu">
<div class="consultant_apointements_vignette_list" >
    <?php
    foreach ($apointments as $apointment) {
    ?>
        <?php get_vignette_rdv($apointment->clientID, $apointment->client_login, $apointment->date, $apointment->time, $apointment->display_name) ?>
    <?php
    }
    ?></div>
<hr />
<h2>Mes derniers rendez vous :</h2>
<div class="consultant_apointements_vignette_list" >
    <?php
    foreach ($oldapointments as $apointment) {
    ?>
        <?php get_vignette_rdv($apointment->clientID, $apointment->client_login, $apointment->date, $apointment->time, $apointment->display_name) ?>
    <?php
    }
    ?></div>
<hr />
</div>