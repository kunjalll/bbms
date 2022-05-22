<?php

require_once "config.php";
if (isset($_POST["search_keyword"]) && isset($_POST["search_keyword"])){
    $search_keyword=$_POST["search_keyword"];

    $search_field=$_POST["search_field"];


    if($search_field=="location"){
        $sql="SELECT * FROM donar WHERE blood_type LIKE '%".$search_keyword."%'";
        $result = mysqli_query($conn, $sql);
    }

}
?>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<body>
<!--navigation bar-->
<nav class="navbar navbar-expand-sm bg-dark navbar>
    <div class="container-fluid">
<a href="mainpage_receiver.php" class="navbar-brand nav-link">blood bank</a>
<div class="collapse navbar-collapse">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="mainpage_receiver.php" class="nav-link" >Home page</a>
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
<div class="container-fluid">
    <a href="create.php" method="post">Create</a>
    <form action="search.php" method="post">
        <input type="text" name="search_keyword" placeholder="search here" required>
        <select name="search_field" required>
            <option value="blood_type">blood_type</option>

        </select>
        <input type="submit" value="search">
    </form>

    <?php
    if(isset($result)) {
        if (mysqli_num_rows($result) == 0) {
            if (mysqli_num_rows($result) == 0) {
                echo "<tr>";
                echo "<td colspan='7'> Oops  not available</td>";
                echo "</tr>";
            }
        }else{
            echo" <table border=1 class='table table-light'>";
            echo"<tr>";
            echo"<th>id</th>";
            echo"<th>name</th>";
            echo" <th>blood_type</th>";
            echo"<th>gender</th>";
            echo"<th>age</th>";
            echo"<th>address</th>";
            echo"<th>phone_number</th>";
            echo"<th>disease_history</th>";



            echo"</tr>";
        }
        ?>



        <?php foreach($result as $row){?>
            <tr>
                <td><?php echo$row['id']?></td>
                <td><?php echo$row['name']?></td>
                <td><?php echo$row['blood_type']?></td>
                <td><?php echo $row['gender']?></td>
                <td><?php echo $row['age']?></td>
                <td><?php echo $row['address']?></td>
                <td><?php echo $row['phone_number']?></td>
                <td><?php echo $row['disease_history']?></td>
            </tr>
            <?php
        }
        ?>
    <?php }?>
</div>

</body>
</html>