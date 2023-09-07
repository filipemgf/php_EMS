<?php
/**
 * The database logic
 *
 * Contains the logic for starting the db and performing CRUD operations
 *
 * PHP version 8.2
 *
 * @category Database
 * @package  Database
 * @author   Filipe Ferreira <filipeferreira94@gmail.com>
 * @license  MIT License
 * @version  GIT: $ID$
 * @link     placeholder.com
 */

$host = "localhost";
$username = "root";
$password = "";
$dbName = "EMS_project";


// Connect to db 
$db = new mysqli($host, $username, $password, $dbName);

if ($db->connect_error) {
    die("Connection Failed - ERROR : " . $mysqlServer->connect_error);
}

