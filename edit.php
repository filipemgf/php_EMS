<?php
/**
 * The create employee page
 *
 * Has the major html structure and logic for the edit employee page
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

$oldName = $oldPhone = $oldEmail = $oldAddress = $oldGender = "";

$formFields = ["name", "phone", "email", "address", "gender"];

// Validation

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    //securing the ID for query
    $id = $db->real_escape_string($_GET["id"]);

    $sql = "SELECT * FROM employees WHERE id = '$id'";
    $results = $db->query($sql);

    if ($results) {
        while ($row = $results->fetch_assoc()) {
            $oldName = $row["name"];
            $oldPhone = $row["phone"];
            $oldEmail = $row["email"];
            $oldAddress = $row["address"];
            $oldGender =$row["gender"];
        }
    }

}

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
            "UPDATE employees 
            SET name = ?, phone = ?, email = ?, address = ?, gender = ? 
            WHERE id = ?"
        );
        // Binding parameters
        $prep->bind_param("sisssi", $name, $phone, $email, $address, $gender, $id);
        // Executing and closing
        $prep->execute();
        $prep->close();

        $_SESSION["message"] = "Employee updated successfully";

        //redirect the user
        header("location: view.php");
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
                <input type="text" name="name" 
                value="<?php echo $oldName ?>"> 
                <?php echo "<span class='error'>" . $nameErr . "</span>"?>
            </p>
            
            <p>
                <input type="tel" name="phone" 
                value="<?php echo $oldPhone ?>">
                <?php echo "<span class='error'>" . $phoneErr . "</span>"?>
                </p>

            <p>
                <input type="email" name="email" 
                value="<?php echo $oldEmail ?>">
                <?php echo "<span class='error'>" . $emailErr . "</span>"?>
            </p>
            <p>
                <input type="address" name="address" 
                value="<?php echo $oldAddress ?>">
                <?php echo "<span class='error'>" . $addressErr . "</span>"?>
            </p>
            <div>
                <label>Gender: </label> 
                <label for="male">
                    Male
                    <input type="radio" name="gender" value="Male" id="male" 
                    <?php if ($oldGender == "Male") { 
                        echo "checked"; 
                    } ?> >
                </label>
                <label for="female">
                    Female
                    <input type="radio" name="gender" id="female" value="Female"
                    <?php if ($oldGender == "Female") { 
                        echo "checked"; 
                    } ?>
                    >
                </label>
                <?php echo "<span class='error'>" . $genderErr . "</span>"?>
            </div>
            <button type="submit">Submit</button>
            </form>
            </section>
            </body>
            </html>