<?php
$volume = [];
$mysqli = new mysqli('127.0.0.1', 'admin', '', 'test');

$sql = 'SELECT DISTINCT subscriber_number FROM call_ticket';
$subscribers = $mysqli->query($sql);
foreach ($subscribers->fetch_all() as $subscriber) {
    $sql = sprintf(
        'SELECT real_volume
                FROM call_ticket 
                WHERE subscriber_number=%s 
                AND hour NOT BETWEEN %s AND %s 
                ORDER BY real_volume DESC
                LIMIT %s',
        $subscriber[0],
        '\'08:00\'',
        '\'18:00\'',
        10
    );

    $realVolume = $mysqli->query($sql);
    if ($realVolume->num_rows > 0) {
        $newRealVolume = [$subscriber[0]];
        foreach ($realVolume->fetch_all() as $realVolume) {
            $newRealVolume[] = $realVolume[0];
        }
        $volume[] = $newRealVolume;
    }
}

$fp = fopen('php://memory', 'w');

foreach ($volume as $fields) {
    fputcsv($fp, $fields, ';');
}
// reset the file pointer to the start of the file
fseek($fp, 0);
// tell the browser it's going to be a csv file
header('Content-Type: application/csv');
// tell the browser we want to save it instead of displaying it
header('Content-Disposition: attachment; filename="topX.csv";');
// make php send the generated csv lines to the browser
fpassthru($fp);
fclose($fp);
$subscribers->close();
$mysqli->close();
