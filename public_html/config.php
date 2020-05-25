<?php
$cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
global $dbhost   = $cleardb_url["host"];
global $db_user = $cleardb_url["user"];
global $dbpass = $cleardb_url["pass"];
global $dbdatabase       = substr($cleardb_url["path"],1);
?>