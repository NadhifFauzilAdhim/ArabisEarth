<?php

// Database connection details
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'earthquake';

// Create a connection to the database
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Load XML file
$xmlFile = 'https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml'; // Replace with the actual path to your XML file
$xml = simplexml_load_file($xmlFile);

// Loop through each 'gempa' element in the XML
foreach ($xml->gempa as $gempa) {
    $tanggal = $gempa->Tanggal;
    $jam = $gempa->Jam;
    $datetime = $gempa->DateTime;
    $coordinates = $gempa->point->coordinates;
    $lintang = $gempa->Lintang;
    $bujur = $gempa->Bujur;
    $magnitude = $gempa->Magnitude;
    $kedalaman = $gempa->Kedalaman;
    $wilayah = $gempa->Wilayah;
    $potensi = $gempa->Potensi;

    // Insert data into the database
    $sql = "INSERT INTO earthquake_data (tanggal, jam, datetime, coordinates, lintang, bujur, magnitude, kedalaman, wilayah, potensi) 
            VALUES ('$tanggal', '$jam', '$datetime', '$coordinates', '$lintang', '$bujur', '$magnitude', '$kedalaman', '$wilayah', '$potensi')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully\n";
    } else {
        echo "Error inserting record: " . $conn->error . "\n";
    }
}

// Close the database connection
$conn->close();

?>