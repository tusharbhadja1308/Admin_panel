<?php

session_start();

if (empty($_SESSION['email'])) {
    header("Location: ../login/login.php");
}

?>

<?php
include "../db.php";

if (isset($_GET['view'])) {
    $id = $_GET['view'];

    $sql_user_select = "SELECT * FROM info WHERE id=$id";
    $result = mysqli_query($conn, $sql_user_select);
    $data = mysqli_fetch_array($result);

    if ($data) {
        $username = $data['username'];
        $contact = $data['contact'];
        $age = $data['age'];
        $email = $data['email'];
        $profile_img = $data['profile_img'];
    } else {
        echo "error in fetching data";
    }
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
                <a href="../login/add_user.php">Add User</a>

            </div>
            <div class="main_container">
                <div class="inside_main_container">
                    <div class="view_left">
                        <div class="profile">
                            <div class="img">
                                <img src="<?php echo '../login/images/' . $profile_img; ?>" alt="<?php echo $profile_img . '`sProfile Image'; ?>">
                            </div>
                            <br>
                            <div class="name"><?php echo $username; ?></div>


                        </div>
                    </div>
                    <div class="view_right">
                        <div class="contain">
                            <h2 class="text-center mt-2">General Information</h2>

                            <div class="info">
                                <div>Username : <?php echo $username; ?></div>
                                <div>Contact : <?php echo $contact; ?></div>
                                <div>Age : <?php echo $age; ?></div>
                                <div>Email : <?php echo $email; ?></div>
                                <div><a href="view_data.php" class="btn btn-primary">Go Back</a></div>
                            </div>
                        </div>
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