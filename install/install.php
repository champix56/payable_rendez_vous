<?php
include_once($PLUGIN_DIR."install/roles/roles.php");
include_once($PLUGIN_DIR."install/db/db.php");
$DEBUG;
function rdv_install_all()
{
   error_log("_______________\n\t\t\tBegin install\n");
   rdv_install_roles();
   rdv_install_db();
   error_log("\n\t\t\tEnd install\n_______________\n");

}
function rdv_uninstall_all()
{
   error_log("_______________\n\t\t\tBegin uninstall\n");
   rdv_uninstall_roles();
   rdv_uninstall_db();
   error_log("\n\t\t\tEnd uninstall\n_______________\n");

}
?>