<?php

require "../db.php";

$showAlert = true;
$showError = false;
$username = "";
$contact = "";
$age = "";
$email = "";
$password = "";
$cpassword = "";


// if (isset($_POST["register"])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = trim($_POST['username']);
    $contact = trim($_POST['contact']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $accesstype = $_POST['accesstype'];
    $exists = false;


    $sql_exists = "SELECT * FROM `info` WHERE  `email` = '$email'";
    $exists_result = mysqli_query($conn, $sql_exists);
    $num_exists_row = mysqli_num_rows($exists_result);

    $fetch_exists_result_id = mysqli_fetch_assoc($exists_result);
    $exists_result_id = $fetch_exists_result_id['id'];



    if ($num_exists_row > 0) {
        $showError = "Email already exists";
    } else {

        if (($password == $cpassword) && $exists == false) {

            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO `info` (`username`, `contact`, `age`, `email`, `password`,`profile_img`) VALUES ('$username', '$contact', '$age', '$email', '$hash_password', '')";
            $insert_result = mysqli_query($conn, $sql_insert);

            if ($insert_result) {
                $sql_exists = "SELECT * FROM `info` WHERE  `email` = '$email'";
                $exists_result = mysqli_query($conn, $sql_exists);

                $fetch_exists_result_id = mysqli_fetch_assoc($exists_result);
                $exists_result_id = $fetch_exists_result_id['id'];

                $sql_usertype_insert = "INSERT INTO `usertype` (`user_id`,`user_type`) VALUES ('$exists_result_id','$accesstype')";

                $usertype_insert_result = mysqli_query($conn, $sql_usertype_insert);

                if ($usertype_insert_result) {
                    $showAlert = false;
                    header('Location: index.php');
                } else {
                    $showError = "Error in insert userype";
                }
            } else {
                $showError = "Error in data update";
            }
        } else {
            $showError = "Password does not match";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/login_logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/register.css">
</head>

<body>


    <div class="content">
        <div class="text">
            Register Form
        </div>

        <div class="message">
            <?php if (!$showAlert) {
                echo "You have some Problem in Register";
            } ?>
        </div>
        <div class="message">
            <?php if ($showError) {
                echo $showError;
            } ?>
        </div>
        <form action="" method="post">
            <div class="field">
                <input type="text" name="username" maxlength="20" value="<?php echo $username; ?>" required>
                <span class="fas fa-user"></span>
                <label>Username</label>
            </div>
            <div class="field">
                <input type="number" name="contact" value="<?php echo $contact; ?>" required>
                <span class="fas fa-user"></span>
                <label>Contact</label>
            </div>
            <div class="field">
                <input type="number" name="age" value="<?php echo $age; ?>" required>
                <span class="fas fa-user"></span>
                <label>Age</label>
            </div>
            <div class="field">
                <input type="email" name="email" value="<?php echo $email; ?>" required>
                <span class="fas fa-user"></span>
                <label>Email</label>
            </div>
            <div class="field">
                <input type="password" name="password" maxlength="20" value="<?php echo $password; ?>" required>
                <span class="fas fa-lock"></span>
                <label>Password</label>
            </div>
            <div class="field">
                <input type="password" name="cpassword" maxlength="20" value="<?php echo $cpassword; ?>" required>
                <span class="fas fa-lock"></span>
                <label>Confirm Password</label>
            </div>
            <div class="field">
                <div class="accesstype" style="width:200px;">
                    <select name="accesstype">
                        <option value="">Select User Type</option>
                        <?php
                        $select_accesstype_sql = "SELECT * FROM accesstype";
                        $select_accesstype_result = mysqli_query($conn, $select_accesstype_sql);

                        while ($fetch_value  = mysqli_fetch_assoc($select_accesstype_result)) {
                            $fetch_accesstype_value = $fetch_value['access_type'];
                            $fetch_accesstype_id = $fetch_value['id'];
                            echo "<option value='$fetch_accesstype_id'>" . $fetch_accesstype_value . "</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>


            <input type="submit" value="Register" name="register">



            <div class="sign-up">
                Already have an account? <br>
                <a href="../login/login.php">Login now</a>
            </div>
        </form>
    </div>
</body>

</html>