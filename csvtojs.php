<?php

function csvToJson($csvUrl) {
    $csvData = [];
    
    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = []; //perbaikan : jika sudah menggunakan fungsi $jsonArray tidak perlu menambahkan "Array" lagi, hanya [] saja sudah cukup atau Array().

    foreach ($csvData as $row) {
        $jsonArrayItem = [];
        for ($i = 0; $i < count($headers); $i++) {
            $jsonArrayItem[$headers[$i]] = $row[$i];
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvUrl = 'https://testingalpro.alwaysdata.net/api/coffee.csv';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
