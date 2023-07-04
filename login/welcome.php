<?php

session_start();

if(empty($_SESSION['email'])){
    header("Location: login.php");
} else {  
    echo "<br>"."Welcome - " . $_SESSION['email'];
    echo "<br>"."Your type is - " . $_SESSION['access_type'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        a{
            text-decoration: none;
            margin: 15px 0;
            padding: 10px 25px;
            width: 100%;
            height: 50px;
            font-size: 18px;
            line-height: 50px;
            font-weight: 600;
            background: #dde1e7;
            border-radius: 25px;
            border: none;
            outline: none;
            cursor: pointer;
            color: #595959;
            box-shadow: 2px 2px 5px #BABECC,
                -5px -5px 10px #ffffff73;
        }

        a:focus{
            color: #3498db;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }
    </style>
</head>

<body>
    <br>
    <a href="view_data.php">view data</a> <br>
    <a href="../login/Education/education_desk.php">Education Desk</a> <br>
    <a href="add_user.php">Add User</a> <br>
    <a href="logout.php">Logout</a>    
</body>

</html>

<!-- if($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher" ){} -->