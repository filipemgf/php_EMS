<?php
/**
 * The notification logic
 *
 * Contains the logic for the notification based on current Session
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

if (isset($_SESSION["message"])) {
    ?>
    <div>
        <?php echo $_SESSION["message"] ?>
    </div>
    

    <?php 
    unset($_SESSION["message"]);
    session_destroy();

} ?>