<?php

session_start();

if (empty($_SESSION['email'])) {
    header("Location: ../admin_panel/login/login.php");
}

?>

<?php
include "../db.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM info WHERE id=$id";
    mysqli_query($conn, $query);
    $success = "Data deleted successfully.";
    header('location:view_data.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/table.css">
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
                    <a href="../Education/standards.php">Standards</a>
                    <a href="../Education/subjects.php">Subjects</a>
                    <a href="../Education/chapters.php">Chapters</a>
                    <?php
                    if ($_SESSION['access_type'] == "Admin") {
                    ?>
                        <a href="../Education/assign_chapter.php">Assign Chapters</a>

                    <?php
                    }
                    ?>
                    <?php

                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {

                    ?>
                        <a href="../Education/assign_subject.php">Assign Subjects</a>
                    <?php
                    }
                    ?>
                    <?php
                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                    ?>
                        <a href="../Education/assign_student.php">Assign Student</a>
                    <?php
                    }
                    ?>
                </div>
                <a href="view_data.php">View Data</a>
                <a href="#clients">Add User</a>

            </div>
            <div class="main_container">
                <div class="inside_main_container">
                    <?php
                    $sqlSelect = "SELECT * from info";

                    $result = mysqli_query($conn, $sqlSelect);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <div class="table">
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Contact</th>
                                        <th>Age</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php

                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['username'] ?></td>
                                        <td><?php echo $row['contact'] ?></td>
                                        <td><?php echo $row['age'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><a href="edit.php?edit=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">Edit</a>
                                            <a href="view.php?view=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">view</a>
                                            <a href="view_data.php?delete=<?php echo $row["id"]; ?>" class="del_btn btn btn-danger">Delete</a>
                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
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