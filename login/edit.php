<?php

    include "db.php";
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = "SELECT * FROM info WHERE id=$id";
        $result= mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);

        if($data){
            $id = $data['id'];
            $username = $data['username'];
            $contact = $data['contact'];
            $age = $data['age'];
            $email = $data['email'];
        } else{
            echo "error in fetching data";
        }
    
    }

    if(isset($_FILES['upload_profile'])){

        $file_name = $_FILES['upload_profile']['name'];
        $file_type = $_FILES['upload_profile']['type'];
        $file_tmp = $_FILES['upload_profile']['tmp_name'];
        $file_size = $_FILES['upload_profile']['size'];

        $roll_no = $_REQUEST['edit'];
        $name = $_REQUEST['username'];

        $file_ext = strtolower(end(explode('.', $_FILES['upload_profile']['name'])));
        $newfilename = $name."_".$roll_no.".".$file_ext;

        // echo $newfilename;

        if(move_uploaded_file($file_tmp,"images/".$newfilename)){
            echo  "<br>" . "File uploaded succesfully" . "<br><br>";
        } else{
            echo "File not uploaded";
        }
    }


     if(isset($_POST['update'])){
        // $id = $_POST['id'];
        $id = $_GET['edit'];
        $username = $_POST['username'];
            $contact = $_POST['contact'];
            $age = $_POST['age'];
            $post_email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            


            $sql_exists = "SELECT * FROM `info` WHERE  `email` = '$post_email'";
    $exists_result = mysqli_query($conn, $sql_exists);
    $num_exists_row = mysqli_num_rows($exists_result);

    if ($num_exists_row > 0 ) {
        
        if($email !== $post_email){
            $showError = "Email already exists";
        } 
    } else {

        if (($password == $cpassword) && $exists == false) {

            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE info SET username='$username', contact='$contact', age='$age', email='$post_email', password='$hash_password', profile_img='$newfilename' WHERE id=$id";

            $result = mysqli_query($conn, $sql_update);
            if ($result) {
                $showAlert = false;
                $showError = "Data Upadated Succesfully";
            
            }
        } else {
            $showError = "Password does not match";
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
    <link rel="stylesheet" href="login_logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="register.css">
    
</head>
<body>
    <div class="content">
        <div class="text">
            Edit Form
        </div>

        <div class="message">
            <?php if ($showAlert) {
                echo "You have some Problem in Register";
            } ?>
        </div>
        <div class="message">
            <?php if ($showError) {
                echo $showError;
            } ?>
        </div>
    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
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
                <input type="file" accept="image/*" name="upload_profile">
                <label for="upload_profile">Upload Profile Image</label>
            </div>
        <input type="submit" value="update" name="update" >
        <a href="view_data.php" class="btn btn-primary">Go Back</a>
    </form>
    </div>
</body>
</html>