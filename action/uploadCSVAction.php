<?php
$file = '../csv/tickets_appels_201202.csv';

$csv = array_map('str_getcsv', file($file));
array_shift($csv); # remove column header
array_shift($csv); # remove column header
array_shift($csv); # remove column header
$mysqli = new mysqli('127.0.0.1', 'admin', '', 'test');

$mysqli->query('TRUNCATE TABLE call_ticket'); // empty call_ticket table

foreach ($csv as $ticket) {
    $arrayTicket = explode (';', $ticket[0]);

    /**
     * Prepare sql request
     *
     * Cut "Durée/volume réel" and "Durée/volume facturé" columns for simplify sql research
     */
    $sql = sprintf(
        'INSERT INTO call_ticket (
                    id,
                    billed_acount, 
                    invoice_number,
                    subscriber_number,
                    date,
                    hour,
                    real_duration,
                    real_volume,
                    invoiced_duration,
                    invoiced_volume,
                    type
                )
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)',
        'null',
        '\''.$arrayTicket[0].'\'',
        '\''.$arrayTicket[1].'\'',
        '\''.$arrayTicket[2].'\'',
        '\''.DateTime::createFromFormat('d/m/Y', $arrayTicket[3])->format('Y-m-d').'\'', // Change format for sql research
        '\''.$arrayTicket[4].'\'',
        $arrayTicket[5] ? (float) $arrayTicket[5] == 0 ?  '\''.$arrayTicket[5].'\'' : 'null' : 'null', // real_duration
        $arrayTicket[5] ? (float) $arrayTicket[5] > 0 ? (float) $arrayTicket[5] : 'null' : 'null', // real_volume
        $arrayTicket[6] ? (float) $arrayTicket[6] == 0 ? '\''.$arrayTicket[6].'\'' : 'null' : 'null', // invoiced_duration
        $arrayTicket[6] ? (float) $arrayTicket[6] > 0 ? (float) $arrayTicket[6] : 'null' : 'null', // invoiced_volume
        '\''.$arrayTicket[7].'\''
    );

    $mysqli->query($sql);
}

$mysqli->close();
