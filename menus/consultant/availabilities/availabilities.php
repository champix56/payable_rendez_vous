<?php
global $PLUGIN_DIR;
include_once $PLUGIN_DIR . "core/time.php";
include_once $PLUGIN_DIR . "menus/consultant/availabilities/availabilities.func.php";
$message="";
if ((isset($_POST) && count($_POST) > 0)) {
    if (isset($_POST['add_unavailability'])) {
        //[date_start] => 2021-01-01 [time_start] => 01:01 [date_end] => 2022-02-02 [time_end] => 02:02 )
        $message=add_consultant_unavailability($_POST['date_start']." ".$_POST['time_start'].":00", $_POST['date_end']." ".$_POST['time_end'].":00");
    } elseif (isset($_POST['add_availability'])) {

        $message=add_consultant_availability($_POST['dayNumber'], $_POST['starttime'], $_POST['starttime']);
    }
}

$availabilities = list_consultant_availability();
$unavailabilities = list_consultant_unavailability();
if (strlen($message) > 0) {
?><div id="message" class="updated notice is-dismissible">
        <p>Update éfféctué</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ignorer cette notification.</span></button>
    </div>
<?php } ?>
<div class="rdv_custom_menu" style="padding-right: 20px;">
    <div style="display: flex;">
        <button class="btn" onclick="showAddAvailabilityPanel()">Ajouter disponibilité</button>
        <button class="btn primary" onclick="showAddUnAvailabilityPanel()">Ajouter indisponibilité</button>
    </div>
    <div id="rdv_consultant_add_availabilities" style="display: none; margin:8px;border:1px solid grey; border-radius: 8px;padding :8px 15px;">
        <h3>Nouvelle disponibilité regulière</h3>
        <form action="?page=<?= $_GET['page'] ?>" method="post" name="consultant_add_availability" onreset="reset_consultant_add_availability()">
            <input type="hidden" name="add_availability" />
            <div style="display: flex; justify-content: space-between;">

                <div>
                    <label for="dayNumber">Jour de la semaine :</label><br />
                    <select name="dayNumber" id="">
                        <option value="1">Lundi</option>
                        <option value="2">Mardi</option>
                        <option value="3">Mercredi</option>
                        <option value="4">Jeudi</option>
                        <option value="5">Vendredi</option>
                        <option value="6">Samedi</option>
                        <option value="7">Dimanche</option>
                    </select>
                </div>
                <div>
                    <label for="starttime">Debut :</label><br />
                    <input type="time" name="starttime" id="" required>
                </div>
                <div>
                    <label for="endtime">Fin :</label><br />
                    <input type="time" name="endtime" id="" required>
                </div>
            </div>
            <hr />
            <div style="display: flex;justify-content: space-around;">
                <button class="btn warning" type="reset">Annuler</button>
                <button class="btn primary" type="submit">Valider</button>
            </div>
        </form>
    </div>
    <div id="rdv_consultant_add_unavailabilities" style="display: none; margin:8px;border:1px solid grey; border-radius: 8px;padding :8px 15px;">
        <h3>Nouvelle indisponibilité ponctuelle</h3>
        <form action="?page=<?= $_GET['page'] ?>" method="post" name="consultant_add_availability" onreset="reset_consultant_add_unavailability()">
        <input type="hidden" name="add_unavailability" />

            <div style="display: flex; justify-content: space-around;">

                <div>
                    <label for="dayNumber">Date de debut :</label><br />
                    <input type="date" name="date_start" id="" required><br />
                    <label for="dayNumber">heure de debut :</label><br />
                    <input type="time" name="time_start" id="" required><br />
                </div>
                <div>
                    <label for="dayNumber">Date de fin :</label><br />
                    <input type="date" name="date_end" id="" required><br />
                    <label for="dayNumber">heure de debut :</label><br />
                    <input type="time" name="time_end" id="" required><br />
                </div>
            </div>
            <hr />
            <div style="display: flex;justify-content: space-around;">
                <button class="btn warning" type="reset">Annuler</button>
                <button class="btn primary" type="submit">Valider</button>
            </div>
        </form>
    </div>
    <h2>Mes disponibilités</h2>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
                <!-- // this column contains checkboxes -->
                <th id="columnname" class="manage-column column-columnname" scope="col">Jour de la semaine</th>
                <th id="columnname" class="manage-column column-columnname num" scope="col">Debut</th>
                <!-- // "num" added because the column contains numbers -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Fin</th>
                <!-- // "num" added because the column contains numbers -->
            </tr>
        </thead>

        <tfoot>
            <tr>

                <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
                <!-- // this column contains checkboxes -->
                <th id="columnname" class="manage-column column-columnname" scope="col">Jour de la semaine</th>
                <th id="columnname" class="manage-column column-columnname num" scope="col">Debut</th>
                <!-- // "num" added because the column contains numbers -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Fin</th>
                <!-- // "num" added because the column contains numbers -->
            </tr>
        </tfoot>

        <tbody>
            <?php
            foreach ($availabilities as $availability) {
            ?>
                <tr class="alternate">
                    <th class="check-column" scope="row"></th>
                    <td class="column-columnname"><?= nameOfDayOfWeek($availability->day_of_week) ?></td>
                    <td class="column-columnname"><?= $availability->time_start ?></td>
                    <td class="column-columnname"><?= $availability->time_end ?></td>
                </tr>
                <tr class="alternate" valign="top">
                    <!-- // this row contains actions -->
                    <th class="check-column" scope="row"></th>
                    <td class="column-columnname">
                        <div class="row-actions">
                            <span><a href="#">Action</a> |</span>
                            <span><a href="#">Action</a></span>
                        </div>
                    </td>
                    <td class="column-columnname"></td>
                    <td class="column-columnname"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <hr />
    <h2>Mes indisponibilités à venir</h2>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>

                <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
                <!-- // this column contains checkboxes -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Debut</th>
                <!-- // "num" added because the column contains numbers -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Fin</th>
                <!-- // "num" added because the column contains numbers -->
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th id="cb" class="manage-column column-cb check-column" scope="col"></th>
                <!-- // this column contains checkboxes -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Debut</th>
                <!-- // "num" added because the column contains numbers -->
                <th id="columnname" class="manage-column column-columnname num" scope="col">Fin</th>
                <!-- // "num" added because the column contains numbers -->
            </tr>
        </tfoot>

        <tbody>
            <?php
            foreach ($unavailabilities as  $unavailability) {
            ?>
                <tr class="alternate">
                    <th class="check-column" scope="row"></th>
                    <td class="column-columnname"><?= $unavailability->start ?></td>
                    <td class="column-columnname"><?= $unavailability->end ?></td>
                </tr>
                <tr class="alternate" valign="top">
                    <!-- // this row contains actions -->
                    <th class="check-column" scope="row"></th>
                    <td class="column-columnname">
                        <div class="row-actions">
                            <span><a href="#">Action</a> |</span>
                            <span><a href="#">Action</a></span>
                        </div>
                    </td>
                    <td class="column-columnname"></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <hr />
</div>