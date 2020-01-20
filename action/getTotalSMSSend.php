<?php
$type = 'envoi de sms';
$mysqli = new mysqli('127.0.0.1', 'admin', '', 'test');

$sql = sprintf('SELECT COUNT(*)  FROM call_ticket WHERE type LIKE %s', '\''. $type.'%\'');

$total = $mysqli->query($sql)->fetch_row();

$mysqli->close();
echo $total[0];
