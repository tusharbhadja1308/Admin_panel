<?php
    if(isset($_POST['submit'])){
        $password = $_POST['password'];
        echo $password;
        echo "<br>";
        $hash = password_hash("$password", PASSWORD_DEFAULT);
        echo $hash;

        if(password_verify($password,$hash)){
            echo "<br> password verify";
        }else{
            echo "kdajskfj";
        }
    }
?>

<form action="" method="post">
    <input type="password" name="password">
    <input type="submit" name="submit">
</form>