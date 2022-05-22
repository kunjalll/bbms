
<?php
// Include config file
require_once "config.php";

//Define variables and initialize with empty values
$name = $contact = $blood_type = "";
$name_err = $contact_err = $blood_type_err = "";
// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    echo "1";


//Validate first name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name";
        echo "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid first name";
        echo "Please enter a valid first name";
    } else {
        $name = $input_name;
    }

//Validate contact
    $input_contact = trim($_POST["contact"]);
    if (empty($input_contact)) {
        $contact_err = "Please enter a contact";
        echo "Please enter a contact.";
    } elseif (!filter_var($input_contact, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $contact_err = "Please enter a valid contact";
        echo "Please enter a valid contact";

    } else {
        $contact = $input_contact;
    }
//Validation of blood type
    $input_blood_type = trim($_POST["blood_type"]);
    if (empty($input_blood_type)) {
        $blood_type_err = "Please enter a blood type";
        echo "Please enter a blood type";
    } else {
        $blood_type = $input_blood_type;
    }

// Check input errors before inserting in database
    if (empty($name_err) && empty($contact_err) && empty($blood_type_err)) {
        echo "2";

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "7";

            // Records updated successfully. Redirect to landing page
            header("location: retrieve_to.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


// Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
        echo "8";

        // Prepare a select statement
        $sql = "SELECT * FROM donar WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            echo "9";

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                echo "10";

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $first_name = $row["name"];
                    $last_name = $row["contact"];
                    $email = $row["blood_type"];


                } else {
                    echo "11";

                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
<a href="retrieve_to.php">Home</a>
<br><br>
<form method="post" action="" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo $name; ?>"<br><br>
    <input type="text" name="contact" value="<?php echo $contact; ?>"<br><br>
    <input type="email" name="blood_type" value="<?php echo $blood_type; ?>" <br><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="update">
</form>

</body>
</html>
update_details.php
Displaying update_details.php.