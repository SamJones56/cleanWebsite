<?php
/**
 * Configuration for database connection
 *
 */
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "hotelTallafornia"; // database name
$dsn = "mysql:host=$host;dbname=$dbname"; // datbase DSN
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

//"Emilys-MacBook-Pro-2.local"