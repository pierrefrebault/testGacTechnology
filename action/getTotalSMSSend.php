<?php
include "../mysqliParams.php";

$type = 'envoi de sms';
$mysqli = new mysqli($host, $userName, $password, $dbName);

$sql = sprintf('SELECT COUNT(*)  FROM call_ticket WHERE type LIKE %s', '\''. $type.'%\'');

$total = $mysqli->query($sql)->fetch_row();

$mysqli->close();
echo $total[0];
