<?php
require_once "config.php";

// Define variables and initialize with empty values
$name= $blood_type = $gender = $age = $address = $phone_number = $disease_history = "";
$name_err = $blood_type_err = $gender_err = $age_err = $address_err = $phone_number_err= $disease_history_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
        echo "Please enter a name";
    }
    elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
        echo "Please enter a valid name.";
    }

    else {
        $name = $input_name;
    }


// Validate blood_type
    $input_blood_type = trim($_POST["blood_type"]);
    if (empty($input_blood_type)) {
        $blood_type_err = "Please enter a blood type";
        echo "Please enter a blood type";
    }
    elseif (!filter_var($input_blood_type, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid blood type";
        echo "Please enter a valid blood type";

    } else {
        $blood_type = $input_blood_type;
    }

// Validate gender
    $input_gender = trim($_POST["gender"]);
    if (empty($input_gender)) {
        $gender_err = "Please enter your gender";
        echo "Please enter your gender";
    }
    elseif (!filter_var($input_gender, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $gender_err = "Please enter your gender ";
        echo "Please enter your valid gender";

    } else {
        $gender = $input_gender;
    }



    // Validate age
    $input_age = trim($_POST["age"]);
    if (empty($input_age)) {
        $age_err = "Please enter your age.";
        echo "Please enter your age";
    } elseif (!filter_var($input_age, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $age_err = "Please enter your age.";
    } else {
        $age = $input_age;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter your address.";
        echo "Please enter your address";
    } elseif (!filter_var($input_address, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $address_err = "Please enter your address.";
    } else {
        $address = $input_address;
    }


    // Validate phone number
    $input_phone_number = trim($_POST["phone_number"]);
    if (empty($input_phone_number)) {
        $phone_number_err = "Please enter your phone number.";
        echo "Please enter your phone number";
    } elseif (!filter_var($input_phone_number, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $phone_number_err = "Please enter the age.";
    } else {
        $phone_number = $input_phone_number;
    }

    // Validate disease history
    $input_disease_history = trim($_POST["disease_history"]);
    if (empty($input_disease_history)) {
        $disease_history_err = "Please enter your disease history.";
        echo "Please enter your disease history";
    } elseif (!filter_var($input_disease_history, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $disease_history_err = "Please enter the your disease_history.";
    } else {
        $disease_history = $input_disease_history;
    }


    if (empty($name_err) && empty($blood_type_err) && empty($gender_err) && empty($age_err) && empty($address_err) && empty($phone_number_err) && empty($disease_history_err)) {




        // Prepare an insert statement
        $sql = "INSERT INTO donar ( name, blood_type, gender, age, address,phone_number,disease_history) VALUES (?,?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $name, $blood_type, $gender, $age, $address, $phone_number, $disease_history);


            // Set parameters
            $name = trim($_POST['name']);
            $blood_type = trim($_POST['blood_type']);
            $gender = trim($_POST['gender']);
            $age = trim($_POST['age']);
            $address = trim($_POST['address']);
            $phone_number = trim($_POST['phone_number']);
            $disease_history = trim($_POST['disease_history']);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: retrieve_to.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }

// Close statement
        mysqli_stmt_close($stmt);

// Close connection
        mysqli_close($conn);
    }

}
?>


<!doctype html>
<html lang="en">
<head>
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<!--navigation bar-->
<nav class="navbar navbar-expand-sm bg-dark navbar>
    <div class="container-fluid">
<a href="mainpage_donar.php" class="navbar-brand nav-link">BLOOD DONATION</a>
<div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="mainpage_donar.php" class="nav-link" >Home page</a>
        </li>
        <li class="nav-item">
            <a href="create.php" class="nav-link" >Upload </a>
        </li>
        <li class="nav-item">
            <a href="search.php" class="nav-link">Search</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Log out</a>
        </li>
    </ul>
</div>
</div>
</nav>
<form action="create.php" method="post" enctype="multipart/form-data">
    name: <input type="text" placeholder="Enter your name " name="name" > <br><br>
    <label >Blood type:</label>
    <select name="blood_type">
        <option value="">--SELECT--</option>
        <option value="O negative">O negative</option>
        <option value="O positive">O positive</option>
        <option value="A negative">A negative</option>
        <option value="A positive">A positive</option>
        <option value="B negative">B negative</option>
        <option value="B positive">B positive</option>
        <option value="AB negative">AB negative</option>
        <option value="AB positive">AB positive</option>
    </select> <br> <br>
    <label >gender:</label>
    <select name="gender">
        <option value="">--SELECT--</option>
        <option value="male"> male</option>
        <option value="female">female</option>
        <option value="others">others</option>
    </select> <br> <br>
    age : <input type="text" placeholder="Enter your age" name="age"> <br><br>
    address : <input type="text" placeholder="Enter your address" name="address"> <br><br>
    phone_number : <input type="text" placeholder="Enter your phone number" name="phone number"> <br><br>
    disease_history : <input type="text" placeholder="Enter your disease history" name="disease history"> <br>
    <input type="submit" value="Submit">
</form>

</body>
</html>