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





try {
    // Connect to mySql server
    $mysqlServer = new mysqli($host, $username, $password);
    if ($mysqlServer->connect_error) {
        throw new Exception(
            "Connection do mySql Server Failed - " . $mysqlServer->connect_error
        );
    }

    //create Database
    $sql= "CREATE DATABASE IF NOT EXISTS $dbName";
    $mysqlServer->query($sql);
        

    // Connect to db 
    $db = new mysqli($host, $username, $password, $dbName);

    if ($db->connect_error) {
        throw new Exception(
            "Connection to Database $dbName Failed - " 
            . $mysqlServer->connect_error
        );
    }

    // Create Table of employees
    $sql = "CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    email VARCHAR(25) NOT NULL,
    address VARCHAR(250) NOT NULL,
    gender VARCHAR(25) NOT NULL,
    UNIQUE KEY (name),
    UNIQUE KEY (email)
    )";

    $db->query($sql); 
    

    

    // Check if DB already seeded
    
    if (!isset($seedStatus)) {
        //create table to store seed status
        $sql = "CREATE TABLE IF NOT EXISTS seeding_status(
        seeded BOOLEAN DEFAULT 0 )";
        $db->query($sql);

        // insert the row if it doesnt exist
        $db->query("INSERT IGNORE INTO seeding_status (seeded) VALUES (0)");

        $result = $db->query("SELECT seeded FROM seeding_status LIMIT 1");

        $row = $result->fetch_assoc();
        $seedStatus = $row["seeded"];

        // if not seeded, seed from file
        if ($seedStatus == false) {
            include_once "seed.php";
            $db->query($sql);
            $db->query("UPDATE seeding_status SET seeded = true");
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

