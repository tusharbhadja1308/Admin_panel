<?php
session_start();

if(isset($_SESSION['email'])){
    header("Location: welcome.php");
}
require "db.php";

$login = true;
$showError = false;

$email = "";
$password = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $exists = false;


$sql_select = "SELECT info.*, accesstype.access_type AS access_type_name 
            FROM `info` 
            JOIN usertype ON info.id = usertype.user_id 
            JOIN accesstype ON usertype.user_type = accesstype.id 
            WHERE email = '$email'";

            $select_result = mysqli_query($conn, $sql_select);

    $num = mysqli_num_rows($select_result);


    if ($num == 1) {

        while ($row = mysqli_fetch_assoc($select_result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['access_type'] = $row['access_type_name'];
                header("Location: welcome.php");
            } else {
                $showError = "Email and Password Does not match";
            }
        }
    } else {
        $showError = "Email and Password Does not asd match";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="login_logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

    <div class="content">
        <div class="text">
            Login Form
        </div>
        <div class="message">
            <?php
            if ($showError) {
                echo $showError;
            }
            ?>
        </div>
        <form action="" method="post">
            <div class="field">
                <input type="email" name="email" value="<?php echo $email; ?>" required>
                <span class="fas fa-user"></span>
                <label>Email</label>
            </div>
            <div class="field">
                <input type="password" name="password" value="<?php echo $password; ?>" required>
                <span class="fas fa-lock"></span>
                <label>Password</label>
            </div>

            <input type="submit" value="Login" name="login">
            <div class="sign-up">
                Not have an account? <br>
                <a href="register.php">Register now</a>
            </div>
        </form>
    </div>
</body>

</html>