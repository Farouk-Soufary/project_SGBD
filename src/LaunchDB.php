<?php
      	$login = 'root';
        $db_pwd = '';
        $db = new PDO("mysql:host=127.0.0.1;dbname=mysql;charset=utf8mb4", $login, $db_pwd);
        if (!$db) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $cr_query = file_get_contents('../sql/create.sql');
        $ins_query = file_get_contents('../sql/insert.sql');
        $drp_query = file_get_contents('../sql/drop.sql');
    
        $db->exec($drp_query);
        $db->exec($cr_query);
        $db->exec($ins_query);
        
?>