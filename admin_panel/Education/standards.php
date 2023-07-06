<?php

session_start();

if (empty($_SESSION['email'])) {
    header("Location: ../login/login.php");
}

?>

<?php
include "../db.php";

$showError = "";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM standards WHERE id=$id";
    mysqli_query($conn, $query);
    // $success = "Data deleted successfully.";
    header('location:standards.php');
}
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
                        <a href="assign_chapter.php">Assign Chapters</a>

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
                    <?php
                    if (isset($_POST['add_standard'])) {
                    ?>
                        <form action="standards.php" method="post" name="add_std_form" class="add_form">
                            <input type="number" name="std_input" autofocus>
                            <br><br>
                            <input type="submit" name="add" value="add">
                            <br><br>

                        </form>

                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_POST['add'])) {
                        $std_input = $_POST['std_input'];
                        $std_insert = "INSERT INTO `standards` (`standard`) VALUES ('$std_input')";

                        $std_insert_result = mysqli_query($conn, $std_insert);
                        header('location:standards.php');
                    }
                    ?>

                    <?php
                    if (isset($_GET['edit'])) {
                        $id = $_GET['edit'];

                        $query = "SELECT * FROM standards WHERE id=$id";
                        $result = mysqli_query($conn, $query);
                        $data = mysqli_fetch_array($result);

                        $std = $data['standard'];
                        $id = $data['id'];

                    ?>
                        <form action="" method="post" name="update_std_form" class="update_std_form add_form">
                            <input type="number" name="std_input" value="<?php echo $data['standard']; ?>" autofocus>
                            <br><br>
                            <input type="submit" name="update" value="Update">
                        </form>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_POST['update'])) {
                        $id = $_GET['edit'];
                        $std_input = $_POST['std_input'];

                        $sql = "SELECT * FROM `standards` WHERE  `standard` = '$std_input'";
                        $result = mysqli_query($conn, $sql);
                        $num_exists_row = mysqli_num_rows($result);



                        if ($num_exists_row > 0) {
                            $showError = "Standard already exists";
                        } else {
                            $sql_update = "UPDATE standards SET standard='$std_input' WHERE id=$id";

                            $result = mysqli_query($conn, $sql_update);

                            if ($result) {
                                $showError = "Standards Upadated Succesfully";
                                // header('location:standards.php');
                    ?>
                                <style>
                                    .update_std_form {
                                        display: none;
                                    }
                                </style>
                    <?php
                            }
                        }
                    }
                    ?>

                    <div class="message">
                        <?php if ($showError) {
                            echo $showError;
                        } ?>
                    </div>

                    <br><br>
                    <?php
                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                    ?>
                        <form action="" method="post" class="add_form">
                            <input type="submit" name="add_standard" value="Add Standard">
                        </form>
                        <br>
                    <?php
                    }
                    ?>

                    <?php
                    $sqlSelect = "SELECT * from standards";

                    $result = mysqli_query($conn, $sqlSelect);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <div class="table">
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>Standard</th>
                                        <?php
                                        if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                                        ?>
                                            <th>Actions</th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <?php

                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['standard'] ?></td>
                                        <?php
                                        if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                                        ?>
                                            <td><a href="standards.php?edit=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">Edit</a>
                                                <a href="standards.php?delete=<?php echo $row["id"]; ?>" class="del_btn btn btn-danger">Delete</a>
                                            </td>
                                        <?php
                                        }
                                        ?>

                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <br> <br>

                        <!-- <a href="education_desk.php" class="back-btn">Back</a> -->
                    <?php
                    } else {
                        echo "data not found";
                    }

                    ?>

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