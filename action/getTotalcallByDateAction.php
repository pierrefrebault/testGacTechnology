<?php
include "../mysqliParams.php";

$date = "15/02/2012";
$mysqli = new mysqli($host, $userName, $password, $dbName);

$sql = sprintf(
    'SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(real_duration))) AS timeSum FROM call_ticket WHERE Date(date) >= %s',
    '\''.DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d').'\''
);
$selectedTicketDuration = $mysqli->query($sql);
$total = $selectedTicketDuration->fetch_row()[0];

$selectedTicketDuration->close();
$mysqli->close();
echo $total;
