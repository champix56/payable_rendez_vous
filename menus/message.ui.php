<?php
function show_message_viewer($message){
   // if (strlen($message) == 0) return ;?>
    <div id="message" class="updated notice is-dismissible closed">
        <p><?= $message ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Ignorer cette notification.</span></button>
    </div>
<?php 
} ?>