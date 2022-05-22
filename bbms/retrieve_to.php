<?php
/* Attempt Mysql server connection. Assuming you are running MySQL
server with default setting  (user 'root' with no password)*/
$link=mysqli_connect("localhost","root", "", "bbms");
if($link===false){
    die("ERROR: could not connect". mysqli_connect_error());
}

$sql="SELECT * FROM bbms";
if($result=mysqli_query($link,$sql)){
    if(mysqli_num_rows($result)>0){
        echo '<a href= "create.php"> Create </a>';
        echo"<table border='1'>";
        echo"<tr>";
        echo"<th>id</th>";
        echo"<th>name</th>";
        echo"<th>blood type</th>";
        echo"<th>gender</th>";
        echo"<th>age</th>";
        echo"<th>address</th>";
        echo"<th>phone number</th>";
        echo"<th>disease history</th>";
        echo"<th>Edit</th>";
        echo "<th>Delete</th>";

        echo"</tr>";
        foreach ($result as $row){
            echo"<tr>";
            echo"<td>".$row['id']."</td>";
            echo"<td>".$row['name']."</td>";
            echo"<td>".$row['blood_type']."</td>";
            echo"<td>".$row['gender']."</td>";
            echo"<td>".$row['age']."</td>";
            echo"<td>".$row['address']."</td>";
            echo"<td>".$row['phone_number']."</td>";
            echo"<td>".$row['disease_history']."</td>";
            echo '<td><a href="update_details.php?id=' . $row['id']. '">Edit</a></td>';
            echo '<td><a href="delete_detail.php? id=' . $row['id'] .'">Delete</a> </td>';
            echo"</tr>";

        }
        echo"</table>";
        //Free Result Set

        mysqli_free_result($result);
    }else{
        echo"ERROR:Could not able to execute $sql.".mysqli_error($link);
    }
    mysqli_close($link);

}
?>

<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<!--navigation bar-->
<nav class="navbar navbar-expand-sm bg-dark navbar>
    <div class="container-fluid">
<a href="mainpage.php" class="navbar-brand nav-link">BLOOD BANK MANAGEMENT SYSTEM</a>
<div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="mainpage.php" class="nav-link" >Home page</a>
        </li>
        <li class="nav-item">
            <a href="create.php" class="nav-link" >Upload </a>
        </li>
        <li class="nav-item">
            <a href="search.php" class="nav-link">search</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">Log out</a>
        </li>
    </ul>
</div>
</div>
</nav>
</html>

