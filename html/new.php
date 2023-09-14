<?php
session_start();

$name = $_POST["name"];
$age = $_POST["age"];
$number = $_POST["number"];
$addr = $_POST["addr"];
$opt = $_POST["opt"];

// Validating phone number
function validateIndianPhoneNumber($phone_number) {
    $pattern = "/^(?:\+91|0)?[6789]\d{9}$/";
    if (preg_match($pattern, $phone_number)) {
        return true;
    } else {
        return false;
    }
}

// Validating name
function validateName($name) {
    $pattern = "/^[a-zA-Z\s']+$/";
    if (preg_match($pattern, $name)) {
        return true;
    } else {
        return false;
    }
}

$verify_number = validateIndianPhoneNumber($number);
$verify_name = validateName($name);

if ($verify_name && $verify_number) {
    // Connection to the MySQL database
    $con = mysqli_connect("localhost", "root", "Qwerty#99", "root");

    if ($con) {
        // Create a table if it doesn't exist
        $createTableSQL = "CREATE TABLE IF NOT EXISTS user_data (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            age INT,
            phone_number VARCHAR(15) NOT NULL,
            address VARCHAR(255),
            option_value VARCHAR(255)
        )";

        if (mysqli_query($con, $createTableSQL)) {
            // Insert data into the table
            $insertDataSQL = "INSERT INTO user_data (name, age, phone_number, address, option_value) 
                              VALUES ('$name', '$age', '$number', '$addr', '$opt')";

            if (mysqli_query($con, $insertDataSQL)) {
                echo "Data inserted successfully!";
            } else {
                $_SESSION['error'] = "Error: " . mysqli_error($con);
            }
        } else {
            $_SESSION['error'] = "Error creating table: " . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
        $_SESSION['success'] = "Thank You For Registering With SPCA Hosur";

    } else {
        $_SESSION['error'] = "Error connecting to the database: " . mysqli_connect_error();
    }
} else {
    $_SESSION['error'] = "Invalid name or phone number.";
}

header("Location: index.php");
?>
