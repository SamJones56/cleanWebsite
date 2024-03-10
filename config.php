<?php
/**
 * Configuration for database connection
 *
 */
$host = "Emilys-MacBook-Pro-2.local";
$username = "root";
$password = "Bl4ckb3rry!";
$dbname = "hotelTallafornia"; // database name
$dsn = "mysql:host=$host;dbname=$dbname"; // datbase DSN
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);