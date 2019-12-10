<?php

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'Receber Notificações':
            insert();
            break;
    }
}


function insert() {
    shell_exec("sh telegram_bot.sh");
        exit;
}
?>