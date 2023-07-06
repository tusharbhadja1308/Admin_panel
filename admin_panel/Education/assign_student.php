<?php

session_start();

if (empty($_SESSION['email'])) {
    header("Location: ../login/login.php");
}

?>

<?php
include "../db.php";

$showError = "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="../css/view.css"> -->
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/add.css">
    <link rel="stylesheet" href="../css/assign.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <header>
                <div class="view_left">
                    <div class="name">
                        <!-- <h2>Tushar</h2> -->
                        <h2><?php echo $_SESSION['email']; ?></h2>
                    </div>
                    <div class="access_type">
                        <!-- <h3>Admin</h3> -->
                        <h3><?php echo $_SESSION['access_type']; ?></h3>
                    </div>
                </div>
                <div class="view_right">
                    <div class="profile_img">
                        <img src="" alt="">
                    </div>
                    <div class="logout">
                        <a href="../login/logout.php">Logout</a>
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
                    <a href="standatds.php">Standards</a>
                    <a href="subjects.php">Subjects</a>
                    <a href="chapters.php">Chapters</a>
                    <?php
                    if ($_SESSION['access_type'] == "Admin") {
                    ?>
                        <a href="chapters.php">Assign Chapters</a>

                    <?php
                    }
                    ?>
                    <?php

                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {

                    ?>
                        <a href="assign_subject.php">Assign Subjects</a>
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
                </div>
                <a href="../view_data/view_data.php">View Data</a>
                <a href="../login/add_user.php">Add User</a>

            </div>
            <div class="main_container">
                <div class="inside_main_container">
                    <div class="form">
                        <form action="" method="post" class="add_form">
                            <label> Select Standards :</label>
                            <select name="select_std" class="select">
                                <option value="">Select Standard</option>
                                <?php
                                $select_std_sql = "SELECT * FROM standards";
                                $select_std_result = mysqli_query($conn, $select_std_sql);

                                while ($fetch_value  = mysqli_fetch_assoc($select_std_result)) {
                                    $fetch_std_value = $fetch_value['standard'];
                                    $fetch_std_id = $fetch_value['id'];
                                    echo "<option value='$fetch_std_id'>" . $fetch_std_value . "</option>";
                                }
                                ?>

                            </select>
                            <br><br>
                            <label> Select Student :</label>
                            <select name="select_student" class="select">
                                <option value="">Select Student</option>
                                <?php
                                $select_student_sql = "SELECT info.username AS student_name, info.id AS student_id 
                                FROM usertype
                                JOIN info ON usertype.user_id = info.id
                                WHERE user_type = 3 ";
                                $select_student_result = mysqli_query($conn, $select_student_sql);

                                while ($fetch_value  = mysqli_fetch_assoc($select_student_result)) {
                                    $fetch_student_value = $fetch_value['student_name'];
                                    $fetch_student_id = $fetch_value['student_id'];
                                    echo "<option value='$fetch_student_id'>" . $fetch_student_value . "</option>";
                                }
                                ?>

                            </select>
                            <br><br>


                            <input type="submit" name="submit" value="Assign">
                        </form>
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

<?php
if (isset($_POST['submit'])) {
    $assign_std = $_POST['select_std'];
    $assign_student = $_POST['select_student'];

    $assign_student_sql = "INSERT INTO `student_relation` (`student_id`, `std_id`) VALUES ('$assign_student', '$assign_std')";
    $assign_student_result = mysqli_query($conn, $assign_student_sql);
}
?>