<?php
        $login = 'jelkarchi';
        $db_pwd = 'jelkarchiSGBD';
        /* Creation de l'objet qui gere la connexion: */
        $conn = oci_connect($login, $db_pwd, 'oracle/oracle');
        if (!$conn) {
            echo 'hi';
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
?>