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
                <a href="#clients">Add User</a>

            </div>
            <div class="main_container">
                <div class="inside_main_container">
                    <div class="form">
                        <form action="" method="post" class="add_form">
                            <label> Select Subject :</label>
                            <select name="select_sub" class="select">
                                <option value="">Select Subject</option>
                                <?php
                                $select_sub_sql = "SELECT * FROM subjects";
                                $select_sub_result = mysqli_query($conn, $select_sub_sql);

                                while ($fetch_value  = mysqli_fetch_assoc($select_sub_result)) {
                                    $fetch_sub_value = $fetch_value['subject'];
                                    $fetch_sub_id = $fetch_value['id'];
                                    echo "<option value='$fetch_sub_id'>" . $fetch_sub_value . "</option>";
                                }
                                ?>

                            </select>
                            <br><br>
                            <label> Select chapter :</label>
                            <select name="select_chapter" class="select">
                                <option value="">Select Chapter</option>
                                <?php
                                $select_chapter_sql = "SELECT * FROM chapters";
                                $select_chapter_result = mysqli_query($conn, $select_chapter_sql);

                                while ($fetch_value  = mysqli_fetch_assoc($select_chapter_result)) {
                                    $fetch_chapter_value = $fetch_value['chapter'];
                                    $fetch_chapter_id = $fetch_value['id'];
                                    echo "<option value='$fetch_chapter_id'>" . $fetch_chapter_value . "</option>";
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
    $assign_sub = $_POST['select_sub'];
    $assign_chapter = $_POST['select_chapter'];

    $assign_chapter_sql = "INSERT INTO `chapter_relation` (`chapter_id`, `sub_id`) VALUES ('$assign_chapter', '$assign_sub')";
    $assign_chapter_result = mysqli_query($conn, $assign_chapter_sql);
}
?>