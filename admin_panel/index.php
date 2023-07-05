<?php
session_start();

if (empty($_SESSION['email'])) {
    header("Location: ../admin_panel/login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../admin_panel/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <header>
                <div class="left">
                    <div class="name">
                        <!-- <h2>Tushar</h2> -->
                        <h2><?php echo $_SESSION['email']; ?></h2>
                    </div>
                    <div class="access_type">
                        <!-- <h3>Admin</h3> -->
                        <h3><?php echo $_SESSION['access_type']; ?></h3>
                    </div>
                </div>
                <div class="right">
                    <div class="img">
                        <img src="" alt="">
                    </div>
                    <div class="logout">
                        <a href="../admin_panel/login/logout.php">Logout</a>
                    </div>
                </div>
            </header>
        </div>
        <div class="body">
            <div class="sidebar">
                <button class="dropdown-btn">Education
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../admin_panel/Education/standards.php">Standards</a>
                    <a href="../admin_panel/Education/subjects.php">Subjects</a>
                    <a href="../admin_panel/Education/chapters.php">Chapters</a>
                    <?php
                    if ($_SESSION['access_type'] == "Admin") {
                    ?>
                        <a href="../admin_panel/Education/assign_chapter.php">Assign Chapters</a>

                    <?php
                    }
                    ?>
                    <?php

                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {

                    ?>
                        <a href="../admin_panel/Education/assign_subject.php">Assign Subjects</a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                    ?>
                        <a href="../admin_panel/Education/assign_student.php">Assign Student</a>
                    <?php
                    }
                    ?>
                </div>
                <a href="../admin_panel/view_data/view_data.php">View Data</a>
                <a href="#clients">Add User</a>

            </div>
            <div class="main_container">
                <div class="inside_main_container">
                    <div>
                        <h1>Welcome, <?php echo $_SESSION['email']; ?></h1>
                    </div>
                    <div>
                        <h3>You Are <?php echo $_SESSION['access_type'] ?></h3>
                    </div>
                    <div>
                        <p>Thank you, Enjoy Your Day</p>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
</body>

</html>