<?php

include("config.php");
$h = mysql_connect($mysql_host, $mysql_user, $mysql_pass);
mysql_select_db($mysql_db);

$r = mysql_query(file_get_contents("systems.sql"));
$count = mysql_num_rows($r);
for($i = 0; $i < $count; $i++) {
	$rows[] = mysql_fetch_assoc($r);
}
echo json_encode($rows);

?>
