<?php
/**
 * The index for the project
 *
 * Has the major html structure and calls upon functions in other files
 *
 * PHP version 8.2
 *
 * @category Index
 * @package  Index
 * @author   Filipe Ferreira <filipeferreira94@gmail.com>
 * @license  MIT License
 * @version  GIT: $ID$
 * @link     placeholder.com
 */

require_once "db.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS</title>
</head>
<body>
    <?php require "notification.php" ?>
    <h1>Employee Management System</h1>
    <form method="post">
        <div>
            <p><a href="view.php">View all employees</a></p>
            <p><a href="create.php">Add a new employee</a></p>
        </div>
    </form>
</body>
</html>