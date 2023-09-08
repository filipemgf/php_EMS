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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS - All Employees</title>
</head>
<body>
    <?php require "notification.php" ?>
    <a href="index.php">Home</a>
    <table>
        <caption>All employees</caption>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Options</th>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT * FROM employees"; 
            $results = $db->query($sql);

            if ($results->num_rows > 0) { 
                while ($row = $results->fetch_assoc()) {?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($row["id"])  ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row["name"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row["phone"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row["email"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row["address"]) ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $row["id"] ?>">
                                Edit
                            </a>
                            <a href="delete.php?id=<?php echo $row["id"] ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php 
                }
            } else {
                $_SESSION["message"] = "No employees found in the database.";
                header("location: index.php");
                exit();
            };
            ?>
        </tbody>
    </table>
</body>
</html>
