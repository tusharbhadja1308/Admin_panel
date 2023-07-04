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
        <label> Select Subject :</label>
        <select name="select_sub">
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
        <select name="select_chapter">
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

    <br><br>
    <a href="education_desk.php" class="back-btn">Back</a>
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