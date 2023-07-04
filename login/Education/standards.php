<?php
session_start();
require "../db.php";


$showError = "";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM standards WHERE id=$id";
    mysqli_query($conn, $query);
    $success = "Data deleted successfully.";
    header('location:standards.php');
}

if (isset($_POST['add_standard'])) {
?>
    <form action="standards.php" method="post" name="add_std_form">
        <input type="number" name="std_input" autofocus>
        <input type="submit" name="add" value="add">
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
    <form action="" method="post" name="update_std_form" class="update_std_form">
        <input type="number" name="std_input" value="<?php echo $data['standard']; ?>" autofocus>
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

    <div class="message">
        <?php if ($showError) {
            echo $showError;
        } ?>
    </div>


    <br><br>
    <?php
    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
    ?>
        <form action="" method="post">
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
        <table border="1">
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
                            <a href="view.php?view=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">view</a>
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
        <br> <br>

        <a href="education_desk.php" class="back-btn">Back</a>
    <?php
    } else {
        echo "data not found";
    }

    ?>
</body>

</html>