<?php
require "db.php";

$showAlert = true;
$showError = false;
$username = "";
$contact = "";
$age = "";
$email = "";
$password = "";
// $cpassword = "";


// if (isset($_POST["register"])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = trim($_POST['username']);
    $contact = trim($_POST['contact']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    // $cpassword = $_POST['cpassword'];


    $sql_exists = "SELECT * FROM `info` WHERE  `email` = '$email'";
    $exists_result = mysqli_query($conn, $sql_exists);
    $num_exists_row = mysqli_num_rows($exists_result);

    if ($num_exists_row > 0) {
        $showError = "Email already exists";
    } else {

        if ($exists == false) {

            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            $sql_insert = "INSERT INTO `info` (`username`, `contact`, `age`, `email`, `password`) VALUES ('$username', '$contact', '$age', '$email', '$hash_password')";
            $insert_result = mysqli_query($conn, $sql_insert);



            if ($insert_result) {
                $showAlert = false;
                header('Location: welcome.php');
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <!-- <title>Neumorphism Login Form UI | CodingNepal</title> -->
    <link rel="stylesheet" href="login_logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="register.css">
    <style>
        a{
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
        a:focus{
            color: #3498db;
            box-shadow: inset 2px 2px 5px #BABECC,
                inset -5px -5px 10px #ffffff73;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="text">
            Add User Form
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

            <input type="submit" value="Add User" name="register">

            <a href="welcome.php">Back</a>

        </form>
    </div>
</body>

</html>