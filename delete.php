<?php 
/**
 * The page for the employee view
 *
 * Has the major html structure and logic to display the employeers from the database
 *
 * PHP version 8.2
 *
 * @category Page
 * @package  Page
 * @author   Filipe Ferreira <filipeferreira94@gmail.com>
 * @license  MIT License
 * @version  GIT: $ID$
 * @link     placeholder.com
 */

session_start();
require_once "db.php";

$name = "";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    //securing the ID for query
    $id = $db->real_escape_string($_GET["id"]);
    $sql = "SELECT name FROM employees WHERE id = $id";
    $results = $db->query($sql);

    if ($results) {
        while ($row = $results->fetch_assoc()) {
            
            $name = $row["name"];

        }
    } else {
        $_SESSION["message"] = "Could not get employee data from database.";
        exit();
    }

    if (!empty($name) & isset($_POST["confirm"])) {
        $prep = $db->prepare(
            "DELETE FROM employees WHERE `id` = ?"
        );
        // Binding parameters
        $prep->bind_param("i", $id);
        // Executing and closing
        $result = $prep->execute();
        //display success or error message
        if ($result) {
            $_SESSION["message"] = "Employee deleted from database";
        } else {
            echo "Error deleting employee " . $prep->error;
        }
        $prep->close();
        header("location: view.php");
        exit();
    } elseif (isset($_POST["cancel"])) {
        header("location: view.php");
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Do you want to delete <?php echo $name ?> Employee nº<?php echo $id ?></h2>
    <form method="POST">
        <button name="confirm">Yes</button>
        <button name="cancel">No</button>
    </form>
</body>
</html>
