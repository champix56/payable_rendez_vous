<?php
include_once($PLUGIN_DIR."install/roles/roles.php");
$DEBUG;
function rdv_install_all()
{
   global $DEBUG;
   rdv_install_roles(true);
}
function rdv_unistall_all()
{
   rdv_uninstall_roles();
}
?>