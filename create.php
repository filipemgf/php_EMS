<?php
/**
 * The create employee page
 *
 * Has the major html structure for the create employee page
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

require_once "db.php";
?>
<?php 

session_start();

$name = $phone = $email = $address = $gender = "";
$nameErr = $phoneErr = $emailErr = $addressErr = $genderErr = "";

$formFields = ["name", "phone", "email", "address", "gender"];

// Validation

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($formFields as $field) {
        if (empty($_POST[$field])) {
            ${$field . "Err"} = ucfirst($field) . " is required";
        } else {
            ${$field} = $db->real_escape_string($_POST[$field]);
        }
    }

    if (empty($nameErr)  
        && empty($phoneErr) 
        && empty($emailErr)  
        && empty($addressErr) 
        && empty($genderErr)
    ) {
        // Prepared statement
        $prep = $db->prepare(
            "INSERT INTO employees (name,phone,email,address, gender ) 
        VALUES (?, ?, ?, ?, ?)"
        );
        // Binding parameters
        $prep->bind_param("sisss", $name, $phone, $email, $address, $gender);
        // Executing and closing
        $prep->execute();
        $prep->close();

        $_SESSION["message"] = "Employee Added";

        //redirect the user
        header("location: index.php");
        exit();
    } else {
        $_SESSION["message"] = "One or more field(s) are empty";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMS - Add employee</title>
</head>
<body>
    <?php require "notification.php" ?>
    <h1>Add employee</h1>
    <section>
        <form method="post">
            <?php 
            
            ?>
            <p>
                <input type="text" name="name" placeholder="Add full name"> 
                <?php echo "<span class='error'>" . $nameErr . "</span>"?>
            </p>
            
            <p>
                <input type="tel" name="phone" placeholder="Add phone number">
                <?php echo "<span class='error'>" . $phoneErr . "</span>"?>
                </p>

            <p>
                <input type="email" name="email" placeholder="Add email">
                <?php echo "<span class='error'>" . $emailErr . "</span>"?>
            </p>
            <p>
                <input type="address" name="address" placeholder="Add address">
                <?php echo "<span class='error'>" . $addressErr . "</span>"?>
            </p>
            <div>
                <label>Gender: </label> 
                <label for="male">
                    Male
                    <input type="radio" name="gender" value="Male" id="male">
                </label>
                <label for="female">
                    Female
                    <input type="radio" name="gender" id="female" value="Female">
                </label>
                <?php echo "<span class='error'>" . $genderErr . "</span>"?>
            </div>
            <button type="submit">Submit</button>
            </form>
            </section>
            </body>
            </html>