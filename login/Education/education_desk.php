<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        a {
            text-decoration: none;
            margin: 15px 10px;
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

        a:focus {
            color: #3498db;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }
    </style>
</head>

<body>
    <br>
    <a href="standards.php">Standards</a>
    <a href="subjects.php">Subjects</a>
    <a href="chapters.php">Chapters</a>
    <?php
    if ($_SESSION['access_type'] == "Admin") {
    ?>
        <a href="assign_chapter.php">Assign Chapter</a>
    <?php
    }
    ?>
    <?php
    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
    ?>
        <a href="assign_subject.php">Assign Subject</a>
    <?php
    }
    ?>
    <?php
    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
    ?>
        <a href="assign_student.php">Assign Student</a>
    <?php
    }
    ?>
    <br><br>
    <a href="../welcome.php">Back</a>
</body>

</html>