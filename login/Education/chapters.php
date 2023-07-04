<?php
session_start();
require "../db.php";
$showError = "";
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM chapters WHERE id=$id";
    mysqli_query($conn, $query);
    $success = "Data deleted successfully.";
    header('location:chapters.php');
}

?>


<?php
if (isset($_POST['add_chapter'])) {
?>
    <form action="chapters.php" method="post" name="add_chapter_form">
        <input type="text" name="chapter_input" autofocus>
        <input type="submit" name="add" value="add">
    </form>

<?php
}
?>

<?php
if (isset($_POST['add'])) {
    $chapter_input = $_POST['chapter_input'];
    $chapter_insert = "INSERT INTO `chapters` (`chapter`, `sub_id`) VALUES ('$chapter_input', '0')";
    // print_r($chapter_insert);
    // die;

    $chapter_insert_result = mysqli_query($conn, $chapter_insert);
    header('location:chapters.php');
}
?>


<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $query = "SELECT * FROM chapters WHERE id=$id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    // $std = $data['chapter'];
    // $id = $data['id'];

?>
    <form action="" method="post" name="update_chapter_form" class="update_sub_form">
        <input type="text" name="chapter_input" value="<?php echo htmlspecialchars($data['chapter']); ?>" autofocus>
        <input type="submit" name="update" value="Update">
    </form>
<?php
}
?>

<?php
if (isset($_POST['update'])) {
    $id = $_GET['edit'];
    $chapter_input = trim($_POST['chapter_input']);

    $sql = "SELECT * FROM `chapters` WHERE  `chapter` = '$chapter_input'";

    $result = mysqli_query($conn, $sql);
    $num_exists_row = mysqli_num_rows($result);

    if ($num_exists_row > 0) {
        $showError = "Chapter already exists";
    } else {
        $sql_update = "UPDATE chapters SET chapter='$chapter_input' WHERE id=$id";

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

    <div class="message">
        <?php if ($showError) {
            echo $showError;
        } ?>
    </div>

    <?php
    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
    ?>
        <br><br>
        <form action="" method="post">
            <input type="submit" name="add_chapter" value="Add Chapter">
        </form>

    <?php
    }
    ?>




    <br><br>

    <?php
    $sqlSelect = "SELECT * from chapters";

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

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['chapter'] ?></td>
                    <?php
                    if ($_SESSION['access_type'] == "Admin" || $_SESSION['access_type'] == "Teacher") {
                    ?>
                        <td><a href="chapters.php?edit=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">Edit</a>
                            <a href="chapters.php?delete=<?php echo $row["id"]; ?>" class="del_btn btn btn-danger">Delete</a>
                        </td>

                    <?php
                    }
                    ?>

                </tr>
            <?php
            }
            ?>
        </table>
        <br>
        <a href="education_desk.php" class="back-btn">Back</a>
    <?php
    } else {
        echo "data not found";
    }

    ?>
</body>

</html>