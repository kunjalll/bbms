<?php
if($role ="admin"){
    header("location: welcome_admin.php");
}else{   //Redirect user to welcome page
    header("location: welcome_user.php");}

if (isset($_SESSION['role']) && $_SESSION['role'] == 'donar') {
    header("location: retrieve_to.php");
} else if (isset($_SESSION['donar']) && $_SESSION['role'] == 'reciver') {
    header("location: search.php");
} else {
    header("location: mainpage_donar.php");
}
?>
