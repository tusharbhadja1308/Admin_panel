<?php
require "../db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    <form action="" method="post">
        <label> Select Standards :</label>
        <select name="select_std">
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
        <select name="select_student">
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

    <br><br>
    <a href="education_desk.php" class="back-btn">Back</a>
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



<!-- INSERT INTO `student_relation` (`id`, `student_id`, `sub_id`) VALUES (NULL, '13', '2'), (NULL, '13', '3'); -->

<!-- $select_student_sql = "SELECT usertype.*, info.username AS student_name 
                                JOIN info ON usertype.user_id = info.id
                                JOIN accesstype ON usertype.user_type = accesstype.id
                                WHERE user_type = 3 "; -->