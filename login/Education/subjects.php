<?php
session_start();
require "../db.php";
$showError = "";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM subjects WHERE id=$id";
    mysqli_query($conn, $query);
    $success = "Data deleted successfully.";
    header('location:subjects.php');
}

?>


<?php
if (isset($_POST['add_subject'])) {
?>
    <form action="subjects.php" method="post" name="add_sub_form">
        <input type="text" name="sub_input" autofocus>
        <input type="submit" name="add" value="add">
    </form>

<?php
}
?>

<?php
if (isset($_POST['add'])) {
    $sub_input = $_POST['sub_input'];
    $sub_insert = "INSERT INTO `subjects` (`subject`) VALUES ('$sub_input')";

    $sub_insert_result = mysqli_query($conn, $sub_insert);
    header('location:subjects.php');
}
?>


<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM subjects WHERE id=$id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    $std = $data['subject'];
    $id = $data['id'];

?>
    <form action="" method="post" name="update_sub_form" class="update_sub_form">
        <input type="text" name="sub_input" value="<?php echo htmlspecialchars($data['subject']); ?>" autofocus>
        <input type="submit" name="update" value="Update">
    </form>
<?php
}
?>

<?php
if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $sub_input = trim($_POST['sub_input']);

    $sql = "SELECT * FROM `subjects` WHERE  `subject` = '$sub_input'";

    $result = mysqli_query($conn, $sql);
    $num_exists_row = mysqli_num_rows($result);

    if ($num_exists_row > 0) {
        $showError = "Subject already exists";
    } else {
        $sql_update = "UPDATE subjects SET subject='$sub_input' WHERE id=$id";

        $result = mysqli_query($conn, $sql_update);

        if ($result) {
            $showError = "Subject Upadated Succesfully";
?>
            <style>
                .update_sub_form {
                    display: none;
                }
            </style>
<?php
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            margin-left: 20px;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 5px;
        }

        .back-btn {
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

        .back-btn:focus {
            color: #3498db;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }
    </style>

</head>

<body>
    <br>
    <div class="message">
        <?php if ($showError) {
            echo $showError;
        } ?>
    </div>


    <br>
    <?php
    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
    ?>
        <form action="" method="post">
            <input type="submit" name="add_subject" value="Add Subject">
        </form>
    <?php
    }
    ?>
    <br> <br>

    <?php
    $sqlSelect = "SELECT * from subjects";

    $result = mysqli_query($conn, $sqlSelect);

    if (mysqli_num_rows($result) > 0) {
    ?>
        <table border="1">
            <thead>
                <tr>
                    <th>subjects</th>
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
                    <td><?php echo $row['subject'] ?></td>
                    <?php
                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                    ?>
                        <td><a href="subjects.php?edit=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">Edit</a>
                            <a href="subjects.php?delete=<?php echo $row["id"]; ?>" class="del_btn btn btn-danger">Delete</a>
                        </td>

                    <?php
                    }
                    ?>

                </tr>
            <?php
            }
            ?>
        </table>
        <br> <br>
        <a href="education_desk.php" class="back-btn">Back</a>
    <?php
    } else {
        echo "data not found";
    }

    ?>
</body>

</html>