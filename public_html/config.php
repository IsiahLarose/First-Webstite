<?php
$cleardb_url      = parse_url(getenv("JAWSDB_URL"));
$dbhost   = $cleardb_url["host"];
$db_user = $cleardb_url["user"];
$dbpass = $cleardb_url["pass"];
$dbdatabase       = substr($cleardb_url["path"],1);
?>